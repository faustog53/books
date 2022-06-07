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
$msg = '';
include('connection.php');

         if(! $conn){
            die('Could not connect: ' . mysqli_error());}
			
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
			$sql="SELECT * FROM $libri ORDER BY $elenco";
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
// 2020-12-27
// 2020-12-24
while ($row = mysqli_fetch_array($result)) {
	if ($row['url']>' '){$url = $row['url'];}else {$url = '';}
    echo '<table width="800"><tr><td>'
		.'<a href="'.$row['copertina'].'"><img src="'.$row['copertina'].'" height="300">'.'</a></td><td>'
    .'<a href="?id='.$row['id'].'"><b>[ # '.$row['id'].'] </b></a><br />'
		.testInput($row['titolo_isbdm'])
    .'. - '.$row['note']
		.'<br />'
		.'<a href="?editore='.$row['editore'].'">'.$row['editore'].'</a>'
		.'<a href="?anno='.$row['anno'].'">, '.$row['anno'].'</a>'
		// .'. - '.$row['pagine'].' p. '
		// .'; '.$row['altezza'].' cm.'
		.'<a href="?serie='.$row['collezione'].'">. - ('.$row['collezione'].')</a>'
    .'<br />'
    .'[ISBN <a href="https://www.google.com/search?q='.$row['isbn'].'" target="_blank">'.$row['isbn'].'</a>]'
		.'<br />'.
	'<a href="'.$row['url'].'" target="_blank">['.$row['url'].']</a>'.
	'<a href="?gruppo='.$row['gruppo'].'">['.$row['gruppo'].']</a>'.
	'<a href="?sezione='.$row['sezione'].'">['.$row['sezione'].']</a>'.
	'<a href="https://www.google.com/search?q=copertina '.$row['TITOLO'].'" target="_blank" title="'.$row['copertina'].'">[copertina]</a>'.
	'<a href="libri_upload.php?id='.$row['id'].'&anno='.$row['anno'].'&titolo='.$row['TITOLO'].'">[jpg]</a><br />'.
  '<a href="libri_edit.php?id='.$row['id'].'" role="button">[MODIFICA]</a>'.
  '<a href="libri_copy.php?id='.$row['id'].'">[COPIA]</a>'.
	'<a href="libri_del.php?id='.$row['id'].'">[CANC]</a>'.
	'</td></tr>';
} 
		 echo '<tr><td>';
     echo "Connessione effettuata: $dbbase - $libri";
		 echo ' - <form action="" class="modulo-ricerca"  >';
		 echo 'titolo <input type="text" name="isbdm"><br />';
		 echo 'editore <input type="text" name="editore"><br />';
		 echo 'id# <input type="text" name="id"><br />';
	   echo 'serie <input type="text" name="serie" value="'.$row['collezione'].'"><br />';
		 echo '<input type="submit" name="invio"> </form> ';
		 echo '<td>';
		 echo '<a href="https://opac.sbn.it/opacsbn/opac/iccu/avanzata.jsp" title="ricerca SBN"  target="_blank">SBN</a> - ';
     echo '<a href="?elenco=id DESC" title="elenco completo: tutti gli anni">tutte le annate</a>';
         $sql_annate = "SELECT DISTINCT anno FROM libri ORDER BY anno DESC";
         $result_annate = mysqli_query($conn, $sql_annate);
     echo ' - ';
         while ($row_annate = mysqli_fetch_array($result_annate)) {
     echo '<a href="libri_anni.php?anno='.$row_annate['anno'].'">'.$row_annate['anno'].'</a> -';}
     echo ' - <a href="libri_copy.php?id=0">[insert]</a>';
		 echo ' - <a href="libri_search.html">[search]</a>';
     echo ' - <a href="https://ucp.altervista.org/libri">[biblioteca]</a>';
		 echo ' - <a href="https://ucp.altervista.org/pim/home.php">[pim]</a>';
		 echo ' - <a href="https://ucp.altervista.org/">[ucp]</a>';
     echo '</table>';
     echo '<br />';
		 mysqli_free_result($result);
     mysqli_close($conn);
		 print $sql;
         // 
      ?>
   </body>
</html>


