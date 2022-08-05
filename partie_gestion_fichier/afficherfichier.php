<?php
$host="localhost";
$data="signature";
$user="root";
$pass="";
$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");

			  $requete=$db->prepare('Select * from upload');
			  $requete->execute();
              $i=1;
				  while($reponse=$requete->fetch()){ 
				   			  
					  echo $reponse['nom_pdf'];
                  }

?>