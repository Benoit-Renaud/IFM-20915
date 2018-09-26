<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<?php
		if (isset($_GET["id"]) )
		{
			$id =  $_GET["id"];
		
			include_once("database.php");
			
			//Verifie si il y a une une erreur dans l'ouverture de la connexion
			if ($conn->connect_error)
			{
				echo "La connexion a échoué: " . $conn->connect_error;
			} 
			else
			{
				//Si nous avons soumis une mise a jour, la pousser dans la database
				if (isset($_POST["btnSave"]))
				{
					$nom = isset($_POST["txtNom"]) ? $_POST["txtNom"] : "";
					$nom = $conn->real_escape_string(htmlspecialchars($nom));
					$note_proj_1 = isset($_POST["txtProj1"]) ? $_POST["txtProj1"] : 0;
					$note_proj_2 = isset($_POST["txtProj2"]) ? $_POST["txtProj2"] : 0;
					$note_exam_1 = isset($_POST["txtExam1"]) ? $_POST["txtExam1"] : 0;
					$note_exam_2 = isset($_POST["txtExam2"]) ? $_POST["txtExam2"] : 0;
					
					$sql = "UPDATE etudiant SET nom='$nom', note_proj_1 = $note_proj_1, note_proj_2 = $note_proj_2, note_exam_1 = $note_exam_1, note_exam_2 = $note_exam_2  WHERE id = $id";
					
					if ($conn->query($sql) === TRUE)
					{
						echo "Mise à jour réussie";
					}
					else
					{
						echo "Erreur: " . $sql . "<br />" . $conn->error;
					}
				}
				
				
				$sql = "SELECT nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2 FROM etudiant WHERE id = $id";
				//Exécute la commande sql et met le résultat dans une variable
				$result = $conn->query($sql);
				//Si le résultat avait au moins une ligne
				if ($result->num_rows > 0) 
				{
					//Récupère une ligne de résultat sous forme de tableau associatif
					while($row = $result->fetch_assoc())
					{
		?>
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
					echo "aucun résultat";
				}
			}
			//Ferme la connexion (Se fait automatiquement à la fin du script)
			$conn->close(); 
		}
		else
		{
			echo "id invalide";
		}
	?>
</body>
</html>