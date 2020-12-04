<?php session_start(); ?>
<?php
include './class/classes.php';
include './class/conn.php';
$id = $_SESSION['user_id'];
$s="";
if(isset($_POST['sort'])){
	$s = $_POST['sort'];
}
$database = new Database();
$db = $database->getConnection();
$ride = new ride();
$rides = $ride->userAllRide($id,$s,$db); 
$tp=0;
foreach ($rides as $key=>$value) {
	$tp +=$value['total_fare'];
}
?>
<?php include "header.php"; ?>

<div class="wrapper">
	<div class="row">
		<div class="column1">
			<h2 class="align">Your Total rides(<?php echo count($rides); ?>)</h2>
			<h6 class="align">You have spend Rs.<?php echo $tp;?> on Total Rides</h6><hr>
			<table class="adminTable">
				<?php if(count($rides)>0): ?>
					<tr class="color"><th>RIDE_ID</th><th>RIDE_DATE</th><th>FROM</th><th>TO</th><th>TOTAL_FARE</th><th>ACTION</th></tr>
					<?php foreach($rides as $key=>$value): ?>
						<tr style="color:red;">   
							<td><?php echo $value['ride_id']?></td>
							<td><?php echo $value['ride_date']?></td>
							<td><?php echo $value['from']?></td>
							<td><?php echo $value['to']?></td>
							<td><?php echo $value['total_fare']?></td>
							<td><input type="button" value="Delete Ride" onclick=" deleteMyRide(<?php echo $value['ride_id']?>)"></td>
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
						<option value="fareasc">By Fare ASC</option>
						<option value="faredsc">By Fare DSC</option>
					</select>
				</form>
				<hr>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>