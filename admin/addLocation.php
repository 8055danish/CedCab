<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$location = new location();
$msg="";
if(isset($_POST['add'])){
    $name = trim($_POST['name']," ");
    $dist = trim($_POST['dist']," ") ;
    $msg=$location->addLoc($name,$dist,$db);
    $_POST['add']='';
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = trim($_POST['name']," ");
    $dist = trim($_POST['dist']," ");
    $msg = $location->updateLoc($id,$name,$dist,$db);
    $_POST['update']='';
}
?>
<?php
$tl = $location->totalLocation($db); 
?>
<?php include "header.php"; ?>
<style>
    .table1,.td1{
        border:none;
        border-collapse: none;
    }
</style>
<div class="wrapper">
    <div>
        <div style="float:right">
            <input style="background-color:yellow" type="button" value="Add Location" onclick="addLoc()">
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Distance</th>
                <th>ACTION1</th>
                <th>ACTION2</th>
                <th>ACTION3</th>
            </tr>
        </thead>
        <tbody style="color:red;">
            <?php $c=0; foreach($tl as $key=>$value): ?>
            <tr>
                <td><?php  echo ++$c; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['distance']; ?></td>
                <?php $n= $value['name'];
                $d = $value['distance'];
                ?>
                <td> <input type="button" value="<?php if($value['is_available']==0)echo "Enable";else echo "Disable"; ?>" onclick="buloc(<?php echo $value['id'].",".$value['is_available']?>)"></td></td>
                <td><input type="button" value="Edit Loc." onclick="editLoc(<?php echo "'".$value['id']."','".$value['name']."','".$value['distance']."'";?>)"></td>
                <td><input type="button" value="Delete Loc."  onclick="deleteLoc(<?php echo $value['id']?>)"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div>
<br>
    <form  id="form1" method="POST" action="" style="display:none">
        <table class="table1">
            <input type="hidden" id="id" name="id">
            <td class="td1"><input type="text" id="name" name="name"  onkeypress="return /[a-zA-Z\s]/i.test(event.key)" placeholder="Enter Location"></td>
            <td class="td1"><input type="text" id="dist" name="dist" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Enter Distance from above"></td>
            <td class="td1"><input id="sub" type="submit" value="" name=""></td>
        </table>
    </form>
</div>
</div>
<h2 style="color:red;text-align:center;"><?php print_r( $msg);$msg=""; ?></h2>
<?php  include "footer.php";?>