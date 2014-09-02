<?php 
session_start();
include '../config.php';

if($_SESSION['username']!='admin')
{
	header('Location: ../index.php');
}
else
{
?>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    
  </head>

  <body>

    


<?php
function doit()
{
	$cat=$_POST['category'];
	$question=$_POST['question'];
  $round=$_POST['round'];
	$opt1=$_POST['opt1'];
	$opt2=$_POST['opt2'];
	$opt3=$_POST['opt3'];
	$opt4=$_POST['opt4'];
	$ans=$_POST['answer'];
	$getcat=mysql_query("SELECT categoryno FROM categories WHERE categoryname='$cat' LIMIT 1") or die('could not execute select query'.mysql_error());
	$arr=mysql_fetch_array($getcat);
	$ins=mysql_query("INSERT INTO questions (question,categoryno,round,answer) VALUES ('$question',".$arr['categoryno'].",$round,'$ans')")  or die('could not execute query'.mysql_error());
	$getqno=mysql_query("SELECT qno FROM questions ORDER BY qno DESC LIMIT 1") or die('could not execute select query'.mysql_error());
	$qrr=mysql_fetch_array($getqno);
	$secins=mysql_query("INSERT INTO options VALUES('".$qrr['qno']."', '$opt1','$opt2','$opt3','$opt4')") or die('could not execute select query'.mysql_error());
	if($ins&&$secins)
		echo "Question added!";
}
?>
	
	<h1>Add questions</h1>
	<form method="POST" action="addquestion.php">
		<label>Category</label>
		<select name="category">
			<option value="">--Select--</option>
			<option value="Innovations">Innovations</option>
			<option value="Entertainment">Entertainment</option>
			<option value="Companies">Companies</option>
      <option value="People">People</option>
      <option value="Mixed Bag">Mixed Bag</option>
      <option value="Gadgets">Gadgets</option>
      <option value="Gaming">Gaming</option>
      <option value="World Wide Web">World Wide Web</option>
      <option value="Abbreviations">Abbreviations</option>
		</select>
		<br>
    <label>Round</label>
    <input type="text" name="round" id="round">
    <br>
    <br>
		<label>Question</label>
		<input type="text" name="question" id="question">
		<br>
		<label>Options</label>
		<br>
		<label>A</label>
		<input type="text" name="opt1"><br>
		<label>B</label>
		<input type="text" name="opt2"><br>
		<label>C</label>
		<input type="text" name="opt3"><br>
		<label>D</label>
		<input type="text" name="opt4"><br>
		<br>
		<label>Correct Answer: </label>
		<select name="answer">
			<option value="">--Select--</option>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
		</select>
		<br>
		<input type="submit" value="Submit" name="submit">
	</form>
</body>
</html>

<?php
}
if(isset($_POST['submit']))
{
	doit();
}
?>