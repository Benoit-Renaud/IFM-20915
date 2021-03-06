<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		function POSTOrDefault($varname, $default)
		{
			$result = isset($_POST[$varname]) ? $_POST[$varname] : $default;
			if (empty($result))
			{
				$result = $default;
			}
			return $result;
		}
		
		function IsIntBetweenMinAndMax($var, $min, $max)
		{
			return (filter_var($var, FILTER_VALIDATE_INT) === 0 || 
				filter_var($var, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))));
		}
	
		$nom = "";
		$note_proj_1 = "";
		$note_proj_2 = "";
		$note_exam_1 = "";
		$note_exam_2 = "";
	
		$nom_err = "";
		$note_proj_1_err = "";
		$note_proj_2_err = "";
		$note_exam_1_err = "";
		$note_exam_2_err = "";
				
		include_once("database.php");
		//Verifie si il y a une une erreur dans l'ouverture de la connexion
		if ($conn->connect_error)
		{
			echo "<span class='error'>La connexion a échoué: " . $conn->connect_error . "</span>";
		}
		else
		{
			if (isset($_POST["btnAdd"]))
			{
				$aDesErreurs = false;
				$nom = POSTOrDefault("txtNom", "");
				$nom = $conn->real_escape_string(htmlspecialchars($nom));
				if (empty($nom))
				{
					$aDesErreurs = true;
					$nom_err = "Vous devez entrer un nom";
				}
				$note_proj_1 = POSTOrDefault("txtProj1", 0);
				if (!IsIntBetweenMinAndMax($note_proj_1, 0, 100))
				{
					$aDesErreurs = true;
					$note_proj_1_err = "Dois être un entier entre 0 et 100";
				}
				$note_proj_2 = POSTOrDefault("txtProj2", 0);
				if (!IsIntBetweenMinAndMax($note_proj_2, 0, 100))
				{
					$aDesErreurs = true;
					$note_proj_2_err = "Dois être un entier entre 0 et 100";
				}
				$note_exam_1 = POSTOrDefault("txtExam1", 0);
				if (!IsIntBetweenMinAndMax($note_exam_1, 0, 100))
				{
					$aDesErreurs = true;
					$note_exam_1_err = "Dois être un entier entre 0 et 100";
				}
				$note_exam_2 = POSTOrDefault("txtExam2", 0);
				if (!IsIntBetweenMinAndMax($note_exam_2, 0, 100))
				{
					$aDesErreurs = true;
					$note_exam_2_err = "Dois être un entier entre 0 et 100";
				}
				
				if (!$aDesErreurs)
				{
					$sql = "INSERT INTO etudiant (nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2) VALUES ('$nom', $note_proj_1, $note_proj_2, $note_exam_1, $note_exam_2)";
					//Exécute une requête sur la base de données
					if ($conn->query($sql) === TRUE)
					{
						echo "Nouvel enregistrement créé avec succès";
						$nom = "";
						$note_proj_1 = "";
						$note_proj_2 = "";
						$note_exam_1 = "";
						$note_exam_2 = "";
					}
					else
					{
						echo "<span class='error'>Erreur: " . $sql . "<br />" . $conn->error . "</span>";
					}
				}
			}
			
			
			$sql = "SELECT id, nom, note_proj_1, note_proj_2, note_exam_1, note_exam_2 FROM etudiant";
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
	<form method="post">
		Nom:<input type="text" name="txtNom" value="<?php echo $nom; ?>" /><span class="error">* <?php echo $nom_err; ?></span><br/>
		Projet 1:<input type="text" name="txtProj1" value="<?php echo $note_proj_1; ?>" /><span class="error"> <?php echo $note_proj_1_err; ?></span><br/>
		Projet 2:<input type="text" name="txtProj2" value="<?php echo $note_proj_2; ?>" /><span class="error"> <?php echo $note_proj_2_err; ?></span><br/>
		Exam 1:<input type="text" name="txtExam1" value="<?php echo $note_exam_1; ?>" /><span class="error"> <?php echo $note_exam_1_err; ?></span><br/>
		Exam 2:<input type="text" name="txtExam2" value="<?php echo $note_exam_2; ?>" /><span class="error"> <?php echo $note_exam_2_err; ?></span><br/>
		<input type="submit" name="btnAdd" value="Add" />
	</form>
</body>
</html>