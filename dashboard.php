<?php
session_start();
if (!isset ($_SESSION['username'])){
    header('Location: login.php');
}
include 'config.php';
$val=$_SESSION['username'];
$check=mysql_query("SELECT * FROM opponent") or die('could not query');
$flag=0;
if(mysql_num_rows($check)==0)
{
	$msg="The rounds have not been made yet.";
	$flag=1;
}

?>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="css/styles.css" type="text/css">

</head>
<body>
	<div id="banner">
</div>
<center>
    <h3 style="font-size:32px">QuizCross</h3>
</center>
<h1>Welcome to the dashboard! <?php echo $_SESSION['username']?></h1>

<p>The event is underway!!! Here are your round details and your opponents....</p>
	
	<?php
		if($flag==1)
		{
			echo "<p>".$msg."</p>";
		}
		else
		{
			for($i=1;$i<=10;$i++)
			{
				$qq=mysql_query("SELECT o.p2_userid FROM opponent o, checkavail c WHERE o.p1_userid=c.userid AND c.roundreached>=$i AND o.p1_userid='$val' AND o.round='$i'") or die('could not');
				
				if(mysql_num_rows($qq)>0)
				{

					$row=mysql_fetch_array($qq);
					$vv=$row['p2_userid'];
					$newq=mysql_query("SELECT gameid FROM roundlog WHERE user1='$val' AND user2='$vv'");
					$arr2=mysql_fetch_array($newq);
					echo "<p><b>Round ".$i.":</b><br>";
					echo "<b>Your opponent is: </b>".$row['p2_userid']."<br>";
					echo "<a href='game.php?gid=".$arr2['gameid']."'>Click here to go to the round</a>";
					echo "<br>";
					echo "<br>";
					
				}
				$q2=mysql_query("SELECT o.p1_userid FROM opponent o, checkavail c WHERE o.p2_userid=c.userid AND c.roundreached>=$i AND o.p2_userid='$val' AND o.round='$i'") or die('could not exec');
				if(mysql_num_rows($q2)>0)
				{
					$row=mysql_fetch_array($q2);
					$val2=$row['p1_userid'];
					$q=mysql_query("SELECT gameid FROM roundlog WHERE user2='$val' AND user1='$val2'");
					$arr3=mysql_fetch_array($q);
					echo "<p><b>Round ".$i.":</b><br>";
					echo "<b>Your opponent is: </b>".$row['p1_userid']."<br>";
					echo "<a href='game.php?gid=".$arr3['gameid']."'>Click here to go to the round</a>";
					echo "<br>";
					echo "<br>";
					
				}
			}
		}
		?>

	
<a href="logout.php"><button id="logout" class="logout">Logout</button></a>
<br>
<br>
<?php
include 'footer.html';
?>
</body>
</html>