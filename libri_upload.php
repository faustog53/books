<?php
  // ucp2.cloud/libri/libri_upload.php 04-01-2021
  // Initialize message variable
  $msg = "";
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$cop = $_FILES['cop']['name'];

  	// Get text
  	// $image_text = StrToUpper(mysqli_real_escape_string($db, $_POST['image_text']));
  	// image file directory
   $id     = $_POST['id'];
	$path = $_SERVER['SCRIPT_FILENAME'];
  	$cop = "/web/htdocs/www.ucp2.eu/home/libri/copertine/$id.jpg";
	// $cop = 'C:/xampp/htdocs/ucp/libri/copertine/'.$id.'.jpg';
	$sql = "UPDATE libri2 SET copertina='copertine/$id.jpg' WHERE id ='$id'";
	include('connection.php');
  	// execute query
  	if (!mysqli_query($conn, $sql)){
		printf($sql, mysqli_error($conn));
	}
  	if (move_uploaded_file($_FILES['cop']['tmp_name'], $cop)) {
		header('location:index.php?id='.$id);
  	}else{
  		echo "Failed to upload copertina";		
  	}
  }
?>
<!DOCTYPE html> 
<html>
<head>
<title>Copertina Upload</title>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
<div id="content">
<?php 
  $id     = $_GET['id'];
  $anno   = $_GET['anno'];
  $titolo = $_GET['titolo'];
  ?>
  <div align="center">
	<h1><?php echo $titolo; ?> [#<?php echo $id;?>]</h1>
	
	<a href="https://ucp2.eug/libri/index.php?anno=<?php echo $anno; ?>"> ritorna a <?php echo $anno; ?></a>
	</div>
    <form method="POST" action="" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
	<input type="hidden" name="id" value="<?php echo $id;?>"> 
    #<?php echo $id;?> - <?php echo $titolo;?> -  <?php echo $anno;?>
	
  	<div>copertina:
  	  <input type="file" name="cop">
  	</div>
	<div>frontespizio:
  	  <input type="file" name="front">
  	</div>
  	<div>
  		<button type="submit" name="upload">carica</button>
  	</div>
  </form>
</div>
</body>
</html>