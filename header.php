<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Cab Booking</title>
  <link rel="stylesheet" type="text/css" href="css/mycss.css">
  <script src="script/myScript.js"></script>   
</head>
<body>
  <ul>
    <li><a><img src="image/cab.png" style="width:40px;height:25px" alt="image missing.."></a></li>
    <?php if(isset($_SESSION['login']) && $_SESSION['login']=='true'){ ?>
     <li><a href="index.php">Book Cab</a></li>
     <li class="dropdown1">
      <a href="javascript:void(0)" class="dropbtn1">Ride&#x21B4;</a>
      <div class="dropdown-content1">
        <a href="pendingRide.php">Pending Rides</a>
        <a href="completeRide.php">Complete Rides</a>
        <a href="allRide.php">All Rides</a>
      </div>
    </li>
    <li class="dropdown1">
      <a href="javascript:void(0)" class="dropbtn1">Account&#x21B4;</a>
      <div class="dropdown-content1">
        <a href="profile.php">Update info.</a>
        <a href="updatePass.php">Change Password</a>
      </div>
    </li>
    <li><a href="logout.php">Logout</a></li>
  <?php }else { ?>
   <li><a href="index.php">Book Cab</a></li>
   <li><a href="login.php">Login</a></li>
   <li><a href="signup.php">Register</a></li>
 <?php } ?> 
 <?php if(isset($_SESSION['login'])&& $_SESSION['login']=='true') { ?>
  <span id="right-span">
    Welcome <strong><?php echo $_SESSION['name'] ?></strong>
  </span>
<?php } ?>
</ul>
