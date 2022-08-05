<?php
$host="localhost";
$data="signature";
$user="root";
$pass="";

if (isset($_POST['sec']) )
{
	try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
	
	$req = $db->prepare(' INSERT INTO structure (nom_structure)
    VALUES(:x)' ) ;
		if ($req->execute(array( 'x'=> $_POST['sec'])))
				header("Location: superadmin.php");
		else{
			echo"Erreur";
		}

	}
	

?>