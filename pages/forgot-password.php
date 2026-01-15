<?php
// pages/forgot-password.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Standward</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <style>
        .auth-container {
            max-width: 400px;
            margin: 80px auto;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container">
        <div class="auth-container">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 fw-normal text-brand">Standward</h1>
            </div>

            <!-- Step 1: Input -->
            <div id="forgotStep1">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Reset Password</h2>
                        <p class="text-muted small mb-4">Enter your registered email or phone number to receive reset
                            instructions.</p>

                        <form id="forgotForm">
                            <div class="mb-3">
                                <label for="identifier" class="form-label">Email or Phone</label>
                                <input type="text" class="form-control" id="identifier" required
                                    placeholder="e.g. name@example.com">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Send Instructions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Step 2: Confirmation -->
            <div id="forgotStep2" class="d-none">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3 text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                            </svg>
                        </div>
                        <h2 class="h5 mb-3">Check Your Inbox</h2>
                        <p class="text-muted small mb-4">We sent instructions to <strong
                                id="confirmDest">****@example.com</strong>.</p>

                        <div class="d-grid">
                            <a href="login.php" class="btn btn-outline-primary">Return to Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="login.php" class="text-muted small text-decoration-none">Cancel</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js?v=1.1"></script>
</body>

</html>