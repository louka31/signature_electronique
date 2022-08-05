<?php
$host="localhost";
$data="signature";
$user="root";
$pass="";
if ( $_POST['pass'] != $_POST['pass1'] )
{
	echo 
	"<script type=\"text/javascript\">".
	"window.alert('Les deux mot de passes sont différentes');".
	"top.location = 'inscrire.php';".
	"</script>"; 
     
}else{
if (isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['cin']) && isset($_POST['pass']) && isset($_POST['pass1'])  )
{
	try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
	$requete = $db->prepare('SELECT id FROM structure WHERE nom_structure=:gouv' ) ;
    $requete->execute(array('gouv'=> $_POST["secteur"] ));
	if ($c=$requete->fetch())
	{
	$req = $db->prepare(' INSERT INTO utilisateur (cin,prenom,nom,email,mot_de_passe,compte,idstructure)
    VALUES(:genre,:prenom,:nom,:email,MD5(:mdp),:t,:id)' ) ;
		if ($req->execute(array( 
			'genre'=> $_POST['cin'], 
			'nom'=> $_POST['nom'], 
			'prenom' => $_POST['prenom'],
			'email'=> $_POST['email'], 
			'mdp' =>$_POST['pass'],
			't'=> 0,
			'id' => $c['id']
		)))
				header("Location: inscrire.php");
		else{
			echo"inscription échouee";
		}

	}else 
    {
		echo 
		"<script type=\"text/javascript\">".
		"window.alert('choisir une structure s'il te plait');".
		"top.location = 'inscrire.php';".
		"</script>"; 
    }
	
}else{

	echo"Vérifier les données saisies";
}
}
?>