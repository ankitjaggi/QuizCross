<html>
<head>
<title>Register Yourself!</title>
<link rel="stylesheet" href="css/styles.css" type="text/css">
<link rel="stylesheet" href="css/validetta.css" type="text/css">

<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
    
    <script type="text/javascript" src="js/validetta.js"></script>
    <style>

.myButton {
	-moz-box-shadow: 0px 10px 14px -7px #276873;
	-webkit-box-shadow: 0px 10px 14px -7px #276873;
	box-shadow: 0px 10px 14px -7px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
	background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:20px;
	font-weight:bold;
	padding:13px 32px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
	background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#599bb3',GradientType=0);
	background-color:#408c99;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>
</head>
<body>
	<div id="banner"></div>
<h1>Registration Form</h1>
<form name="reg" action="regcheck.php" method="post" id="reg">
<table>
	
<tr>
	<td><label style="font-size:22px"><strong>Name:</strong></label></td>
<td><input type="text" name="name" data-validetta="required"></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>Username:</strong></label></td>
<td><input type="text" name="userid" id="username" data-validetta="required,minLength[6],maxLength[30]"><span class="error" id="userError" style="font-size:18px"> </span></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>Password:</strong></label></td>
<td><input type="password" name="password" id="password" data-validetta="required,minLength[6],maxLength[24]"><br></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>Confirm Password:</strong></label></td>
<td><input type="password" name="confpassword" data-validetta="equal[password]"><br></td>
</tr>
<tr><td><label style="font-size:22px"><strong>Email:</strong></label></td>
	<td><input type="text" name="email" id="email" data-validetta="required,email"><span class="error" id="emailError" style="font-size:18px"> </span></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>College:</strong></label></td>
	<td><input type="text" name="college" data-validetta="required"><br></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>City:</strong></label></td>
	<td><input type="text" name="city" data-validetta="required"><br></td>
</tr>
<tr>
	<td><label style="font-size:22px"><strong>Mobile No.:</strong></label></td>
	<td><input type="text" name="mob" data-validetta="required"><br></td>
</tr>
<tr>
	<td><input type="submit" id="submit" value="Register" class="myButton"></td>
	<td><input type="reset" value="Clear" class="myButton"></td>
</tr>
</table>
</form>
<?php include 'footer.html' ?>
<script>
$(document).ready(function() {


    $("#reg").validetta();
    $("#email").change(function() {
        //gets the value of the field
        var email = $("#email").val();
 
		if(email!="")
		{ 
	        //here is where you send the desired data to the PHP file using ajax
	        $.ajax({
	        	type:"POST",
	        	url: "checkavailability.php", 
	        	data: "email="+email,
	        	success: function(msg)
	        	{
	        		//alert(msg);
	        		var $response=$(msg);
	        		var val=$response.filter('#val').val();
	                if(val == '1')
	                {
	                    //the email is available
	                    $("#emailError").html("");
	                    $("#submit").removeAttr('disabled');
	                    return true;
	                }
	                else
	                {
	                    //the email is not available
	                    $("#emailError").html("  &nbsp;&nbsp;&nbsp; Email already registered");
	                    $('#submit').attr("disabled","disabled");
	                    return false;
	                }
	            }
	    	});
	    }
     });
    $("#username").change(function() {
        //gets the value of the field
        var username = $("#username").val();
 
		if(username!="")
		{ 
        //here is where you send the desired data to the PHP file using ajax
        $.ajax({
	        	type:"POST",
	        	url: "checkavailabilityuser.php", 
	        	data: "username="+username,
	        	success: function(msg)
	        	{
	        		//alert(msg);
	        		var $response=$(msg);
	        		var val=$response.filter('#val').val();
	                if(val == '1')
	                {
	                    //the email is available
	                    $("#userError").html("");
	                    $("#submit").removeAttr('disabled');
	                    return true;
	                }
	                else
	                {
	                    //the email is not available
	                    $("#userError").html("  &nbsp;&nbsp;&nbsp; Username already registered");
	                    $('#submit').attr("disabled","disabled");
	                    return false;
	                }
	            }
	    	});
    	}
     });
});
</script>
</body>
</html>