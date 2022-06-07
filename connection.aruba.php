<?php
    // 28-01-2022 ARUBA
		$dbhost = '31.11.39.51';
    $dbuser = 'Sql1555463';
    $dbpass = 'Delphi.2021';
    $dbbase = 'Sql1555463_1';
		$libri  = 'libri2';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);

    function testInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
    }
    function anteprima($testo, $lunghezza, $finale) {
      return (count($parole = explode(' ', $testo)) > $lunghezza) ? implode(' ', array_slice($parole, 0, $lunghezza)) . $finale : $testo;
    }
    //$link = "<a href='libri_copertine.php?id=".$row['id']."' title='".$row['testi_copertine']."'> ... Leggi tutto </a>";
    function collegamento( $link, $title, $anchor){
      return "<a href='$link' title='$title'>$anchor</a>";
    }
    // 26-12-2021 menu x libri
    function menu ( $colonna, $tabella, $connessione) { 
      $sql_menu = "SELECT DISTINCT $colonna FROM $tabella ORDER BY $colonna";
      $result_menu = mysqli_query($connessione, $sql_menu);
      if ($result_menu === false) {
          exit("Errore: impossibile eseguire la query: $sql_menu " . mysqli_error($connessione));}
      echo "<hr />$colonna: "  ;
      while ($row_menu = mysqli_fetch_array($result_menu)) {
          echo '<a href="index.php?'.$colonna.'='.$row_menu[$colonna].'">'.$row_menu[$colonna].'</a>  - ';}
      mysqli_free_result($result_menu);
      }

?>         
