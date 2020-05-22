<!DOCTYPE html>
<html>
<head>
<title>Engineering Schedule</title>
<link rel="stylesheet" type="text/css" href="MyStyle.css">
<script type="text/javascript" src="edit_table.js"></script>
</head>
<body>

<?php  //engsched.php

	require_once 'login.php';  //username & pw info
	
	//create connection to mysql
	$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
	die("Fatal Error");

	//Sunday beginning the week is used a lot on this page
	$day = date('w');
	$week_start = date('m-d-Y', strtotime('-'.$day.' days'));

	//html start
	echo <<<_END
		<pre>
		<div class="row" id="header_row">
		<div class="column" id="header_column1">
			<h1>Engineering Schedule</h1>
		</div>
		<div class="column" id="header_column2">
			<h1>Week Beginning: 
		_END;
	echo $week_start; //Display week start date at top of page
	echo "</h1>";
	echo <<<_END
		</div>
		</div><br>
			<div class="row" id="table_row">
			<div class="column" id="column1">
		</pre>
		_END;


	//create top of table
	echo <<<_END
	<table><pre>
	<thead>
		<tr>
			<th>Engineer</th>
			<th>Joyce</th>
			<th>Sondra</th>
			<th>Work Order</th>
			<th>PO#</th>
			<th>P/N</th>
			<th>ECI</th>
			<th>Hrs</th>
			<th>Target Date</th>
			<th>Due Date</th>
			<th>Assigned To</th>
			<th>Program</th>
			<th>New Work</th>
			<th>Notes</th>
			<th>Edit</th>
		</tr>
	</thead></pre>
	_END;
	

	//Query the database to get everything, for eng sched change to search off date range
	$query = "SELECT * FROM engineer_schedule WHERE final_date is NULL OR final_date >= $week_start";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed");
	
	$rows = $result->num_rows;
	for ($j = 0; $j<$rows; ++$j)
	{
		$row = $result->fetch_array(MYSQLI_NUM);
		
		$r0 = htmlspecialchars($row[0]);
		$r1 = htmlspecialchars($row[1]);
		$r2 = htmlspecialchars($row[2]);
		$r3 = htmlspecialchars($row[3]);
		$r4 = htmlspecialchars($row[4]);
		$r5 = htmlspecialchars($row[5]);
		$r6 = htmlspecialchars($row[6]);
		$r7 = htmlspecialchars($row[7]);
		$r8 = htmlspecialchars($row[8]);
		$r9 = htmlspecialchars($row[9]);
		$r10 = htmlspecialchars($row[10]);
		$r11 = htmlspecialchars($row[11]);
		$r12 = htmlspecialchars($row[12]);
		$r13 = htmlspecialchars($row[13]);
		$r14 = htmlspecialchars($row[14]);
		
		$engineer_app = $format_app = $final_app = $eci ='';

		//background color for engineer approval column
		switch($r2) {
			case 0:
				$engineer_app = 'inherit';
				break;
			case 1:
				$engineer_app = 'rgb(255,192,0)';
				break;
			case 2:
				$engineer_app = 'green';
				break;
			default:
				$engineer_app = 'inherit';
		}
		
		//background color for format approval column
		switch ($r4) {
			case 0:
				$format_app = 'inherit';
				break;
			case 1:
				$format_app = 'rgb(255,192,0)';
				break;
			case 2:
				$format_app = 'green';
				break;
			default:
				$format_app = 'inherit';
		}
		
		//background color for final submit column
		if ($r5 != NULL)
			$final_app = 'green';
		else $final_app = 'inherited';
		
		switch ($r9) {
			case 1:
				$eci = 'Yes';
				break;
			case 2:
				$eci = 'No';
				break;
			default:
				$eci = '';
		}

		//Drafting program type
		switch ($r13) {
			case 0:
				$cad="CREO 4.0";
				break;
			case 1:
				$cad="SolidWorks 2018";
				break;
			default:
				$cad="??";
		}
		
		//due_date & target date from database
		$due_date=date("Y\-m\-d",strtotime($r11));
		$target_date = date("Y\-m\-d",strtotime($r11)-(21*24*60*60));
		

		echo <<<_END
		<pre>
		<tr>
		  <td class='left' style='background:$engineer_app'>$r1 $r0</td> 	<!--Engineer-->
		  <td class='left' style='background:$format_app'>$r3</td> 			<!--Joyce-->
		  <td class='left' style='background:$final_app'>$r5</td>			<!--Sondra-->
		  <td>$r6</td>														<!--Work Order-->
		  <td>$r7</td>														<!--PO#-->
		  <td>$r8</td>														<!--P/N-->
		  <td>ECI $eci</td>													<!--ECI-->
		  <td>$r10</td>														<!--Hrs-->
		  <td>$target_date</td>												<!--Target Date-->
		  <td>$due_date</td>												<!--Due Date-->
		  <td>$r12</td>														<!--Assigned-->
		  <td>$cad</td>														<!--Program-->
		  <td>$new_work</td>												<!--New Work-->
		  <td class='left'>$r14</td>										<!--Notes-->
		  <td><button type='button' onclick='productEdit(this) class='btn btn-default'>
		  <span class='glyphicon glyphicon-edit'/></button></td>
		</tr></pre>
		_END;
	}
	
	echo "</table>";
	
	function sanitizeString($var)
	{
		if (get_magic_quotes_gpc())
			$var = stripslashes($var);
		$var = strip_tags($var);
		$var = htmlentities($var);
		return $var;
	}
	
?>


<div class="column" id="column2">Column 2<br>
With Things</div>  
</div>
</body>
</html>