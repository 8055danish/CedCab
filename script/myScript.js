function blockunblock(id,isblock){
	$.ajax({
		type:"POST",
		url:"../ajax/ajax.php",
		data:{id:id,isblock:isblock},
		success: function(response){
			location.reload();
		}
	});
}

function checkCarType()
{   
    if ($("#carType").val() == 'CabMicro'){
        $("#weight-div").hide();
    }
    else{
     $("#weight-div").show();
 }    
}

function validate(){
    var pickup = $("#pickup").val();
    var drop = $("#drop").val();
    var carType = $("#carType").val();
    var weight = $("#weight").val();
    if (!pickup)
    {
        alert("Please Select current Location");
        return false;
    }
    if (!drop) 
    {
        alert("Please Select Drop Location");
        return false;
    }
    if(pickup==drop)
    {
        alert("Both Location shouldn't be same");
        return false;
    }
    if (!carType) 
    {
        alert("Please Select Car Type");
        return false;
    }
    if(carType!="CabMicro")
    {
        if (!weight)
        {
            alert("Please Add Luggage Weight");
            return false;
        }
    }
    $.ajax({
        type:"POST",
        url:"./ajax/ajax1.php",
        data:{p:pickup,d:drop,c:carType,w:weight},
        success: function(response) {
            if (confirm("Confirmation! Total price is: "+response)) { 
               $.ajax({     
                type:"POST",
                url:"./ajax/ajax2.php",
                success: function(response) {
                        alert(response);
                }
            });
           } 
           else {

              console.log('Not confirm');
          }
      }
  });
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
    }
}
}
}

function approvedRide(id){
    $.ajax({
        type:"POST",
        url:"../ajax/ajax3.php",
        data:{id:id,s:2},
        success: function(response){
            location.reload();
        }
    });

}

function cancelledRide(id){
    $.ajax({
        type:"POST",
        url:"../ajax/ajax3.php",
        data:{id:id,s:0},
        success: function(response){
            location.reload();
        }
    });

}
function deleteRide(id){
   $.ajax({
    type:"POST",
    url:"../ajax/ajax4.php",
    data:{id:id},
    success: function(response){
        location.reload();
    }
});
}
function addLoc(){
    $("#form1").css("display","block");
    $("#sub").val("Add Location");
    $("#sub").attr("name","add");
}
function editLoc(id,name,dist){
    $("#form1").css("display","block");
    $("#id").val(id);
    $("#name").val(name);
    $("#dist").val(dist);
    $("#sub").val("Update Location");
    $("#sub").attr("name","update");
    
}
function deleteLoc(id){
   if (confirm("Are You Sure!")) {
       $.ajax({
        type:"POST",
        url:"../ajax/ajax5.php",
        data:{id:id},
        success: function(response){
            location.reload();
        }
    });
   }
}
function invoice(ride_id,user_id){
    alert(user_id);
}