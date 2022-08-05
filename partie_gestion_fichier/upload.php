<!DOCTYPE html>
<html lang="en">
<?php
                session_start();
                
                    $id = $_SESSION['id'];
                    $nom = $_SESSION['nom'];
                    $prenom = $_SESSION['prenom'];
                    $idsecteur = $_SESSION['idsecteur'];
               


            ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="style.css">
    <style>
      input[type=submit] {
        display: inline;
        background-color: #fbd6d2;
        border-radius: 10px;
        border: 2px double #cccccc;
        color: #f1786a;
        text-align: center;
        font-size: 23px;
        padding: 20px;
        width: 150px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
      }
      input[type=submit] span {
        cursor: pointer;
        display: inline-block;
        position: centers;
        transition: 0.5s;
      }
      input[type=submit] span:after {
        content: "\00bb";
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
      }
      input[type=submit]:hover {
        background-color: #db7267;
      }
      input[type=submit]:hover span {
        padding-right: 25px;
      }
      input[type=submit]:hover span:after {
        opacity: 1;
        right: 0;
      }
    
    </style>
</head>
<body>
<br>

            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Upload PDF</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                
                                <input name="userfile" type="file" id="userfile" />
                            </div>
                           
                            <div class="form-group form-button">
                            <input type="submit" name="upload" id="upload" class="form-submit" value="Upload" />

                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/p.PNG" alt="sing up image"></figure>
                       
                    </div>
                </div>
            </div>


    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js1/main.js"></script>
</body>
</html>
<?php
$mdp= implode(array_rand(range(1, 9), 2));
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
#$pname = rand(1000,10000)."-".$_FILES["userfile"]["name"];
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

    $fileName = addslashes($fileName);
    $file1=explode(".",$fileName);
    $ext=$file1[1];
	$allowed=array("pdf");
	if(in_array($ext,$allowed))
	{
#upload directory path
$host="localhost";
$data="signature";
   $user="root";
      $pass="";
   $dbb = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
$req=$dbb->prepare('Select path from repertoire where id=1');
			  $req->execute();
           $p=$req->fetch();
           $n=quotemeta($p['path']);
$h=quotemeta("\ ");
$uploads_dir =$n.$h;

#TO move the uploaded file to specific location
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploads_dir.$_FILES['userfile']['name']);

include 'opendb.php';
$fileName1 = $_FILES['userfile']['name'];
$formated_DATETIME = date('Y-m-d H:i:s');

$query = "INSERT INTO upload (nom_pdf, size ,idutil,date) "."VALUES ('$fileName1', '$fileSize','$id','$formated_DATETIME')";

$exec_requete = mysqli_query($db,$query);


echo "<script>alert(\"fichier importé !\")</script>";
header("Location: pages/principale.php");


}
else{

  echo "<script>alert(\"Importation des fichiers pdf uniquement !\")</script>";
}
}
?>