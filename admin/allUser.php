 <?php session_start(); ?>
 <?php
 include '../class/classes.php';
 include '../class/conn.php';
 $database = new Database();
 $db = $database->getConnection();
 $User = new admin();
 $users = $User->allUser($db);
 
 ?>
 <?php require "header.php" ?>
 
 <div class="wrapper">
 	<table class="adminTable">
 		<h2 class="align">Total Users(<?php echo count($users); ?>)</h2>
 		<?php if(count($users)>0): ?>
 			<tr><th>USER ID </th><th>NAME </th><th>USERNAME </th><th>DATE/TIME OF SIGNUP </th><th>MOBILE </th><th>ACCESS </th><th>isADMIN </th><th></th></tr>
 			<?php foreach($users as $key=>$value): ?>
 				<tr style="color:red;">   
 					<td><?php echo $value['user_id']?></td>
 					<td><?php echo $value['name']?></td>
 					<td><?php echo $value['user_name']?></td>
 					<td><?php echo $value['dateofsignup']?></td>
 					<td><?php echo $value['mobile']?></td>
 					<td><?php echo $value['isblock']?></td>
 					<td><?php echo $value['is_admin']?></td>
 					<td><input id="allow-<?php echo $value['user_id']?>" type="button" value="<?php if($value['isblock']=='0')echo"Unblock";else echo"Block";?>" onclick=" blockunblock(<?php echo $value['user_id']?>,<?php echo $value['isblock']?>)"></td>
 				</tr>
 			<?php endforeach; ?>
 			<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
 			<?php endif;?>
 		</table>
 	</div>
 	<?php require "footer.php" ?>