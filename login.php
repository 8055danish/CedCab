 <?php session_start(); ?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$msg="";
if(isset($_POST['submit'])){
  $username = trim($_POST['username']," ");
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
  <h1 class="align">User Login</h1>
  <form name="form1" action="" method="post" novalidate>
    <table class="center">
     <tr>
       <td>Username </td>
       <td><input name="username" class="lugwt" type="text" required="" placeholder="Enter Username"></td>
     </tr>
     <tr>
       <td>Password </td>
       <td><input name="password" class="lugwt" type="password" required="" placeholder="Enter Password"></td>
     </tr>
     <tr><td></td><td> <input type="checkbox" id="check" name="check" value="check"> Remember Me</td></tr>
     <tr>
      <td>&nbsp;</td>
      <td><input name="submit" type="submit" value="Login"></td>
    </tr>
  </table>
</form>
<div><h2 style="color:red;text-align:center;"><?php echo $msg ?></h2></div>
</div>
<script type="text/javascript">
  $('.lugwt').on("cut copy paste drag drop",function(e) {
e.preventDefault();
});
</script>
<?php require "footer.php" ?>