<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

$msg = "";
$error = "";

// FETCH MEMBERS
$members = mysqli_query($conn, "SELECT member_id, name FROM members ORDER BY name ASC");

// ADD PAYMENT
if(isset($_POST['submit'])){
    $member_id = !empty($_POST['member_id']) ? (int)$_POST['member_id'] : 0;
    $amount = !empty($_POST['amount']) ? (float)$_POST['amount'] : 0;
    $method = !empty($_POST['method']) ? trim($_POST['method']) : "";

    if($member_id <= 0 || $amount <= 0 || empty($method)){
        $error = "Please fill all fields correctly.";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO payments (member_id, amount, payment_date, method)
            VALUES (?, ?, CURDATE(), ?)
        ");
        $stmt->bind_param("ids", $member_id, $amount, $method);

        if($stmt->execute()){
            $msg = "Payment Added Successfully";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Payment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

<style>
/* ✅ FIX FOOTER POSITION */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1;
}

/* OPTIONAL: center form nicely */
.form-card {
    max-width: 500px;
    margin: auto;
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
<a href="view_payments.php" class="btn btn-outline-light me-2">View Payments</a>
<a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>
</div>

</div>
</nav>

<div class="main-content">
<div class="container mt-5">
<div class="card form-card p-4 shadow">

<h3 class="text-center mb-4">Add Payment</h3>

<?php if($msg != ""){ ?>
<div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<?php if($error != ""){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<select name="member_id" class="form-control mb-3" required>
<option value="">Select Member</option>
<?php while($m = mysqli_fetch_assoc($members)){ ?>
<option value="<?php echo $m['member_id']; ?>">
<?php echo htmlspecialchars($m['name']); ?>
</option>
<?php } ?>
</select>

<input type="number" step="0.01" name="amount" class="form-control mb-3" placeholder="Amount" required>

<select name="method" class="form-control mb-3" required>
<option value="">Select Method</option>
<option>Cash</option>
<option>UPI</option>
<option>Card</option>
</select>

<button class="btn btn-success w-100" name="submit">Add Payment</button>

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