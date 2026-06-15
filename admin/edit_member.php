<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: view_members.php");
    exit();
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM members WHERE member_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if(!$row){
    header("Location: view_members.php");
    exit();
}

if(isset($_POST['update'])){

    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $plan = $_POST['plan'];

    // Recalculate expiry based on old join_date when plan changes
    $join_date = $row['join_date'];

    if($plan == "Basic"){
        $expiry_date = date('Y-m-d', strtotime($join_date . ' +1 month'));
    } elseif($plan == "Standard"){
        $expiry_date = date('Y-m-d', strtotime($join_date . ' +3 months'));
    } elseif($plan == "Premium"){
        $expiry_date = date('Y-m-d', strtotime($join_date . ' +1 year'));
    } else {
        $expiry_date = $row['expiry_date'];
    }

    $update = $conn->prepare("
        UPDATE members
        SET name=?, age=?, gender=?, phone=?, email=?, plan=?, expiry_date=?
        WHERE member_id=?
    ");
    $update->bind_param("sisssssi", $name, $age, $gender, $phone, $email, $plan, $expiry_date, $id);
    $update->execute();

    header("Location: view_members.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Member</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">

<nav class="navbar navbar-dark custom-navbar">
<div class="container-fluid px-4">
<a class="navbar-brand fw-bold" href="dashboard.php">💪 <span class="logo-highlight">VYOMRA</span> Fitness</a>
<div class="ms-auto">
<a href="view_members.php" class="btn btn-outline-light me-2">Back</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>
</div>
</nav>

<div class="main-content">
<div class="container mt-5">
<div class="card form-card p-4 shadow">

<h3 class="text-center mb-4">Edit Member</h3>

<form method="POST">

<input class="form-control mb-3" type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
<input class="form-control mb-3" type="number" name="age" value="<?php echo $row['age']; ?>" required>

<select class="form-control mb-3" name="gender" required>
<option value="Male" <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
<option value="Female" <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
<option value="Other" <?php if($row['gender']=="Other") echo "selected"; ?>>Other</option>
</select>

<input class="form-control mb-3" type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
<input class="form-control mb-3" type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

<select class="form-control mb-3" name="plan" required>
<option value="Basic" <?php if($row['plan']=="Basic") echo "selected"; ?>>Basic</option>
<option value="Standard" <?php if($row['plan']=="Standard") echo "selected"; ?>>Standard</option>
<option value="Premium" <?php if($row['plan']=="Premium") echo "selected"; ?>>Premium</option>
</select>

<button class="btn btn-primary w-100" name="update">Update Member</button>

</form>

</div>
</div>
</div>

<footer class="footer">
© <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness
</footer>

</body>
</html>