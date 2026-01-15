<?php
// pages/login.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Standward</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container">
        <div class="login-container">
            <div class="text-center mb-4">
                <div class="logo mb-3">
                    <img src="../Personal, Private and Corporate Place _ Standard Chartered_files/Scb_logo.png"
                        alt="Standward" style="max-width: 200px;">
                </div>
                <!-- <h1 class="h3 mb-3 fw-normal text-brand">Standward</h1> -->
                <p class="text-muted">Secure Online Place</p>
            </div>

            <?php if (isset($_GET['registered']) && $_GET['registered'] === 'success'): ?>
                <div class="alert alert-success" role="alert">
                    Registration successful! You can now log in.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    switch ($_GET['error']) {
                        case 'empty_fields':
                            echo 'Please enter both username and password.';
                            break;
                        case 'invalid_credentials':
                            echo 'Invalid username or password.';
                            break;
                        case 'system_error':
                            echo 'An internal error occurred. Please try again later.';
                            break;
                        default:
                            echo 'An error occurred. Please try again.';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form id="loginForm" action="../actions/login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required
                                    autocomplete="current-password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label text-muted small" for="rememberMe">Remember this
                                device</label>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                        </div>
                        <div class="text-center">
                            <a href="forgot-password.php" class="text-decoration-none small">Forgot password?</a>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-muted small mb-0">Don't have an account? <a href="register.php"
                                class="text-brand fw-bold text-decoration-none">Sign Up</a></p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="../index.php" class="text-muted small text-decoration-none">&larr; Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js?v=1.1"></script>
</body>

</html>