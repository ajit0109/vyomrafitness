<!DOCTYPE html>
<html>
<head>
<title>Pricing</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<style>
body {
    background: linear-gradient(135deg, #111111, #1b1b1b);
    color: #fff;
}

.pricing-section {
    padding: 110px 0 70px;
}

.pricing-header {
    text-align: center;
    margin-bottom: 50px;
}

.pricing-header h2 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
}

.pricing-header p {
    color: #cfcfcf;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.7;
}

.price-card {
    position: relative;
    border-radius: 22px;
    padding: 35px 26px;
    background: #f8f9fa;
    box-shadow: 0 12px 30px rgba(0,0,0,0.22);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid transparent;
}

.price-card:hover {
    transform: translateY(-8px);
}

.price-card h4 {
    font-weight: 800;
    margin-bottom: 12px;
    color: #1d1d1d;
}

.price-card .price {
    font-size: 2.4rem;
    font-weight: 800;
    margin-bottom: 18px;
    color: #FFD700;
}

.price-card ul li {
    margin-bottom: 12px;
    color: #5a5a5a;
}

.price-card .btn {
    border-radius: 12px;
    font-weight: 700;
    padding: 11px 16px;
}

.popular {
    border: 2px solid #FFD700;
    transform: scale(1.03);
}

.popular-badge {
    display: inline-block;
    background: #FFD700;
    color: #000;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 50px;
    margin-bottom: 14px;
}

.highlight-line {
    width: 90px;
    height: 4px;
    background: #FFD700;
    margin: 0 auto 18px;
    border-radius: 50px;
}

@media (max-width: 768px) {
    .pricing-section {
        padding: 95px 0 50px;
    }

    .pricing-header h2 {
        font-size: 2rem;
    }

    .popular {
        transform: none;
    }
}
</style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="main-content">
<div class="container pricing-section">

    <div class="pricing-header">
        <div class="highlight-line"></div>
        <h2>Membership Plans</h2>
        <p>Choose the membership plan that best matches your fitness goals and training needs.</p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="price-card text-center">
                <h4>Basic</h4>
                <h2 class="price">₹1000</h2>

                <ul class="list-unstyled mt-3 mb-4">
                    <li>✔ Gym Access</li>
                    <li>✔ Basic Equipment</li>
                    <li>✖ Personal Trainer</li>
                    <li>✖ Diet Guidance</li>
                </ul>

                <a href="login.php" class="btn btn-outline-warning w-100">Join Now</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="price-card popular text-center">
                <div class="popular-badge">Most Popular</div>
                <h4>Standard</h4>
                <h2 class="price">₹2500</h2>

                <ul class="list-unstyled mt-3 mb-4">
                    <li>✔ Gym Access</li>
                    <li>✔ All Equipment</li>
                    <li>✔ Trainer Guidance</li>
                    <li>✖ Diet Guidance</li>
                </ul>

                <a href="login.php" class="btn btn-warning w-100">Join Now</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="price-card text-center">
                <h4>Premium</h4>
                <h2 class="price">₹8000</h2>

                <ul class="list-unstyled mt-3 mb-4">
                    <li>✔ Full Access</li>
                    <li>✔ Personal Trainer</li>
                    <li>✔ Diet Plan</li>
                    <li>✔ Premium Support</li>
                </ul>

                <a href="login.php" class="btn btn-dark w-100">Join Now</a>
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