<?php
include '../class/classes.php';
include '../class/conn.php';
$id = $_POST['id'];
$database = new Database();
$db = $database->getConnection();
$admin = new admin();
$admin->deleteUser($id,$db);
?>