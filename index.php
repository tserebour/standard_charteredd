<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standward - Safe, Secure, Modern Banking</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --bank-primary: #003366;
            /* Deep Professional Blue */
            --bank-secondary: #004d99;
            /* Lighter shade for hover */
            --bank-accent: #00a8e8;
            /* Cyan accent for highlights */
            --text-dark: #333333;
            --text-light: #666666;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text-dark);
        }

        /* Navbar Styling */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--bank-primary);
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-dark);
            margin: 0 10px;
        }

        .nav-link:hover {
            color: var(--bank-primary);
        }

        .btn-bank-primary {
            background-color: var(--bank-primary);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-bank-primary:hover {
            background-color: var(--bank-secondary);
            color: white;
            transform: translateY(-1px);
        }

        .btn-bank-outline {
            border: 2px solid var(--bank-primary);
            color: var(--bank-primary);
            padding: 8px 23px;
            border-radius: 5px;
            background: transparent;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-bank-outline:hover {
            background-color: var(--bank-primary);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f0f4f8 0%, #ffffff 100%);
        }

        .hero-title {
            color: var(--bank-primary);
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: white;
        }

        .feature-card {
            border: none;
            border-radius: 10px;
            padding: 30px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--bank-primary);
            margin-bottom: 20px;
        }

        /* Stats Section */
        .stats-section {
            background-color: var(--bank-primary);
            color: white;
            padding: 60px 0;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background-color: #f8f9fa;
            padding: 60px 0 20px;
            border-top: 1px solid #dee2e6;
        }

        .footer h5 {
            color: var(--bank-primary);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-link {
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
        }

        .footer-link:hover {
            color: var(--bank-primary);
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-bank icon-margin-right"></i> Standward
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Personal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Business</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cards</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Loans</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
                </ul>
                <div class="d-flex gap-3">
                    <a href="pages/login.php" class="btn btn-bank-outline">Login</a>
                    <a href="pages/register.php" class="btn btn-bank-primary">Open Account</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Banking Built for Your Future.</h1>
                    <p class="hero-text">
                        Experience secure, modern, and personal banking designed to help you reach your financial goals.
                        Join over 2 million satisfied customers today.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-bank-primary btn-lg">Get Started</a>
                        <a href="#" class="btn btn-bank-outline btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 text-center text-lg-end">
                    <!-- Abstract Placeholder Illustration (CSS only visual) -->
                    <div class="p-5 d-inline-block rounded-circle bg-white shadow-lg"
                        style="width: 300px; height: 300px; display: flex; align-items: center; justify-content: center; position: relative;">
                        <div style="font-size: 8rem; color: var(--bank-primary);">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold" style="color: var(--bank-primary);">Why Choose Us?</h2>
                    <p class="text-muted">Smart tools and dedicated support for every step of your journey.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Digital First</h4>
                        <p class="text-muted">Manage your money anywhere with our award-winning mobile app and online
                            banking.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Fast Transfers</h4>
                        <p class="text-muted">Send money instantly to anyone, anywhere in the world with competitive
                            rates.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Secure Cards</h4>
                        <p class="text-muted">Contactless debit and credit cards with advanced fraud protection
                            built-in.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h4 class="fw-bold mb-3">24/7 Support</h4>
                        <p class="text-muted">Our dedicated team is here to help you around the clock, whenever you need
                            us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust / Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="stat-number">2M+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">System Uptime</div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Access to Funds</div>
                </div>
                <div class="col-md-3">
                    <div class="stat-number">Grade A</div>
                    <div class="stat-label">Security Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5>Standward</h5>
                    <p class="text-muted">
                        Committed to providing safe, reliable, and forward-thinking banking solutions for everyone.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Company</h5>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Careers</a>
                    <a href="#" class="footer-link">Press</a>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Support</h5>
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">Contact Us</a>
                    <a href="#" class="footer-link">Lost Card</a>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Legal</h5>
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                    <a href="#" class="footer-link">Security Code</a>
                </div>
            </div>
            <div class="row mt-5 pt-4 border-top">
                <div class="col-12 text-center text-muted">
                    <p>&copy; <?php echo date("Y"); ?> Standward. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>