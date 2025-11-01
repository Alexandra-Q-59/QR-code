<?php $titre = $_GET['titre'] ?? '';
			$logo = valider("logo");
			$URL_image = valider("URL_image");
			$hauteur = valider("hauteur");
			$largeur = valider("largeur");
			$couleur = valider("couleur");
			$police = valider("police");
			$pos_qr = valider("pos_qr");
			$pos_titre = valider("pos_titre");
			$largeur_qr = valider("largeur_qr");
			$id = valider("id");
			$phrase = "placement.php?"
        . "titre=" . urlencode($titre)
        . "&logo=" . urlencode($logo)
        . "&URL_image=" . urlencode($URL_image)
        . "&hauteur=" . urlencode($hauteur)
        . "&largeur=" . urlencode($largeur)
        . "&couleur=" . urlencode($couleur)
        . "&police=" . urlencode($police)
        . "&pos_titre=" . urlencode($pos_titre)
		. "&id=" . urldecode($id)
		. "&largeur_qr=" . urldecode($largeur_qr)
        . "&pos_qr=" . urlencode($pos_qr);



echo "<div class=groupe>";
    echo "<div class=groupe1>";
		echo "<iframe src='$phrase' name='zone_contenu' width='$largeur' height='$hauteur'></iframe>";
	echo "</div>";
    echo "<div class=groupe1>";
	mkForm("controleur.php");
	//echo "<div class=groupe1>";
echo "Choisissez la couleur du texte :  <BR>";
mkInput("color", "color_row", "$couleur");
//	echo "</div>";

//	echo "<div class=groupe1>";
echo "<BR>Choisissez la taille de la police";
mkInput("number", "size_font", $police);
//	echo "</div>";

  //  echo "<div class=groupe1>";
echo "Choisissez la position du QR code <BR>";
echo "<label for='posi_qr'>position 1</label>";
if ($pos_qr == 1) mkInput("radio", "posi_qr", "1", "checked");
else mkInput("radio", "posi_qr", "1");
echo "<label for='posi_qr'>position 2</label>";
if ($pos_qr == 2) mkInput("radio", "posi_qr", "2", "checked");
else mkInput("radio", "posi_qr", "2");
echo "<label for='posi_qr'>position 3</label>";
if ($pos_qr == 3) mkInput("radio", "posi_qr", "3", "checked");
else mkInput("radio", "posi_qr", "3");
echo "<label for='posi_qr'>position 4</label>";
if ($pos_qr == 4) mkInput("radio", "posi_qr", "4", "checked");
else mkInput("radio", "posi_qr", "4");
	//echo "</div>";

    //echo "<div class=groupe1>";
echo "<BR>Choisissez la position du texte <BR>";
echo "<label for='posi_text'>position 1</label>";
if ($pos_titre == 1) mkInput("radio", "posi_text", "1", "checked");
else mkInput("radio", "posi_text", "1");
echo "<label for='posi_text'>position 2</label>";
if ($pos_titre == 2) mkInput("radio", "posi_text", "2", "checked");
else mkInput("radio", "posi_text", "2");
echo "<label for='posi_text'>position 3</label>";
if ($pos_titre == 3) mkInput("radio", "posi_text", "3", "checked");
else mkInput("radio", "posi_text", "3");

echo "<BR>Choisissez la taille du QR Code";
mkInput("number", "largeur_qr", $largeur_qr);
//	echo "</div>";
//	echo "<div class=groupe1>";
mkInput("hidden", "id", $id);
mkInput("submit", "action", "Appliquer les modifications");
endForm();
//	echo "</div>";
	echo "</div>";

	echo "</div>";
?>