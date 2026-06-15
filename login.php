<?php
include("includes/db.php");

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    session_start();

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Fitness Club</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body class="login-bg">

<div class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4 shadow" style="width:350px;">
<h3 class="text-center mb-3">Admin Login</h3>

<?php if($error != ""){ ?>
<div class="alert alert-danger text-center"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">
<input class="form-control mb-3" type="text" name="username" placeholder="Username" required>
<input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
<button class="btn btn-primary w-100" name="login">Login</button>
</form>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer">
© <?php echo date('Y'); ?> 💪 <span class="logo-highlight">VYOMRA</span> Fitness | All Rights Reserved
</footer>
</body>
</html>