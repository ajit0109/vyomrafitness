<?php
session_start();

if (!isset($_SESSION['admin'])) {
    exit("Unauthorized");
}

include("../includes/db.php");

$member_id = isset($_GET['member_id']) ? (int)$_GET['member_id'] : 0;

if ($member_id <= 0) {
    exit("<div class='text-danger'>Invalid member ID.</div>");
}

$month = date('m');
$year = date('Y');

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfMonth = date('N', strtotime("$year-$month-01")); // 1=Mon, 7=Sun

$stmt = $conn->prepare("
    SELECT attendance_date, status
    FROM attendance
    WHERE member_id = ?
      AND MONTH(attendance_date) = ?
      AND YEAR(attendance_date) = ?
");
$stmt->bind_param("iii", $member_id, $month, $year);
$stmt->execute();
$result = $stmt->get_result();

$attendanceData = [];
while ($row = $result->fetch_assoc()) {
    $day = (int)date('j', strtotime($row['attendance_date']));
    $attendanceData[$day] = $row['status'];
}
?>

<style>
.calendar-header {
    text-align: center;
    font-weight: 700;
    margin-bottom: 15px;
    color: #ffc107;
    font-size: 1.1rem;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
}

.day-name, .calendar-day {
    text-align: center;
    border-radius: 12px;
    padding: 12px 8px;
    font-weight: 600;
}

.day-name {
    background: rgba(255,255,255,0.08);
    color: #fff;
}

.calendar-day {
    min-height: 58px;
    background: rgba(255,255,255,0.05);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.08);
}

.present-day {
    background: rgba(16,185,129,0.25);
    border: 1px solid #10b981;
    color: #d1fae5;
}

.absent-day {
    background: rgba(239,68,68,0.22);
    border: 1px solid #ef4444;
    color: #fee2e2;
}

.empty-day {
    background: transparent;
    border: none;
}

.legend-box {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 18px;
}

.legend-item {
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 0.9rem;
    font-weight: 600;
}

.legend-present {
    background: rgba(16,185,129,0.25);
    border: 1px solid #10b981;
}

.legend-absent {
    background: rgba(239,68,68,0.22);
    border: 1px solid #ef4444;
}

.legend-none {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
}
</style>

<div class="calendar-header">
    Attendance for <?php echo date('F Y'); ?>
</div>

<div class="calendar-grid">
    <div class="day-name">Mon</div>
    <div class="day-name">Tue</div>
    <div class="day-name">Wed</div>
    <div class="day-name">Thu</div>
    <div class="day-name">Fri</div>
    <div class="day-name">Sat</div>
    <div class="day-name">Sun</div>

    <?php
    for ($i = 1; $i < $firstDayOfMonth; $i++) {
        echo "<div class='calendar-day empty-day'></div>";
    }

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $class = "calendar-day";
        if (isset($attendanceData[$day])) {
            if ($attendanceData[$day] === "Present") {
                $class .= " present-day";
            } elseif ($attendanceData[$day] === "Absent") {
                $class .= " absent-day";
            }
        }

        echo "<div class='$class'>$day</div>";
    }
    ?>
</div>

<div class="legend-box">
    <div class="legend-item legend-present">Green = Present</div>
    <div class="legend-item legend-absent">Red = Absent</div>
    <div class="legend-item legend-none">Normal = No Record</div>
</div>