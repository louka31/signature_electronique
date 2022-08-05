
<!DOCTYPE html>
<html>
	<?php
                session_start();
                
                    $id = $_SESSION['id'];
                    $nom = $_SESSION['nom'];
                    $prenom = $_SESSION['prenom'];
                    $idsecteur = $_SESSION['idsecteur'];
               


            ?>
<head>
	<title>Multiselect Tutorial</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css">
    <style type="text/css">
    	.multiselect-container{
    		width: 500px;
    	}
    	.multiselect-item > a,.multiselect-container >li>a{
    		color: black;
    	}
    </style>
</head>
<body>
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=signature', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
<center>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h4>Partager avec :</h4>
			<form method="post" action="insert.php">
			<select class="form-control" name="category[]" id="selectoption" multiple="multiple">
			<?php
 
 $reponse = $bdd->query('SELECT * FROM structure where id');
  
 while ($donnees = $reponse->fetch())
 {
 ?>
				<option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom_structure']; ?></option>
				<?php
}
 
?>
			</select>
			<?php $y=$_GET['t'] ?>
			<input id="x" name="x" type="hidden" value="<?php echo $y; ?>">
			<input type="submit" name="submit" class="btn btn-primary">
			<a href="pages/principale.php" class="btn btn-warning">Retour</a>

		</form>
		<figure><img src="images/partage.jpg" alt="sing up image"></figure>

		</div>
</center>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	$('#selectoption').multiselect({
		includeSelectAllOption:true,
		nonSelectedText:'Select Option',
		enableFiltering:true,
		buttonWidth:'500px'
	});

</script>

</body>
</html>
