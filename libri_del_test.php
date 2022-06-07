<?php // 17-01-202 crud_delete.php
    include_once 'connection.php';
 
    $sql = "DELETE FROM libri2 WHERE id='" . $_GET["id"] . "'";
   /*
    if (mysqli_query($conn, $sql)) {
 
        echo "Record deleted successfully";
 
    } else {
     
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    */
?>
<html>
<head>
<script>
    function myFunction() {
        var x;
        var r = confirm("Conferma Elimina la scheda ?");
        if (r == true) {
           <?php mysqli_query($conn, $sql);?>
            x = Scheda eliminata !";
        }
        else {
            x = "Scheda non eliminata!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>
</head>
<body>
<?php
?>
<button onclick="myFunction()">Eliminazione scheda</button>
<p id="demo"></p>
</body>

</html>
