<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL | E_STRICT);
include('connection.php');
function test_input($data) {
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// echo $_POST['btnadd'];

if( isset($_POST['btnadd']) )
{
	$id   = $_POST['id'];
	$anno = $_POST['anno'];
	
    $delete = "DELETE FROM libri2 WHERE id=$id";
	
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
    $result = mysqli_query($conn,$delete);
	// print $delete;
    if($result === false) {
    exit("Errore: impossibile eseguire la query: $delete " . mysqli_error($conn));
    }   
    header('location:index.php?anno='.$id);
}

if( isset($_GET['id']) ){
  $id = test_input($_GET['id']);
  $sql = "SELECT * FROM libri2 WHERE id = $id";
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
  if(! $conn){
    die('Could not connect: ' . mysqli_error());}

  $result_libri = mysqli_query($conn, $sql);

  if($result_libri === false) {
    exit("Errore: impossibile eseguire la query: $sql <strong>" . mysqli_error($conn));}
  else {
    $row_libri = mysqli_fetch_assoc($result_libri);
	}
} 
else {
  $titolo_isbdm = $titolo_originale = $collezione = $editore = $anno = $pagine = "";
  $altezza = $isbn = $url = $copertina = $note = $data  = $libreria = $posizione = $gruppo = $sezione = "";
}
?> 

<!DOCTYPE HTML>  
<html>
<head>
<title>Libri</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>  



<h2>PHP Libri delete</h2>

<form method="post" name="frmAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <input type="submit" name="btnadd" value="Elimina">   Id# <?php echo $id;?><br /> 
  <table width="800">
  <tr>
  <td><img src="<?php echo $row['copertina'];?>" height="300"></td>
  <td><?php echo $row_libri['titolo_isbdm'];?></td>
  </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $id;?>">
  <input type="hidden" name="anno" value="<?php echo $anno;?>">
  <input type="submit" name="btnadd" value="Elimina">   Id# <?php echo $id;?> 

</form>

</body>
</html>
