<!DOCTYPE html>
<html>
<head>
<title>Fitness Club</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<style>
.hero-section {
    min-height: 100vh;
    background: rgba(0,0,0,0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 100px 20px 40px;
}

.hero-box {
    max-width: 800px;
    color: #fff;
    animation: fadeUp 0.8s ease;
}

.hero-title {
    font-size: 3.7rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 15px;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #e2e2e2;
    margin-bottom: 10px;
}

.hero-quote {
    font-size: 1.15rem;
    color: #ffc107;
    font-style: italic;
    margin-bottom: 10px;
}

.hero-tagline {
    font-size: 1rem;
    color: #d8d8d8;
    margin-bottom: 30px;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.hero-buttons .btn {
    min-width: 160px;
    border-radius: 30px;
    padding: 12px 24px;
    font-weight: 600;
}

.hero-mini-stats {
    margin-top: 40px;
}

.hero-stat-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    backdrop-filter: blur(6px);
    border-radius: 16px;
    padding: 20px;
    color: white;
    transition: 0.3s;
}

.hero-stat-card:hover {
    transform: translateY(-4px);
    background: rgba(255,255,255,0.12);
}

.hero-stat-card h4 {
    font-size: 1.8rem;
    margin-bottom: 8px;
    color: #ffc107;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.2rem;
    }

    .hero-subtitle,
    .hero-quote,
    .hero-tagline {
        font-size: 0.95rem;
    }
}
</style>

</head>

<body class="home-bg">

<?php include("includes/navbar.php"); ?>

<div class="hero-section">
    <div class="hero-box">

        <h1 class="hero-title">Transform Your Body</h1>

        <p class="hero-subtitle">Join the best fitness club in your city and start your journey today.</p>

        <p class="hero-quote">“Push yourself because no one else is going to do it for you.”</p>

        <p class="hero-tagline">Train Hard. Stay Fit. Live Better.</p>

        <div class="hero-buttons">
            <a href="login.php" class="btn btn-warning text-dark">Admin Login</a>
            <a href="pricing.php" class="btn btn-outline-light">View Plans</a>
        </div>

        <div class="row hero-mini-stats justify-content-center g-3 mt-2">
            <div class="col-md-3 col-10">
                <div class="hero-stat-card">
                    <h4>500+</h4>
                    <p class="mb-0">Members</p>
                </div>
            </div>

            <div class="col-md-3 col-10">
                <div class="hero-stat-card">
                    <h4>15+</h4>
                    <p class="mb-0">Expert Trainers</p>
                </div>
            </div>

            <div class="col-md-3 col-10">
                <div class="hero-stat-card">
                    <h4>24/7</h4>
                    <p class="mb-0">Motivation</p>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="footer">
© <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness | All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>