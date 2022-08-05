<?php
session_start();

	$id = $_SESSION['id'];
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
	$idsecteur = $_SESSION['idsecteur'];
$con=mysqli_connect('localhost','root','','signature');

if(mysqli_connect_errno())
{
	echo 'Fail to connect '.mysqli_connect_error();
}

if(isset($_POST['submit']))
{
	//print_r($_POST['category']);

	foreach ($_POST['category'] as $key => $value) {
		$category=$_POST['category'][$key];
		$xx=$_POST['x'];
		$insertqry="INSERT INTO `partage`(`idstructure`,`idpdf`,`idstructure_part`) VALUES ('$category','$xx','$idsecteur')";
		$insertres=mysqli_query($con,$insertqry);
		$sql = "UPDATE upload SET partage=1 WHERE idd='$xx'";
		$con->query($sql) ;

	}
}
header('Location: pages/principale.php');
?>