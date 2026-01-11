<?php
// pages/login.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Standard Chartered</title>
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
                <h1 class="h3 mb-3 fw-normal text-brand">Standard Chartered</h1>
                <p class="text-muted">Secure Online Banking</p>
            </div>

            <div id="loginError" class="alert alert-danger d-none" role="alert">
                Invalid credentials. Please check your username and password and try again.
            </div>

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
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="../index.php" class="text-muted small text-decoration-none">&larr; Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>