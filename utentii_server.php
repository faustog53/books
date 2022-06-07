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
	$password = '';
	$id = 0;
	$update = false;

if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$address = $_POST['address'];
	$password = MD5($_POST['password']);
		
	$result = mysqli_query($db, "INSERT INTO info (name, address, password) VALUES ('$name', '$address', '$password')"); 
	if($result === false) {
		$_SESSION['message'] = "Impossibile eseguire l'inserimento!". mysqli_error($conn)); 
	}
	else {
		$_SESSION['message'] = "Address saved"; 
		}
	header('location: utenti_index.php');
	}
	
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$password = MD5($_POST['password']);
	
	mysqli_query($db, "UPDATE info SET name='$name', address='$address', password='$password' WHERE id=$id");
	if($result === false) {
		$_SESSION['message'] = "Impossibile eseguire l'aggiornamento!". mysqli_error($conn)); 
	}
	else {
		$_SESSION['message'] = "Address updated!"; 
	}
	header('location: utenti_index.php');
	}
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['message'] = "Address deleted!"; 
		header('location: utenti_index.php');
	}
?>