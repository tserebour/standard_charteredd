<?php
// auth/security-question.php
// UI-only security question page — uses fixtures only
// SECURITY SAFETY: This file is for UI simulation only.
// It uses plain text answers from fixtures and does NO real authentication.

session_start();
require_once __DIR__ . '/../config/constants.php'; // Adjust if needed

// Simulated user identifier set by the dummy login flow:
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header('Location: ../pages/login.php');
    exit;
}

// Include DB
require_once __DIR__ . '/../config/db.php';

// Load user from DB
try {
    $stmt = $pdo->prepare("
        SELECT u.*, sq.question 
        FROM users u 
        LEFT JOIN security_questions sq ON u.security_question_id = sq.id 
        WHERE u.id = ?
    ");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("A system error occurred.");
}

// Validation against DB
if (!$user || empty($user['question'])) {
    // no security question configured for this user — skip to dashboard
    header('Location: ../pages/dashboard.php');
    exit;
}

$securityQuestionText = $user['question'];
$expectedAnswer = $user['security_answer'] ?? '';

$error = '';
// Session-based attempt counter (UI simulation)
$attempts = $_SESSION['secq_attempts'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = trim($_POST['security_answer'] ?? '');

    // Simple case-insensitive check for the demo
    if (strcasecmp($answer, $expectedAnswer) === 0) {
        // simulated success
        unset($_SESSION['secq_attempts']);
        header('Location: ../pages/dashboard.php');
        exit;
    } else {
        $attempts++;
        $_SESSION['secq_attempts'] = $attempts;
        $error = 'Incorrect answer. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question - Standard Chartered</title>
    <!-- Use existing styles -->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Minimal inline styles to match existing look roughly */
        body {
            font-family: 'SC Sans', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            max-width: 200px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background-color: #0c77b9;
            /* SC Blue approximate */
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: #005a8e;
        }

        .alert {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .text-muted {
            font-size: 0.8rem;
            color: #6c757d;
            text-align: center;
            margin-top: 1rem;
            display: block;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="logo">
            <!-- Adjust logo path if needed -->
            <img src="../Personal, Private and Corporate Banking _ Standard Chartered_files/Scb_logo.png"
                alt="Standard Chartered">
        </div>

        <h2>Security Verification</h2>
        <p>Please answer your security question to continue.</p>

        <div class="form-group">
            <label>Question:</label>
            <div style="padding: 10px; background: #e9ecef; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($securityQuestionText) ?>
            </div>
        </div>

        <?php if ($error): ?>
            <div class="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="security_answer">Your Answer</label>
                <input type="text" id="security_answer" name="security_answer" class="form-control"
                    placeholder="Enter your answer" required autofocus>
            </div>

            <button class="btn" type="submit">Verify Identity</button>

            <small class="text-muted">
                UI-only simulation. Data is loaded from fixtures.<br>
                (Hint: The answer is <strong>
                    <?= htmlspecialchars($user['security_answer']) ?>
                </strong>)
            </small>
        </form>
    </div>

</body>

</html>