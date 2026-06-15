<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(isset($_GET['search']) && $_GET['search'] != ""){
    
    $search = trim($_GET['search']);

    $stmt = $conn->prepare("
        SELECT m.*, t.name AS trainer_name, w.title AS workout_title
        FROM members m
        LEFT JOIN trainers t ON m.trainer_id = t.trainer_id
        LEFT JOIN workout_plans w ON m.workout_id = w.plan_id
        WHERE m.name LIKE ? OR m.phone LIKE ?
        ORDER BY m.member_id ASC
    ");

    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

} else {

    $query = "
        SELECT m.*, t.name AS trainer_name, w.title AS workout_title
        FROM members m
        LEFT JOIN trainers t ON m.trainer_id = t.trainer_id
        LEFT JOIN workout_plans w ON m.workout_id = w.plan_id
        ORDER BY m.member_id ASC
    ";

    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Members</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
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

<h2 class="mb-4 text-white">Members List</h2>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
<a class="btn btn-success px-3" href="add_member.php">+ Add Member</a>

<form method="GET" class="d-flex search-box">
<input class="form-control me-2" type="text" name="search" placeholder="Search by name or phone" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
<button class="btn btn-primary">Search</button>
</form>
</div>

<div class="card table-card p-3 shadow">
<div class="table-responsive" style="overflow-x:auto;">

<table class="table table-hover align-middle" style="width:max-content; min-width:100%;">

<thead class="table-dark">
<tr>
<th>No.</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Phone</th>
<th>Email</th>
<th>Join Date</th>
<th>Plan</th>
<th>Trainer</th>
<th>Workout</th>
<th>Expiry Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php 
$i = 1;

while($row = mysqli_fetch_assoc($result)){ 
?>
<tr class="<?php 
    if ($row['expiry_date'] < date('Y-m-d')) {
        echo 'table-danger';  // For expired members
    } elseif ($row['expiry_date'] >= date('Y-m-d') && $row['expiry_date'] <= date('Y-m-d', strtotime('+7 days'))) {
        echo 'table-warning'; // For expiring soon members
    } else {
        echo strtolower($row['plan']);  // Default for normal members
    }
?>">

<td><?php echo $i; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo htmlspecialchars($row['gender']); ?></td>
<td><?php echo htmlspecialchars($row['phone']); ?></td>
<td><?php echo htmlspecialchars($row['email']); ?></td>
<td><?php echo $row['join_date']; ?></td>

<td><span class="badge bg-info"><?php echo htmlspecialchars($row['plan']); ?></span></td>

<td><?php echo !empty($row['trainer_name']) ? htmlspecialchars($row['trainer_name']) : 'N/A'; ?></td>
<td><?php echo !empty($row['workout_title']) ? htmlspecialchars($row['workout_title']) : 'N/A'; ?></td>
<td><?php echo $row['expiry_date']; ?></td>

<td>
<?php
$today = date('Y-m-d');

if($row['expiry_date'] < $today){
    echo "<span class='badge bg-danger'>Expired</span>";
} else {
    echo "<span class='badge bg-success'>Active</span>";
}
?>
</td>

<td>
<a class="btn btn-warning btn-sm" href="edit_member.php?id=<?php echo $row['member_id']; ?>">Edit</a>
<a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="delete_member.php?id=<?php echo $row['member_id']; ?>">Delete</a>
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