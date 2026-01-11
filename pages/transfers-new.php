<?php
// pages/transfers-new.php
require_once __DIR__ . '/../includes/utils.php';

$data = get_data();
$accounts = $data['accounts'];
$page_title = "New Transfer";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <!-- Top Bar -->
    <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h1 class="h2 mb-0">Transfers</h1>
        <div class="d-flex align-items-center gap-3">
            <a href="#" class="btn btn-sm btn-outline-secondary">Help</a>
        </div>
    </header>

    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Wizard Progress (Optional visual) -->
                <div class="mb-4 d-none" id="wizardProgress">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 33%" id="progressBar"></div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <!-- Step 1: Details -->
                        <div id="transferStep1">
                            <h2 class="h4 mb-4">Transfer Details</h2>
                            <form id="transferForm">
                                <div class="mb-3">
                                    <label class="form-label">From Account</label>
                                    <select class="form-select form-select-lg" id="fromAccount">
                                        <?php foreach ($accounts as $acc): ?>
                                            <option value="<?php echo $acc['id']; ?>"
                                                data-name="<?php echo $acc['name']; ?>"
                                                data-num="<?php echo mask_account($acc['number']); ?>"
                                                data-bal="<?php echo $acc['balance']; ?>">
                                                <?php echo $acc['name']; ?> (
                                                <?php echo mask_account($acc['number']); ?>) -
                                                <?php echo format_currency($acc['balance'], $acc['currency']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">To Payee</label>
                                    <select class="form-select" id="toPayee">
                                        <option value="new">Add New Payee...</option>
                                        <option value="saved_1">Electric Company</option>
                                        <option value="saved_2">Mom & Dad</option>
                                        <option value="saved_3">Landlord</option>
                                        <?php
                                        // Add internal accounts as payees too (excluding current)
                                        foreach ($accounts as $acc) {
                                            echo "<option value='internal_{$acc['id']}'>{$acc['name']} (Internal)</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3 d-none" id="newPayeeFields">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small">Payee Name</label>
                                            <input type="text" class="form-control" id="payeeName">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small">Account Number</label>
                                            <input type="text" class="form-control" id="payeeIban">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Amount</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="amount" step="0.01" min="0.01"
                                                placeholder="0.00">
                                        </div>
                                        <div class="form-text text-danger d-none" id="amountError">Insufficient funds.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control form-control-lg" id="date"
                                            value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="button" class="btn btn-primary btn-lg" id="btnToReview">Continue to
                                        Review</button>
                                </div>
                            </form>
                        </div>

                        <!-- Step 2: Review -->
                        <div id="transferStep2" class="d-none">
                            <h2 class="h4 mb-4">Review Transfer</h2>

                            <dl class="row mb-4">
                                <dt class="col-sm-4 text-muted">From</dt>
                                <dd class="col-sm-8 fw-bold" id="reviewFrom">Everyday Checking</dd>

                                <dt class="col-sm-4 text-muted">To</dt>
                                <dd class="col-sm-8 fw-bold" id="reviewTo">Electric Company</dd>

                                <dt class="col-sm-4 text-muted">Date</dt>
                                <dd class="col-sm-8" id="reviewDate">Today</dd>

                                <dt class="col-sm-4 text-muted">Amount</dt>
                                <dd class="col-sm-8 fs-4 fw-bold text-brand" id="reviewAmount">$0.00</dd>

                                <dt class="col-sm-4 text-muted">Fees</dt>
                                <dd class="col-sm-8">$0.00</dd>
                            </dl>

                            <!-- Large Transfer Confirmation (Conditional) -->
                            <div class="alert alert-warning d-none mb-4" id="largeTransferWarning">
                                <i class="bi bi-shield-exclamation me-2"></i>
                                <strong>Large Transfer:</strong> Please verify details carefully.
                            </div>

                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-outline-secondary flex-fill"
                                    id="btnBackToStep1">Edit</button>
                                <button type="button" class="btn btn-primary flex-fill fw-bold" id="btnConfirm">Confirm
                                    Transfer</button>
                            </div>
                        </div>

                        <!-- Step 3: Success -->
                        <div id="transferStep3" class="d-none text-center py-4">
                            <div class="mb-4 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                            </div>
                            <h2 class="h4">Transfer Successful</h2>
                            <p class="text-muted">Your transaction has been processed.</p>

                            <div class="bg-light p-3 rounded d-inline-block mb-4 text-start">
                                <div class="small text-muted mb-1">Reference ID</div>
                                <div class="font-monospace fw-bold" id="successRef">TR-XXXXXXXX</div>
                            </div>

                            <div class="d-grid gap-2 col-md-6 mx-auto">
                                <a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a>
                                <button type="button" class="btn btn-link text-decoration-none"
                                    onclick="location.reload()">Make another transfer</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>