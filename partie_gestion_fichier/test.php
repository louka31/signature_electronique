<?php
$con=mysqli_connect('localhost','root','','signature');

$dst = $_POST['chemin'];
$ch=quotemeta($dst);
if (!is_dir($dst)) 
{
mkdir($dst, 0770, true);
$sql = "UPDATE repertoire SET path='$ch' WHERE id=1";
$con->query($sql) ;
header("Location: pages/superadmin.php");

}else{
    $sql = "UPDATE repertoire SET path='$ch' WHERE id=1";
    $con->query($sql) ;
    header("Location: pages/superadmin.php");

}
?>