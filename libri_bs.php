
<?php
include('connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
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
			$sql="SELECT * FROM $libri ORDER BY $elenco LIMIT 0, 20";
		    }	
    else{
          // 
          $anno = date('Y'); 
          $sql="SELECT * FROM $libri WHERE anno='$anno' ORDER BY id DESC";
          // $sql="SELECT * FROM $libri  ORDER BY id DESC";
        }
         // 
         $result = mysqli_query($conn, $sql);

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
<div class="container">
  <div class="row">

<?php 
while ($row = mysqli_fetch_array($result)) {
	if ($row['url']>' '){$url = $row['url'];}else {$url = '';}
  if ($row['pubblicazione_url']>' '){$pubblicazione_url = $row['pubblicazione_url'];}else {$pubblicazione_url = '';}
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
                    <a href="?serie=<?php echo $row['collezione'];?>"><?php echo $row['collezione'];?></a> - 
                    [ISBN #<a href="https://www.google.com/search?q=<?php echo $row['isbn'];?>" target="_blank"><?php echo $row['isbn'];?></a> - 
                    <a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a> 
                    <a href="?gruppo=<?php echo $row['gruppo'];?>" target="_blank"><?php echo $row['gruppo'];?></a> 
                    <a href="?sezione=<?php echo $row['sezione'];?>" target="_blank"><?php echo $row['sezione'];?></a> 
                    <a href="https://www.google.com/search?q=copertina <?php echo $row['titolo_isbdm'];?>" target="_blank">[copertina]</a> 
                    <a href="libri_upload.php?id=<?php echo $row['id'];?>&anno=<?php echo $row['anno'];?>&titolo=<?php echo $row['titolo'];?>">[jpg]</a><br />
                    <a href="<?php echo $pubblicazione_url;?>" target="_blank"><?php echo $pubblicazione_url;?></a> 
                    <a href="?posizione=<?php echo $row['posizione'];?>" target="_blank"><?php echo $row['posizione'];?></a> 
                  <p class="card-text"></p>
                  <a href="libri_edit.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Modifica</a>
                  <a href="libri_copy.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Copia</a>
                  <a href="libri_del.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Elimina</a>
                </div>   
            </div>
          </div>
<?php } ?>
    
  <div class="col">
    <div class="card-body">
     <?php
     echo "Connessione effettuata: $dbbase - $libri";
		 echo ' - <form action="" class="modulo-ricerca"  >';
		 echo 'titolo <input type="text" name="isbdm"><br />';
		 echo 'editore <input type="text" name="editore"><br />';
     echo 'anno <input type="text" name="anno"><br />';
		 echo 'id# <input type="text" name="id"><br />';
	   echo 'serie <input type="text" name="serie" value="'.$row['collezione'].'"><br />';
		 echo '<input type="submit" name="invio"> </form> ';
		 echo '<td>';
		 echo '<a href="https://opac.sbn.it/opacsbn/opac/iccu/avanzata.jsp" title="ricerca SBN"  target="_blank">SBN</a> - ';
		 echo '<a href="https://www.anobii.com/" title="ANOBII"  target="_blank">ANOBII</a> - ';
		 echo '<a href="https://www.librarything.it/" title="LIBRARYTHING"  target="_blank">LIBRARYTHING</a> - ';
     echo '<a href="?elenco=id DESC" title="elenco completo: tutti gli anni">ultimi</a>';
         $sql_annate = "SELECT DISTINCT anno FROM libri2 ORDER BY anno DESC";
         $result_annate = mysqli_query($conn, $sql_annate);
     echo ' - ';
         while ($row_annate = mysqli_fetch_array($result_annate)) {
     echo '<a href="?anno='.$row_annate['anno'].'">'.$row_annate['anno'].'</a> -';}
     echo ' - <a href="libri_copy.php?id=0">[insert]</a>';
		 echo ' - <a href="libri_search.html">[search]</a>';
     echo ' - <a href="https://ucp.altervista.org/libri">[biblioteca]</a>';
		 echo ' - <a href="https://ucp.altervista.org/pim/home.php">[pim]</a>';
		 echo ' - <a href="https://ucp.altervista.org/">[ucp]</a>';
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