<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$success = "";
$error = "";

if(isset($_POST['add'])){

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $specialization = trim($_POST['specialization']);

    if(empty($name) || empty($phone)){
        $error = "Name and phone are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO trainers (name, phone, specialization) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $specialization);

        if($stmt->execute()){
            $success = "Trainer Added Successfully";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Trainer</title>

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
    overflow-y: auto;
    padding-top: 20px;
    padding-bottom: 20px;
}

.form-card {
    max-width: 500px;
    margin: 0 auto;
    border-radius: 12px;
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
<a href="view_trainers.php" class="btn btn-outline-light me-2">View Trainers</a>
<a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<div class="main-content">
<div class="container mt-5">

<div class="card form-card p-4 shadow">

<h3 class="text-center mb-4">Add Trainer</h3>

<?php if($success != ""){ ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php } ?>

<?php if($error != ""){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>Specialization</label>
<input type="text" name="specialization" class="form-control" placeholder="e.g. Weight Loss, Strength">
</div>

<button type="submit" name="add" class="btn btn-success w-100 fw-bold">
Add Trainer
</button>

</form>

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

</body>
</html>