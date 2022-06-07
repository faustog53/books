<?php // link.php 26-12-2021
include('connection.php');
echo collegamento('index.php', 'libreria', 'libri');
?>
<hr />
<?php 
menu ( 'collezione', 'libri2', $conn);
menu ( 'editore', 'libri2', $conn);
?>