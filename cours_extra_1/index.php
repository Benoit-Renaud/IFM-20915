<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
	<style>
		/* style pour class="erreur" */
		.erreur
		{
			color:red;
		}
		
		/* style pour les tag "label" */
		label
		{
			color:blue;
		}
		/* style pour les tag "label" qui se font survoler par la souris */
		label:hover
		{
			color:red;
		}
		
		/* style pour l'élément avec l'id "MonId" */
		#MonId
		{
			color:green;
		}
	</style>
</head>
<body>
	<?php
		function GetVarOrDefault($nomDeLaVariable, $valeurParDefaut)
		{
			//Prend la valeur GET de $nomDeLaVariable
			//ou $valeurParDefaut si la valeur est null ou vide
			$var = isset($_GET[$nomDeLaVariable]) ? $_GET[$nomDeLaVariable] : $valeurParDefaut;
			$var = empty($var) ? $valeurParDefaut : $var;
			return $var;
			
		/*
			isset($_GET[$nomDeLaVariable]) ? $_GET[$nomDeLaVariable] : $valeurParDefaut;
			Equivalent de: 
			if (isset($_GET[$nomDeLaVariable]))
			{
				$var = isset($_GET[$nomDeLaVariable]);
			}
			else
			{
				$var = $valeurParDefaut;
			}
		*/
		}
		
		$erreurNom = "";
		$erreurLettre = "";
		
		if(isset($_GET["btnOK"]))
		{
			$nom = GetVarOrDefault("txtNom", 0);
			$vip = GetVarOrDefault("chbVIP", false);
			$lettre = GetVarOrDefault("rbLettre", "a");
			
			$aDesErreur = true;
			
			if (filter_var($nom, FILTER_VALIDATE_INT) !== false)
			{
				echo "CEST UN INT";
			}
			
			
			if ($nom == "")
			{
				$erreurNom = "ERREUR! LE NOM EST OBLIGATOIR";
				$aDesErreur = true;
			}
			
			if ($lettre != "a" && $lettre != "b" && $lettre != "c")
			{
				$erreurLettre = "ERREUR! LA LETTRE N'EST PAS VALIDE";
				$aDesErreur = true;
			}
			
			if ($aDesErreur == false)
			{
				//Connecter a la base de données
				$servername = "localhost";
				$username = "root";
				$password = "";
				$db = "notre_base_de_donne";
				
				$conn = new mysqli($servername, $username, $password, $db);
				
				//Verifie si il y a une une erreur dans l'ouverture de la connexion
				if ($conn->connect_error)
				{
					echo"La connexion a échoué: " . $conn->connect_error;
				} 
				else
				{
					//Si la connection a réussi
					//Inseret la rangé
					$sql = "INSERT INTO MaTable (Nom, estVIP, Lettre) VALUES ('$nom', $vip, '$lettre');";
					if ($conn->query($sql) === TRUE)
					{
						echo "youpi!";
					}
					else
					{
						echo "un erreur c'est produite: " .  $conn->error;
					}
				}
					
				//Ferme la connexion (Se fait automatiquement à la fin du script)
				$conn->close();
			}
			
			/*
			echo "Nom: $nom <span class='erreur'>$erreurNom</span><br />";
			echo "Est VIP: $vip <br />";
			echo "Notre Lettre: $lettre <span class='erreur'>$erreurLettre</span><br />";
			*/
		}
	?>
	<form method="get" action="index.php">
		Noms: <input type="text" name="txtNom" /><span class="erreur">* <?php echo $erreurNom; ?></span><br />
		<input type="checkbox" name="chbVIP" value="estVIP" /> est VIP <br />
		<input id="rbA" type="radio" name="rbLettre" value="a" /> <label id="MonId" for="rbA">A</label> <br />
		<input id="rbB" type="radio" name="rbLettre" value="b" /> <label for="rbB">B</label>  <br />
		<input id="rbC" type="radio" name="rbLettre" value="c" /> <label for="rbC">C</label>  <br />
		
		<!--
			name = nom de la variable
			value = texte qui vas apparaitre dans le bouton ET la valeur qui sera envoyé
		-->
		<input type="submit" name="btnOK" value="OK" /> 
		
		<!-- 
			Si tu veux avoir un image dans le bouton
		<button type="submit">
			<img src="img.jpg" alt="sourire" style="width:50px;" />
		</button>
		-->
	</form>
</body>
</html>