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
		$couleur = isset($_GET["couleur"]) ? $_GET["couleur"] : "black";
		
		if (isset($_GET["btnMontrez"]))
		{
			echo "Texte: $monTxt<br/>Taille: $fontSize<br/>Gras: $isBold<br/>Italique: $isIta<br/>Souligné: $isUnder<br/>Couleur: $couleur<br/>";
		}
		elseif (isset($_GET["btnInterpretez"]))
		{
			$isBold = isset($_GET["cbBold"]) ? " bold;" : "";
			$isIta = isset($_GET["cbIta"]) ? "italic;" : "";
			$isUnder = isset($_GET["cbUnder"]) ? ": underline;" : "";
		
			echo "<p style='color:$couleur;font-weight:{$isBold};font-style:{$isIta};text-decoration{$isUnder};font-size:{$fontSize}px;'>
				$monTxt
			</p>";
		}
	?>
</body>
</html>