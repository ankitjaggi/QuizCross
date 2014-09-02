<?php
include 'config.php';

$username = $_POST["username"];
 
$result = mysql_query("SELECT username FROM logindetails WHERE username = '" . $username . "'") or die('could not execute query'.mysql_error());

if(mysql_num_rows($result) > 0) {
    
    echo "<input type='hidden' id='val' value='0'>";
}
else {
    
    echo "<input type='hidden' id='val' value='1'>";
}
 
?>