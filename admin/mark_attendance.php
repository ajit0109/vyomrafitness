<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$success = "";
$error = "";

// Handle attendance form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = intval($_POST['member_id']);
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    // Prevent duplicate attendance for same member on same date
    $check = $conn->prepare("SELECT * FROM attendance WHERE member_id = ? AND attendance_date = ?");
    $check->bind_param("is", $member_id, $attendance_date);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        $error = "Attendance already marked for this member on this date.";
    } else {
        $stmt = $conn->prepare("INSERT INTO attendance (member_id, attendance_date, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $member_id, $attendance_date, $status);

        if ($stmt->execute()) {
            $success = "Attendance marked successfully.";
        } else {
            $error = "Something went wrong.";
        }
    }
}

// Fetch members
$members = mysqli_query($conn, "SELECT member_id, name FROM members ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance | VYOMRA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .attendance-wrap {
            padding: 95px 0 40px;
        }

        .attendance-card {
            max-width: 700px;
            margin: 0 auto;
            background: rgba(18,18,18,0.94);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.22);
            color: #fff;
        }

        .attendance-card h2 {
            font-weight: 800;
            margin-bottom: 6px;
        }

        .attendance-card p {
            color: rgba(255,255,255,0.72);
            margin-bottom: 22px;
        }

        .attendance-card .form-label {
            font-weight: 600;
            color: #fff;
        }

        .attendance-card .form-control,
        .attendance-card .form-select {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            color: #fff;
            border-radius: 12px;
            padding: 12px;
        }

        .attendance-card .form-control:focus,
        .attendance-card .form-select:focus {
            box-shadow: none;
            border-color: #ffc107;
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .attendance-card .form-select option {
            color: #000;
        }

        .btn-theme {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px;
        }

        .btn-theme:hover {
            opacity: 0.95;
            color: #fff;
        }

        .top-actions {
            max-width: 700px;
            margin: 0 auto 18px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .top-actions a {
            text-decoration: none;
        }
    </style>
</head>
<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            💪 <span style="color:#ffc107;">VYOMRA</span> Fitness
        </a>
        <div class="ms-auto d-flex gap-2">
           <a href="dashboard.php" class="btn btn-outline-light">Dashboard</a>
            <a href="view_attendance.php" class="btn btn-warning">View Attendance</a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container attendance-wrap">

        <div class="attendance-card">
            <h2>Mark Attendance</h2>
            <p>Select a member and mark today’s attendance.</p>

            <?php if ($success != ""): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if ($error != ""): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Select Member</label>
                    <select name="member_id" class="form-select" required>
                        <option value="">Choose Member</option>
                        <?php while ($row = mysqli_fetch_assoc($members)) { ?>
                            <option value="<?php echo $row['member_id']; ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Attendance Date</label>
                    <input type="date" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-theme w-100">Mark Attendance</button>
            </form>
        </div>

    </div>
</div>

<footer class="footer">
    © <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness | All Rights Reserved
</footer>

</body>
</html>