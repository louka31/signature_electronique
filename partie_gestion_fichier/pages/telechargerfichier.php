<?php 
$x=$_GET['id'];

		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$x");
		header("Content-Type: application/pdf");
		header("Content-Transfer-Emcoding: binary");

		readfile('C:\Users\Malek Moussa\Desktop\draw\Flask-Cnn-Recognition-App-master\ '.$x);
		exit;

	

 ?>