<?php
session_start();
include 'config.php';
$val=$_SESSION['username'];
$gameid=$_GET['gid'];
$_SESSION['gid']=$gameid;
$gamestatus=0;
$getroundid=mysql_query("SELECT round FROM roundgameid WHERE gameid='".$_SESSION['gid']."'") or die('could not execute query '.mysql_error());
$rarr=mysql_fetch_array($getroundid);
$_SESSION['round']=$rarr['round'];
$que=mysql_query("SELECT user1,user2 FROM roundlog WHERE gameid='$gameid'") or die('could not execute query');
$arr=mysql_fetch_array($que);
if($arr['user1']!=$val&&$arr['user2']!=$val)
{
	header("Location:login.php");
}
else
{
$getactive=mysql_query("SELECT active FROM activeuser WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
if(mysql_num_rows($getactive)!=0)
	$getuser=mysql_fetch_array($getactive);
?>
<?php
		$newq=mysql_query("SELECT * FROM gridcateg WHERE gameid='$gameid'") or die('could not execute query this one');
		$arr1=mysql_fetch_array($newq);
		$getdata=mysql_query("SELECT * FROM roundlog WHERE gameid='$gameid'") or die(mysql_error());
		$arrdata=mysql_fetch_array($getdata);
		if($arrdata['q1']==$arrdata['q2']&&$arrdata['q2']==$arrdata['q3']&&$arrdata['q1status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q1']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q1']==$arrdata['q4']&&$arrdata['q4']==$arrdata['q7']&&$arrdata['q1status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q1']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q1']==$arrdata['q5']&&$arrdata['q5']==$arrdata['q9']&&$arrdata['q1status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q1']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q2']==$arrdata['q5']&&$arrdata['q5']==$arrdata['q8']&&$arrdata['q2status']!=4)
		{    
			$gamestatus=1;
			if($arrdata['q2']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q3']==$arrdata['q6']&&$arrdata['q6']==$arrdata['q9']&&$arrdata['q3status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q3']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q4']==$arrdata['q5']&&$arrdata['q5']==$arrdata['q6']&&$arrdata['q4status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q4']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q7']==$arrdata['q8']&&$arrdata['q8']==$arrdata['q9']&&$arrdata['q7status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q7']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
		else if($arrdata['q3']==$arrdata['q5']&&$arrdata['q5']==$arrdata['q7']&&$arrdata['q3status']!=4)
		{
			$gamestatus=1;
			if($arrdata['q3']==$_SESSION['username'])
			{
				echo "You won!";
				$insdata=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'");
			}
			else
				echo "You lost!";
		}
?>
<html>
<head>
	<META HTTP-EQUIV="Refresh" CONTENT="20">
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<style>
	td
	{
		 border: solid 1px;
		 width:100px;
		 height:100px;
		 text-align: center;
		 color:black;
	}
	</style>
	<script src="js/jquery-1.10.1.min.js"></script>
<title>QuizCross</title>
</head>
<body>
	<div id="banner"></div>
	<center>
		<h1>QuizCross</h1>
	<div id="active"><label id="activetext">
<?php
if($gamestatus==0)
{
	if($getuser['active']==$_SESSION['username'])
	{ 
		$_SESSION['active']=1; 
	?> 
	Active! It's Your turn.
	<?php
	} 
	else
	{
		$_SESSION['active']=0;?> Waiting for opponent...
		<?php
		}
	}
	else
	{
		echo "<p>The game is over!</p>";
		echo "<p>Head back to dashboard. <a href='dashboard.php'>Go Back!</a></p>";
	}
		?> </label></div>

        <p><b><u>DISCLAIMER: Please click on submit ONLY ONCE. If the question does not get submitted, please wait for the timer to get over. Your answer will be stored.</b></u></p>
		
	<table>
		<tr>
			<?php
			for($i=1;$i<=3;$i++)
			{
				$getstatus=mysql_query("SELECT q".$i." AS user,q".$i."status AS count FROM roundlog WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
				$qstatus=mysql_fetch_array($getstatus);
				$disabled="";
				$str='white';
				$getrows=1;
				$count=$qstatus['count'];
				if($qstatus['user']==$_SESSION['username'])
					$str='green';
				else if($qstatus['user']!=$_SESSION['username'])
					$str='red';

				if($qstatus['count']==4)
				{
					$str='white';
					$getrows=0;
				}
				if($_SESSION['active']==1&&$qstatus['count']!=3&&$qstatus['user']!=$_SESSION['username'])
				{
					$disabled="";
				}
				else
				{
					$disabled="disabled";
				}
				if($gamestatus==1)
					$disabled="disabled";
				$getno=mysql_query("SELECT categoryno FROM categories WHERE categoryname='".$arr1['cat'.$i]."'") or die(mysql_error());
				$get=mysql_fetch_array($getno);
			?>
			<td bgcolor="<?php echo $str; ?>"><button id="cat<?php echo $i; ?>" <?php echo $disabled; ?>><img src="images/<?php echo $get['categoryno']; ?>.png"></button><label id="lcat<?php echo $i ;?>"><?php echo $arr1['cat'.$i]; ?></label><br><?php if($getrows!=0){?><label><?php for($k=1;$k<=$count;$k++){?>&#9733;<?php } for($k=1;$k<=(3-$count);$k++) {?> &#9734; <?php } ?></label><?php } ?></td>
			
		<?php }
				
			?>
		</tr>
		<tr>
			<?php
			for($i=4;$i<=6;$i++)
			{
				$getstatus=mysql_query("SELECT q".$i." AS user,q".$i."status AS count FROM roundlog WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
				$qstatus=mysql_fetch_array($getstatus);
				$disabled="";
				$str='white';
				$getrows=1;
				$count=$qstatus['count'];
				if($qstatus['user']==$_SESSION['username'])
					$str='green';
				else if($qstatus['user']!=$_SESSION['username'])
					$str='red';

				if($qstatus['count']==4)
				{
					$str='white';
					$getrows=0;
				}
				if($_SESSION['active']==1&&$qstatus['count']!=3&&$qstatus['user']!=$_SESSION['username'])
				{
					$disabled="";
				}
				else
				{
					$disabled="disabled";
				}
				if($gamestatus==1)
					$disabled="disabled";
				$getno=mysql_query("SELECT categoryno FROM categories WHERE categoryname='".$arr1['cat'.$i]."'") or die(mysql_error());
				$get=mysql_fetch_array($getno);
			?>
			<td bgcolor="<?php echo $str; ?>"><button id="cat<?php echo $i; ?>" <?php echo $disabled; ?>><img src="images/<?php echo $get['categoryno']; ?>.png"></button><label id="lcat<?php echo $i ;?>"><?php echo $arr1['cat'.$i]; ?></label><br><?php if($getrows!=0){?><label><?php for($k=1;$k<=$count;$k++){?>&#9733;<?php } for($k=1;$k<=(3-$count);$k++) {?> &#9734; <?php } ?></label><?php } ?></td>
			
		<?php }
				
			?>
		</tr>
		<tr>
			<?php
			for($i=7;$i<=9;$i++)
			{
				$getstatus=mysql_query("SELECT q".$i." AS user,q".$i."status AS count FROM roundlog WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
				$qstatus=mysql_fetch_array($getstatus);
				$disabled="";
				$str='white';
				$getrows=1;
				$count=$qstatus['count'];
				if($qstatus['user']==$_SESSION['username'])
					$str='green';
				else if($qstatus['user']!=$_SESSION['username'])
					$str='red';

				if($qstatus['count']==4)
				{
					$str='white';
					$getrows=0;
				}
				if($_SESSION['active']==1&&$qstatus['count']!=3&&$qstatus['user']!=$_SESSION['username'])
				{
					$disabled="";
				}
				else
				{
					$disabled="disabled";
				}
				if($gamestatus==1)
					$disabled="disabled";
				$getno=mysql_query("SELECT categoryno FROM categories WHERE categoryname='".$arr1['cat'.$i]."'") or die(mysql_error());
				$get=mysql_fetch_array($getno);
			?>
			<td bgcolor="<?php echo $str; ?>"><button id="cat<?php echo $i; ?>" <?php echo $disabled; ?> ><img src="images/<?php echo $get['categoryno']; ?>.png"></button><label id="lcat<?php echo $i ;?>"><?php echo $arr1['cat'.$i]; ?></label><br><?php if($getrows!=0){?><label><?php for($k=1;$k<=$count;$k++){?>&#9733;<?php } for($k=1;$k<=(3-$count);$k++) {?> &#9734; <?php } ?></label><?php } ?></td>
			
		<?php }
				
			?>
		</tr>
	</table>
	<br>
	<br>
	

	<a href="logout.php" class="logout">Logout</a>




	<script>
	$(document).ready(function () {

		


		$("button").click(function() {
			var cat=this.id;
			cat2="#l"+cat;
			var catvalue=$(cat2).text();
			var url = 'question.php';
			var form = $('<form action="' + url + '" method="post">' +
			  '<input type="hidden" name="categ" value="' + catvalue + '" />' +
			  '<input type="hidden" name="catno" value="' + cat + '" />' +
			  '</form>');
			$('body').append(form);
			$('form').submit();
		});

	});

	</script>
	<?php include 'footer.html'; ?>
</body>
</html>
<?php }
?>