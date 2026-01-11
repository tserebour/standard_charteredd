<?php
// actions/login.php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header("Location: ../pages/login.php?error=empty_fields");
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, username, password_hash, full_name FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Success
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];

            header("Location: ../pages/dashboard.php");
            exit;
        } else {
            // Failure
            header("Location: ../pages/login.php?error=invalid_credentials");
            exit;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        header("Location: ../pages/login.php?error=system_error");
        exit;
    }
} else {
    // Only POST allowed
    header("Location: ../pages/login.php");
    exit;
}
