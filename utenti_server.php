<?php // 03-01-2021 utenti_server
	session_start();
		 $dbhost = '89.46.111.187';
         $dbuser = 'Sql1425636';
         $dbpass = '82820r8b1i';
         $dbbase = 'Sql1425636_1';
		 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
		$_SESSION['message'] = "Address saved"; 
		header('location: index.php');
	}
?>