<!DOCTYPE html>
<?php
$val=$_SERVER['REQUEST_URI'];
$find=strpos($val, "?");


?>
<html lang="en">
<head>
<meta charset="utf-8" >
<meta name="author" content="Web Remix">
<title>Login - QuizCross</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<div id="banner">
</div>

	<div id="form-container">

        <div id="form-header">
            <span>QUIZCROSS LOGIN</span>
        </div>
        <?php
        if($find)
		{
			echo "<h3>&nbsp; &nbsp;Incorrect Login Credentials! Please try again.</h3>";
		}
		?>
        <form id="form" action="checklogin.php" method="post">
        
            <input type="text" class="hide" id="username" name="username" value="Username" title="Username" required aria-required="true" pattern="\S{5,}">
          
           
            <br>
            <input class="hide" type="password" id="password" name="password" value="Password" title="Password" required aria-required="true" pattern="\S{4,}">
            <br>
            <input id="submit" type="submit" value="Submit" name="posted" class="myButton">
            <div class="clear"></div>
        </form>
</div>
<?php include 'footer.html' ?>
</body>
</html>