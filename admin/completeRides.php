<?php session_start(); ?>
<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$rides = $ride->completeRides($db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<table class="adminTable">
		<h2 class="align">Total Complete Rides(<?php echo count($rides); ?>)</h2>
		<?php if(count($rides)>0): ?>
			<tr><th>RIDE ID </th><th>RIDE DATE </th><th>FROM </th><th>TO </th><th>TOTAL DISTANCE </th><th>LUGGAGE </th><th>TOTAL FARE </th><th>STATUS</th><th>USER ID </th></tr>
			<?php foreach($rides as $key=>$value): ?>
				<tr style="color:red;">   
					<td><?php echo $value['ride_id']?></td>
					<td><?php echo $value['ride_date']?></td>
					<td><?php echo $value['from']?></td>
					<td><?php echo $value['to']?></td>
					<td><?php echo $value['total_distance']?></td>
					<td><?php echo $value['luggage']?></td>
					<td><?php echo $value['total_fare']?></td>
					<td><?php echo $value['status']?></td>
					<td><?php echo $value['customer_user_id']?></td>
				</tr>
			<?php endforeach; ?>
			<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
			<?php endif;?>
		</table>
		<?php include "footer.php"; ?>