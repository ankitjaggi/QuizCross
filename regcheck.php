<?php
include_once 'config.php';
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$username=$_POST['userid'];
$college=$_POST['college'];
$city=$_POST['city'];
$mob=$_POST['mob'];
$loginque=mysql_query("INSERT INTO logindetails(username,password,email) VALUES ('$username','$password','$email')") or die('Query could not be executed'.mysql_error());
$userque=mysql_query("INSERT INTO userdetails(username,name,college,collegecity,mob) VALUES ('$username','$name','$college','$city','$mob')") or die('Could not execute query');
$newque=mysql_query("INSERT INTO checkavail VALUES ('$username','Y')") or die('Query could not be executed for this'.mysql_error());
header("Location:login.php");
?>