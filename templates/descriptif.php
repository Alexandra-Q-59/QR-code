<?php
echo "<div class=groupe>";
$id = valider("id");
$data = select_data($id) ?: [];
echo "<div class=groupe1>";
foreach($data as $dat){
    echo $dat["data"];
}
	echo "</div>";


$image = recup_illu($id) ?: [];
foreach($image as $im){
    $largeur = $im["largeur_image"];
    $hauteur = $im["hauteur_image"];
    $police = $im["taille_police"];
    $couleur = $im["couleur_police"];
    $largeur_qr = $im["largeur_qr"];
    $URL_image = $im["image_url"];
    $logo = $im["logo_url"];
    $titre = $im["titre"];
    $pos_titre = $im["position_texte"];
    $pos_qr = $im["position_QR"];

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

    echo "<div class=groupe1>";
		echo "<iframe src='$phrase' name='zone_contenu' width='$largeur' height='$hauteur'></iframe>";
	echo "</div>";
	echo "</div>";

}

?>