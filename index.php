
<?php // 27-01-2022 ARUBA
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
include('connection.php');
$msg = '';
    if(! $conn){
      die('Could not connect: ' . mysqli_error($conn));}
			
		if (isset($_GET['id']) and $_GET['id']>0){
          $id = $_GET['id']; 
          $sql="SELECT * FROM $libri WHERE id=$id";
        }	
    elseif(isset($_GET['anno']) and $_GET['anno']>0){
          $anno = $_GET['anno']; 
          $sql="SELECT * FROM $libri WHERE anno=$anno";
        }
    elseif(isset($_GET['editore']) and $_GET['editore']>' '){
          $editore = $_GET['editore']; 
          $editore = StrToUpper('%'.$editore.'%');
          $sql="SELECT * FROM $libri WHERE Upper(editore) LIKE '$editore' ORDER BY anno DESC ";
        }
        elseif(isset($_GET['posizione']) and $_GET['posizione']>' '){
          $posizione = $_GET['posizione']; 
          $posizione = StrToUpper('%'.$posizione.'%');
          $sql="SELECT * FROM $libri WHERE Upper(posizione) LIKE '$posizione' ORDER BY anno DESC ";
        } 
		elseif(isset($_GET['gruppo']) and $_GET['gruppo']>' '){
          $gruppo = $_GET['gruppo']; 
          $gruppo = StrToUpper('%'.$gruppo.'%');
          $sql="SELECT * FROM $libri WHERE Upper(gruppo) LIKE '$gruppo' ORDER BY anno DESC ";
        }
		elseif(isset($_GET['sezione']) and $_GET['sezione']>' '){
          $sezione = $_GET['sezione']; 
          $sezione = StrToUpper('%'.$sezione.'%');
          $sql="SELECT * FROM $libri WHERE Upper(sezione) LIKE '$sezione' ORDER BY anno DESC ";
        }
    elseif(isset($_GET['serie']) and $_GET['serie']>' '){ 
           $serie = StrToUpper('%'.$_GET['serie'].'%');
           $sql="SELECT * FROM libri WHERE Upper(collezione)  LIKE '$serie' ";
        }        
    elseif(isset($_GET['isbdm']) and $_GET['isbdm']>' '){
          $isbdm = $_GET['isbdm']; 
          $isbdm = StrToUpper('%'.$isbdm.'%');
          $sql="SELECT * FROM $libri WHERE Upper(titolo_isbdm)  LIKE '$isbdm' ";
		    }
		 elseif(isset($_GET['copertina'])){
			$sql="SELECT * FROM $libri WHERE copertina LIKE '%Images%'";
		    }
    elseif (isset($_GET['elenco'])){
			$elenco = $_GET['elenco'];
			$sql="SELECT * FROM $libri ORDER BY $elenco LIMIT 0, 30";
		    }	
    else{
          // 
          $anno = date('Y'); 
          $sql="SELECT * FROM $libri WHERE anno='$anno' ORDER BY id DESC";
          // $sql="SELECT * FROM $libri  ORDER BY id DESC";
        }
         // 
         $result = mysqli_query($conn, $sql);
         $rowcount=mysqli_num_rows($result);
if($result === false) {
    exit("Errore: impossibile eseguire la query: $sql " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <title>libri bs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">UCP LIBRARY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="https://ucp.altervista.org/">Home</a>
        <a class="nav-link" href="https://opac.sbn.it/opacsbn/opac/iccu/avanzata.jsp" title="ricerca SBN"  target="_blank">SBN</a>
        <a class="nav-link" href="https://www.anobii.com/" title="ANOBII"  target="_blank">ANOBII</a>
        <a class="nav-link" href="https://www.librarything.it/" title="LIBRARYTHING"  target="_blank">LIBRARYTHING</a>
        <a class="nav-link" href="https://books.google.it/?hl=it&tab=8p&authuser=0" title="GOOGLE BOOKS"  target="_blank">GOOGLE</a>
        <a class="nav-link" href="https://www.libraccio.it/" title="LIBRACCIO.IT"  target="_blank">LIBRACCIO</a>
        <a class="nav-link" href="https://www.ucp2.eu/pub/" title="PUBBLICAZIONI SU ARUBA www.ucp2.eu"  target="_blank">PUBBLICAZIONI</a>
        <a class="nav-link" href="?elenco=id DESC" title="elennco ultimi libri inseriti">ULTIMI</a>
        <a class="nav-link" href="libri_copy.php?id=0" title="RICERCA LIBRI">RICERCA</a>
        <a class="nav-link" href="libri_search.php?id=0vista.org/pim" title="PIM">PIM</a>
        <a class="nav-link" href="libri_test.php" title="menu editori e collezioni">MENU</a>
      </div>
    </div>
  </div>
</nav>
<nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="">
            <img src="1978582_597675883651331_753113554_o.jpeg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            ucp librI
          </a>
        </div>
      </nav>
<div class="container-fluid">
  <div class="row">

<?php 
while ($row = mysqli_fetch_array($result)) {
	if ($row['sbn_url']>' '){$url = $row['sbn_url'];}else {$url = '';}
  if ($row['pubblicazione_url']>' '){$pubblicazione_url = $row['pubblicazione_url'];$pubblicazione_tipo='[pdf]';}else {$pubblicazione_url = '';$pubblicazione_tipo='[]';}

  if ($row['recensione_url']>' ')   {$recensione_url    = $row['recensione_url'];$recensione_url_anchor = 'recensione';} 
    else    {$recensione_url = '';$recensione_url_anchor= '';}
  if ($row['sbn_url']>' ')   {$url    = $row['sbn_url'];$url_anchor = '[sbn]';} 
    else    {$url = '';$url_anchor= '';}
    $link = collegamento('libri_copertine.php?id='.$row['id'], 'testi copertine', ' ... leggi');
  //$link = "<a href='libri_copertine.php?id=".$row['id']."' title='".$row['testi_copertine']."'> ... Leggi tutto </a>";
  $link = collegamento('libri_copertine.php?id='.$row['id'], 'testi copertine', ' ... leggi');
?>
          <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $row['copertina'];?>" class="card-img-top" alt="<?php echo $row['titolo_isbdm'];?>">
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo $row['titolo_isbdm'];?> - <?php echo $row['note'];?>
                  </h5>
                  <a href="?id=<?php echo $row['id'];?>"><b>[# <?php echo $row['id'];?>]</b></a>
                  <a href="?editore=<?php echo $row['editore'];?>"><?php echo $row['editore'];?></a>: 
                  <a href="?anno=<?php echo $row['anno'];?>"><?php echo $row['anno'];?></a> - 
                  <a href="?serie=<?php echo $row['collezione'];?>"><?php echo $row['collezione'];?></a> <br /> 
                  <a href="https://www.google.com/search?q=<?php echo $row['isbn'];?>" target="_blank"><?php echo $row['isbn'];?></a> - 
                  <a href="<?php echo $url;?>" target="_blank"><?php echo $url_anchor;?></a> 
                  <a href="?sezione=<?php echo $row['sezione'];?>" target="_blank"><?php echo $row['sezione'];?></a> 
                  <a href="?gruppo=<?php echo $row['gruppo'];?>" target="_blank"><?php echo $row['gruppo'];?></a> 
                  <a href="https://www.google.com/search?q=copertina=<?php echo $row['titolo_isbdm'];?>" target="_blank">[copertina]</a> 
                  <a href="libri_upload.php?id=<?php echo $row['id'];?>&anno=<?php echo $row['anno'];?>&titolo=<?php echo $row['titolo_isbdm'];?>">[jpg]</a><br />
                  <a href="<?php echo $pubblicazione_url;?>" title="pubblicazione" target="_blank"><?php echo $pubblicazione_tipo;?></a> 
                  <a href="<?php echo $recensione_url;?>" title="recensione" target="_blank">[<?php echo $recensione_url_anchor;?>]</a> 
                  <a href="?posizione=<?php echo $row['posizione'];?>" target="_blank"><?php echo $row['posizione'];?></a> 
                  <a href="libri_item.php?id=<?php echo $row['id'];?>" target="_blank">[stampa]</a>
                  <p class="card-text"><?php echo anteprima($row['copertina_testo'],10,$link);?></p>
                  <a href="libri_edit.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Modifica</a>
                  <a href="libri_copy.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Copia</a>
                  <a href="libri_del.php?id=<?php echo $row['id'];?>" class="btn btn-primary" onclick="return confirm('Conferma eliminazione ?')">Elimina</a>
                  
                </div>   
            </div>
          </div>
<?php } ?>
    
  <div class="col">
    <div class="card-body">
     <?php
     echo "Connessione effettuata: $dbbase - $libri - $sql - $rowcount;";
		 echo ' - <form action="" class="modulo-ricerca"  >';
		 echo 'titolo <input type="text" name="isbdm"><br />';
		 echo 'editore <input type="text" name="editore"><br />';
     echo 'anno <input type="text" name="anno" size="4"><br />';
		 echo 'id# <input type="text" name="id"><br />';
	   echo 'serie <input type="text" name="serie" value=""><br />';
		 echo '<input type="submit" name="invio"> </form> ';
		 echo '<td>'; 
     // * ----------h-------------------------------------------------------------------------------- * 
     // editore, posizione, libreria, gruppo, collezione, sezione, ... 
    // * ----------h-------------------------------------------------------------------------------- * 
     menu ( 'anno', 'libri2', $conn);
     // * ----------h-------------------------------------------------------------------------------- * 
     menu ( 'gruppo', 'libri2', $conn);
     // * ----------h-------------------------------------------------------------------------------- * 
     menu ( 'posizione', 'libri2', $conn);
     // * ----------h-------------------------------------------------------------------------------- * 
     menu ( 'libreria', 'libri2', $conn);
     // * ----------h-------------------------------------------------------------------------------- * 
     menu ( 'sezione', 'libri2', $conn);
     // * ----------h-------------------------------------------------------------------------------- * 
     ?>
    </div>
  </div>

  </div>
</div>
<?php print $sql;?>
</body>
</html>
<?php
 mysqli_free_result($result);
 mysqli_close($conn);
 ?>