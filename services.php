<!DOCTYPE html>
<html>
<head>
<title>Services</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<style>
body {
    background: linear-gradient(135deg, #111111, #1b1b1b);
    color: #fff;
}

.services-section {
    padding: 110px 0 70px;
}

.services-header {
    text-align: center;
    margin-bottom: 50px;
}

.services-header h2 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
}

.services-header p {
    color: #cfcfcf;
    max-width: 720px;
    margin: 0 auto;
    line-height: 1.7;
}

.service-card {
    border-radius: 20px;
    padding: 30px 24px;
    background: #f8f9fa;
    box-shadow: 0 12px 30px rgba(0,0,0,0.22);
    transition: 0.3s ease;
    height: 100%;
    text-align: center;
}

.service-card:hover {
    transform: translateY(-8px);
}

.service-card .icon {
    font-size: 2rem;
    margin-bottom: 14px;
}

.service-card h5 {
    font-weight: 800;
    margin-bottom: 12px;
    color: #1d1d1d;
}

.service-card p {
    color: #666;
    margin-bottom: 0;
    line-height: 1.7;
}

.why-title {
    text-align: center;
    margin-top: 55px;
    margin-bottom: 25px;
    font-weight: 800;
}

.why-box {
    background: #f8f9fa;
    color: #1d1d1d;
    border-radius: 16px;
    padding: 24px 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    font-weight: 700;
    text-align: center;
    transition: 0.3s ease;
    height: 100%;
}

.why-box:hover {
    transform: translateY(-5px);
}

.highlight-line {
    width: 90px;
    height: 4px;
    background: #FFD700;
    margin: 0 auto 18px;
    border-radius: 50px;
}

@media (max-width: 768px) {
    .services-section {
        padding: 95px 0 50px;
    }

    .services-header h2 {
        font-size: 2rem;
    }
}
</style>

</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="main-content">
    <div class="container services-section">

        <div class="services-header">
            <div class="highlight-line"></div>
            <h2>Our Services</h2>
            <p>We provide everything you need to stay fit, strong, healthy, and consistent in your fitness journey.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon">💪</div>
                    <h5>Weight Training</h5>
                    <p>Build muscle strength using modern gym equipment and structured workout plans.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon">🏃</div>
                    <h5>Cardio Training</h5>
                    <p>Improve stamina and heart health with treadmill, cycling, endurance, and HIIT sessions.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon">👨‍🏫</div>
                    <h5>Personal Training</h5>
                    <p>Get one-on-one expert guidance with customized plans for faster and smarter results.</p>
                </div>
            </div>

        </div>

        <h3 class="why-title">Why Choose Us?</h3>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="why-box">🔥 Modern Equipment</div>
            </div>

            <div class="col-md-4">
                <div class="why-box">👨‍🏫 Expert Trainers</div>
            </div>

            <div class="col-md-4">
                <div class="why-box">💯 Friendly Environment</div>
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