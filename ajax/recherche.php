<?php
	include_once("database.php");
	
	//Verifie si il y a une une erreur dans l'ouverture de la connexion
	if ($conn->connect_error)
	{
		echo "La connexion a échoué: " . $conn->connect_error;
	}
	else
	{
		$nom = isset($_GET["nom"]) ? $_GET["nom"] : "";
		$nom = $conn->real_escape_string(htmlspecialchars($nom));
		
		$sql = "SELECT * FROM etudiant WHERE nom like '%$nom%'";
		//Exécute la commande sql et met le résultat dans une variable
		$result = $conn->query($sql);
		//Si le résultat avait au moins une ligne
		if ($result->num_rows > 0) 
		{
			echo "<table border=1><tr><th>Nom</th><th>Projet 1</th><th>Projet 2</th><th>Exam 1</th><th>Exam 2</th><tr/>";
		
			//Récupère une ligne de résultat sous forme de tableau associatif
			while($row = $result->fetch_assoc())
			{
				echo "<tr><td>" . 
					$row["nom"] . "</td><td>" . 
					$row["note_proj_1"] . "</td><td>" . 
					$row["note_proj_2"] . "</td><td>" . 
					$row["note_exam_1"] . "</td><td>" . 
					$row["note_exam_2"] . "</td></tr>";
			}
			
			echo "</table>";
		} 
		else 
		{
			echo "aucun résultat";
		}
	}
	//Ferme la connexion (Se fait automatiquement à la fin du script)
	$conn->close();
?>