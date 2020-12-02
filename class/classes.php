<?php 
class user{
	function login($user_name,$password,$db){
		if($user_name=="" && $password==""){
			return "All fields must be filled";
		}
		$query0 = "SELECT `user_name`, `password` FROM `admin`";
		$stmt0 = $db->prepare($query0);
		$stmt0->execute();
		$admin = $stmt0->fetch(PDO::FETCH_ASSOC);

		if($user_name==$admin['user_name'] and $password==$admin['password']){
			$_SESSION['alogin']="true";
			header("location:admin");
		}
		$password = md5($password);
		$user_check_query = "SELECT * FROM `tbl_user` WHERE `user_name`='$user_name' and `password`='$password' LIMIT 1";
		$stmt = $db->prepare($user_check_query);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		if($user['user_name']==$user_name and $user['password']==$password && $user['isblock']=='0') {
			$_SESSION['login'] = "false";
			return "Wait for admin to aprrove";
		}
		else if($user['user_name']==$user_name and $user['password']==$password && $user['isblock']=='1') {
			if(isset($_POST['check'])){
				setcookie('username',$user_name,time()+60*60*7);
				setcookie('password',$password,time()+60*60*7);
			}
			$_SESSION['login'] = "true";
			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['name'] = $user['name'];
			header("location:index.php");
		}
		
		else{
			return "Email or Password Incorrect";
		}
	}	
	function signup($user_name,$name,$mobile,$password,$cpassword,$db){
		if($user_name==""||$name==""||$mobile==""||$password==""||$cpassword==""){
			return "All field must be filled";
			
		}
		if($password!=$cpassword){
			return "Both Password should be same";
			
		}
		$user_check_query = "SELECT `user_name` FROM `tbl_user` WHERE user_name='$user_name'";
		$stmt = $db->prepare($user_check_query);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) { // if user exists
        	if ($user['user_name']==$user_name) {
        		return "Username already exists";
        	}
        }
        $query = "INSERT INTO `tbl_user` (`user_name`,`name`,`dateofsignup`,`mobile`,`isblock`,`password`,`is_admin`)
        VALUES (
        '".$user_name."','".$name."',now(),'".$mobile."','0','".md5($password)."','0')";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return "Registration Successful";   
    }
    function myprofile($user_id,$db){
    	$user_query = "SELECT `user_name`,`name`,`mobile` FROM `tbl_user` WHERE `user_id`='$user_id' LIMIT 1";
    	$stmt = $db->prepare($user_query);
    	$stmt->execute();
    	$user = $stmt->fetch(PDO::FETCH_ASSOC);
    	return $user;
    }
    function updateprofile($user_id,$name,$mobile,$db){
    	$query ="UPDATE `tbl_user` SET `name`='".$name."',`mobile`='".$mobile."' WHERE `user_id` ='".$user_id."'";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	header("location:./profile.php");
    }
    function updatePass($pass,$npass,$cpass,$db){
    	if($pass==""||$npass==""||$cpass==""){
    		return "All Field must be filled";
    	}
    	if($npass!==$cpass){
    		return "New Password and Confrim Password Should be same";
    	}
    	$query = "SELECT * FROM `tbl_user` WHERE user_name='".$_SESSION['user_id']."'";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	$user = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($user['password']==$pass || $npass==$cpass){
    		$query1 = "UPDATE `tbl_user` SET `password`='".md5($cpass)."'";
    		$stmt1 = $db->prepare($query1);
    		$stmt1->execute();
    		return "Password Updated Successfully";
    	}
    }
}
class admin{
	function isBlockUser($db){
		$user_query = "SELECT `user_id`,`user_name`,`isblock` FROM `tbl_user` WHERE `isblock`='0'";
		$stmt = $db->prepare($user_query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $users;
	}
	function isNotBlockUser($db){
		$user_query = "SELECT `user_id`,`user_name`,`isblock` FROM `tbl_user` WHERE `isblock`='1'";
		$stmt = $db->prepare($user_query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $users;
	}
	function blockunblock($id,$isblock,$db){
		if($isblock==0)
			$isblock = 1;
		else
			$isblock = 0;

		$query ="UPDATE `tbl_user` SET `isblock`=".$isblock." WHERE `user_id` =".$id;
		$stmt = $db->prepare($query);
		$stmt->execute();
	}
	function allUser($db){
		$user_query = "SELECT * FROM `tbl_user`";
		$stmt = $db->prepare($user_query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $users;
	}
	function updatePass($pass,$npass,$cpass,$db){
		if($pass==""||$npass==""||$cpass==""){
			return "All Field must be filled";
		}
		if($npass!==$cpass){
			return "New Password and Confrim Password Should be same";
		}
		$query = "SELECT * FROM `admin`";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$admin = $stmt->fetch(PDO::FETCH_ASSOC);
		if($admin['password']==$pass || $npass==$cpass){
			$query1 = "UPDATE `admin` SET `password`='".$cpass."'";
			$stmt1 = $db->prepare($query1);
			$stmt1->execute();
			return "Password Updated Successfully";
		}
	}
}
class ride{
	function total_price($p,$d,$c,$w,$db){
		session_start();
		$query1 = "SELECT * from `tbl_location` WHERE name='".$p."'"; 
		$query2 = "SELECT * from `tbl_location` WHERE name='".$d."'";
		$stmt = $db->prepare($query1);
		$stmt->execute();
		$location1 = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt1 = $db->prepare($query2);
		$stmt1->execute();
		$location2 = $stmt1->fetch(PDO::FETCH_ASSOC);

		$total_distance =abs($location1['distance'] - $location2['distance']);

		if($c == 'CabMicro'){
			if($total_distance==10)
				$price = 185; //185=50+10*13.50
			elseif($total_distance>10 && $total_distance<=60)
				$price =185+(($total_distance-10)*12);
			elseif($total_distance>60 && $total_distance<=160)
				$price =785+(($total_distance-60)*10.2); //785=50+10*13.50 +50*12
			else
				$price =1805+(($total_distance-160)*8.5); //1805=50+10*13.50 +50*12+100*10.2
		}
		if($c == 'CabMini'){
			if($total_distance==10)
				$price = 295; //295=150+10*14.5
			elseif($total_distance>10 && $total_distance<=60)
				$price =295+(($total_distance-10)*13);
			elseif($total_distance>60 && $total_distance<=160)
				$price =945+(($total_distance-60)*11.2);//945=150+10*14.5+50*13
			else
				$price =2065+(($total_distance-160)*9.5); //2065=150+10*14.5+50*13+100*10.20
		}
		if($c == 'CabRoyal'){
			if($total_distance==10)
				$price = 355; //335=200+10*15.5
			elseif($total_distance>10 && $total_distance<=60)
				$price =355+(($total_distance-10)*14);
			elseif($total_distance>60 && $total_distance<=160)
				$price =1055+(($total_distance-60)*12.2); //1055=200+10*15.5+100*50*14
			else
				$price =2275+(($total_distance-160)*10.5); //2275=200+10*15.5+100*50*14+100*10.5
		}
		if($c == 'CabSUV'){
			if($total_distance==10)
				$price = 415; //415=250+10*16.50
			elseif($total_distance>10 && $total_distance<=60)
				$price =415+(($total_distance-10)*15);
			elseif($total_distance>60 && $total_distance<=160)
				$price =1165+(($total_distance-60)*13.2); //1165=250+10*16.50+50*15
			else
				$price =2485+(($total_distance-160)*11.5); //1165=250+10*16.50+50*15+100*13.20
		}

		$weight = 0;

		if($c == 'CabMini' || $c == 'CabRoyal'){
			if($w<=10){
				$weight = 50;
			}
			if($w>10 && $w<=20){
				$weight = 100;
			}
			if($w>20){
				$weight = 200;
			}
		}
		if($c == 'CabSUV'){
			if($w<=10){
				$weight = 2*50;
			}
			if($w>10 && $w<=20){
				$weight = 2*100;
			}
			if($w>20){
				$weight = 2*200;
			}	
		}
		$_SESSION['start'] = time();
		$_SESSION['total_distance'] = $total_distance;
		$_SESSION['from'] = $location1['name'];
		$_SESSION['to'] = $location2['name'];
		$_SESSION['luggage'] = $w;
		$total_price =$price + $weight;
		$_SESSION['total_price'] = $total_price;
		echo $total_price;
	}
	function my_ride($db){
		session_start();
		if(isset($_SESSION['login'])){
			$query0="SELECT `ride_id` from `tbl_ride` WHERE `status`='1' AND customer_user_id='".$_SESSION['user_id']."'";
			$stmt0 = $db->prepare($query0);
			$stmt0->execute();
			$ride = $stmt0->fetch(PDO::FETCH_ASSOC);
			if($ride['ride_id']){
				echo "Pending Ride Exist,Please Wait..";
				return;
			}
		}
		if(isset($_SESSION['login'])){
			$query = "INSERT INTO `tbl_ride`( `ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES (now()".",'".$_SESSION['from']."','".$_SESSION['to']."','".$_SESSION['total_distance']."','".$_SESSION['luggage']."','".$_SESSION['total_price']."','1','".$_SESSION['user_id']."')";
			$stmt = $db->prepare($query);
			$stmt->execute();
			unset($_SESSION['from']);
			unset($_SESSION['to']);
			unset($_SESSION['total_distance']);
			unset($_SESSION['luggage']);
			unset($_SESSION['total_price']);
			echo "Success,waiting for admin to approve,Check ride section";
			return;}
			else{
				echo "Please Login First";
				return;
			}
		}
		function cancelledRides($db){
			$query = "SELECT * FROM `tbl_ride` WHERE `status`='0'";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rides;

		}
		function pendingRides($db){
			$query = "SELECT * FROM `tbl_ride` WHERE `status`='1'";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rides;
		}
		function completeRides($db){
			$query = "SELECT * FROM `tbl_ride` WHERE `status`='2'";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rides;
		}

		function allRides($s,$db){
			if($s==""){
				$query = "SELECT * FROM `tbl_ride`";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}
			if($s=="date"){
				$query = "SELECT * FROM `tbl_ride` ORDER BY `ride_date` ASC";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}
			if($s=="fare"){
				$query = "SELECT * FROM `tbl_ride` ORDER BY `total_fare` ASC";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}

		}
		function rideStatus($id,$s,$db){
			$query = "UPDATE `tbl_ride` SET `status`='".$s."' WHERE ride_id=".$id;
			$stmt = $db->prepare($query);
			$stmt->execute();
			return $rides;
		}
		function userPendingRide($id,$db){
			$query = "SELECT * FROM `tbl_ride` WHERE `status`='1' AND `customer_user_id`=".$id;
			$stmt = $db->prepare($query);
			$stmt->execute();
			$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rides;

		}
		function userCompleteRide($id,$db){
			$query = "SELECT * FROM `tbl_ride` WHERE `status`='2' AND `customer_user_id`=".$id;
			$stmt = $db->prepare($query);
			$stmt->execute();
			$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rides;

		}
		function userAllRide($id,$s,$db){
			if($s==""){
				$query = "SELECT * FROM `tbl_ride` WHERE `customer_user_id`=".$id;
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}
			if($s=="date"){
				$query = "SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' ORDER BY `ride_date` ASC";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}
			if($s=="fare"){
				$query = "SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' ORDER BY `total_fare` ASC";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rides;
			}

		}
		function deleteRide($id,$db){
			$query = "DELETE FROM `tbl_ride` WHERE `ride_id`='".$id."'";
			$stmt = $db->prepare($query);
			$stmt->execute();
		}
	}
	class location{
		function totalLocation($db){
			$query = "SELECT * from `tbl_location` ORDER BY `distance` asc";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $locations;
		}
		function addLoc($name,$dist,$db){
			$check_query = "SELECT `name` from `tbl_location` WHERE name='".ucfirst($name)."'";
			$stmt0 = $db->prepare($check_query);
			$stmt0->execute();
			$loc = $stmt0->fetch(PDO::FETCH_ASSOC);
			if($loc['name']==ucfirst($name)){
				return "Location already exist";
			}
			$query = "INSERT INTO `tbl_location`(`name`, `distance`, `is_available`) VALUES ('".$name."','".$dist."','1')";
			$stmt = $db->prepare($query);
			$stmt->execute();
			header("location:../admin/addLocation.php");
		}
		function updateLoc($id,$name,$dist,$db){
			$query = "UPDATE `tbl_location` SET `name`='".$name."',`distance`='".$dist."' WHERE `id`=".$id;
			$stmt = $db->prepare($query);
			$stmt->execute();
		}
		function deleteLoc($id,$db){
			$query="DELETE FROM `tbl_location` WHERE `id`='".$id."'";
			$stmt = $db->prepare($query);
			$stmt->execute();
		}
	} 
	?>