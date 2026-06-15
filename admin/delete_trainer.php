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

// Remove trainer references from members table
$stmt1 = $conn->prepare("UPDATE members SET trainer_id=NULL WHERE trainer_id=?");
$stmt1->bind_param("i", $id);
$stmt1->execute();

// Remove trainer-member assignments
$stmt2 = $conn->prepare("DELETE FROM trainer_members WHERE trainer_id=?");
$stmt2->bind_param("i", $id);
$stmt2->execute();

// Delete trainer
$stmt3 = $conn->prepare("DELETE FROM trainers WHERE trainer_id=?");
$stmt3->bind_param("i", $id);
$stmt3->execute();

header("Location: view_trainers.php");
exit();
?>