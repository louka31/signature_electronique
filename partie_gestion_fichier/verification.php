<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'signature';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username == "superadmin" && $password == "superadmin")
      {  
         $_SESSION['nom'] = $username;
         $_SESSION['prenom'] = $password;
         
         header('Location: pages/superadmin.php');}
   else{
        $requete = "SELECT count(*) FROM utilisateur where email = '".$username."' and mot_de_passe = '". MD5($password) ."' and compte=1 ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);

        $host="localhost";
      $data="signature";
         $user="root";
            $pass="";
         $dbb = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");

			  $req=$dbb->prepare('Select * from utilisateur where email=:r and mot_de_passe=:t');
			  $req->execute(array('r'=> $username ,'t'=> MD5($password) ));
           $rep=$req->fetch();



        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['id'] = $rep['id'];
           $_SESSION['nom'] = $rep['nom'];
           $_SESSION['prenom'] = $rep['prenom'];
           $_SESSION['idsecteur'] = $rep['idstructure'];

           
           header('Location: pages/dashboard.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }

}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>