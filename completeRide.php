<?php session_start(); ?>
<?php
include './class/classes.php';
include './class/conn.php';
$id = $_SESSION['user_id'];
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$rides = $ride->userCompleteRide($id,$db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<table class="adminTable">
		<h2 class="align">Your Total Complete Rides(<?php echo count($rides); ?>)</h2>
		<hr>
		<?php if(count($rides)>0): ?>
			<tr class="color"><th>RIDE_ID&nbsp;</th><th>RIDE_DATE&nbsp;</th><th>FROM&nbsp;</th><th>TO&nbsp;</th><th>TOTAL_DISTANCE&nbsp;</th><th>TOTAL_FARE&nbsp;</th></tr>
			<?php foreach($rides as $key=>$value): ?>
				<tr style="color:red;">   
					<td><?php echo $value['ride_id']?></td>
					<td><?php echo $value['ride_date']?></td>
					<td><?php echo $value['from']?></td>
					<td><?php echo $value['to']?></td>
					<td><?php echo $value['total_distance']?></td>
					<td><?php echo $value['total_fare']?></td>
				</tr>
			<?php endforeach; ?>
			<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
			<?php endif;?>
		</table>
	</div>
	<?php include "footer.php"; ?>