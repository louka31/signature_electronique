<?php
$x=$_GET['id'];
header('Content-type: application/pdf');
readfile('C:\Users\Malek Moussa\Desktop\draw\Flask-Cnn-Recognition-App-master\ '.$x);
?>