<?php session_start(); ?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$msg= "";
$user_id = $_SESSION['user_id'];
$database = new Database();
$db = $database->getConnection();
$User = new user();
$user = $User->myprofile($user_id,$db);

if(isset($_POST['submit'])){
	$user_id = $_SESSION['user_id'];
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$User1 = new user();
	$msg = $User1->updateprofile($user_id,$name,$mobile,$db);
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
	<table>
		<form action="" method="post" novalidate>
			<tr>
				<td><label for="username">Username</label></td>
				<td><input style="color:white;" type="text" name="username" value="<?php echo $user['user_name']; ?>" disabled></td>
			</tr>
			<tr>
				<td><label for="name">Name</label></td>
				<td><input type="text" name="name" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" value="<?php echo $user['name']; ?>"></td>
			</tr>
			<tr>
				<td><label for="mobile">Mobile</label></td>
				<td><input type="text" name="mobile" minlength="10" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $user['mobile']; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Update"></td>
			</tr>
		</table>
	</form>
	<div>
		<h2 style="color:red;text-align:center;"><?php if(isset($_GET['s'])){
	echo $msg = $_GET['s'];
}?></h2>
	</div>
</div>

<?php include 'footer.php' ?>