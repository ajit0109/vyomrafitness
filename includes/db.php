
<?php
$conn = mysqli_connect("sql112.infinityfree.com", "if0_41450537", "Ajju0904", "if0_41450537_fitness_club");

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>