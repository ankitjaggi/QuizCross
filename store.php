<?php
session_start();
include 'config.php';
$qno=$_POST['qno'];
$answer=$_POST['answer'];
$getcat=$_POST['getcat'];
$seconds=11-$_POST['seconds'];
$checklog=mysql_query("SELECT * FROM log_data WHERE userid='".$_SESSION['username']."' AND qno=".$qno." AND gameid=".$_SESSION['gid']." AND gridcateg='$getcat'") or die(mysql_error());
$num=mysql_num_rows($checklog);
if($num==0)
{
	$inslogdata=mysql_query("INSERT INTO log_data (userid,qno,answered,timetaken,round,gameid,gridcateg) VALUES ('".$_SESSION['username']."', $qno, '$answer', $seconds, '".$_SESSION['round']."', '".$_SESSION['gid']."', '$getcat')") or die('Could not execute query '.mysql_error());
	$getans=mysql_query("SELECT answer FROM questions WHERE qno=$qno") or die(mysql_error());
	$arr=mysql_fetch_array($getans);
	if($arr['answer']==$answer)
	{
		$val="Correct";
	}
	else
	{
		$val="Wrong";
	}
	?>
	<input type="hidden" id="correctanswer" value="<?php echo $arr['answer']; ?>">
	<input type="hidden" id="correctness" value="<?php echo $val; ?>">
	<?php
}
?>