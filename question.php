<?php
session_start();
include 'config.php';

$catvalue=$_POST['categ'];
$catno=$_POST['catno'];

echo "<br>";
$catno=substr($catno,3);
$getcat="gridques".$catno;
echo "<input type='hidden' id='getcat' value='".$getcat."' >";
//echo $getcat;
$getques=mysql_query("SELECT * FROM $getcat WHERE gameid='".$_SESSION['gid']."'") or die('could not execute query'.mysql_error());
$qarr=mysql_num_rows($getques);
?>
<html>
<head>
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<script src="js/jquery-1.10.1.min.js"></script>
	
	<style>
	.correct {
	    background: Green;
	    border-radius: 6px;
	    border: 1px solid Green;
	}
	.wrong {
		 background: Red;
	    border-radius: 6px;
	    border: 1px solid Red;
	}

	</style>
<title><?php echo " | Game ID: ".$_SESSION['gid']." | QuizCross"?></title>
</head>
<body>
	<div id="banner"></div>

	<center>
		<h1>QuizCross</h1>
<input type="hidden" id="user" value="<?php echo $_SESSION['username']; ?>">
<input type="hidden" id="catno" value="<?php echo $catno; ?>">
<h2><?php echo $catvalue; ?></h2>
<?php 
if($qarr!=0)
{
?>
<div id="msg" style="font-size: 18px;"></div>
<div style="align:right;" id="displayTime"></div>
<br>
<div id="questions">

	<input type="hidden" id="qno">
	<label id="questionlb">
		
	</label>
</div>

<div id="options">

	<form id="frmoptions">
		<input type="radio" id="opt1" name="opt" value="A"><label id="lopt1" for="opt1"></label><br>
		<input type="radio" id="opt2" name="opt" value="B"><label id="lopt2" for="opt2"></label><br>
		<input type="radio" id="opt3" name="opt" value="C"><label id="lopt3" for="opt3"></label><br>
		<input type="radio" id="opt4" name="opt" value="D"><label id="lopt4" for="opt4"></label><br>
		<input type="radio" checked='checked' style="display:none;" value="5" id='opt5' name='opt'>
		<input type="button" id="submit" value="Submit">
	</form>
</div>

<button id="start" class="myButton">Play!</button>
<a href="game.php?gid=<?php echo $_SESSION['gid']; ?>"><button id="goback" class="myButton">Go Back!</button></a>
<h4 id="h4"></h4>
<button id="next">Next Question</button>
<?php
}
else
{
?>
<h3>Sorry! No questions available!</h3>
<a href="game.php?gid=<?php echo $_SESSION['gid']; ?>"><button id="goback">Go Back!</button></a>
<?php
}
?>
<script>
$(document).ready(function () {
	var correctness='';
	var correctoption='';
	var i=1;
	var id=0;
	
	$("#questions").hide();
	$("#options").hide();
	$("#next").hide();
	$("#msg").hide();
	//$("#opt1").hide();
	
	
	$("#start").click(function () {
		$("#start").hide();
		$("#goback").hide();
		
		$.ajax({
			type: "POST",
			data: "getcat="+$('#getcat').val()+"&no="+i,
			url: "fetchquestion.php",
			success: function(msg)
			{
				//alert(msg);
				i++;
				var $response=$(msg);
				var oneval = $response.filter('#qno').val();
				$("#qno").val(oneval);
			    var question = $response.filter('#questionlb').text();
			    $('#questionlb').html(question);
			    var opt1 = $response.find('#opt1').text();
			    var opt2 = $response.find('#opt2').text();
			    var opt3 = $response.find('#opt3').text();
			    var opt4 = $response.find('#opt4').text();
			    $("#lopt1").html(opt1);
			    $("#lopt2").html(opt2);
			    $("#lopt3").html(opt3);
			    $("#lopt4").html(opt4);

			}
		});

		$("#questions").delay(1500).fadeIn();
		$('#options').delay(5500).fadeIn();
		setTimeout(function() { id=setInterval(counter,1000); }, 5500);

	});

	$("#submit").click(function () {
		var option = $('input[name="opt"]:checked').val();
		$('#displayTime').hide();
		$.ajax({
        type: "POST",
        url: "store.php",
        data: "qno="+$('#qno').val()+"&answer="+option+"&getcat="+$('#getcat').val()+"&seconds="+seconds,
        success: function(msg)
        {
        	
        	var $response=$(msg);
        	correctoption=$response.filter('#correctanswer').val();
        	correctness=$response.filter('#correctness').val();
        	$('#h4').html(correctness);
        	$("#h4").show();
        	if(correctness=="Correct")
        		$('input:radio:checked').next('label').addClass("correct");
        	else
        	{
        		$('input:radio:checked').next('label').addClass("wrong");
        		$('input[name=opt][value='+correctoption+']').next('label').addClass("correct");
        	}
        	
   				$("#questions").delay(2550).fadeOut();
				$("#options").delay(2550).fadeOut();
			
			if(i<=3)
			{
				$("#h4").delay(2550).fadeOut();
				$("#next").delay(2550).fadeIn();
				seconds=11;
				clearInterval(id);
			}
			else
			{
				$("#msg").html("");
				$("#msg").show();
					$.ajax({
						type: "POST",
						url: "modifydb.php",
						data: "user="+$('#user').val()+"&catno="+$('#catno').val(),
						success: function(msg1)
						{
							
							alert(msg1);
							var $response2=$(msg1);
							var tie=$response2.filter('#msg').val();
							
							if(tie=='0')
							{
								//alert("You lost the challenge! You answered less questions correctly.");
								$("#msg").html("You lost the challenge. The tile has been forfeited.");
							}
							else if(tie=='1')
							{
								//alert("You won the challenge! You answered more questions correctly.");
								$("#msg").html("You won the challenge. The tile is yours.");
							}
							else if(tie=='2')
							{
								var status=$response2.filter('#status').val();
								if(status=='0')
									$("#msg").html("You lost the challenge!");
			        			else
			        				$("#msg").html("You won the challenge! The tile is yours.");
							}
						}
					});
					setTimeout(function() { document.location.href="game.php?gid="+<?php echo $_SESSION['gid']; ?>; }, 2550);
					
				}
				
			}

        
    	});
	});

	$("#next").click(function () {
		
		$("#next").hide();
		if(correctness=="Correct")
        			$('input:radio:checked').next('label').delay(2550).removeClass("correct");
	        	else
	        	{
	        		$('input:radio:checked').next('label').delay(2550).removeClass("wrong");
	        		$('input[name=opt][value='+correctoption+']').next('label').delay(2550).removeClass("correct");
	        	}
		$("input:radio").attr("checked", false);
		$("input:radio[value=5]").prop("checked", "checked");
		$.ajax({
			type: "POST",
			data: "getcat="+$('#getcat').val()+"&no="+i,
			url: "fetchquestion.php",
			success: function(msg)
			{
				i++;
				var $response=$(msg);
				var oneval = $response.filter('#qno').val();
				$("#qno").val(oneval);
			    var question = $response.filter('#questionlb').text();
			    $('#questionlb').html(question);
			    var opt1 = $response.find('#opt1').text();
			    var opt2 = $response.find('#opt2').text();
			    var opt3 = $response.find('#opt3').text();
			    var opt4 = $response.find('#opt4').text();
			    $("#lopt1").html(opt1);
			    $("#lopt2").html(opt2);
			    $("#lopt3").html(opt3);
			    $("#lopt4").html(opt4);
			}
		});
		$('#displayTime').html("");
		$('#displayTime').show();
		$("#questions").delay(1500).fadeIn();
		$('#options').delay(5500).fadeIn();
		setTimeout(function() { id=setInterval(counter,1000); }, 5500);
	});


	
});
</script>
<script>

var seconds = 11;


function counter() {

    seconds = seconds - 1;
    //ss = seconds + 1;
    
   
    if(seconds<0)
    {
    	
    	$("#submit").click();
    }
    $('#displayTime').html("<b>Time left:</b> "+seconds+"");
    
}
</script>
<?php include 'footer.html'; ?>

</body>
</html>