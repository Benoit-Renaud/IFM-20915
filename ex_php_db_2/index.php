<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Page D'accueil</title>
</head>
<body>
	<h2>Tableau d'étudiants</h2>
	<?php
		//Veuillez noter qu'aucune validation php ne sera effectuée dans cet exemple

		//Inclue notre fichier de "database.php", qui contient la création de l'objet "$conn"
		include_once("database.php");
		
		//Verifie si il y a une une erreur dans l'ouverture de la connexion
		if ($conn->connect_error)
		{
			//Puisque la connexion échoue, nous afficherons un message d'erreur au lieu d'exécuter des requêtes SQL.
			echo "La connexion a échoué: " . $conn->connect_error;
		}
		else
		{
			//Si il y a une valeur dans $_POST["btnAdd"]
			//(puisque btnAdd est un input du type submit, cela signifie que l'utilisateur l'a appuyé)
			if (isset($_POST["btnAdd"]))
			{
				//Lit tout les variable passé en POST
				$nom = isset($_POST["txtNom"]) ? $_POST["txtNom"] : "";
				//$conn->real_escape_string : pour nous protégé contre les attaque d'injection SQL
				//		Note: On devrait techniquement l'appeler pour les notes, puisqu'on ne fait pas de validation
				//htmlspecialchars : pour nous protégé contre les attaque d'inject HTML
				$nom = $conn->real_escape_string(htmlspecialchars($nom));
				$note_proj_1 = isset($_POST["txtProj1"]) ? $_POST["txtProj1"] : 0;
				$note_proj_2 = isset($_POST["txtProj2"]) ? $_POST["txtProj2"] : 0;
				$note_exam_1 = isset($_POST["txtExam1"]) ? $_POST["txtExam1"] : 0;
				$note_exam_2 = isset($_POST["txtExam2"]) ? $_POST["txtExam2"] : 0;
				
				//Commande SQL pour inserer un nouvel étudiant dans notre base de donnée
				$sql = "INSERT INTO etudiant (nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2) VALUES ('$nom', $note_proj_1, $note_proj_2, $note_exam_1, $note_exam_2)";
				
				//Exécute la requête sur la base de données
				if ($conn->query($sql) === TRUE)
				{
					echo "Nouvel enregistrement créé avec succès";
				}
				else
				{
					echo "Erreur: " . $sql . "<br />" . $conn->error;
				}
			}
			
			//Indépendamment que nous ayons ou non appuyé sur btnAdd, nous voulons afficher la liste de nos étudiants
			
			$sql = "SELECT id, nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2 FROM etudiant";
			//Exécute la commande sql et met le résultat dans la variable $result
			$result = $conn->query($sql);
			//Si le résultat avait au moins une rangée
			if ($result->num_rows > 0) 
			{
				//Affiche le header de notre tableau
				echo "<table border=1><tr><th>Nom</th><th>Projet 1</th><th>Projet 2</th><th>Exam 1</th><th>Exam 2</th><th></th><tr/>";
				
				//Récupère une rangée de résultat sous forme de tableau associatif
				//La rangée est stocké dans la variable $row
				//Une fois que nous avons passé au-travers chaque rangée, fetch_assoc vas retourner "null"
				//[if (null)] est l'équivalent de [if (false)] et donc nous allons sortir de la loop while
				while($row = $result->fetch_assoc())
				{
					//Affiche les valeur contenu dans la variable $row
					echo "<tr><td>" . 
						$row["nom"] . "</td><td>" . 
						$row["note_proj_1"] . "</td><td>" . 
						$row["note_proj_2"] . "</td><td>" . 
						$row["note_exam_1"] . "</td><td>" . 
						$row["note_exam_2"] . "</td><td><a href='edit.php?id=" . 
						$row["id"] . "'>edit</a></td></tr>";
				}
				
				//Affiche la fin de notre tableau
				echo "</table>";
			} 
			else 
			{
				//Affiche que nous avons aucun résultat
				echo "aucun résultat";
			}
		}
		//Ferme la connexion (Se fait automatiquement à la fin du script)
		$conn->close(); 

	?>
	
	<h2>Formulair d'ajout</h2>
	<form method="post">
		Nom: <input type="text" name="txtNom" /><br />
		Projet 1: <input type="number" name="txtProj1" min="0" max="100" /><br />
		Projet 2: <input type="number" name="txtProj2" min="0" max="100" /><br />
		Examen 1: <input type="number" name="txtExam1" min="0" max="100" /><br />
		Examen 2: <input type="number" name="txtExam2" min="0" max="100" /><br />
		<input type="submit" name="btnAdd" value="Add" />
	</form>
</body>
</html>