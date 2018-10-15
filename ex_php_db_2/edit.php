<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Page de Mise a Jour</title>
</head>
<body>
	<?php
		//Veuillez noter qu'aucune validation php ne sera effectuée dans cet exemple
		
		//Puisque nous voulons mettre à jour un étudiant, nous lui avons transmis son identifiant via l'URL (exemple: edit.php?id=3)
		//Nous pouvons maintenant récupérer l'identifiant avec $ _GET["id"]
		if (isset($_GET["id"]) )
		{
			//Met $_GET["id"] dans la variable $id pour simplifier son utilisation future
			$id =  $_GET["id"];
		
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
				//Si nous avons soumis une mise a jour, la pousser dans la base de donnée
				if (isset($_POST["btnSave"]))
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
					
					//Commande SQL pour mettre a jour l'étudiant dans notre base de donnée
					$sql = "UPDATE etudiant SET nom='$nom', note_proj_1 = $note_proj_1, note_proj_2 = $note_proj_2, note_exam_1 = $note_exam_1, note_exam_2 = $note_exam_2  WHERE id = $id";
					
					//Exécute la requête sur la base de données
					if ($conn->query($sql) === TRUE)
					{
						echo "Mise à jour réussie";
					}
					else
					{
						echo "Erreur: " . $sql . "<br />" . $conn->error;
					}
				}
				
				//Indépendamment que nous ayons ou non appuyé sur btnAdd, nous voulons afficher l'étudiants choisi
				
				$sql = "SELECT nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2 FROM etudiant WHERE id = $id";
				//Exécute la commande sql et met le résultat dans une variable
				$result = $conn->query($sql);
				//Si le résultat avait au moins une ligne
				if ($result->num_rows > 0) 
				{
					//Récupère une rangée de résultat sous forme de tableau associatif
					//La rangée est stocké dans la variable $row
					//Une fois que nous avons passé au-travers chaque rangée, fetch_assoc vas retourner "null"
					//[if (null)] est l'équivalent de [if (false)] et donc nous allons sortir de la loop while
					
					//NOTE: théoriquement, $result devrait contenir une seule ligne, donc le code suivant sera exécuté une seul fois
					while($row = $result->fetch_assoc())
					{
						//Affiche les valeur contenu dans la variable $row dans un formulaires
		?>
						<h2>Formulair de mise à jour</h2>
						<form method="post">
							Nom: <input type="text" name="txtNom" value="<?php echo $row["nom"]; ?>" /><br />
							Projet 1: <input type="number" name="txtProj1" min="0" max="100" value="<?php echo $row["note_proj_1"]; ?>" /><br />
							Projet 2: <input type="number" name="txtProj2" min="0" max="100" value="<?php echo $row["note_proj_2"]; ?>" /><br />
							Exam 1: <input type="number" name="txtExam1" min="0" max="100" value="<?php echo $row["note_exam_1"]; ?>" /><br />
							Exam 2: <input type="number" name="txtExam2" min="0" max="100" value="<?php echo $row["note_exam_2"]; ?>" /><br />
							<input type="submit" name="btnSave" value="save" />
						</form>
		<?php
					}
				} 
				else 
				{
					//Affiche que nous avons aucun résultat
					echo "aucun résultat";
				}
			}
			//Ferme la connexion (Se fait automatiquement à la fin du script)
			$conn->close(); 
		}
		else
		{
			//Si id était null, l'utilisateur a probablement essayé d'accéder à cette page pour des raisons néfastes
			echo "id invalide";
		}
	?>
</body>
</html>