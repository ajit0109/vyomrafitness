<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: view_trainers.php");
    exit();
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM trainers WHERE trainer_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if(!$row){
    header("Location: view_trainers.php");
    exit();
}

if(isset($_POST['update'])){
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $specialization = trim($_POST['specialization']);

    $update = $conn->prepare("UPDATE trainers SET name=?, phone=?, specialization=? WHERE trainer_id=?");
    $update->bind_param("sssi", $name, $phone, $specialization, $id);

    if($update->execute()){
        header("Location: view_trainers.php");
        exit();
    } else {
        echo "Error updating trainer";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Trainer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
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
<div class="container mt-5">
<div class="card form-card p-4 shadow">

<h3 class="text-center mb-4">Edit Trainer</h3>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
</div>

<div class="mb-3">
<label>Specialization</label>
<input type="text" name="specialization" class="form-control" value="<?php echo htmlspecialchars($row['specialization']); ?>">
</div>

<button type="submit" name="update" class="btn btn-primary w-100">
Update Trainer
</button>

</form>

</div>
</div>
</div>

<footer class="footer">
© <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness
</footer>

</body>
</html>