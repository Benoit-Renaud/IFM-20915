<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<?php
		$monTxt = isset($_POST["monTxt"]) ? $_POST["monTxt"] : "";
		$fontSize = isset($_POST["fontSize"]) ? $_POST["fontSize"] : "16";
		$isBold = isset($_POST["cbBold"]) ? "bold" : "normal";
		$isIta = isset($_POST["cbIta"]) ? "italic" : "normal";
		$isUnder = isset($_POST["cbUnder"]) ? "underline" : "none";
		$couleur = isset($_POST["couleur"]) ? $_POST["couleur"] : "black";
		
		if (isset($_POST["btnMontrez"]))
		{
			echo "Texte: $monTxt<br/>Taille: $fontSize<br/>Gras: $isBold<br/>Italique: $isIta<br/>Souligné: $isUnder<br/>Couleur: $couleur<br/>";
		}
		elseif (isset($_POST["btnInterpretez"]))
		{
			echo "<p style='color:$couleur;font-weight:{$isBold};font-style:{$isIta};text-decoration:{$isUnder};font-size:{$fontSize}px;'>
				$monTxt
			</p>";
		}
	?>
</body>
</html>