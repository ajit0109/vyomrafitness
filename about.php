<!DOCTYPE html>
<html>
<head>
    <title>About</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #111111, #1b1b1b);
            color: #fff;
        }

        .about-section {
            padding: 110px 0 70px;
        }

        .about-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .about-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 14px;
            color: #ffffff;
        }

        .about-header p {
            max-width: 760px;
            margin: 0 auto;
            color: #cfcfcf;
            line-height: 1.8;
            font-size: 1rem;
        }

        .about-box,
        .mission-box {
            background: #f8f9fa;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 30px 24px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.22);
            transition: all 0.3s ease;
            height: 100%;
        }

        .about-box:hover,
        .mission-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 35px rgba(0,0,0,0.28);
        }

        .about-box h3 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #FFD700;
            margin-bottom: 8px;
        }

        .about-box h5,
        .mission-box h4 {
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .about-box p,
        .mission-box p {
            color: #5f5f5f;
            line-height: 1.7;
            margin-bottom: 0;
        }

        .mission-box {
            margin-top: 45px;
            text-align: center;
        }

        .stats-row .about-box {
            text-align: center;
        }

        .highlight-line {
            width: 90px;
            height: 4px;
            background: #FFD700;
            margin: 0 auto 18px;
            border-radius: 50px;
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 95px 0 50px;
            }

            .about-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="main-content">
    <div class="container about-section">

        <div class="about-header">
            <div class="highlight-line"></div>
            <h2>About Us</h2>
            <p>
                We are a modern fitness club dedicated to helping people transform their bodies and lives.
                With advanced equipment, certified trainers, and a motivating environment, we ensure you stay
                consistent and achieve your fitness goals.
            </p>
        </div>

        <div class="row g-4 stats-row">
            <div class="col-md-4">
                <div class="about-box">
                    <h3>500+</h3>
                    <p>Active Members</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-box">
                    <h3>15+</h3>
                    <p>Expert Trainers</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-box">
                    <h3>24/7</h3>
                    <p>Open Hours</p>
                </div>
            </div>
        </div>

        <div class="mission-box">
            <h4>Our Mission</h4>
            <p>
                Our mission is to create a healthy and motivating environment where everyone can improve their fitness,
                build confidence, and live a better life.
            </p>
        </div>

        <div class="row text-center mt-4 g-4">
            <div class="col-md-4">
                <div class="about-box">
                    <h5>Our Vision</h5>
                    <p>To inspire and empower people to live healthier, stronger, and more disciplined lives through fitness.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-box">
                    <h5>Expert Trainers</h5>
                    <p>Certified professionals guide every member with proper workouts, motivation, and full support.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-box">
                    <h5>Modern Equipment</h5>
                    <p>State-of-the-art machines and quality fitness tools for safe, effective, and result-driven training.</p>
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