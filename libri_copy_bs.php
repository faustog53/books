<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  include('connection.php');

$titolo_isbdm = $titolo_originale = $collezione = $collezione_nr = $editore = $anno = $pagine = $altezza = $isbn = $url = $copertina = $note = "";
// echo $_POST['btnadd'];

if( isset($_POST['btnadd']) )
{	// 27-12-2021
    $titolo_isbdm      = GetSQLValueString($_POST['titolo_isbdm'], "text");
    $titolo_originale  = GetSQLValueString($_POST['titolo_originale'], "text");
    $titolo_uniforme   = GetSQLValueString(SubStr($_POST['titolo_uniforme'],0,255), "text");
    $editore           = test_input($_POST['editore']);
    $posizione         = StrToUpper(test_input($_POST['posizione']));   // 31/12/2020
	  $sezione           = StrToUpper(test_input($_POST['sezione']));   	// 31/12/2020
	  $gruppo            = StrToUpper(test_input($_POST['gruppo']));   	// 31/12/2020
	if ($_POST['data'] = ''){
		$data = NULL;}
	else {$data          = test_input($_POST['data']);}
	// 31/12/2020
	  $libreria         = StrToUpper(test_input($_POST['libreria']));   	// 31/12/2020
    $collezione       = test_input($_POST['collezione']);
	  $collezione_nr    = test_input($_POST['collezione_nr']);
    $pubblicazione_tipo = test_input($_POST['pubblicazione_tipo']);
    $pubblicazione_url = test_input($_POST['pubblicazione_url']);
    $recensione_url  = test_input($_POST['recensione_url']);
	  $note       	   = test_input($_POST['note']);
	  $anno       	   = $_POST['anno'];
    $pagine    		   = $_POST['pagine'];
    $isbn       	   = $_POST['isbn'];
    $altezza    	   = $_POST['altezza'];
    $url        	   = test_input($_POST['url']);
    $copertina  	   = test_input($_POST['copertina']);
    $dorso      	   = test_input($_POST['dorso']);
    $testi_copertine = GetSQLValueString($_POST['testi_copertine'], "text");
    $id              = $_POST['id'];

    $insert = "insert into $libri (titolo_isbdm, titolo_originale, copertina_testo, editore, anno, collezione, collezione_nr, pubblicazione_tipo, pubblicazione_url, recensione_url, pagine, isbn, altezza, sbn_url, copertina, dorso, note, titolo_uniforme, posizione, sezione, gruppo, libreria) 
    values(\"$titolo_isbdm\", \"$titolo_originale\",\"$testi_copertine\",'$editore','$anno','$collezione','$collezione_nr','$pubblicazione_tipo','$pubblicazione_url','$recensione_url', '$pagine','$isbn','$altezza','$url','$copertina', '$dorso','$note', \"$titolo_uniforme\", '$posizione', '$sezione', '$gruppo', '$libreria')";

    // $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
    $result = mysqli_query($conn,$insert);

    if($result === false) {
    exit("Errore: impossibile eseguire la query: $insert " . mysqli_error($conn));
    }   
    // echo($insert);
    header('location:index.php?id='.mysqli_insert_id($conn));
}

if (isset($_GET['id'])){
  $id = test_input($_GET['id']);}
else {
  $id = 0;}

  $sql = "SELECT * FROM $libri WHERE id = $id";
  // $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);


  $result_libri = mysqli_query($conn, $sql);

  if($result_libri === false) {
    exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));}

    while ($row_libri = mysqli_fetch_array($result_libri)){
    
    $libreria         = $row_libri['libreria'];
    $titolo_isbdm     = $row_libri['titolo_isbdm'];
    $titolo_originale = $row_libri['titolo_originale'];
    $titolo_uniforme  = $row_libri['titolo_uniforme'];
    $testi_copertine  = $row_libri['copertina_testo'];
    $editore          = $row_libri['editore'];
    $collezione       = $row_libri['collezione'];
    $collezione_nr    = $row_libri['collezione_nr'];
    $pubblicazione_tipo = $row_libri['pubblicazione_tipo'];
    $pubblicazione_url = $row_libri['pubblicazione_url'];
    $recensione_url   = $row_libri['recensione_url'];
    $anno             = $row_libri['anno'];
    $pagine           = $row_libri['pagine'];
    $altezza          = $row_libri['altezza'];
    $isbn             = $row_libri['isbn'];
    $url              = $row_libri['sbn_url'];
    $copertina        = $row_libri['copertina'];
    $dorso        = $row_libri['dorso'];
    $note             = $row_libri['note'];
    $id               = $row_libri['id'];
    $data             = $row_libri['data'];
    $posizione        = $row_libri['posizione'];
    $sezione          = $row_libri['sezione'];
    $gruppo           = $row_libri['gruppo'];
  }

  
} 
else {
  $titolo_isbdm = $titolo_originale = $collezione = $editore = $anno = $pagine = $altezza = $isbn = $url = $copertina = $note = "";
}
?> 

<!DOCTYPE HTML>  
<html>
<head>
<style> .error {color: #FF0000;} </style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<title>Libri</title>
</head>
<body>  

<?php /*
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
} */
?>

<h2>PHP Libri copy</h2>
<p><span class="error">* dati obbligatori</span></p>
<form method="post" name="frmAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <input type="submit" name="btnadd" value="Salva"> <br />
  <?php include('libri_form_bs.php');?>
  <input type="submit" name="btnadd" value="Salva">  
</form>

</body>
</html>