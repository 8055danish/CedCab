<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$location = new location();
$tl = $location->totalLocation($db); 
$t=0;
foreach($tl as $key) {
	$t +=1;
}
?>
<?php include 'header.php'; ?>
<div class="wrapper">
	<h2 class="align">Here Are Total <?php echo $t;?> Locations</h2><hr>
	<table>
		<thead>
			<tr>
				<th>ID </th>
				<th>Name </th>
				<th>Available</th>
				<th>Distance </th>
			</tr>
		</thead>
		<tbody style="color:red;">
			<?php foreach ($tl as $key=>$value): ?>
				<tr>
					<td><?php echo $value['id'];?></td>
					<td><?php echo $value['name'];?></td>
					<td><?php if( $value['is_available'])echo "Enable";else echo "Disable";?></td>
					<td><?php echo $value['distance'];?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php include 'footer.php'; ?>