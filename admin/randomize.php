<?php
session_start();
if (!isset ($_SESSION['username'])&&$_SESSION['username']!='admin')
{
    header('Location: ../login.php');
}
?>
<html>
<head>
	<title>Randomize Opponents</title>
</head>
<body>
	<form action="randomize.php" method="POST">
		<input type="text" name="round" placeholder="Enter round!">
		<input type="submit" name="submit" value="Randomize">
	</form>

	<a href="deleterecords.php">Delete Now!!!</a>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
include '../config.php';
$arr=array();
$round=$_POST['round'];
$que=mysql_query("SELECT l.username FROM logindetails l, checkavail c WHERE l.username NOT LIKE 'admin' AND c.userid=l.username AND c.roundreached>=$round") or die('Could not execute query');
if(mysql_num_rows($que)!=0)
{
while($row=mysql_fetch_array($que))
{
	array_push($arr,$row['username']);

}
}
shuffle($arr);
//print_r($arr);
//print_r($arr);

$cc=count($arr);
//echo $cc;
$selqq=mysql_query("SELECT * FROM opponent WHERE round='$round'") or die('could not execute query');
if(mysql_num_rows($selqq)==0)
{
for($i=0;$i<$cc/2;$i++)
{
	$name1=$arr[$i];
	$name2=$arr[$cc-1-$i];
	$id=rand(100000,999999);
	$que2=mysql_query("SELECT * FROM roundlog WHERE gameid LIKE $id") or die('could not execute query this'.mysql_error());
	if(mysql_num_rows($que2)==0)
	{
		$qq=mysql_query("INSERT INTO opponent VALUES($id, '$round','$name1','$name2')") or die('could not execute query'.mysql_error());
		$q2=mysql_query("INSERT INTO roundlog VALUES($id,'$name1','$name2',' ',4,' ',4,' ',4,' ',4,' ',4,' ',4,' ',4,' ',4,' ',4)") or die('could not execute query'.mysql_error());
		$q3=mysql_query("INSERT INTO activeuser VALUES($id, '$name1')") or die(mysql_error());
		$q4=mysql_query("INSERT INTO roundgameid VALUES($id, $round)") or die(mysql_error());
	}
	else
	{
		while(mysql_num_rows(mysql_query("SELECT gameid FROM roundlog WHERE $id==gameid") or die('could not execute query'))!=0)
		{
			$id=rand(100000,999999);
		}
		$qq=mysql_query("INSERT INTO opponent VALUES($id,'$round','$name1','$name2')") or die('could not execute query'.mysql_error());
		$q2=mysql_query("INSERT INTO roundlog ($id,'$name1','$name2','',4,'',4,'',4,'',4,'',4,'',4,'',4,'',4,'',4");
		$q3=mysql_query("INSERT INTO activeuser VALUES($id, '$name1')") or die(mysql_error());
		$q4=mysql_query("INSERT INTO roundgameid VALUES($id, $round)") or die(mysql_error());
	}
	$qq=mysql_query("SELECT categoryname FROM categories ORDER BY categoryno") or die('could not execute query'.mysql_error());
	$arr1=array();
	$val="";
	if(mysql_num_rows($qq)!=0)
	{
		$count=0;
		while($row=mysql_fetch_array($qq))
		{
			if($count!=4)
				array_push($arr1,$row['categoryname']);
			else
				$val=$row['categoryname'];
			$count++;
		}

	}
	shuffle($arr1);
	print_r($arr1);
	$ins=mysql_query("INSERT INTO gridcateg VALUES($id,'$arr1[0]','$arr1[1]','$arr1[2]','$arr1[3]','$val','$arr1[4]','$arr1[5]','$arr1[6]','$arr1[7]')") or die('not possbile');


	for($j=0;$j<=3;$j++)
	{
		$str=$arr1[$j];
		$selques=mysql_query("SELECT q.qno, c.categoryno FROM questions q, categories c WHERE q.round=$round AND q.categoryno=c.categoryno AND c.categoryname LIKE '$str'") or die('could not execute this query'.mysql_error());
		$newarr=array();
		$nametb='gridques'.($j+1);

		if(mysql_num_rows($selques)!=0)
		{
			$row1=mysql_fetch_array($selques);
			$row2=mysql_fetch_array($selques);
			$row3=mysql_fetch_array($selques);
			
			$q1=$row1['qno'];
			$q2=$row2['qno'];
			$q3=$row3['qno'];
			
			array_push($newarr, $q1);
			array_push($newarr, $q2);
			array_push($newarr, $q3);
			
			shuffle($newarr);
			$ccno=$row1['categoryno'];
		
			$insque=mysql_query("INSERT INTO $nametb VALUES($id,$ccno,$newarr[0],$newarr[1],$newarr[2])") or die('could not insert ques'.mysql_error());
		}
		else
		{}
			//echo "No records";
		
	}


		$str=$val;
		$selques=mysql_query("SELECT q.qno, c.categoryno FROM questions q, categories c WHERE q.round=$round AND q.categoryno=c.categoryno AND c.categoryname LIKE '$str'") or die('could not execute this query'.mysql_error());
		$newarr=array();
		$nametb='gridques5';

		if(mysql_num_rows($selques)!=0)
		{
			$row1=mysql_fetch_array($selques);
			$row2=mysql_fetch_array($selques);
			$row3=mysql_fetch_array($selques);
			
			$q1=$row1['qno'];
			$q2=$row2['qno'];
			$q3=$row3['qno'];
			
			array_push($newarr, $q1);
			array_push($newarr, $q2);
			array_push($newarr, $q3);
			
			shuffle($newarr);
			$ccno=$row1['categoryno'];
		
			$insque=mysql_query("INSERT INTO $nametb VALUES($id,$ccno,$newarr[0],$newarr[1],$newarr[2])") or die('could not insert ques'.mysql_error());
		}
		else
		{}



	for($j=4;$j<=7;$j++)
	{
		$str=$arr1[$j];
		$selques=mysql_query("SELECT q.qno, c.categoryno FROM questions q, categories c WHERE q.round=$round AND q.categoryno=c.categoryno AND c.categoryname LIKE '$str'") or die('could not execute this query'.mysql_error());
		$newarr=array();
		$nametb='gridques'.($j+2);

		if(mysql_num_rows($selques)!=0)
		{
			$row1=mysql_fetch_array($selques);
			$row2=mysql_fetch_array($selques);
			$row3=mysql_fetch_array($selques);
			
			$q1=$row1['qno'];
			$q2=$row2['qno'];
			$q3=$row3['qno'];
			
			array_push($newarr, $q1);
			array_push($newarr, $q2);
			array_push($newarr, $q3);
			
			shuffle($newarr);
			$ccno=$row1['categoryno'];
		
			$insque=mysql_query("INSERT INTO $nametb VALUES($id,$ccno,$newarr[0],$newarr[1],$newarr[2])") or die('could not insert ques'.mysql_error());
		}
		else
		{}
			//echo "No records";
		
	}

	echo $name1." ".$name2;
}
}
else
{
	echo "The opponents have already been finalised for this round!!";
}
}
?>