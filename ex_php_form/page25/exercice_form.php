<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<?php
		$monTxt = isset($_GET["monTxt"]) ? $_GET["monTxt"] : "";
		$fontSize = isset($_GET["fontSize"]) ? $_GET["fontSize"] : "16";
		$isBold = isset($_GET["cbBold"]) ? "bold" : "normal";
		$isIta = isset($_GET["cbIta"]) ? "italic" : "normal";
		$isUnder = isset($_GET["cbUnder"]) ? "underline" : "none";
		$couleur = isset($_GET["couleur"]) ? $_GET["couleur"] : "red";
		
		//Validation
		if ($couleur != "red" && $couleur != "green" && $couleur != "blue")
		{
			$couleur = "red";
		}
		
		if (filter_var($fontSize, FILTER_VALIDATE_INT))
		{
			$fontSize = min(22, max(10, $fontSize));
		}
		else
		{
			$fontSize = 16;
		}
		
		$monTxt = htmlspecialchars($monTxt);

		
	?>
	
	<form action="exercice_form.php" method="get">
		<h1>Formulaire</h1>
		<h4>Texte</h4>
		<textarea name="monTxt"><?php echo $monTxt;?></textarea>
		<h4>Taille</h4>
		<input type="number" name="fontSize" min="10" max="22" value="<?php echo $fontSize;?>" />
		<h4>Style(s)</h4>
		<input type="checkbox" name="cbBold" id="cbBold" value="bold" <?php echo $isBold ? "checked" : "" ?> /><label for="cbBold">Gras</label><br/>
		<input type="checkbox" name="cbIta" id="cbIta" value="italic" <?php echo $isIta ? "checked" : "" ?> /><label for="cbIta">Italique</label><br/>
		<input type="checkbox" name="cbUnder" id="cbUnder" value="underlined" <?php echo $isUnder ? "checked" : "" ?> /><label for="cbUnder">Souligné</label>
		<h4>Couleur</h4>
		<input type="radio" name="couleur" id="rbRed" value="red" <?php echo $couleur == "red" ? "checked" : "" ?> /><label for="rbRed">Rouge</label><br/>
		<input type="radio" name="couleur" id="rbGreen" value="green" <?php echo $couleur == "green" ? "checked" : "" ?> /><label for="rbGreen">Vert</label><br/>
		<input type="radio" name="couleur" id="rbBlue" value="blue" <?php echo $couleur == "blue" ? "checked" : "" ?> /><label for="rbBlue">Bleu</label><br/>
		<input type="submit" name="btnMontrez" value="Montrez les réponses du formulaire" /><br/>
		<input type="submit" name="btnInterpretez" value="Interprétez  les réponses du formulaire" />
	</form>
	
	<?php
		
		if (isset($_GET["btnMontrez"]))
		{
			echo "Texte: $monTxt<br/>Taille: $fontSize<br/>Gras: $isBold<br/>Italique: $isIta<br/>Souligné: $isUnder<br/>Couleur: $couleur<br/>";
		}
		elseif (isset($_GET["btnInterpretez"]))
		{
			echo "<p style='color:$couleur;font-weight:{$isBold};font-style:{$isIta};text-decoration:{$isUnder};font-size:{$fontSize}px;'>
				$monTxt
			</p>";
		}
	?>
</body>
</html>