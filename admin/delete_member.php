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

// Delete related records first
$stmt1 = $conn->prepare("DELETE FROM payments WHERE member_id=?");
$stmt1->bind_param("i", $id);
$stmt1->execute();

$stmt2 = $conn->prepare("DELETE FROM trainer_members WHERE member_id=?");
$stmt2->bind_param("i", $id);
$stmt2->execute();

// Delete member
$stmt3 = $conn->prepare("DELETE FROM members WHERE member_id=?");
$stmt3->bind_param("i", $id);
$stmt3->execute();

header("Location: view_members.php");
exit();
?>