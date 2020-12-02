<?php
$id = $_POST['id'];
$isblock = $_POST['isblock'];
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$User = new admin();
$User->blockunblock($id,$isblock,$db);
?>
