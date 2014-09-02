<?php
include 'config.php';

$email = $_POST["email"];
echo $email;
$result = mysql_query("SELECT email FROM logindetails WHERE email = '" . $email . "'") or die('could not execute query'.mysql_error());
$ans=mysql_num_rows($result);
echo $ans;
if(mysql_num_rows($result) > 0) {
    
    echo "<input type='hidden' id='val' value='0'>";
}
else {
    
    echo "<input type='hidden' id='val' value='1'>";
}
 
?>