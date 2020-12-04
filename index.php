<?php session_start(); ?>
<?php if(isset($_SESSION['alogin'])){
  unset($_SESSION['alogin']);
}
?>
<?php
if(isset($_SESSION['start']) && time()-$_SESSION["start"]>180)   
{ 
 unset($_SESSION['from']);
 unset($_SESSION['to']);
 unset($_SESSION['total_distance']);
 unset($_SESSION['luggage']);
 unset($_SESSION['total_price']);  
} 
?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$database = new Database();
$db = $database->getConnection();
$location = new location();
$tl = $location->locationShow($db); 
?>
<?php include "header.php"; ?>
<div class="container-fluid pb-5">
    <div class="text-center text-color p-5">
        <h2 style="color:yellow;"><?php
        if(isset($_SESSION['login']) && isset($_SESSION['total_price'])){
            echo "You have 1 ride in pending
            <input type='button' class='btn-primary' value='See Detail' data-toggle='modal' data-target='#myModal'>";
        }
        ?></h2>
        <h2 id="head"></h2>
    </div>
    <div class="pl-5 pr-5">
        <div class="form-div col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 bg-white text-center pt-3 pb-3">
            <span id="cl" class="font-weight-bold p-1">City Cab</span>
            <h1 class="border-top m-2"></h1>
            <h6><strong>Your everyday travel partner</strong></h6>
            <h6>AC Cabs for Point to Point Travel</h6>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><small>Pickup</small></span>
                </div>
                <select class="form-control input-bg" id="pickup">
                    <option selected disabled>Current Location</option>
                    <?php foreach($tl as $key=>$value): ?>
                        <option value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><small>Drop</small></span>
                </div>
                <select class="form-control input-bg" name="drop" id="drop">
                    <option selected disabled>Select Drop Location</option>
                    <?php foreach($tl as $key=>$value): ?>
                        <option value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><small>Cab Type</small></span>
                </div>
                <select class="form-control input-bg" id="carType" onchange="checkCarType()">
                    <option selected disabled>Select Cab Type</option>
                    <option value="CabMicro">CabMicro</option>
                    <option value="CabMini">CabMini</option>
                    <option value="CabRoyal">CabRoyal</option>
                    <option value="CabSUV">CabSUV</option>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3" id="weight-div">
                <div class="input-group-prepend">
                    <span class="input-group-text"><small>Luggage</small></span>
                </div>
                <input type="number" onkeypress="return /[0-9]/i.test(event.key)" id="weight" class="form-control input-bg" placeholder="Enter Weight in KG">
            </div>
            <button onclick="validate()" class="btn"><b>Calculate Total Price</b></button>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pending Ride</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="background-color: #333;color:white">
         <h5>From :<?php echo $_SESSION['from'];?></h5>
         <h5>To :<?php echo $_SESSION['to'];?></h5>
         <h5>Total Distance :<?php echo $_SESSION['total_distance'];?></h5>
         <h5>Total Luggage :<?php if($_SESSION['luggage'])echo $_SESSION['luggage'];else echo '0';?></h5>
         <h5>Total Fare :<?php echo $_SESSION['total_price'];?></h5>
     </div>
     <!-- Modal footer -->
     <div class="modal-footer">
         <button type="button" class="btn-danger" onclick="deleteRide1()">Delete</button>
         <button type="button" class="btn-primary" onclick="myRide()">Confirm</button>
     </div>
 </div>
</div>
</div>
<script>
let spantyped = new Typed("#head", {
  strings: ["Book a Cab to Reach your Destination","Choose from range of Categories and Prices"],
  typeSpeed: 20,
  backSpeed: 20,
  loop: true,
  cursorChar: "",
});

</script>
<?php include "footer.php"; ?>