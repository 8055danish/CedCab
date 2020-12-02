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
$rides = $ride->allRides($s,$db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
	<div class="row">
		<div class="column1">
			<h2 class="align">Total rides(<?php echo count($rides); ?>)</h2><hr>
			<table class="adminTable">
				<?php if(count($rides)>0): ?>
					<tr><th>RIDE_ID&nbsp;</th><th>RIDE_DATE&nbsp;</th><th>FROM&nbsp;</th><th>TO&nbsp;</th><th>TOTAL_DISTANCE&nbsp;</th><th>LUGGAGE&nbsp;</th><th>TOTAL_FARE&nbsp;</th><th>STATUS&nbsp;</th><th>USER_ID</th></tr>
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
				            <td><input type="button" value="Invoice" data-toggle="modal" data-target="#myModal-<?php echo $value['ride_id']; ?>"></td>
							<td><input type="button" value="Delete Ride" onclick=" deleteRide(<?php echo $value['ride_id']?>)"></td>
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
						<option value="date">By Date</option>
						<option value="fare">By Total Fare</option>
					</select>
				</form>
		</div>
	</div>
</div>
<?php foreach ($rides as $key=>$value): ?>
  <!-- The Modal -->
  <div class="modal fade" id="myModal-<?php echo $value['ride_id']; ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Token Id: <?php echo $value['ride_id'];?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" style="background-color: #333;color:white">
        	 <h5 style="float:right">Date :<?php echo $value['ride_date'];?></h5>
          <h5>User Id :<?php echo $value['customer_user_id'];?></h5>
          <h5>Total Distnace :<?php echo $value['total_distance']; ?></h5>
          <h5><?php echo "From ".$value['from']." To ".$value['to']; ?></h5>
          <h5>Total Luggage :<?php if($value['luggage'])echo $value['luggage'];else echo "0"?>KG</h5>
          <h5>Total fare :Rs.<?php echo $value['total_fare'];?></h5>
        </div>
        
        <!-- Modal footer -->
      <!--   <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php include "footer.php"; ?>