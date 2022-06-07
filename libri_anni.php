<html>
   <head>
      <title>libri</title>
	 <link rel="stylesheet" type="text/css" href="style.css"> 
   </head>  
   <body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

include('connection.php');
   
         if(! $conn){
            die('Could not connect: ' . mysqli_error());}

         if(isset($_GET['anno'])){
          $anno = $_GET['anno']; 
          $sql="SELECT * FROM $libri WHERE anno=$anno";
        }
         else{
          $anno = date('Y');
          $sql="SELECT * FROM $libri WHERE anno='$anno' ORDER BY id DESC";}
         $result = mysqli_query($conn, $sql);

		if($result === false) {
			exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));
}
// 2020-12-27

// 2020-12-24
$colonna = 0; 
echo '<table width="800"><tr>';
while ($row = mysqli_fetch_array($result)) {
	echo '<td>'.'<a href="index.php?id='.$row['id'].'"><img src="'.$row['copertina'].'" height="300" alt="'.$row['titolo_isbdm'].'"></a>'.'</td>';
	$colonna = $colonna +1;
	if ($colonna == 4) { 
		echo '</tr><tr>';
		$colonna = 0;
	}	
} 
		 
		mysqli_free_result($result);
         mysqli_close($conn);
         // 
      ?>
          <table border="1" align="center">
      <tr>
        <td></td>
        <td></td>
      </tr>
    </table>
   </body>
</html>


<?php // 2020-12-23

/*

         $sql="CREATE TABLE `libri1` (
  `id` int NOT NULL,
  `titolo_isbdm` varchar(4096) NOT NULL,
  `anno` year DEFAULT NULL,
  `modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";


const USERNAME = "root";
const PASSWORD = "delphi";
const DATABASENAME = "biblioteca";
private $conn;
$db = mysqli_connect('localhost', USERNAME, PASSWORD, DATABASENAME);

$sql="CREATE TABLE  'libri' (
id int(11)  UNSIGNED NOT NULL,
titolo varchar(255) NOT NULL DEFAULT '',
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
mysqli_query($db, $sql);
*/
?>
