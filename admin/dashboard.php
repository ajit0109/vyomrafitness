<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

// Total Members
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM members");
$total_members = mysqli_fetch_assoc($totalQuery)['total'] ?? 0;

// Active Members
$activeQuery = mysqli_query($conn, "SELECT COUNT(*) AS active FROM members WHERE expiry_date >= CURDATE()");
$active_members = mysqli_fetch_assoc($activeQuery)['active'] ?? 0;

// Expired Members
$expiredQuery = mysqli_query($conn, "SELECT COUNT(*) AS expired FROM members WHERE expiry_date < CURDATE()");
$expired_members = mysqli_fetch_assoc($expiredQuery)['expired'] ?? 0;

// Revenue
$revenueQuery = mysqli_query($conn, "SELECT SUM(amount) AS revenue FROM payments");
$revenue = mysqli_fetch_assoc($revenueQuery)['revenue'] ?? 0;

// Expiring Soon
$expiringQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS expiring
     FROM members
     WHERE expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)"
);
$expiring_members = mysqli_fetch_assoc($expiringQuery)['expiring'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | VYOMRA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .dashboard-wrap {
            padding: 95px 0 40px;
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 22px;
            align-items: start;
        }

        .quick-menu {
            position: sticky;
            top: 84px;
            background: rgba(18,18,18,0.94);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.22);
        }

        .quick-menu h5 {
            color: #fff;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .quick-menu a {
            display: block;
            text-decoration: none;
            color: rgba(255,255,255,0.88);
            padding: 11px 12px;
            border-radius: 12px;
            margin-bottom: 8px;
            background: rgba(255,255,255,0.05);
            font-weight: 600;
            transition: 0.2s ease;
        }

        .quick-menu a:hover {
            background: #ffc107;
            color: #111;
        }

        .top-box {
            background: rgba(18,18,18,0.94);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.22);
            margin-bottom: 20px;
            color: #fff;
        }

        .top-box h3 {
            font-weight: 800;
            margin-bottom: 6px;
        }

        .top-box p {
            color: rgba(255,255,255,0.72);
            margin-bottom: 8px;
        }

        .top-box .amount {
            color: #ffc107;
            font-size: 2.2rem;
            font-weight: 800;
        }

        .section-title {
            margin-bottom: 16px;
        }

        .section-title h4 {
            color: #fff;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .section-title p {
            color: rgba(255,255,255,0.72);
            margin-bottom: 0;
        }

        .stat-card {
            border-radius: 18px;
            padding: 22px 18px;
            min-height: 150px;
            color: #fff;
            box-shadow: 0 10px 22px rgba(0,0,0,0.22);
            transition: 0.2s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-card .icon {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .stat-card h6 {
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-card h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .card-blue { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .card-green { background: linear-gradient(135deg, #059669, #10b981); }
        .card-red { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .card-orange { background: linear-gradient(135deg, #d97706, #f59e0b); }

        .bottom-note {
            margin-top: 16px;
            color: rgba(255,255,255,0.75);
            font-size: 0.92rem;
        }

        @media (max-width: 991px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .quick-menu {
                position: relative;
                top: 0;
            }
        }
       .dashboard-heading-left {
    grid-column: 1 / -1;
    margin-bottom: 18px; /* space before cards */
}

.dashboard-heading-left h2 {
    color: #fff;
    font-weight: 800;
    font-size: 2.2rem;
    margin-left: 4px;
    letter-spacing: 0.5px;
}
        .top-box {
    position: relative;
    z-index: 1;
}
        .dashboard-heading-left h2 {
    border-left: 4px solid #ffc107;
    padding-left: 10px;
}
    </style>
</head>
<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="../index.php">
            💪 <span style="color:#ffc107;">VYOMRA</span> Fitness
        </a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-danger px-3">Logout</a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container dashboard-wrap text-white">

        <div class="dashboard-layout">
<div class="dashboard-heading-left">
    <h2>Dashboard</h2>
</div>
            <aside class="quick-menu">
                <h5>Quick Menu</h5>
                <a href="add_member.php">➕ Add Member</a>
                <a href="add_trainer.php">➕ Add Trainer</a>
                <a href="add_workout.php">📋 Add Workout</a>
                <a href="view_members.php">👥 View Members</a>
                <a href="view_trainers.php">👨‍🏫 View Trainers</a>
                <a href="add_payment.php">💸 Add Payment</a>
                <a href="view_payments.php">💰 View Payments</a>
                <a href="mark_attendance.php">🗓️ Mark Attendance</a>
                <a href="view_attendance.php">📅 View Attendance</a>
            </aside>

            <div>
                <div class="top-box text-center">
                    <h3>Revenue Overview</h3>
                    <p>Total revenue collected from the gym system</p>
                    <div class="amount">₹<?php echo number_format((float)$revenue, 2); ?></div>
                </div>

                <div class="section-title">
                    <h4>Membership Summary</h4>
                    
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-xl-3">
                        <div class="stat-card card-blue text-center">
                            <div class="icon">👥</div>
                            <h6>Total Members</h6>
                            <h1><?php echo $total_members; ?></h1>
                            <p>All registered members</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="stat-card card-green text-center">
                            <div class="icon">✅</div>
                            <h6>Active Members</h6>
                            <h1><?php echo $active_members; ?></h1>
                            <p>Currently active plans</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="stat-card card-red text-center">
                            <div class="icon">⚠️</div>
                            <h6>Expired Members</h6>
                            <h1><?php echo $expired_members; ?></h1>
                            <p>Need renewal</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="stat-card card-orange text-center">
                            <div class="icon">⏳</div>
                            <h6>Expiring Soon</h6>
                            <h1><?php echo $expiring_members; ?></h1>
                            <p>Within next 7 days</p>
                        </div>
                    </div>
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