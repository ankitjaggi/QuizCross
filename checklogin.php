<?php
session_start();
include 'config.php';
$username=$_POST['username'];
$password=$_POST['password'];
$query=mysql_query("SELECT username,password FROM logindetails WHERE username='$username'") or die('Could not execute query');
$row=mysql_fetch_array($query);
$num=mysql_num_rows($query);
if($num!=0)
{
	if($row['password']==$password)
	{
		$_SESSION['username']=$username;
		header('Location:dashboard.php');
	}
	else
	{
		header('Location:login.php?status=err');
	}
}
else if($num==0)
{
	header('Location:login.php?status=err');
}
?>