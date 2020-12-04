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
 $User = new admin();
 $users = $User->allUser($s,$db);
 
 ?>
 <?php require "header.php" ?>
 <div class="wrapper">
 	<div class="column1">
 		<table class="adminTable">
 			<h2 class="align">Total Users(<?php echo count($users); ?>)</h2>
 			<hr>
 			<?php if(count($users)>0): ?>
 				<tr><th>USER ID </th><th>NAME </th><th>USERNAME </th><th>DATE/TIME OF SIGNUP </th><th>MOBILE </th><th>ACCESS </th><th>ACTION1</th><th>ACTION2</th></tr>
 				<?php foreach($users as $key=>$value): ?>
 					<tr style="color:red;">   
 						<td><?php echo $value['user_id']?></td>
 						<td><?php echo $value['name']?></td>
 						<td><?php echo $value['user_name']?></td>
 						<td><?php echo $value['dateofsignup']?></td>
 						<td><?php echo $value['mobile']?></td>
 						<td><?php if( $value['isblock'])echo "Yes";else echo "No";?></td>
 						<td><input id="allow-<?php echo $value['user_id']?>" type="button" value="<?php if($value['isblock']=='0')echo"Unblock";else echo"Block";?>" onclick=" blockunblock(<?php echo $value['user_id']?>,<?php echo $value['isblock']?>)"></td>
 						<td><input type="button" value="Delete" onclick="deleteUser(<?php echo $value['user_id']?>)"></td>
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
 					<option value="name">By Name</option>
 					<option value="dateasc">By Date ASC</option>
 					<option value="datedsc">By Fare DSC</option>
 				</select>
 			</form>
 		</div>
 	</div>
 	<?php require "footer.php" ?>