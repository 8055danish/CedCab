<?php session_start(); ?>
<?php
include './class/classes.php';
include './class/conn.php';
$id = $_SESSION['user_id'];
$s="";
if(isset($_POST['sort'])){
	echo $s = $_POST['sort'];
}
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$rides = $ride->userCompleteRide($id,$s,$db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<div class="column1">
		<table class="adminTable">
			<h2 class="align">Your Total Complete Rides(<?php echo count($rides); ?>)</h2>
			<hr>
			<?php if(count($rides)>0): ?>
				<tr class="color"><th>RIDE_ID</th><th>RIDE_DATE</th><th>FROM</th><th>TO</th><th>TOTAL_DISTANCE</th><th>TOTAL_FARE</th></tr>
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
	<div  class="column2">
			<form method="POST" action="">
				<select name="sort" id="sort" onchange="this.form.submit()">
					<option selected disabled>Sort By</option>
					<option value="dateasc">By Date ASC</option>
					<option value="datedsc">By Date DSC</option>
					<option value="faredsc">By Fare ASC</option>
					<option value="fareasc">By Fare DSC</option>
				</select>
			</form>
			<hr>
	</div>
</div>
<?php include "footer.php"; ?>