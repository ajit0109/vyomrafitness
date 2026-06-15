<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(!isset($_GET['trainer_id']) || !is_numeric($_GET['trainer_id'])){
    header("Location: view_trainers.php");
    exit();
}

$trainer_id = (int)$_GET['trainer_id'];
$msg = "";

// Get trainer details
$tstmt = $conn->prepare("SELECT * FROM trainers WHERE trainer_id = ?");
$tstmt->bind_param("i", $trainer_id);
$tstmt->execute();
$trainer = $tstmt->get_result()->fetch_assoc();

if(!$trainer){
    header("Location: view_trainers.php");
    exit();
}

// ASSIGN MEMBER
if(isset($_POST['assign'])){
    $member_id = (int)$_POST['member_id'];

    $check = $conn->prepare("SELECT * FROM trainer_members WHERE trainer_id=? AND member_id=?");
    $check->bind_param("ii", $trainer_id, $member_id);
    $check->execute();
    $check_result = $check->get_result();

    if($check_result->num_rows == 0){
        $insert = $conn->prepare("INSERT INTO trainer_members (trainer_id, member_id) VALUES (?, ?)");
        $insert->bind_param("ii", $trainer_id, $member_id);
        $insert->execute();
        $msg = "Member Assigned Successfully";
    } else {
        $msg = "Member already assigned";
    }
}

// REMOVE MEMBER
if(isset($_POST['remove'])){
    $member_id = (int)$_POST['member_id'];

    $delete = $conn->prepare("DELETE FROM trainer_members WHERE trainer_id=? AND member_id=?");
    $delete->bind_param("ii", $trainer_id, $member_id);
    $delete->execute();

    $msg = "Member Removed Successfully";
}

// Get all members
$members = mysqli_query($conn, "SELECT * FROM members ORDER BY name ASC");

// Get assigned members
$assigned = mysqli_query($conn, "
    SELECT m.* 
    FROM members m
    JOIN trainer_members tm ON m.member_id = tm.member_id
    WHERE tm.trainer_id = $trainer_id
    ORDER BY m.name ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Assign Members</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>
/* ✅ SCROLLABLE TABLE */
.table-scroll {
    max-height: 400px;
    overflow-y: auto;
}

/* Sticky header */
.table-scroll thead th {
    position: sticky;
    top: 0;
    background: #000;
    color: #fff;
    z-index: 2;
}
</style>

</head>

<body class="dashboard-bg">

<nav class="navbar navbar-dark custom-navbar">
<div class="container-fluid px-4">

<a class="navbar-brand fw-bold" href="dashboard.php">
💪 <span class="logo-highlight">VYOMRA</span> Fitness
</a>

<div class="ms-auto">
<a href="view_trainers.php" class="btn btn-outline-light me-2">Back</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<div class="main-content">
<div class="container mt-4">

<h3 class="text-white mb-3">
Assign Members to: <span class="text-warning"><?php echo htmlspecialchars($trainer['name']); ?></span>
</h3>

<?php if($msg != ""){ ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<div class="row">

<div class="col-md-7">
<div class="card p-3 shadow mb-4">
<h5>All Members</h5>

<!-- ✅ SCROLL WRAPPER -->
<div class="table-scroll">
<table class="table table-hover">
<thead>
<tr>
<th>Name</th>
<th>Age</th>
<th>Plan</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($m = mysqli_fetch_assoc($members)){ ?>
<tr>
<td><?php echo htmlspecialchars($m['name']); ?></td>
<td><?php echo $m['age']; ?></td>
<td><?php echo htmlspecialchars($m['plan']); ?></td>
<td>
<form method="POST">
<input type="hidden" name="member_id" value="<?php echo $m['member_id']; ?>">
<button class="btn btn-success btn-sm" name="assign">Add</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>
</div>

<div class="col-md-5">
<div class="card p-3 shadow">

<h5>Assigned Members</h5>

<?php if(mysqli_num_rows($assigned) == 0){ ?>
<p class="text-muted">No members assigned</p>
<?php } ?>

<ul class="list-group">
<?php while($a = mysqli_fetch_assoc($assigned)){ ?>
<li class="list-group-item d-flex justify-content-between align-items-center">
<?php echo htmlspecialchars($a['name']); ?>

<form method="POST" style="margin:0;">
<input type="hidden" name="member_id" value="<?php echo $a['member_id']; ?>">
<button class="btn btn-danger btn-sm" name="remove">Remove</button>
</form>
</li>
<?php } ?>
</ul>

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