<?php
include '../class/classes.php';
include '../class/conn.php';
$id = $_POST['id'];
$s = $_POST['s'];
$database = new Database();
$db = $database->getConnection();
$location = new location();
$location->buloc($id,$s,$db);
?>