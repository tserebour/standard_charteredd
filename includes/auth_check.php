<?php
// includes/auth_check.php
// Middleware to ensure user is logged in

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}
