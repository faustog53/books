<?php // 2022-02-02 libri_edit_test.php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL | E_STRICT);

		$dbhost = '31.11.39.51';
        $dbuser = 'Sql1555463';
        $dbpass = 'Delphi.2021';
        $dbbase = 'Sql1555463_1';
        $libri  = 'libri2';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];

$query_rs_libri = "SELECT * FROM $libri WHERE id=$id";
$rs_libri = mysqli_query($conn, $query_rs_libri ) or die(mysqli_error($conn).'<br /><strong>'.$query_rs_libri);
$row_rs_libri = mysqli_fetch_assoc($rs_libri);
$totalRows_rs_libri = mysqli_num_rows($rs_libri);
$mission = 'Aggiorna ';

$form = "<form method='GET' ><fieldset><input type='submit' value='Submit'></fieldset>";
$result = $conn->query("describe libri2");

if ($totalRows_rs_libri > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["Field"] != "id") {
            $form .= "<div class='form-group'><label for='" . $row["Field"] . "'>" . $row["Field"] . "</label> <input type='text' name='" . $row["Field"] . "' size='100' value='".$row_rs_libri[$row["Field"]]."' ></div>";
        }
    }
    $form .= "<fieldset><input type='submit' value='Submit'></fieldset></form>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test libri</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div align="center">EDIT - LIBRI -TEST - <?php echo $id; ?></div>
<?php echo $form;?>
</body>
</html>
