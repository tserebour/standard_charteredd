<div class="sidebar d-flex flex-column flex-shrink-0 p-0" style="width: 280px;">
    <div class="p-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <span class="fs-4 fw-bold text-brand">Standard Chartered</span>
        </a>
    </div>
    <ul class="nav nav-pills flex-column mb-auto py-2">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link active" aria-current="page">
                <i class="bi bi-speedometer2 me-2"></i>
                Overview
            </a>
        </li>
        <li>
            <a href="transfers-new.php" class="nav-link link-dark">
                <i class="bi bi-arrow-left-right me-2"></i>
                Transfers
            </a>
        </li>
        <li>
            <a href="cards.php" class="nav-link link-dark">
                <i class="bi bi-credit-card me-2"></i>
                Cards
            </a>
        </li>
        <li>
            <a href="transactions.php" class="nav-link link-dark">
                <i class="bi bi-list-check me-2"></i>
                Transactions
            </a>
        </li>
    </ul>
    <div class="p-4 border-top">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white"
                    style="width: 40px; height: 40px;">
                    AM
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <div class="fw-bold">
                    <?php echo htmlspecialchars($_SESSION['full_name'] ?? 'User'); ?>
                </div>
                <div class="small text-muted">ID:
                    <?php echo $_SESSION['user_id'] ?? '...'; ?>
                </div>
            </div>
            <a href="login.php" class="text-muted"><i class="bi bi-box-arrow-right"></i></a>
        </div>
    </div>
</div>