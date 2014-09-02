<?php
session_start();
include 'config.php';
$query=mysql_query("UPDATE checkavail SET roundreached=roundreached+1 WHERE userid='".$_SESSION['username']."'") or die(mysql_error());
echo "You have qualified for Round 2";
//header('Location: dashboard.php');
?>