<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$ride->my_ride($db);
?>