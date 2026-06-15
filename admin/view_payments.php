<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$query = "
SELECT p.*, m.name 
FROM payments p
JOIN members m ON p.member_id = m.member_id
ORDER BY p.payment_date DESC, p.payment_id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1;
}
</style>
</head>

<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
<div class="container-fluid px-4">

<a class="navbar-brand fw-bold" href="dashboard.php">
💪 <span class="logo-highlight">VYOMRA</span> Fitness
</a>

<div class="ms-auto">
<a href="add_payment.php" class="btn btn-outline-light me-2">Add Payment</a>
<a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<div class="main-content">
<div class="container mt-4">

<h2 class="mb-4 text-white">Payments History</h2>

<div class="card table-card p-3 shadow">
<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">
<tr>
<th>No.</th>
<th>Member Name</th>
<th>Amount (₹)</th>
<th>Payment Date</th>
<th>Method</th>
</tr>
</thead>

<tbody>

<?php 
$i = 1;

if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_assoc($result)){ 
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td>₹<?php echo number_format((float)$row['amount'], 2); ?></td>
<td><?php echo $row['payment_date']; ?></td>
<td><span class="badge bg-info"><?php echo htmlspecialchars($row['method']); ?></span></td>
</tr>
<?php 
$i++; 
}
} else {
    echo "<tr><td colspan='5' class='text-center'>No Payments Found</td></tr>";
}
?>

</tbody>

</table>

</div>
</div>

</div>
</div>

<footer class="footer text-center">
<div class="container">
    © <?php echo date('Y'); ?> 💪 
    <span class="logo-highlight">VYOMRA</span> Fitness | 
    All Rights Reserved
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>