<html>
   <head>
      <title>libri</title>
   </head>
   <body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
        include('connection.php');
         if(! $conn){
            die('Could not connect: ' . mysqli_error());}
         echo "Connessione effettuata: $dbbase ";
         echo '<a href="?" title="elenco completo: tutti gli anni">tutte le annate</a>';
         $sql_annate = "SELECT DISTINCT Date FROM library ORDER BY Date";
         $result_annate = mysqli_query($conn, $sql_annate);
         echo ' - ';
         while ($row_annate = mysqli_fetch_array($result_annate)) {
         echo '<a href="?anno='.$row_annate['Date'].'">'.$row_annate['Date'].'</a> -';}
         echo ' - <a href="libri_copy.php?id=0">[insert]</a>';
         echo ' - <a href="/">[home]</a>';
         echo '<br />';
         if(isset($_GET['anno'])){
          $anno = $_GET['anno']; 
          echo " - anno: $anno";
          $sql="SELECT * FROM library WHERE Date=$anno";
         }
         else{
          $sql="SELECT * FROM library";}
         // $sql="SELECT * FROM libri";
         $result = mysqli_query($conn, $sql);
if($result === false) {
    exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));
}
// 2020-12-27

// 2020-12-24
echo '<ul>'; 
while ($row = mysqli_fetch_array($result)) {
    echo '<li>'.'<img src="'.$row['Review'].'" height="100"> # '.$row['Book ID'].' - '.$row['Summary'].' -- '.$row['Publication'].
    ' - <a href="library_copy.php?id='.$row['Book ID'].'">[copy]</a>'.
    '<a href="libri_edit.php?id='.$row['Book ID'].'">[edit]</a>';
}
echo '</ul>'; 
mysqli_free_result($result);
          // echo PASSWORD('6ejY9ifzfzj0');
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
