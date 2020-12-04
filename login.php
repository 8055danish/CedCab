 <?php session_start(); ?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$msg="";
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $database = new Database();
  $db = $database->getConnection();
  $User = new user();
  $msg = $User->login($username,$password,$db);
}
?>
<?php require "header.php" ?>
<style>
  table,th,td{
border:none;
border-collapse: none;
}
</style>
<div class="wrapper">
  <h1 class="align">Universal Login</h1>
  <form name="form1" action="" method="post" novalidate>
    <table class="center">
     <tr>
       <td>Username </td>
       <td><input name="username" type="text" required="" placeholder="Enter Username"></td>
     </tr>
     <tr>
       <td>Password </td>
       <td><input name="password" type="password" required="" placeholder="Enter Password"></td>
     </tr>
     <tr><td></td><td> <input type="checkbox" id="check" name="check" value="check"> Remember Me</td></tr>
     <tr>
      <td></td>
      <td><input name="submit" type="submit" value="Login"></td>
    </tr>
  </table>
</form>
<div><h2 style="color:red;text-align:center;"><?php echo $msg ?></h2></div>
</div>
<?php require "footer.php" ?>