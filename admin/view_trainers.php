<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = trim($_GET['search']);
    $stmt = $conn->prepare("SELECT * FROM trainers WHERE name LIKE ? OR phone LIKE ? ORDER BY trainer_id ASC");
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT * FROM trainers ORDER BY trainer_id ASC";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Trainers</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>
.dashboard-bg {
    background-color: #1c1c1c;
    min-height: 100vh;
    padding-top: 70px;
    color: white;
}

.custom-navbar {
    background-color: #111;
}

/* ✅ GOLD COLOR APPLIED */
.logo-highlight {
    color: #FFD700;
}

.table-card {
    background-color: #2c2c2c;
    border-radius: 12px;
    padding: 20px;
    overflow-x: auto;
}

#trainers-table-wrapper {
    overflow-x: auto;
}

#trainers-table td, 
#trainers-table th {
    padding: 5px 10px;
    vertical-align: middle;
    text-align: center;
}

#trainers-table td .btn {
    padding: 3px 8px;
    font-size: 13px;
}

#trainers-table tbody tr {
    height: auto;
}

#trainers-table .badge {
    font-size: 0.9rem;
}

.footer {
    text-align: center;
    padding: 15px;
    background-color: #111;
    color: white;
    position: relative;
}

.search-box input {
    width: 200px;
}
</style>
</head>

<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
<div class="container-fluid px-4">

<a class="navbar-brand fw-bold" href="dashboard.php">
💪 <span class="logo-highlight">VYOMRA</span> Fitness
</a>

<div class="ms-auto">
<a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<div class="main-content">
<div class="container mt-4">

<h2 class="mb-4 text-white">Trainers List</h2>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
<a class="btn btn-success px-3" href="add_trainer.php">+ Add Trainer</a>

<form method="GET" class="d-flex search-box">
<input class="form-control me-2" type="text" name="search" placeholder="Search by name or phone" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
<button class="btn btn-primary">Search</button>
</form>
</div>

<div class="card table-card shadow">
<div id="trainers-table-wrapper">

<table id="trainers-table" class="table table-hover align-middle">

<thead class="table-dark">
<tr>
<th>No.</th>
<th>Name</th>
<th>Phone</th>
<th>Specialization</th>
<th>Assigned Members</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php 
$i = 1;

while($row = mysqli_fetch_assoc($result)){ 
    $trainer_id = (int)$row['trainer_id'];

    $count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM trainer_members WHERE trainer_id=?");
    $count_stmt->bind_param("i", $trainer_id);
    $count_stmt->execute();
    $assigned_count = $count_stmt->get_result()->fetch_assoc()['total'];
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['phone']); ?></td>
<td><?php echo !empty($row['specialization']) ? htmlspecialchars($row['specialization']) : 'N/A'; ?></td>
<td><span class="badge bg-info"><?php echo $assigned_count; ?></span></td>
<td>
<a class="btn btn-primary btn-sm" href="assign_members.php?trainer_id=<?php echo $trainer_id; ?>">Assign</a>
<a class="btn btn-warning btn-sm" href="edit_trainer.php?id=<?php echo $trainer_id; ?>">Edit</a>
<a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="delete_trainer.php?id=<?php echo $trainer_id; ?>">Delete</a>
</td>
</tr>
<?php 
$i++; 
} 
?>
</tbody>
</table>
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