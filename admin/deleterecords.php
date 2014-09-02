<?php
	include '../config.php';
	$q1=mysql_query("DELETE FROM opponent") or die(mysql_error());
	$q2=mysql_query("DELETE FROM roundlog") or die(mysql_error());
	$q3=mysql_query("DELETE FROM gridcateg") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques1") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques2") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques3") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques4") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques5") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques6") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques7") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques8") or die(mysql_error());
	$q4=mysql_query("DELETE FROM gridques9") or die(mysql_error());
	$q4=mysql_query("DELETE FROM roundgameid") or die(mysql_error());
	$q4=mysql_query("DELETE FROM activeuser") or die(mysql_error());
	header('Location:randomize.php');
?>
