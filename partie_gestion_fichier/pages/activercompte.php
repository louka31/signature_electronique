<?php

$mdp= implode(array_rand(range(0, 9), 4));

$host="localhost";
$data="signature";
$user="root";
$pass="";
$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
$requete = $db->prepare('UPDATE utilisateur set compte=1  where id= :x' ) ;
$requete->execute(array( 'x' => $_GET['idd'] ));

                    
$requete1 = $db->prepare('SELECT * from utilisateur where id=:y ' ) ;
$requete1->execute(array( 'y'=> $_GET['idd']));
$entree=$requete1->fetch();
$mail=$entree["email"] ;
$objet="Validation du compte" ;
$msg = "Bonjour ,votre compte a été bien validé . Votre login est ".$entree["email"]." , votre code de sécurité est : " . $mdp;
$headers = "From: mallouka31079819@gmail.com";
mail($mail,$objet,$msg,$headers);
$requete2 = $db->prepare('UPDATE utilisateur set code=:t  where id= :z' ) ;
$requete2->execute(array( 'z' => $_GET['idd'] ,'t' => $mdp ));
header("Location: superadmin1.php");

?>