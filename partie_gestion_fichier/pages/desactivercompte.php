<?php

$host="localhost";
$data="signature";
$user="root";
$pass="";
$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
$requete = $db->prepare('UPDATE utilisateur set compte=0  where id= :x' ) ;
$requete->execute(array( 'x' => $_GET['idd'] ));
header("Location: superadmin.php");
                        


?>