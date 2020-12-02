 <?php session_start(); ?>
 <?php
 include '../class/classes.php';
 include '../class/conn.php';
 $database = new Database();
 $db = $database->getConnection();
 $User = new admin();
 $users = $User->isNotBlockUser($db); 
 ?>
 <?php require "header.php" ?>
 <div class="wrapper align">
 	<h2 class="align">Current User(<?php echo count($users); ?>)</h2>
 	<hr>
 	<?php if(count($users)>0): ?>
 		<?php foreach($users as $key=>$value): ?>
 			<h5><?php echo $value['user_name'] ?></h5>
 			<select onchange="blockunblock(<?php echo $value['user_id']; ?>,<?php echo $value['isblock']; ?>)">
 				<option selected="selected" disabled="disabled"><?php echo "Block" ?></option>
 				<option value="1">Unblock</option>
 			</select><br>
 		<?php endforeach; ?>
 		<?php else:echo "<div class='align'>No Records Found !!!</div>" ?>
 		<?php endif;?>
 	</div>
 	<?php require "footer.php" ?>