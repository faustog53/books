<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL | E_STRICT);
include('connection.php');


// echo $_POST['btnadd'];

if( isset($_POST['btnadd']) )
{ $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
  $titolo_isbdm      = test_input($_POST['titolo_isbdm']);
  $titolo_originale  = test_input($_POST['titolo_originale']);
  $titolo_uniforme   = test_input($_POST['titolo_uniforme']);
    $editore           = test_input($_POST['editore']);
    $posizione         = StrToUpper(test_input($_POST['posizione']));   // 31/12/2020
	  $sezione           = StrToUpper(test_input($_POST['sezione']));   	// 31/12/2020
	  $gruppo            = StrToUpper(test_input($_POST['gruppo']));   	// 31/12/2020
	if ($_POST['data'] = ''){	$data = NULL;}	else {$data              = $_POST['data'];}
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
    $dorso  	   = test_input($_POST['dorso']);
    $testi_copertine = test_input($_POST['testi_copertine']);
    $id              = $_POST['id'];

    $update = "UPDATE $libri SET titolo_isbdm=\"$titolo_isbdm\", titolo_originale=\"$titolo_originale\", 
	titolo_uniforme=\"$titolo_uniforme\", editore='$editore', anno='$anno', collezione='$collezione', collezione_nr='$collezione_nr',
  pubblicazione_tipo='$pubblicazione_tipo', pubblicazione_url='$pubblicazione_url', recensione_url = '$recensione_url',	pagine='$pagine', isbn='$isbn', altezza='$altezza', sbn_url='$url', dorso='$dorso',copertina='$copertina', note='$note',	sezione='$sezione', data='$data', posizione='$posizione', gruppo='$gruppo', libreria='$libreria', copertina_testo=\"$testi_copertine\"
	WHERE id=$id";
    
    $result = mysqli_query($conn,$update);
	print $update;
    if($result === false) {
    exit("Errore: impossibile eseguire la query: $update " . mysqli_error($conn));
    }   
    header('location:index.php?id='.$id);
}

if( isset($_GET['id']) ){
  $id = test_input($_GET['id']);
  $sql = "SELECT * FROM $libri WHERE id = $id";
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
  if(! $conn){
    die('Could not connect: ' . mysqli_error($conn));}

  $result_libri = mysqli_query($conn, $sql);

  if($result_libri === false) {
    exit("Errore: impossibile eseguire la query: $sql <strong>" . mysqli_error($conn));}
  else {
    $row_libri = mysqli_fetch_assoc($result_libri);
	  $libreria         = $row_libri['libreria'];
    $titolo_isbdm     = $row_libri['titolo_isbdm'];
    $titolo_originale = $row_libri['titolo_originale'];
    $titolo_uniforme  = $row_libri['titolo_uniforme'];
    $testi_copertine  = testInput($row_libri['copertina_testo']);
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
    $dorso            = $row_libri['dorso'];
    $note             = $row_libri['note'];
    $id               = $row_libri['id'];
	  $data             = $row_libri['data'];
	  $posizione        = $row_libri['posizione'];
	  $sezione          = $row_libri['sezione'];
	  $gruppo           = $row_libri['gruppo'];
	}
} 
else {
  $titolo_isbdm = $titolo_originale = $titolo_uniforme = $collezione = $editore = $anno = $pagine = "";
  $altezza = $isbn = $url = $copertina = $dorso = $note = $data  = $libreria = $posizione = $gruppo = $sezione = "";
  $testi_copertine = $pubblicazione_tipo = $pubblicazione_url = $recensione_url = "";
}
?> 

<!DOCTYPE HTML>  
<html>
<head>
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

<?php
// define variables and set to empty values
$titolo_isbdmErr = $titolo_originaleErr = $collezioneErr = $editoreErr = $annoErr = $pagineErr = $altezzaErr = "";
	$isbnErr = $urlErr = $copertinaErr = $noteErr = $sezioneErr = $gruppoErr= "";

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
    $isbn = "";
  } else {
    $isbn = test_input($_POST["isbn"]);
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
  if (empty($_POST["dorso"])) {
    $dorso = "";
  } else {
    $dorso = test_input($_POST["dorso"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$dorso)) {
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
  if (empty($_POST["pubblicazione_url"])) {
    $pubblicazione_url = "";
  } else {
    $pubblicazione_url = test_input($_POST["coperpubblicazione_urltina"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$pubblicazione_url)) {
      $urlErr = "Invalid Pubblicazione URL";
    }
  }
  if (empty($_POST["testi_copertine"])) {
    $testi_copertine = "";
  } else {
    $testi_copertine = $_POST["testi_copertine"];
  }
  if (empty($_POST["note"])) {
    $note = "";
  } else {
    $note = test_input($_POST["note"]);
  }
  $recensione_url = test_input($_POST["recensione_url"]);
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>
<div class="container">
<h2>BS Libri edit</h2>
<!-- <p><span class="error">* dati obbligatori</span></p> -->
<form method="post" name="frmAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <!-- <input type="submit" name="btnadd" value="Salva">   Id# <br />  -->
  <button type="submit"  name="btnadd" class="btn btn-primary">Salva # <?php echo $id;?></button>
  <?php include('libri_form_bs.php');?>
  <input type="hidden" name="id" value="<?php echo $id;?>">
  <button type="submit"  name="btnadd" class="btn btn-primary">Salva # <?php echo $id;?></button>
  <!-- <input type="submit" name="btnadd" value="Salva">   Id# <?php echo $id;?>  -->
</form>
</div>
</body>
</html>
