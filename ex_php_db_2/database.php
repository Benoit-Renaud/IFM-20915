<?php
	//La connexion est stockée dans un document séparé pour simplifier les modifications futures

	//Informations nécessaires pour se connecter à la base de données
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "web_ii_notes";
	
	//Ouvre une connexion mysql
	//$conn contient notre connection, chaque interaction avec la base de données vas devoir passer par lui
	$conn = new mysqli($servername, $username, $password, $db);
?>