<?php 
include '../config.php';
$strque=mysql_query("SELECT * FROM opponent") or die('could not execute query');

?>
<html>
<head>
<title>Display Opponents</title>
</head>
<body>
<h1>List of players and opponents</h1>
<table>
<tr>
<td><b>Round</b></td>
<td><b>Player 1</b></td>
<td><b>vs.</b></td>
<td><b>Player 2</b></td>
</tr>
<?php
	while($row=mysql_fetch_array($strque))
	{
		?>
		<tr>
			<td><?php echo $row['round']; ?></td>
			<td><?php echo $row['p1_userid']; ?></td>
			<td>-</td>
			<td><?php echo $row['p2_userid']; ?></td>
		</tr>
		<?php

	}
	?>
	</table>
	</body>
	</html>
