<!DOCTYPE html>
<html>
<head>
<title>Contact</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<style>
body {
    background: linear-gradient(135deg, #111111, #1b1b1b);
    color: #fff;
}

.contact-section {
    padding: 110px 0 70px;
}

.contact-header {
    text-align: center;
    margin-bottom: 45px;
}

.contact-header h2 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
}

.contact-header p {
    color: #cfcfcf;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.7;
}

.contact-card,
.contact-form-card {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 32px 28px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.22);
    border: 1px solid rgba(255,255,255,0.06);
    height: 100%;
}

.contact-card h4,
.contact-form-card h4 {
    font-weight: 800;
    margin-bottom: 24px;
    color: #1d1d1d;
}

.contact-info-item {
    padding: 14px 0;
    border-bottom: 1px solid #e5e5e5;
}

.contact-info-item:last-child {
    border-bottom: none;
}

.contact-info-item h5 {
    font-weight: 700;
    margin-bottom: 6px;
    color: #FFD700;
    font-size: 1rem;
}

.contact-info-item p {
    margin: 0;
    color: #555;
    line-height: 1.6;
}

.contact-form-card .form-control {
    border-radius: 12px;
    padding: 13px 14px;
    border: 1px solid #d9d9d9;
    box-shadow: none;
}

.contact-form-card .form-control:focus {
    border-color: #FFD700;
    box-shadow: 0 0 0 0.15rem rgba(255, 215, 0, 0.20);
}

.contact-form-card .btn {
    border-radius: 12px;
    padding: 12px;
    font-weight: 700;
    background: #FFD700;
    border: none;
    color: #000;
    transition: 0.3s ease;
}

.contact-form-card .btn:hover {
    background: #e6c200;
    color: #000;
    transform: translateY(-2px);
}

.highlight-line {
    width: 90px;
    height: 4px;
    background: #FFD700;
    margin: 0 auto 18px;
    border-radius: 50px;
}

@media (max-width: 768px) {
    .contact-section {
        padding: 95px 0 50px;
    }

    .contact-header h2 {
        font-size: 2rem;
    }
}
</style>

</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="main-content">
    <div class="container contact-section">

        <div class="contact-header">
            <div class="highlight-line"></div>
            <h2>Contact Us</h2>
            <p>Reach out to us for membership details, training support, timings, or any fitness-related enquiry.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-5">
                <div class="contact-card">
                    <h4>Get In Touch</h4>

                    <div class="contact-info-item">
                        <h5>📍 Address</h5>
                        <p>Nagpur, Maharashtra</p>
                    </div>

                    <div class="contact-info-item">
                        <h5>📞 Phone</h5>
                        <p>+91 9876543210</p>
                    </div>

                    <div class="contact-info-item">
                        <h5>📧 Email</h5>
                        <p>fitnessclub@gmail.com</p>
                    </div>

                    <div class="contact-info-item">
                        <h5>🕒 Working Hours</h5>
                        <p>Monday to Saturday: 6:00 AM – 10:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-form-card">
                    <h4>Send Us a Message</h4>

                    <form>
                        <input type="text" class="form-control mb-3" placeholder="Your Name" required>
                        <input type="email" class="form-control mb-3" placeholder="Your Email" required>
                        <input type="text" class="form-control mb-3" placeholder="Subject" required>
                        <textarea class="form-control mb-3" rows="5" placeholder="Your Message" required></textarea>
                        <button class="btn w-100">Send Message</button>
                    </form>
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