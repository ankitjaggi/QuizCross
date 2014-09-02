<?php
session_start();
include 'config.php';
$catno=$_POST['catno'];
$user=$_POST['user'];
$count=0;
$getq=mysql_query("SELECT * FROM gridques".$catno." WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
$numrows=mysql_num_rows($getq);
if($numrows!=0)
{
	$getqarr=mysql_fetch_array($getq);
	for($j=1;$j<=3;$j++)
	{
		$val='q'.$j;
		$getans=mysql_query("SELECT COUNT(*) AS count FROM log_data WHERE answered=(SELECT answer FROM questions WHERE qno=".$getqarr[$val].") AND qno=".$getqarr[$val]." AND gameid=".$_SESSION['gid']." AND userid='".$_SESSION['username']."'") or die(mysql_error());
		$arr2=mysql_fetch_array($getans);
		if($arr2['count']!=0)
			$count++;
	}
}
$getotheruser=mysql_query("SELECT p2_userid AS userid FROM opponent WHERE gameid=".$_SESSION['gid']." AND p1_userid='$user'") or die(mysql_error());
if(mysql_num_rows($getotheruser)!=0)
{
	$otheruser=mysql_fetch_array($getotheruser);
}
else
{
	$getotheruser=mysql_query("SELECT p1_userid AS userid FROM opponent WHERE gameid=".$_SESSION['gid']." AND p2_userid='$user'") or die(mysql_error());
	$otheruser=mysql_fetch_array($getotheruser);
}
$getvalue=mysql_query("SELECT q".$catno." AS user, q".$catno."status AS count FROM roundlog WHERE gameid=".$_SESSION['gid']."") or die(mysql_error());
$getarr=mysql_fetch_array($getvalue);
echo $getarr['count'];
if($getarr['count']==4)
	$updlog=mysql_query("UPDATE roundlog SET q".$catno."='$user', q".$catno."status=$count WHERE gameid=".$_SESSION['gid']."") or die(mysql_error());
else
{
	if($getarr['count']<$count&&$getarr['count']!=4)
	{
		$updlog=mysql_query("UPDATE roundlog SET q".$catno."='$user', q".$catno."status=3 WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
		echo "<input type='hidden' id='msg' value='1'>";
	}
	else if($getarr['count']>$count&&$getarr['count']!=4)
	{
		echo "<input type='hidden' id='msg' value='0'>";
		$updfull=mysql_query("UPDATE roundlog SET q".$catno."status=3 WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
	}
	else if($getarr['count']==$count&&$getarr['count']!=4)
	{
		echo "<input type='hidden' id='msg' value='2'>";
		$getopptime=mysql_query("SELECT SUM(timetaken) AS timetaken FROM log_data WHERE gameid=".$_SESSION['gid']." AND userid='".$otheruser['userid']."' AND gridcateg='gridques".$catno."'") or die(mysql_error());
		$getopptimearr=mysql_fetch_array($getopptime);
		$getmytime=mysql_query("SELECT SUM(timetaken) AS timetaken FROM log_data WHERE gameid=".$_SESSION['gid']." AND userid='".$user."' AND gridcateg='gridques".$catno."'") or die(mysql_error());
		$getmytimearr=mysql_fetch_array($getmytime);
		if($getopptimearr['timetaken']>=$getmytimearr['timetaken'])
		{
			$updlog=mysql_query("UPDATE roundlog SET q".$catno."='$user', q".$catno."status=3 WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
			echo "<input type='hidden' id='status' value='1'>";
		}
		else
		{
			$insround=mysql_query("UPDATE roundlog SET q".$catno."status=3 WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
			echo "<input type='hidden' id='status' value='0'>";
		}
	}
}
$updactive=mysql_query("UPDATE activeuser SET active='".$otheruser['userid']."' WHERE gameid='".$_SESSION['gid']."'") or die(mysql_error());
$_SESSION['gridques'.$catno]=1;

?>