<?php  //convert 2 mysqli
error_reporting(E_ALL);
ini_set("display_errors", 1);
$id   = $_GET['id'];
include ('test.php');
include ('connection.php');
$tab  = "libri2";
$qry  = sprintf("select * from %s where id=%s", $tab, $id);
print_line($conn, $dbbase, $tab, $qry);
?>