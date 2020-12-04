<?php session_start(); ?>
<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$s="";
if(isset($_POST['sort'])){
	$s = $_POST['sort'];
}
$ride = new ride();
$rides = $ride->cancelledRides($s,$db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<div class="column1">
		<table class="adminTable">
			<h2 class="align">Total Cancelled Rides(<?php echo count($rides); ?>)</h2><hr>
			<?php if(count($rides)>0): ?>
				<tr><th>RIDE ID </th><th>RIDE DATE </th><th>FROM </th><th>TO </th><th>TOTAL DISTANCE </th><th>LUGGAGE </th><th>TOTAL FARE </th><th>STATUS</th><th>USER ID </th></tr>
				<?php foreach($rides as $key=>$value): ?>
					<tr style="color:red;">   
						<td><?php echo $value['ride_id']?></td>
						<td><?php echo $value['ride_date']?></td>
						<td><?php echo $value['from']?></td>
						<td><?php echo $value['to']?></td>
						<td><?php echo $value['total_distance']?></td>
						<td><?php if( $value['luggage'])echo $value['luggage']."KG";else echo "0KG"?></td>
						<td><?php echo $value['total_fare']?></td>
						<td><?php echo $value['status']?></td>
						<td><?php echo $value['customer_user_id']?></td>
					</tr>
				<?php endforeach; ?>
				<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
				<?php endif;?>
			</table>
		</div>
		<div class="column2">
			<form method="POST" action="">
				<select name="sort" id="sort" onchange="this.form.submit()">
					<option selected disabled>Sort By</option>
					<option value="dateasc">By Date ASC</option>
					<option value="datedsc">By Date DSC</option>
					<option value="fareasc">By Fare ASC</option>
					<option value="faredsc">By Fare DSC</option>
				</select>
			</form>
		</div>
	</div>
	<?php include "footer.php"; ?>