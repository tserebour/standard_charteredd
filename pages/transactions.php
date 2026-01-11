<?php
// pages/transactions.php
require_once __DIR__ . '/../includes/utils.php';

$data = get_data();
$transactions = $data['transactions'];
$accounts = $data['accounts'];
$page_title = "Transactions";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <header class="mb-4 pb-3 border-bottom">
        <h1 class="h2 mb-3">Transactions</h1>

        <!-- Filters (Visual only) -->
        <div class="d-flex flex-wrap gap-2">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="txSearch" placeholder="Search transactions...">
            </div>

            <select class="form-select w-auto">
                <option selected>All Accounts</option>
                <?php foreach ($accounts as $acc): ?>
                    <option value="<?php echo $acc['id']; ?>">
                        <?php echo $acc['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button class="btn btn-outline-secondary"><i class="bi bi-calendar3 me-2"></i>Date Range</button>
            <button class="btn btn-outline-secondary"><i class="bi bi-download me-2"></i>Export</button>
        </div>
    </header>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="txTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th class="text-end pe-4">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $tx): ?>
                            <tr class="tx-row">
                                <td class="ps-4 text-nowrap text-secondary small">
                                    <?php echo date('d M Y', strtotime($tx['date'])); ?>
                                </td>
                                <td>
                                    <div class="fw-medium text-truncate" style="max-width: 350px;">
                                        <?php echo htmlspecialchars($tx['description']); ?>
                                    </div>
                                    <div class="small text-muted font-monospace">
                                        <?php echo $tx['id']; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border fw-normal">Uncategorized</span>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="fw-bold <?php echo ($tx['amount'] < 0) ? '' : 'text-success'; ?>">
                                        <?php echo format_currency($tx['amount']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- Empty State (Hidden by default) -->
                        <tr id="noResults" class="d-none">
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted mb-2"><i class="bi bi-search fs-1"></i></div>
                                <p class="h6 text-muted">No transactions found matching your criteria.</p>
                                <button class="btn btn-sm btn-outline-primary" onclick="resetFilters()">Reset
                                    Filters</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white py-3 border-top-0">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

<script>
    // Simple client-side search
    const searchInput = document.getElementById('txSearch');
    const table = document.getElementById('txTable');

    if (searchInput && table) {
        searchInput.addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr.tx-row');
            let hasVisible = false;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.classList.remove('d-none');
                    hasVisible = true;
                } else {
                    row.classList.add('d-none');
                }
            });

            const noResults = document.getElementById('noResults');
            if (noResults) {
                if (!hasVisible) noResults.classList.remove('d-none');
                else noResults.classList.add('d-none');
            }
        });
    }

    function resetFilters() {
        if (searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('keyup'));
        }
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>