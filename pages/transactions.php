<?php
// pages/transactions.php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/utils.php';

$user_id = $_SESSION['user_id'];
$page_title = "Transactions";

// 1. Fetch User Accounts for Filter
try {
    $stmtAcct = $pdo->prepare("SELECT id, type, account_number FROM accounts WHERE user_id = ?");
    $stmtAcct->execute([$user_id]);
    $accounts = $stmtAcct->fetchAll();
    // Get list of Account IDs for validation
    $account_ids = array_column($accounts, 'id');
} catch (PDOException $e) {
    $accounts = [];
    $account_ids = [];
}

// 2. Build Query Filters
$where = ["t.account_id IN (SELECT id FROM accounts WHERE user_id = ?)"];
$params = [$user_id];

// Filter: Account
if (!empty($_GET['account']) && in_array($_GET['account'], $account_ids)) {
    $where[] = "t.account_id = ?";
    $params[] = $_GET['account'];
}

// Filter: Search (Description)
if (!empty($_GET['search'])) {
    $where[] = "t.description LIKE ?";
    $params[] = '%' . $_GET['search'] . '%';
}

// Filter: Date
if (!empty($_GET['date_from'])) {
    $where[] = "t.created_at >= ?";
    $params[] = $_GET['date_from'] . ' 00:00:00';
}
if (!empty($_GET['date_to'])) {
    $where[] = "t.created_at <= ?";
    $params[] = $_GET['date_to'] . ' 23:59:59';
}

// 3. Pagination Setup
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
    $page = 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Count Total
$sqlCount = "SELECT COUNT(*) FROM transactions t JOIN accounts a ON t.account_id = a.id WHERE " . implode(" AND ", $where);
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute($params);
$total_rows = $stmtCount->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// Fetch Data
// Note: We join accounts to maybe show valid account name if needed, but mostly just filtering.
$sql = "SELECT t.*, a.type as account_type FROM transactions t 
        JOIN accounts a ON t.account_id = a.id 
        WHERE " . implode(" AND ", $where) . " 
        ORDER BY t.created_at DESC 
        LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$transactions = $stmt->fetchAll();

?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h1 class="h2 mb-0">Transactions</h1>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download me-1"></i> Export
            </button>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-printer me-1"></i> Print
            </button>
        </div>
    </header>

    <!-- Filters -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="transactions.php" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" name="search" Place="Description..."
                            value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Account</label>
                    <select class="form-select" name="account" onchange="this.form.submit()">
                        <option value="">All Accounts</option>
                        <?php foreach ($accounts as $acc): ?>
                            <option value="<?php echo $acc['id']; ?>" <?php echo (isset($_GET['account']) && $_GET['account'] == $acc['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($acc['type']); ?>
                                (...<?php echo substr($acc['account_number'], -4); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Date filters could go here too, preserving existing GET params if complex JS, but simplified for now -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a href="transactions.php" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Date</th>
                            <th class="py-3">Description</th>
                            <th class="py-3">Category</th>
                            <th class="pe-4 py-3 text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    No transactions found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transactions as $t): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold"><?php echo date('M d, Y', strtotime($t['created_at'])); ?></div>
                                        <div class="small text-muted"><?php echo date('H:i', strtotime($t['created_at'])); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-truncate" style="max-width: 250px;">
                                            <?php echo htmlspecialchars($t['description']); ?>
                                        </div>
                                        <div class="small text-muted"><?php echo htmlspecialchars($t['account_type']); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?php echo ucfirst($t['type']); ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="fw-bold <?php echo $t['amount'] < 0 ? 'text-dark' : 'text-success'; ?>">
                                            <?php echo ($t['amount'] > 0 ? '+' : '') . format_currency($t['amount']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="card-footer bg-white py-3">
                <nav>
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="?page=<?php echo $page - 1; ?>&account=<?php echo htmlspecialchars($_GET['account'] ?? ''); ?>&search=<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="?page=<?php echo $i; ?>&account=<?php echo htmlspecialchars($_GET['account'] ?? ''); ?>&search=<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="?page=<?php echo $page + 1; ?>&account=<?php echo htmlspecialchars($_GET['account'] ?? ''); ?>&search=<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>