<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

function print_line($con, $db, $tab, $qry){
	$res = mysqli_query($con, $qry) or trigger_error(mysqli_error($con),E_USER_ERROR).$qry;
	$numfields = mysqli_num_fields($res);
	$row = mysqli_fetch_row($res);
	$i = 0;
	echo '<!DOCTYPE html><html><head><meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="stile.css">
	<title>'.$tab.'</title>
	</head><body>';
	echo "<table border><caption>tabella: $tab</caption>";
	while($fieldinfo=mysqli_fetch_field($res)){
		printf("<tr><th>%s\n</th><td>%s</td>", $fieldinfo->name, $row[$i] );	
		$i++;
	}
	

	echo "</table>";
	echo "stampato il ".date("d/m/Y H:i");
	echo "</body></html>";
}

?>
