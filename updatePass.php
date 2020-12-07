<?php session_start(); ?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$msg= "";
if(isset($_POST['submit'])){
	$pass1 = $_POST['pass'];
	$npass = $_POST['npass'];
	$cpass = $_POST['cpass'];
	$database = new Database();
	$db = $database->getConnection();
	$pass = new user();
	$msg = $pass->updatePass($pass1,$npass,$cpass,$db);
}
?>
<?php include 'header.php' ?>
<style>
  table,th,td{
border:none;
border-collapse: none;
}
</style>
<div class="wrapper">
	<table class="center">
		<form action="" method="post" novalidate>
			<tr>
				<td><label for="pass">Current Password</label></td>
				<td><input type="password" name="pass"></td>
			</tr>
			<tr>
				<td><label for="npass">New Password</label></td>
				<td><input type="password" name="npass"></td>
			</tr>
			<tr>
				<td><label for="cpass">Confirm Password</label></td>
				<td><input type="password" name="cpass"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Update"></td>
			</tr>
		</table>
	</form>
	<div>
		<h2 style="color:red;text-align:center;"><?php print_r( $msg) ?></h2>
	</div>
</div>

<?php include 'footer.php' ?>