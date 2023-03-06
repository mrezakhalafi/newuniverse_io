<?php include_once('/apps/web/palio.io/db_conn.php');?>
<?php include_once('/apps/web/palio.io/url_function.php');?>
<?php include_once('/apps/web/palio.io/session_function.php');?>
<?php require_once('HtmlExcel.php'); ?>

<?php
	session_start();

	$dbconn = getDBConn();
        
	if($_GET['startDate'] != ''){
		$startdate = $_GET['startDate'];
		$untildate = $_GET['endDate'];
	
		$query= $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND BILL_DATE BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)");
		$query->bind_param("iss", $_SESSION['id_company'], $_GET['startDate'], $_GET['endDate']);
		$query->execute();
		$bills = array();
		$bills = $query->get_result(); //GET COLUMNS
		$query->close();

	}else if($_GET['startDate'] == ''){
		$startdate = "2020-01-01";
		$untildate = date("Y-m-d");
		
		$query= $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc");
		$query->bind_param("i", $_SESSION['id_company']);
		$query->execute();
		$bills = array();
		$bills = $query->get_result(); //GET COLUMNS
		$query->close();

	}

	$date = date_create($startdate);
	$startdate = date_format($date, 'dmY');
	
	$date = date_create($untildate);
	$untildate = date_format($date, 'dmY');

	// startExcel('nus/'.$startdate.'-'.$untildate.'.xls');
	// $filename = "nus/" .$startdate. "-" .$untildate. ".xls";

	// header("Content-type: application/vnd.ms-excel; charset=UTF-8");
	// header("Content-Disposition: attachment; filename=\"$filename\"");
	// header("Expires: 0");
	// header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	// header("Pragma: public");
	// exit();
?>

<?php
	$css = "
	.red {
		color: red;
	}";
	
	$numbers = '<table>
	<tr>
		<td class="red">1</td>
		<td>2</td>
		<td>3</td>
	</tr>
	<tr>
		<td>4</td>
		<td class="red">5</td>
		<td>6</td>
	</tr>
	<tr>
		<td>7</td>
		<td>8</td>
		<td class="red">9</td>
	</tr>
	</table>';
	
	$names = '<table>
	  <tr>
		<th>First name</th>
		<th>Last name</th>
	  </tr>
	  <tr>
		<td>John</td>
		<td>Doe</td>
	  </tr>
	  <tr>
		<td>Jane</td>
		<td>Doe</td>
	  </tr>
	</table>';
	
	$xls = new HtmlExcel();
	$xls->setCss($css);
	$xls->addSheet("Numbers", $numbers);
	$xls->addSheet("Names", $names);
	$xls->headers();
	echo $xls->buildFile();
?>
