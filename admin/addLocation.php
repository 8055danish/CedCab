<?php
include '../class/classes.php';
include '../class/conn.php';
$database = new Database();
$db = $database->getConnection();
$location = new location();
$msg="";
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $dist = $_POST['dist'];
    $msg=$location->addLoc($name,$dist,$db);
    $_POST['add']='';
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dist = $_POST['dist'];
    $location->updateLoc($id,$name,$dist,$db);
}
?>
<?php
$tl = $location->totalLocation($db); 
?>
<?php include "header.php"; ?>
<div class="wrapper">
    <div>
        <div style="float:right">
            <button style="background-color:yellow" onclick="addLoc()">Add Location</button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>Distance</th>
            </tr>
        </thead>
        <tbody style="color:red;">
            <?php $c=0; foreach($tl as $key=>$value): ?>
            <tr>
                <td><?php  echo ++$c; ?></td>
                <td></td>
                <td></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['distance']; ?></td>
                <td></td>
                <?php $n= $value['name'];
                $d = $value['distance'];
                ?>
                <td><input type="button" value="Edit Loc." onclick="editLoc(<?php echo "'".$value['id']."','".$value['name']."','".$value['distance']."'";?>)">
                    <input type="button" value="Delete Loc."  onclick="deleteLoc(<?php echo $value['id']?>)"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2 style="color:red;text-align:center;"><?php print_r( $msg) ?></h2>
    <div>
        <form  id="form1" method="POST" action="" style="display:none">
            <table>
                <tr><input type="hidden" id="id" name="id">
                    <td><input type="text" id="name" name="name" placeholder="Enter Location"></td>
                    <td><input type="text" id="dist" name="dist" placeholder="Enter Distance from above"></td>
                    <td><input id="sub" type="submit" value="" name=""></td>
                </table>
            </form>
        </div>

    </div>
    <?php  include "footer.php";?>