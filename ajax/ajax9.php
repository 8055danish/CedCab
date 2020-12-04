<?php
include '../class/classes.php';
include '../class/conn.php';
$id = $_POST['id'];
$database = new Database();
$db = $database->getConnection();
$user = new user();
$user->deleteMyRide($id,$db);
?>