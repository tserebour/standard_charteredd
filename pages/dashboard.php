<?php
// pages/dashboard.php
require_once __DIR__ . '/../includes/utils.php';

$data = get_data();
$user = $data['user'];
$accounts = $data['accounts'];
$page_title = "Overview";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Sidebar is included in header.php wrapper if we structure it right, 
     but currently header.php just opens <body d-flex>. 
     Let's verify header structure.
     Header opens <div class="d-flex">.
-->
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <!-- Top Bar -->
    <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h2 mb-0">Good afternoon,
                <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?>
            </h1>
            <p class="text-muted small mb-0">Last login:
                <?php echo htmlspecialchars($user['last_login']); ?>
            </p>
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
            <?php foreach ($accounts as $account): ?>
                <?php include __DIR__ . '/../includes/components/account-summary.php'; ?>
            <?php endforeach; ?>
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