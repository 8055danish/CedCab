<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CabBook Admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="../script/myScript.js"></script>
	<link rel="stylesheet" href="../css/mycss.css">
</head>
<body>
	<header>
		<ul>
			<li><a><img src="../image/cab.png" style="width:40px;height:25px" alt="image missing.."></a></li>
			<li><a href="index.php">Home</a></li>
			<li class="dropdown1">
				<a href="javascript:void(0)" class="dropbtn1">Rides&#x21B4;</a>
				<div class="dropdown-content1">
					<a href="pendingRides.php">Pending Rides</a>
					<a href="completeRides.php">Complete Rides</a>
					<a href="cancelledRides.php">Cancelled Rides</a>
					<a href="allRides.php">All Rides</a>
				</div>
			</li>
			<li class="dropdown1">
				<a href="javascript:void(0)" class="dropbtn1">Users&#x21B4;</a>
				<div class="dropdown-content1">
					<a href="pendingUser.php">Pending User Request</a>
					<a href="approvedUser.php">Approved User Request</a>
					<a href="allUser.php">All User</a>
				</div>
			</li>
			<li class="dropdown1">
				<a href="javascript:void(0)" class="dropbtn1">Location&#x21B4;</a>
				<div class="dropdown-content1">
					<a href="location.php">Location List</a>
					<a href="addLocation.php">Add New Location</a>
				</div>
			</li>
			<li class="dropdown1">
				<a href="javascript:void(0)" class="dropbtn1">Acccount&#x21B4;</a>
				<div class="dropdown-content1">
					<a href="updatePass.php">Change Password</a>
				</div>
			</li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
	</header>