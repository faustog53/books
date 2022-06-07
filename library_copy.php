<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL | E_STRICT);
include('connection.php');
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$titolo_isbdm = $titolo_originale = $collezione = $collezione_nr = $editore = $anno = $pagine = $altezza = $isbn = $url = $copertina = $note = "";
// echo $_POST['btnadd'];

if( isset($_POST['btnadd']) )
{
	/*
    $titolo_isbdm  = $_POST['titolo_isbdm'];
    $editore    = $_POST['editore'];
    $anno       = $_POST['anno'];
    $collezione = $_POST['collezione'];
    $pagine     = $_POST['pagine'];
    $isbn       = $_POST['isbn'];
    $altezza    = $_POST['altezza'];
    $url        = $_POST['url'];
    $note       = $_POST['note'];
	*/
	// 24 01 2021
    $titolo_isbdm      = test_input($_POST['titolo_isbdm']);
    $titolo_originale  = test_input($_POST['titolo_originale']);
    $titolo_uniforme   = test_input(SubStr($_POST['titolo_isbdm']),0,255);
    $editore           = test_input($_POST['editore']);
    $posizione         = StrToUpper(test_input($_POST['posizione']));   // 31/12/2020
	$sezione           = StrToUpper(test_input($_POST['sezione']));   	// 31/12/2020
	$gruppo            = StrToUpper(test_input($_POST['gruppo']));   	// 31/12/2020
	if ($_POST['data'] = ''){
		$data = NULL;}
	else {$data              = test_input($_POST['data']);}
	   		// 31/12/2020
	$libreria          = StrToUpper(test_input($_POST['libreria']));   	// 31/12/2020
    $collezione        = test_input($_POST['collezione']);
	$collezione_nr     = test_input($_POST['collezione_nr']);
	$note       	   = test_input($_POST['note']);
	$anno       	   = $_POST['anno'];
    $pagine    		   = $_POST['pagine'];
    $isbn       	   = $_POST['isbn'];
    $altezza    	   = $_POST['altezza'];
    $url        	   = test_input($_POST['url']);
    $copertina  	   = test_input($_POST['copertina']);
									
    $insert = "insert into $libri (titolo_isbdm, titolo_originale, editore, anno, collezione, collezione_nr, pagine, isbn, altezza, url, copertina, note, titolo_uniforme, posizione, sezione, gruppo, libreria) 
    values('$titolo_isbdm', '$titolo_originale','$editore','$anno','$collezione','$collezione_nr','$pagine','$isbn','$altezza','$url','$copertina', '$note', '$titolo_uniforme', '$posizione', '$sezione', '$gruppo', '$libreria')";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
    $result = mysqli_query($conn,$insert);

    if($result === false) {
    exit("Errore: impossibile eseguire la query: $insert " . mysqli_error($conn));
    }   
    // echo($insert);
    header('location:index.php?id='.mysqli_insert_id($conn));
}

if( isset($_GET['id']) ){
  $id = test_input($_GET['id']);

  $sql = "SELECT * FROM library WHERE `Book ID` = $id";
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
  if(! $conn){
    die('Could not connect: ' . mysqli_error());}

  $result_libri = mysqli_query($conn, $sql);

  if($result_libri === false) {
    exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));}

    while ($row_libri = mysqli_fetch_array($result_libri)){
    $titolo_isbdm     = $row_libri['Summary'];
    // $titolo_originale = $row_libri['titolo_originale'];
    $editore          = $row_libri['Publication'];
    // $collezione       = $row_libri['collezione'];
    $anno             = $row_libri['Date'];
    $pagine           = $row_libri['Page Count'];
    $altezza          = $row_libri['Height'];
    $isbn             = $row_libri['ISBN'];
    // $url              = $row_libri['url'];
    // $copertina        = $row_libri['copertina'];
    $note             = $row_libri['Subjects'];
  }

  
} 
else {
  $titolo_isbdm = $titolo_originale = $collezione = $editore = $anno = $pagine = $altezza = $isbn = $url = $copertina = $note = "";
}
?> 

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<title>Libri</title>
</head>
<body>  

<?php
// define variables and set to empty values
$titolo_isbdmErr = $titolo_originaleErr = $collezioneErr = $editoreErr = $annoErr = $pagineErr = $altezzaErr = $isbnErr = $urlErr = $copertinaErr = $noteErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["titolo_isbdm"])) {
    $titolo_isbdmErr = "E' richiesta una descrizione ISBD(M) completa";
  } else {
    $titolo_isbdm = test_input($_POST["titolo_isbdm"]);
  }

  if (empty($_POST["editore"])) {
    $editoreErr = "Editore";
  } else {
    $editore = test_input($_POST["editore"]);
  }

  if (empty($_POST["anno"])) {
    $annoErr = "Anno";
  } else {
    $anno = test_input($_POST["anno"]);
  }

  if (empty($_POST["collezione"])) {
    $collezioneErr = "Collezione";
  } else {
    $collezione = test_input($_POST["collezione"]);
  }

  if (empty($_POST["pagine"])) {
    $pagineErr = "Pagine";
  } else {
    $pagine = test_input($_POST["pagine"]);
  }

    if (empty($_POST["altezza"])) {
    $altezzaErr = "Altezza";
  } else {
    $altezza = test_input($_POST["altezza"]);
  }

    if (empty($_POST["isbn"])) {
    $isbnErr = "ISBN";
  } else {
    $isbn = test_input($_POST["isbn"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("\d",$isbn)) {
      $urlErr = "Invalid URL";
    }
  }

  if (empty($_POST["url"])) {
    $url = "";
  } else {
    $url = test_input($_POST["url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
      $urlErr = "Invalid URL";
    }
  }

  if (empty($_POST["copertina"])) {
    $copertina = "";
  } else {
    $copertina = test_input($_POST["copertina"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$copertina)) {
      $urlErr = "Invalid URL";
    }
  }

  if (empty($_POST["note"])) {
    $note = "";
  } else {
    $note = test_input($_POST["note"]);
  }
}
?>

<h2>PHP Libri copy</h2>
<p><span class="error">* dati obbligatori</span></p>
<form method="post" name="frmAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <input type="submit" name="btnadd" value="Salva"> <br />
  <?php // include('libri_form.php');?>

  <div class="input-group">
  Titolo: <textarea name="titolo_isbdm" rows="5" cols="60" title="descrizione completa ISBD(M)"><?php echo $titolo_isbdm;?></textarea>
  <span class="error">* <?php echo $titolo_isbdmErr;?></span>
  </div>
  <div class="input-group">
  Titolo originale: <input type="text" name="titolo_originale" value="<?php // echo $titolo_originale;?>" size="60">
  <span class="error"> <?php echo $titolo_originaleErr;?></span>
  </div>
  <div class="input-group">
  Editore: <input type="text" name="editore" value="<?php echo $editore;?>" size="60">
  <span class="error">* <?php echo $editoreErr;?></span>
  </div>
  <div class="input-group">
  Anno: <input type="text" name="anno" value="<?php echo $anno;?>" size="4">
  <span class="error">* <?php echo $annoErr;?></span>
  </div>
  <div class="input-group">
  Collezione: <input type="text" name="collezione" value="<?php // echo $collezione;?>" size="60">
  <span class="error"> <?php echo $collezioneErr;?></span>
  </div>
<div class="input-group">
  Collezione #: <input type="text" name="collezione_nr" value="<?php // echo $collezione_nr;?>" size="10">
  <span class="error"> <?php echo $collezioneErr;?></span>
  </div>
  <div class="input-group">
  Sezione: <input type="text" name="sezione" value="<?php // echo $row_libri['sezione'];?>" size="60">
  </div>
  <div class="input-group">
  Gruppo: <input type="text" name="gruppo" value="<?php // echo $row_libri['gruppo'];?>" size="60">
  </div>
  <div class="input-group">
  Pagine: <input type="text" name="pagine" value="<?php echo $pagine;?>" size="20">
  <span class="error">* <?php echo $pagineErr;?></span>
  </div>
  <div class="input-group">
  Altezza: <input type="text" name="altezza" value="<?php echo $altezza;?>" size="4">
  <span class="error">* <?php echo $altezzaErr;?></span>
  </div>
  <div class="input-group">
  ISBN: <input type="text" name="isbn" value="<?php echo $isbn;?>" size="60">
  <span class="error"> <?php echo $isbnErr;?></span>
  </div>
  <div class="input-group">
  url: <input type="url" name="url" value="<?php // echo $url;?>" size="60">
  <span class="error"><?php echo $urlErr;?></span>
  </div>
  <div class="input-group">
  Copertina: <input type="url" name="copertina" placeholder="https://ucp2.cloud/libri/copertine/" value="<?php echo $copertina;?>" size="60">
  <span class="error"><?php echo $copertinaErr;?></span>
  <br>https://ucp2.cloud/libri/copertine/<br /></div>
  <div class="input-group">
  Posizione: <input type="text" name="posizione" value="<?php echo $row_libri['posizione'];?>" size="60">
  </div>
  <div class="input-group">
  Libreria: <input type="text" name="libreria" value="<?php echo $row_libri['libreria'];?>" size="60">
  </div>
  <div class="input-group">
  Data: <input type="text" name="data" value="<?php echo $row_libri['data'];?>">
  </div>
  <div class="input-group">
  Annotazioni: <textarea name="note" rows="5" cols="40"><?php echo $note;?></textarea>
  </div>

  <input type="submit" name="btnadd" value="Salva">  
</form>

</body>
</html>
