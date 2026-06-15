<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$success = "";
$error = "";

if(isset($_POST['add'])){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $duration = !empty($_POST['duration']) ? (int)$_POST['duration'] : 0;

    if(empty($title) || empty($description) || $duration <= 0){
        $error = "Please fill all required fields correctly.";
    } else {

        $stmt = $conn->prepare("INSERT INTO workout_plans (title, description, duration) VALUES (?, ?, ?)");

        if(!$stmt){
            $error = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("ssi", $title, $description, $duration);

            if($stmt->execute()){
                $success = "Workout Added Successfully";
            } else {
                $error = "Execute failed: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Workout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>
.form-card {
    max-width: 500px;
    margin: auto;
    padding: 25px;
}

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

<nav class="navbar navbar-dark custom-navbar">
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
<div class="container mt-5">

<div class="card form-card shadow">

<h3 class="text-center mb-4">Add Workout Plan</h3>

<?php if($success != ""){ ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php } ?>

<?php if($error != ""){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Workout Title</label>
<input type="text" name="title" id="workoutSelect" class="form-control" placeholder="Type or select a workout" required list="workoutsList" onchange="fillDescription()">

<datalist id="workoutsList">
<option value="Full Body Beginner">
<option value="Weight Loss Starter">
<option value="Basic Strength Training">
<option value="Upper Lower Split">
<option value="Push Pull Legs">
<option value="Muscle Gain Program">
<option value="Bodybuilding Split">
<option value="Fat Loss + HIIT">
<option value="Strength & Conditioning">
<option value="Cardio Blast">
<option value="Core Strength Program">
<option value="Functional Training">
</datalist>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" id="description" class="form-control" rows="4" placeholder="Workout description" required></textarea>
</div>

<div class="mb-3">
<label>Duration (Weeks)</label>
<input type="number" name="duration" class="form-control" min="1" placeholder="e.g., 4" required>
</div>

<button type="submit" name="add" class="btn btn-success w-100">
Add Workout
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

<script>
function fillDescription() {
    let workout = document.getElementById("workoutSelect").value;
    let desc = document.getElementById("description");

    let data = {
        "Full Body Beginner": "Simple full body workout for beginners focusing on basic strength.",
        "Weight Loss Starter": "Light cardio and fat burning exercises for beginners.",
        "Basic Strength Training": "Introduction to strength training with compound movements.",
        "Upper Lower Split": "Workout split targeting upper and lower body on different days.",
        "Push Pull Legs": "Structured workout dividing push, pull and leg exercises.",
        "Muscle Gain Program": "Hypertrophy based program for muscle growth.",
        "Bodybuilding Split": "Advanced training targeting individual muscle groups.",
        "Fat Loss + HIIT": "High intensity workouts combined with fat loss training.",
        "Strength & Conditioning": "Focus on strength, endurance and athletic performance.",
        "Cardio Blast": "High calorie burning cardio workout.",
        "Core Strength Program": "Exercises focused on abs and core muscles.",
        "Functional Training": "Real-life movement based exercises for overall fitness."
    };

    desc.value = data[workout] || "";
}
</script>

</body>
</html>