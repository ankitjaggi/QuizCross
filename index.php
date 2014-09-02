<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" >
<meta name="author" content="Web Remix">
<title>QuizCross</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <style>



</style></head>

</head>

<body>

<div id="banner">
</div>
<center>
    <h3 style="font-size:32px">QuizCross</h3>
</center>

        <a href="register.php"><button id="register" class="myButton">Register</button></a>
        
        <br>
        <br>
        <a href="login.php"><button id="login" class="myButton">Login</button></a>
    
    <left>
        <h2>About the event</h2>
        <p><h3>About the playing board</h3>
Each tile on the playing board represents three questions. The category is indicated by a symbol on the tile.<br> After a tile has been played it will indicate what has happened by representing each correct answer by a star.<br><h4> Your tiles are green and your opponents tiles are red.</h4>
<br> 
<img src="images/about1.png">&nbsp;
<img src="images/about2.png">&nbsp;
<img src="images/about3.png">&nbsp;<br>
The tiles to the left indicates 1 and 2 correct answers.
The right tile means three right answers.
<br>

<img src="images/about0.png">
<br>
The tile indicates no right answers.
<br>
<br>

<h3>How to win a tile</h3>
Each tile on the playing board represents three questions. The category is indicated by a symbol on the tile.<br> After a tile has been played it will indicate what has happened by representing each correct answer by a star.

<br>
<br>
<h3>Different categories</h3>
Each tile on the playing board represents three questions. The category is indicated by a symbol on the tile.
<br>
<table>
    <tr>
        <td style="width:100px"><img src="images/1.png"></td>
        <td style="width:100px"><img src="images/2.png"></td>
        <td style="width:100px"><img src="images/3.png"></td>
        <td style="width:100px"><img src="images/4.png"></td>
        <td style="width:100px"><img src="images/5.png"></td>
    </tr>
    <tr>
        <td style="width:100px"><b>Innovations</b></td>
        <td style="width:100px"><b>Entertainment</b></td>
        <td style="width:100px"><b>Companies</b></td>
        <td style="width:100px"><b>People</b></td>
        <td style="width:100px"><b>Mixed Bag</b></td>
    </tr>
    <tr>
        <td style="width:100px"><img src="images/6.png"></td>
        <td style="width:100px"><img src="images/7.png"></td>
        <td style="width:100px"><img src="images/8.png"></td>
        <td style="width:100px"><img src="images/9.png"></td>
    </tr>
    <tr>
        <td style="width:100px"><b>Gadgets</b></td>
        <td style="width:100px"><b>Gaming</b></td>
        <td style="width:100px"><b>Logos/Expressicons</b></td>
        <td style="width:100px"><b>Abbreviations</b></td>
    </tr>
</table>

<br>
<br>
<h3>How to win a match</h3>
Be the first player to own three tiles in a row on the playing board.
        </p>
    </left>
</center>
<?php
include 'footer.html';
?>
</body>
</html>

