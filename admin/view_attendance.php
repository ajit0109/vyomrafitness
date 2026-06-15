<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$search = $_GET['search'] ?? "";

// Show unique members who exist in attendance table
$query = "
    SELECT DISTINCT m.member_id, m.name, m.plan
    FROM attendance a
    INNER JOIN members m ON a.member_id = m.member_id
    WHERE 1
";

$params = [];
$types = "";

if ($search != "") {
    $query .= " AND m.name LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}

$query .= " ORDER BY m.name ASC";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance | VYOMRA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .attendance-wrap {
            padding: 95px 0 40px;
        }

        .attendance-box {
            background: rgba(18,18,18,0.94);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.22);
            color: #fff;
        }

        .attendance-box h2 {
            font-weight: 800;
            margin-bottom: 6px;
        }

        .attendance-box p {
            color: rgba(255,255,255,0.72);
            margin-bottom: 20px;
        }

        .filter-box .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            color: #fff;
            border-radius: 12px;
        }

        .filter-box .form-control:focus {
            box-shadow: none;
            border-color: #ffc107;
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .attendance-table-wrap {
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            color: #fff;
            margin-bottom: 0;
        }

        .attendance-table th {
            background: rgba(255,255,255,0.08);
            border: none;
            padding: 14px;
        }

        .attendance-table td {
            background: rgba(255,255,255,0.04);
            border: none;
            padding: 14px;
            vertical-align: middle;
        }

        .btn-theme {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 12px;
            padding: 10px 16px;
        }

        .btn-theme:hover {
            color: #fff;
            opacity: 0.95;
        }

        .btn-check-attendance {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 10px;
            padding: 8px 14px;
        }

        .btn-check-attendance:hover {
            color: #fff;
            opacity: 0.95;
        }

        .modal-content {
            background: #111;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 18px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .modal-footer {
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        /* FORCE WHITE TEXT FOR ATTENDANCE TABLE */
.attendance-table,
.attendance-table th,
.attendance-table td {
    color: #ffffff !important;
}

/* ALSO FIX INPUT TEXT (search + date) */
.filter-box input {
    color: #ffffff !important;
}

/* Placeholder color (light white) */
.filter-box input::placeholder {
    color: rgba(255,255,255,0.6);
}
        .attendance-table tr:hover td {
    background: rgba(255,255,255,0.08);
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
            <a href="mark_attendance.php" class="btn btn-warning">Mark Attendance</a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container attendance-wrap">
        <div class="attendance-box">
            <h2>Attendance Records</h2>
            <p>View each member and check attendance in calendar format.</p>

            <form method="GET" class="row g-3 filter-box mb-4">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control" placeholder="Search member name" value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-theme">Filter</button>
                </div>
            </form>

            <div class="attendance-table-wrap">
                <table class="table attendance-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Name</th>
                            <th>Plan</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['plan']); ?></td>
                                <td>
                                    <button 
                                        type="button"
                                        class="btn btn-check-attendance openAttendanceModal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#attendanceModal"
                                        data-member-id="<?php echo $row['member_id']; ?>"
                                        data-member-name="<?php echo htmlspecialchars($row['name']); ?>"
                                    >
                                        Check
                                    </button>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4" class="text-center">No attendance records found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Calendar - <span id="memberName"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="attendanceCalendarContent">
                <div class="text-center py-4">Loading attendance...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    © <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness | All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.openAttendanceModal').forEach(button => {
    button.addEventListener('click', function () {
        const memberId = this.getAttribute('data-member-id');
        const memberName = this.getAttribute('data-member-name');

        document.getElementById('memberName').textContent = memberName;
        document.getElementById('attendanceCalendarContent').innerHTML = '<div class="text-center py-4">Loading attendance...</div>';

        fetch('attendance_calendar.php?member_id=' + memberId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('attendanceCalendarContent').innerHTML = data;
            })
            .catch(() => {
                document.getElementById('attendanceCalendarContent').innerHTML = '<div class="text-danger text-center">Failed to load attendance.</div>';
            });
    });
});
</script>

</body>
</html>