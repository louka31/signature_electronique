<?php

$mdp= implode(array_rand(range(1, 9), 4));

$host="localhost";
$data="signature";
$user="root";
$pass="";
$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");


                    
$requete1 = $db->prepare('SELECT * from utilisateur where id=:y ' ) ;
$requete1->execute(array( 'y'=> $_GET['idd']));
$entree=$requete1->fetch();
$mail=$entree["email"] ;
$objet="Rénitialisation du code" ;
$msg = "Bonjour ,votre code est rénitialisé . Votre login est ".$entree["email"]." , votre nouveau code de sécurité est : " . $mdp;
$headers = "From: mallouka31079819@gmail.com";
mail($mail,$objet,$msg,$headers);
$requete2 = $db->prepare('UPDATE utilisateur set code=:t  where id= :z' ) ;
$requete2->execute(array( 'z' => $_GET['idd'] ,'t' => $mdp ));
header("Location: superadmin.php");

?>