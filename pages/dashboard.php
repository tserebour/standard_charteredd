<?php
// pages/dashboard.php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/utils.php';

// Fetch current user details if needed (mostly session has it)
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['full_name'] ?? '';

// Fetch Accounts
try {
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $accounts = $stmt->fetchAll();
} catch (PDOException $e) {
    // In a real app we'd show a friendly error
    $accounts = [];
}

$page_title = "Overview";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <!-- Top Bar -->
    <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h2 mb-0">Good afternoon,
                <?php echo htmlspecialchars($user_name ? explode(' ', $user_name)[0] : 'User'); ?>
            </h1>
            <p class="text-muted small mb-0">Last login: <?php echo date('Y-m-d H:i'); // Place for now ?></p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="#" class="text-secondary position-relative">
                <i class="bi bi-bell fs-5"></i>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </a>
            <a href="#" class="btn btn-sm btn-outline-secondary">Help</a>
        </div>
    </header>

    <!-- Account Summary Section -->
    <section class="mb-5">
        <h2 class="h4 mb-3">Your Accounts</h2>
        <div class="row">
            <?php if (empty($accounts)): ?>
                <div class="alert alert-info">No accounts found.</div>
            <?php else: ?>
                <?php foreach ($accounts as $account): ?>
                    <?php
                    // Ensure keys match what component checks
                    // Database columns are: id, user_id, type, account_number, balance, currency
                    // Component expects: type, number, name, balance, currency.
                    // We map 'type' + ' Account' to 'name' for display if needed or just query it.
                    $account['name'] = $account['type'] . ' Account';
                    $account['number'] = $account['account_number'];

                    include __DIR__ . '/../includes/components/account-summary.php';
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Quick Actions / Promo (Optional filler) -->
    <section>
        <div class="card bg-brand text-white border-0">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="h5">Need to send money abroad?</h3>
                    <p class="mb-0 small text-white-50">Global transfers are now fee-free for premium accounts.</p>
                </div>
                <a href="transfers-new.php" class="btn btn-light btn-sm fw-bold">Send Money</a>
            </div>
        </div>
    </section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>