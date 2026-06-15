<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$success = "";
$error = "";

if(isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $plan = $_POST['plan'];

    $trainer_id = !empty($_POST['trainer_id']) ? (int)$_POST['trainer_id'] : NULL;
    $workout_id = !empty($_POST['workout_id']) ? (int)$_POST['workout_id'] : NULL;

    $amount = !empty($_POST['amount']) ? (float)$_POST['amount'] : NULL;
    $method = !empty($_POST['method']) ? trim($_POST['method']) : NULL;

    // Expiry date based on selected plan
    if($plan == "Basic"){
        $expiry = date('Y-m-d', strtotime('+1 month'));
    } elseif($plan == "Standard"){
        $expiry = date('Y-m-d', strtotime('+3 months'));
    } elseif($plan == "Premium"){
        $expiry = date('Y-m-d', strtotime('+1 year'));
    } else {
        $expiry = NULL;
    }

    if(empty($name) || empty($age) || empty($gender) || empty($phone) || empty($email) || empty($plan)){
        $error = "Please fill all required fields";
    } elseif($expiry === NULL){
        $error = "Invalid membership plan selected";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO members
            (name, age, gender, phone, email, join_date, plan, expiry_date, trainer_id, workout_id)
            VALUES (?, ?, ?, ?, ?, CURDATE(), ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sisssssii",
            $name,
            $age,
            $gender,
            $phone,
            $email,
            $plan,
            $expiry,
            $trainer_id,
            $workout_id
        );

        if($stmt->execute()){

            $member_id = $conn->insert_id;

            if($amount !== NULL && !empty($method)){
                $pay_stmt = $conn->prepare("
                    INSERT INTO payments (member_id, amount, payment_date, method)
                    VALUES (?, ?, CURDATE(), ?)
                ");
                $pay_stmt->bind_param("ids", $member_id, $amount, $method);
                $pay_stmt->execute();
            }

            $success = "Member Added Successfully";

        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}

$trainers = mysqli_query($conn, "SELECT * FROM trainers ORDER BY name ASC");
$workouts = mysqli_query($conn, "SELECT * FROM workout_plans ORDER BY title ASC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Member</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>

/* PAGE STRUCTURE */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

/* SCROLLABLE CONTENT */
.main-content {
    flex: 1;
    overflow-y: auto;
    padding-top: 20px;
    padding-bottom: 20px;
}

/* CENTER FORM */
.form-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

/* FORM */
.form-card {
    width: 100%;
    max-width: 450px;
    padding: 20px 15px;
}

.form-card input,
.form-card select {
    margin-bottom: 10px;
}

</style>
</head>

<body class="dashboard-bg">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
<div class="container-fluid px-4">

<a class="navbar-brand fw-bold" href="dashboard.php">
💪 <span class="logo-highlight">VYOMRA</span> Fitness
</a>

<div class="ms-auto">
<a href="view_members.php" class="btn btn-outline-light me-2">View Members</a>
<a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">

<div class="container form-wrapper">

<div class="card form-card shadow">

<h3 class="text-center">Add Member</h3>

<?php if($success != "") { ?>
<div class="alert alert-success text-center"><?php echo $success; ?></div>
<?php } ?>

<?php if($error != "") { ?>
<div class="alert alert-danger text-center"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input class="form-control" type="text" name="name" placeholder="Name" required>
<input class="form-control" type="number" name="age" placeholder="Age" required>

<select class="form-control" name="gender" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

<input class="form-control" type="text" name="phone" placeholder="Phone" required>
<input class="form-control" type="email" name="email" placeholder="Email" required>

<select class="form-control" name="plan" required>
<option value="">Select Plan</option>
<option>Basic</option>
<option>Standard</option>
<option>Premium</option>
</select>

<select class="form-control" name="trainer_id">
<option value="">Select Trainer</option>
<?php while($t = mysqli_fetch_assoc($trainers)){ ?>
<option value="<?php echo $t['trainer_id']; ?>"><?php echo $t['name']; ?></option>
<?php } ?>
</select>

<select class="form-control" name="workout_id">
<option value="">Select Workout</option>
<?php while($w = mysqli_fetch_assoc($workouts)){ ?>
<option value="<?php echo $w['plan_id']; ?>"><?php echo $w['title']; ?></option>
<?php } ?>
</select>

<h5 class="mt-3">Payment</h5>

<input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount">

<select class="form-control" name="method">
<option value="">Method</option>
<option>Cash</option>
<option>UPI</option>
<option>Card</option>
</select>

<!-- ✅ GREEN BUTTON -->
<button class="btn btn-success w-100 mt-2 fw-bold" name="submit">
Add Member
</button>

</form>

</div>
</div>
</div>

<!-- ✅ IMPROVED FOOTER -->
<footer class="footer text-center">
<div class="container">
    © <?php echo date('Y'); ?> 💪 
    <span class="logo-highlight">VYOMRA</span> Fitness | 
    All Rights Reserved
</div>
</footer>

</body>
</html>