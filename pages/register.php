<?php
// pages/register.php
require_once __DIR__ . '/../config/db.php';

// Fetch security questions
try {
    $stmt = $pdo->query("SELECT * FROM security_questions ORDER BY id ASC");
    $questions = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $questions = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Standward</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 450px;
            margin: 60px auto;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container">
        <div class="register-container">
            <div class="text-center mb-4">
                <div class="logo mb-3">
                    <img src="../Personal, Private and Corporate Place _ Standard Chartered_files/Scb_logo.png"
                        alt="Standward" style="max-width: 200px;">
                </div>
                <!-- <h1 class="h3 mb-3 fw-normal text-brand">Standward</h1> -->
                <p class="text-muted">Create your multi-bank interface account</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    switch ($_GET['error']) {
                        case 'empty_fields':
                            echo 'Please fill in all fields.';
                            break;
                        case 'password_mismatch':
                            echo 'Passwords do not match.';
                            break;
                        case 'username_taken':
                            echo 'Username is already taken. Please choose another.';
                            break;
                        case 'system_error':
                            echo 'A system error occurred. Please try again later.';
                            break;
                        default:
                            echo 'An error occurred. Please try again.';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form id="registerForm" action="../actions/register.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required
                                Place="e.g. John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="security_question_id" class="form-label">Security Question</label>
                            <select class="form-select" id="security_question_id" name="security_question_id" required>
                                <option value="" selected disabled>Choose a security question...</option>
                                <?php foreach ($questions as $q): ?>
                                    <option value="<?= $q['id'] ?>">
                                        <?= htmlspecialchars($q['question']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="security_answer" class="form-label">Security Answer</label>
                            <input type="text" class="form-control" id="security_answer" name="security_answer" required
                                Place="Enter your answer">
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">Already have an account? <a href="login.php"
                        class="text-brand fw-bold text-decoration-none">Sign In</a></p>
                <a href="../index.php" class="text-muted small text-decoration-none">&larr; Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js?v=1.1"></script>
</body>

</html>