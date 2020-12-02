<?php session_start(); ?>
<?php
if(!isset($_SESSION['alogin'])){
	header("location:..");
}
?>
<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$admin0 = new admin();
$alluser = $admin0->allUser($db);
$admin1 = new admin();
$pendinguser = $admin1->isBlockUser($db);
$ride0 = new ride();
$pendingride = $ride0->pendingRides($db);
$ride1 = new ride();
$s="";
$allride = $ride1->allRides($s,$db);
$loc = new location();
$totalLocation = $loc->totalLocation($db);
$tu=0;
$tf=0;
foreach ($alluser as $key0=>$value0) {
	$tu += 1;
}
$pu=0;
foreach ($pendinguser as $key1=>$value1) {
	$pu += 1;
}
$pr=0;
foreach ($pendingride as $key2=>$value2) {
	$pr += 1;
}
$tr=0;
$td=0;
foreach ($allride as $key3=>$value3) {
	$tr += 1;
	$tf += $value3['total_fare'];
	$td += $value3['total_distance'];
}
$tl=0;
foreach ($totalLocation as $key4=>$value4) {
	$tl +=1;
}
?>
<?php require "header.php" ?>
<style>
	@font-face { font-family: Century; src: url('GOTHIC.ttf'); } body{ font-family: Century; background: rgb(51,51,51); color: #fff; padding:; } .pagina{ width:auto; height:auto; } .linha{ width:auto; padding:5px; height:auto; display:table;}
	.tile{ height:200px; width:200px; float:left; margin:25px 5px 0 0; padding:2px;border-radius: 18px; } .tileLargo{ width:210px; }

	.amarelo{ background:#DAA520; } .vermelho{ background:#CD0000; } .azul{ background:#4682B4; } .verde{ background-color: #2E8B57; }
	a:link {text-decoration: none;}a{color:white;}
</style>

<div class="pagina"> 
	<div class="linha align" > 
		<a href="allUser.php">
			<div class="tile tileLargo verde hov">
				<br><br><h5>All User</h5>
				<i class="fa fa-users" aria-hidden="true"></i>
				<h6>You have <?php echo $tu; ?> Users</h6>
			</div>
		</a>
		<a href="pendingUser.php">
			<div class="tile tileLargo vermelho hov">
				<br><br><h5>Pending User</h5>
				<i class="fa fa-lock" aria-hidden="true"></i>
				<h6><?php echo $pu; ?> Users are Pending</h6>
			</div> 
		</a>
		<a href="pendingRides.php">
			<div class="tile tileLargo amarelo hov">
				<br><br><h5>Pending Rides</h5>
				<i class="fa fa-plus-circle" aria-hidden="true"></i>
				<h6><?php echo $pr; ?> Rides are Pending</h6>
			</div>
		</a>
		<a href="allRides.php">
			<div class="tile tileLargo vermelho hov">
				<br><br><h5>All Rides</h5>
				<i class="fa fa-car" aria-hidden="true"></i>
				<h6>Total <?php echo $tr; ?> Rides Occur</h6>
			</div>
		</a>
	</div>
	<div class="linha align">
		<div class="tile tileLargo amarelo"><br><br><h4>Total Revenue<br> Rs.<?php echo $tf; ?></h4></div> 		
		<div class="tile tileLargo verde"><br><br><small><h4>Total Distance<br> <?php echo $td;?> Km</h4></small></div>
		<div class="tile tileLargo vermelho"><br><h4>Total <?php echo $tl;?> Location<br> Availaible To<br> Travel</h4></div> 
		<div class="tile tileLargo amarelo"><br><br><h4>Comming Soon..</h4></div>
	</div>
</div>
<?php require "footer.php" ?>

