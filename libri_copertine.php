<?php // libri_copertine.php
include('connection.php');
if (!isset($_GET['id']))
{
    echo '#id mancante!';
?>
<a href="">torna indietro</a>
<?php
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
    $testi_copertine  = $row_libri['copertina_testo'];
    $editore          = $row_libri['editore'];
    $collezione       = $row_libri['collezione'];
	  $collezione_nr    = $row_libri['collezione_nr'];
    $pubblicazione_tipo = $row_libri['pubblicazione_tipo'];
    $pubblicazione_url = $row_libri['pubblicazione_url'];
    $anno             = $row_libri['anno'];
    $pagine           = $row_libri['pagine'];
    $altezza          = $row_libri['altezza'];
    $isbn             = $row_libri['isbn'];
    $url              = $row_libri['url'];
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php?id=<?php echo $id;?>"><?php echo $id;?></a>
        <a class="nav-link" href="libri_upload.php??id=<?php echo $id;?>&anno=<?php echo $anno;?>&titolo=<?php echo $titolo_isbdm;?>">copertina</a>
        <a class="nav-link" href="libri_upload_dorso.php?id=<?php echo $id;?>&anno=<?php echo $anno;?>&titolo=<?php echo $titolo_isbdm;?>">dorso</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>
<button onclick="history.back()">Go Back</button>
  <h1><?php echo $titolo_isbdm;?> [#<?php echo $id;?>]</h1>
<p class="lead">
  <?php echo $testi_copertine;?></p>
  <img src="<?php echo $copertina;?>">
  <img src="<?php echo $dorso;?>">
 

