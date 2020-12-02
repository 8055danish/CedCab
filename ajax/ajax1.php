<?php
$p = $_POST['p'];
$d = $_POST['d'];
$c = $_POST['c'];
$w = $_POST['w'];
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$ride->total_price($p,$d,$c,$w,$db);
?>