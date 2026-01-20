<?php
// pages/transfers-new.php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/utils.php';

// Fetch Accounts
$user_id = $_SESSION['user_id'];
$accounts = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $accounts = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handling
}

$success_ref = $_GET['ref'] ?? null;
$page_title = "New Transfer";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <header class="mb-4 pb-3 border-bottom">
        <h1 class="h2 mb-0">Make a Transfer</h1>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <?php if ($success_ref): ?>
                        <!-- Success State (Server Rendered) -->
                        <div id="transferStep3" class="text-center animate-fade-in">
                            <div class="mb-4">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-check-lg fs-1"></i>
                                </div>
                            </div>
                            <h3 class="h4 mb-3">Transfer Successful!</h3>
                            <p class="text-muted mb-4">Your funds have been securely transferred.</p>

                            <div class="bg-light p-3 rounded mb-4 d-inline-block">
                                <span class="text-muted small d-block">Reference ID</span>
                                <span class="font-monospace fw-bold" id="successRef">
                                    <?php echo htmlspecialchars($success_ref); ?>
                                </span>
                            </div>

                            <div class="d-grid gap-2 d-sm-flex justify-content-center">
                                <a href="dashboard.php" class="btn btn-outline-secondary">Return to Dashboard</a>
                                <a href="transfers-new.php" class="btn btn-primary">Make Another Transfer</a>
                            </div>
                        </div>
                    <?php else: ?>

                        <!-- Standard Form Submission -->
                        <form id="transferForm" action="../actions/process-transfer.php" method="POST">
                            <div id="transferStep1">
                                <h3 class="h5 mb-4">Transfer Details</h3>

                                <div class="mb-3">
                                    <label class="form-label">From Account</label>
                                    <select class="form-select" id="fromAccount" name="from_account">
                                        <?php foreach ($accounts as $acc): ?>
                                            <option value="<?php echo $acc['id']; ?>" data-bal="<?php echo $acc['balance']; ?>"
                                                data-num="<?php echo $acc['account_number']; ?>"
                                                data-name="<?php echo $acc['type']; ?>">
                                                <?php echo $acc['type']; ?> (...
                                                <?php echo substr($acc['account_number'], -4); ?>)
                                                -
                                                <?php echo format_currency($acc['balance']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">To Payee</label>
                                    <select class="form-select" id="toPayee" name="to_payee">
                                        <option value="new">Select Payee...</option>
                                        <optgroup label="My Accounts">
                                            <?php foreach ($accounts as $acc): ?>
                                                <option value="<?php echo $acc['id']; ?>">
                                                    <?php echo $acc['type']; ?> (...
                                                    <?php echo substr($acc['account_number'], -4); ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                        <optgroup label="Recent">
                                            <option value="external_1">Mom & Dad</option>
                                            <option value="external_2">Landlord</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <input type="hidden" name="payee_name" id="hiddenPayeeName" value="External">

                                <div id="newPayeeFields" class="d-none mb-3 p-3 bg-light rounded">
                                    <div class="mb-2">
                                        <label class="form-label small">Payee Name</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small">Account Number</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="amount" name="amount" Place="0.00"
                                            step="0.01">
                                    </div>
                                    <div id="amountError" class="form-text text-danger d-none">
                                        Insufficient funds.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary" id="btnToReview">Continue to
                                        Review</button>
                                </div>
                            </div>

                            <!-- Step 2: Review (Client-side display only, assuming no sensitive data leak) -->
                            <div id="transferStep2" class="d-none">
                                <h3 class="h5 mb-4">Review Transfer</h3>

                                <div class="bg-light p-3 rounded mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">From</span>
                                        <span class="fw-bold" id="reviewFrom">Checking (...)</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">To</span>
                                        <span class="fw-bold" id="reviewTo">Mom & Dad</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Date</span>
                                        <span id="reviewDate">2023-10-25</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Amount</span>
                                        <span class="fs-4 fw-bold text-primary" id="reviewAmount">$0.00</span>
                                    </div>
                                </div>

                                <div id="largeTransferWarning" class="alert alert-warning d-flex align-items-center d-none"
                                    role="alert">
                                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"></i>
                                    <div>
                                        Large transfer detected. Please review carefully.
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary" id="btnConfirm">Confirm Transfer</button>
                                    <button type="button" class="btn btn-outline-secondary" id="btnBackToStep1">Back to
                                        Edit</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnConfirm = document.getElementById('btnConfirm');
        const form = document.getElementById('transferForm');
        const payeeSelect = document.getElementById('toPayee');
        const hiddenPayeeName = document.getElementById('hiddenPayeeName');

        if (btnConfirm && form) {
            // Replace button to remove existing listeners
            const newBtn = btnConfirm.cloneNode(true);
            btnConfirm.parentNode.replaceChild(newBtn, btnConfirm);

            newBtn.addEventListener('click', () => {
                const modal = new bootstrap.Modal(document.getElementById('transferUnavailableModal'));
                modal.show();
            });
        }
    });
</script>

<?php include __DIR__ . '/../includes/components/transfer-modal.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>