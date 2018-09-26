<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "web_ii_notes";
		//Ouvre une connexion mysql
		$conn = new mysqli($servername, $username, $password, $db);
		//Verifie si il y a une une erreur dans l'ouverture de la connexion
		if ($conn->connect_error)
		{
			echo "La connexion a échoué: " . $conn->connect_error;
		}
		else
		{
			echo "Connecté avec succès";
		}
		//Ferme la connexion (Se fait automatiquement à la fin du script)
		$conn->close(); 

	?>
</body>
</html>