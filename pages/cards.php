<?php
// pages/cards.php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/utils.php';

// Fetch Accounts to generate "Virtual" cards
$user_id = $_SESSION['user_id'];
try {
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $accounts = $stmt->fetchAll();
} catch (PDOException $e) {
    $accounts = [];
}

// Generate cards from accounts (1-to-1 mapping for demo)
$cards = [];
foreach ($accounts as $index => $acc) {
    // Deterministic pseudo-random generation based on account ID
    $cards[] = [
        'id' => 'card_' . $acc['id'],
        'type' => ($index % 2 == 0) ? 'Debit' : 'Credit', // Alternate types
        'network' => ($index % 2 == 0) ? 'Visa' : 'Mastercard',
        'number' => 'XXXX •••• •••• ' . substr($acc['account_number'], -4),
        'expiry' => '12/' . (26 + $index),
        'holder' => strtoupper($_SESSION['full_name']),
        'status' => 'Active',
        'limit' => 5000.00,
        'balance' => $acc['balance'] // Link balance
    ];
}

$page_title = "Cards";
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<main class="main-content flex-grow-1 bg-light">
    <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h1 class="h2 mb-0">My Cards</h1>
        <a href="#" class="btn btn-sm btn-primary">Request Replacement</a>
    </header>

    <div class="row">
        <?php if (empty($cards)): ?>
            <div class="alert alert-info">No active cards found.</div>
        <?php else: ?>
            <?php foreach ($cards as $card): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 card-visual-wrapper border-0 shadow-sm">
                        <!-- Visual Card Representation CSS-only -->
                        <div class="card-visual p-4 text-white mb-3 rounded-4 bg-gradient-dark position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <span class="badge bg-light text-dark opacity-75"><?php echo $card['type']; ?></span>
                                <i class="bi bi-wifi fs-4"></i>
                            </div>
                            <div class="mb-4">
                                <div class="small opacity-50 text-uppercase letter-spacing-2">Card Number</div>
                                <div class="fs-5 fw-bold font-monospace"><?php echo $card['number']; ?></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <div class="small opacity-50 text-uppercase">Card Holder</div>
                                    <div class="fw-bold"><?php echo $card['holder']; ?></div>
                                </div>
                                <div class="text-end">
                                    <div class="small opacity-50 text-uppercase">Expires</div>
                                    <div class="fw-bold"><?php echo $card['expiry']; ?></div>
                                </div>
                            </div>
                            <!-- Network Icon Placeholder -->
                            <div class="position-absolute bottom-0 end-0 p-3 opacity-25">
                                <i class="bi bi-credit-card-2-front fs-1"></i>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h3 class="h6 mb-0"><?php echo $card['network']; ?> <?php echo $card['type']; ?></h3>
                                    <span class="small text-muted">Linked to <?php echo substr($card['number'], -4); ?></span>
                                </div>
                                <?php if ($card['status'] === 'Active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle"><?php echo $card['status']; ?></span>
                                <?php endif; ?>
                            </div>

                            <ul class="list-group list-group-flush border-top border-bottom mb-3">
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <i class="bi bi-lock me-2 text-muted"></i>
                                        Lock Card
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input card-lock-toggle" type="checkbox" role="switch" 
                                            data-card-id="<?php echo $card['id']; ?>"
                                            <?php echo ($card['status'] !== 'Active') ? 'checked' : ''; ?>>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <i class="bi bi-globe me-2 text-muted"></i>
                                        Travel Notice
                                    </div>
                                    <i class="bi bi-chevron-right text-muted"></i>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="cardIoast" class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Card status updated.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>