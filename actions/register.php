<?php
// actions/register.php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Basic Validation
    if (empty($full_name) || empty($username) || empty($password) || empty($confirm_password)) {
        header("Location: ../pages/register.php?error=empty_fields");
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: ../pages/register.php?error=password_mismatch");
        exit;
    }

    try {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            header("Location: ../pages/register.php?error=username_taken");
            exit;
        }

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert User
        $stmt = $pdo->prepare("INSERT INTO users (full_name, username, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$full_name, $username, $password_hash]);

        // Success - Redirect to login with success message
        header("Location: ../pages/login.php?registered=success");
        exit;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        header("Location: ../pages/register.php?error=system_error");
        exit;
    }
} else {
    header("Location: ../pages/register.php");
    exit;
}
