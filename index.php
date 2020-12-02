<?php session_start(); ?>
<?php
include 'class/classes.php';
include 'class/conn.php';
$database = new Database();
$db = $database->getConnection();
$location = new location();
$tl = $location->totalLocation($db); 
?>
<?php include "header.php"; ?>
<div class="container-fluid pb-5">
    <div class="text-center text-color p-5">
        <h1>Book a Cab to Reach your Destinations</h1>
        <h5>Choose from range of Categories and Prices</h5>
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
                <input type="number" id="weight" class="form-control input-bg" placeholder="Enter Weight in KG">
            </div>
            <button onclick="validate()" class="btn"><b>Calculate Total Price</b></button>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>