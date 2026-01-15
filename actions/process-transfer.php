<?php
// actions/process-transfer.php
session_start();
require_once __DIR__ . '/../config/db.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $from_account_id = $_POST['from_account'];
    $amount = (float) ($_POST['amount'] ?? 0);
    $payee_name = $_POST['payee_name'] ?? 'Unknown Payee'; // Simplified for demo
    $date = $_POST['date'] ?? date('Y-m-d');

    // Logic for "To Payee" - simplified
    // If payee is "Savings", we try to find the user's savings account.
    // If it's external, we just deduct. 
    // Docs say "Internal transfers only", "Accounts must belong to the same user".
    // So we need to handle "Transfer to own account" vs "Payment to external".
    // But the schema implies we can transfer to another account.
    // Let's check `to_payee` value from form.
    $to_payee_raw = $_POST['to_payee'];

    // Validate inputs
    if ($amount <= 0) {
        die("Invalid amount.");
    }

    try {
        $pdo->beginTransaction();

        // 1. Verify From Account Ownership & Balance
        $stmtEx = $pdo->prepare("SELECT balance FROM accounts WHERE id = ? AND user_id = ? FOR UPDATE");
        $stmtEx->execute([$from_account_id, $user_id]);
        $fromAcc = $stmtEx->fetch();

        if (!$fromAcc) {
            throw new Exception("Source account not found or access denied.");
        }
        if ($fromAcc['balance'] < $amount) {
            throw new Exception("Insufficient funds.");
        }

        // 2. Determine To Account (Logic for demo)
        // If the user selected another one of their accounts, we krediting it.
        // We'll look up if 'to_payee' matches an account ID (heuristic).
        // Since the select output in UI isn't strictly IDs, we might fallback to just 'Deduced' logic if not found.
        // But let's assume if it matches an integer, it's an account ID. Or we check if it's 'new'.

        $target_account_id = null;
        if (is_numeric($to_payee_raw) && $to_payee_raw != $from_account_id) {
            // Check if this target account exists (even if not verified perfectly as owned by user in broad placeholder, but docs say internal transfer = same user?)
            // "Accounts must belong to the same user" -> OK so we check if it is owned by user.
            $stmtCheck = $pdo->prepare("SELECT id FROM accounts WHERE id = ? AND user_id = ?");
            $stmtCheck->execute([$to_payee_raw, $user_id]);
            if ($stmtCheck->fetch()) {
                $target_account_id = $to_payee_raw;
            }
        }

        // 3. Deduct from Source
        $newRef = 'TR-' . strtoupper(substr(md5(uniqid()), 0, 8));

        $updateSrc = $pdo->prepare("UPDATE accounts SET balance = balance - ? WHERE id = ?");
        $updateSrc->execute([$amount, $from_account_id]);

        $logSrc = $pdo->prepare("INSERT INTO transactions (account_id, amount, type, description, reference_id, created_at) VALUES (?, ?, 'transfer', ?, ?, ?)");
        $logSrc->execute([$from_account_id, -$amount, "Transfer to $payee_name", $newRef, $date]);

        // 4. Credit Target (if internal)
        if ($target_account_id) {
            $updateDest = $pdo->prepare("UPDATE accounts SET balance = balance + ? WHERE id = ?");
            $updateDest->execute([$amount, $target_account_id]);

            $logDest = $pdo->prepare("INSERT INTO transactions (account_id, amount, type, description, reference_id, created_at) VALUES (?, ?, 'transfer', ?, ?, ?)");
            // Get source account number or custom text for description
            $logDest->execute([$target_account_id, $amount, "Transfer from Account", $newRef, $date]);
        }

        $pdo->commit();

        // Redirect with success
        // In the pure PHP way, we might just redirect to dashboard or show success page.
        // API docs say "Success confirmation with a dummy reference ID".
        // The frontend JS used to show Step 3.
        // If we use standard POST, we reload the page.
        // To keep the JS wizard feel, we would need AJAX.
        // BUT scope says "No API".
        // So we must do a full page reload?
        // Phase 11 says "Update pages/transfers-new.php form action".
        // So standard POST.
        // Upon POST success, we can redirect back to transfers-new.php?success=1&ref=$newRef
        header("Location: ../pages/transfers-new.php?success=1&ref=" . $newRef);
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Transfer failed: " . $e->getMessage());
    }
}
