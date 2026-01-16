<?php
// includes/components/account-summary.php
// Expects $account to be set
?>
<div class="col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                <?php echo htmlspecialchars($account['type']); ?>
            </span>
            <span class="text-muted small">
                <?php echo mask_account($account['number']); ?>
            </span>
        </div>
        <div class="card-body">
            <h3 class="card-title h5 mb-3">
                <?php echo htmlspecialchars($account['name']); ?>
            </h3>
            <div class="mb-4">
                <div class="text-muted small text-uppercase">Current Balance</div>
                <div class="fs-3 fw-bold">
                    <?php echo format_currency($account['balance'], $account['currency']); ?>
                </div>
                <?php if ($account['balance'] < 0): ?>
                    <div class="mt-2">
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                            <i class="bi bi-exclamation-circle me-1"></i> Overdrawn
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-grid gap-2 d-md-flex">
                <a href="transfers-new.php?from=<?php echo $account['id']; ?>" class="btn btn-sm btn-primary">
                    Transfer
                </a>
                <a href="transactions.php?account=<?php echo $account['id']; ?>"
                    class="btn btn-sm btn-outline-secondary">
                    View Transactions
                </a>
            </div>
        </div>
    </div>
</div>