<?php session_start(); ?>
<?php
include './class/classes.php';
include './class/conn.php';
$id = $_SESSION['user_id'];
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$rides = $ride->userPendingRide($id,$db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<table class="adminTable">
		<h2 class="align">Your Total Pending rides(<?php echo count($rides); ?>)</h2><hr>
		<?php if(count($rides)>0): ?>
			<h6 class="align" style="color:yellow">Please Wait For Admin to Approve Your Ride</h6>
			<hr>
			<tr class="color"><th>RIDE_ID</th><th>RIDE_DATE</th><th>FROM</th><th>TO</th><th>TOTAL_DISTANC</th><th>LUGGAGE</th><th>TOTAL_FARE</th><th>ACTION</th></tr>
			<?php foreach($rides as $key=>$value): ?>
				<tr style="color:red;">   
					<td><?php echo $value['ride_id']?></td>
					<td><?php echo $value['ride_date']?></td>
					<td><?php echo $value['from']?></td>
					<td><?php echo $value['to']?></td>
					<td><?php echo $value['total_distance']?></td>
					<td><?php if( $value['luggage'])echo $value['luggage']."KG";else echo "0KG"?></td>
					<td><?php echo $value['total_fare']?></td>
					<td><input type="button" value="cancel Ride" onclick=" cancelledRide(<?php echo $value['ride_id']?>)"></td>
				</tr>
			<?php endforeach; ?>
			<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
			<?php endif;?>
		</table>
	</div>
	<?php include "footer.php"; ?>