<?php
session_start();
include 'config.php';
$getcat=$_POST['getcat'];
$no=$_POST['no'];

$getques=mysql_query("SELECT * FROM $getcat WHERE gameid=".$_SESSION['gid']." ") or die('could not execute query'.mysql_error());
$qarr=mysql_fetch_array($getques);

$q=mysql_query("SELECT q.* FROM questions q, $getcat g WHERE q.qno=g.q".$no." AND gameid=".$_SESSION['gid']."") or die('could not execute query 1'.mysql_error());
$qq=mysql_fetch_array($q);

$getopt=mysql_query("SELECT o.* FROM options o, $getcat g WHERE o.qno=g.q".$no." AND gameid=".$_SESSION['gid']."") or die('could not execute query 2'.mysql_error());
$getop=mysql_fetch_array($getopt);

?>


	<input type="hidden" id="qno" value="<?php echo $qq['qno']; ?>">
	<label id="questionlb">
		<?php
			
			echo $qq['question']."<br>";
		?>
	</label>



	<form id="frmoptions">
		<input type="radio" id="radio_opt1" name="opt" value="A"><label id="opt1"><?php echo $getop['opt1'];?></label><br>
		<input type="radio" id="radio_opt2" name="opt" value="B"><label id="opt2"><?php echo $getop['opt2'];?></label><br>
		<input type="radio" id="radio_opt3" name="opt" value="C"><label id="opt3"><?php echo $getop['opt3'];?></label><br>
		<input type="radio" id="radio_opt4" name="opt" value="D"><label id="opt4"><?php echo $getop['opt4'];?></label><br>
		<input type="button" id="submit2" value="Submit">
	</form>
