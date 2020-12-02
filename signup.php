<?php
include 'class/classes.php';
include 'class/conn.php';
$msg="";
if(isset($_POST['submit'])){
  $user_name =$_POST['username'];
  $name =$_POST['name'];
  $mobile =$_POST['mobile'];
  $password =$_POST['password'];
  $cpassword =$_POST['cpassword'];
  $database = new Database();
  $db = $database->getConnection();
  $User = new user();
  $msg = $User->signup($user_name,$name,$mobile,$password,$cpassword,$db);
}
?>
<?php require "header.php" ?>
<div class="wrapper">
  <h1 class="align">User Registration</h1>
  <table class="center">
    <form action="" name="signup-form" method="post" novalidate>
      <tr>
        <td>Username:</td>
        <td><input name="username" type="text" placeholder="Enter Username"></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><input type="text" name="name" placeholder="Enter Name"></td>
      </tr>
      <tr>
        <td>Mobile No:</td>
        <td><input type="number" maxlength="10" name="mobile" placeholder="Enter 10 Digit Mobile No."></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="password" placeholder="Enter Password"></td>
      </tr>
      <tr>
        <td>Confirm Password:</td>
        <td><input type="password" name="cpassword" placeholder="Enter Confirm Password"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Register"></td>
      </tr>
    </table>
  </form>
  <div>
    <h2 style="color:red;text-align: center;"><?php echo $msg ?></h2>
  </div>
</div>

<?php require "footer.php" ?>


