<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// echo $_POST['btnadd'];

if( isset($_POST['btnadd']) )
{
    $titolo_isbdm     = $_POST['titolo_isbdm'];
    $editore    = $_POST['editore'];
    $anno       = $_POST['anno'];
    $collezione = $_POST['collezione'];
    $pagine     = $_POST['pagine'];
    $isbn       = $_POST['isbn'];
    $altezza    = $_POST['altezza'];
    $url        = $_POST['url'];
    $note       = $_POST['note'];

    $insert = "insert into libri (titolo_isbdm, titolo_originale, editore, anno, collezione, pagine, isbn, altezza, url, copertina, note) 
    values('$titolo_isbdm', '$titolo_originale','$editore','$anno','$collezione','$pagine','$isbn','$altezza','$url','$copertina', '$note')";
    include('connection.php');
include('connection.php');
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
    $result = mysqli_query($conn,$insert);
    if($result === false) {
    exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));
}   
    // echo($insert);
    header('location:index.php');
}?> 

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
$titolo_isbdmErr = $titolo_originaleErr = $editorelErr = $annoErr = $pagineErr = $isbnErr = $urlErr = $noteErr = "";
$titolo_isbdm = $titolo_originale = $editore = $anno = $pagine = $isbn = $url = $copertina = $note = "";

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

<h2>PHP Libri</h2>
<p><span class="error">* dati obbligatori</span></p>
<form method="post" name="frmAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <input type="submit" name="btnadd" value="Salva"> 
  <?php include('libri_form.php');?>
  <input type="submit" name="btnadd" value="Salva">  
</form>

</body>
</html>
