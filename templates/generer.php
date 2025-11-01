<?php
require_once("libs/qr_2i.php");

mkForm("controleur.php", "get", "form-generer");//donne l'id form-genrer
echo "<div class=cacher_form1>";//servira à cacher le form quand on clique sur suivant
echo "<h1>Générer un nouveau QR Code</h1>";

echo "<div class=groupe1>";//juste pour le css
echo "Entrez votre texte (max:100 caractères)";
//mkInput("text", "titre");
if ($titre = valider("titre")){
    mkInput("text", "titre", $titre);
}
else {
?>
<input type="text" name="titre" id="titre">
<?php
}
echo "</div>";//le input c'est pour mettre une id

echo "<div class=groupe>";
    echo "<div class=groupe1>";
        echo "<label for='url_logo'>Choisissez le logo</label>";
        echo "<select name='logo' id='url_logo'>";
            echo "<option value='ig2i.png'>IG2I</option>";
            echo "<option value='ITEEM.png'>ITEEM</option>";
            echo "<option value='ENSCL.png'>ENSCL</option>";
            echo "<option value='Centrale.png'>Centrale</option>";
            echo "<option value='Aucun_logo.png'>Aucun logo</option>";
        echo "</select>";
    echo "</div>";

    echo "<div class=groupe1>";
        echo "Entrez l'URL de l'image";
        if ($url_im = valider("URL_image")){
        mkInput("text", "URL_image", $url_im, false, "url_image");
        }
        else mkInput("text", "URL_image", "", false, "url_image");//finalement j'ai modif la fonction mkInput pour pouvoir mettre un id
    echo "</div>";

echo "</div>";

echo "<div class=groupe>";
    echo "<div class=groupe1>";
        echo "Entrez la hauteur de l'image désirée (minimum : 300)";
        if ($hauteur = valider("hauteur")){
        mkInput("number", "hauteur", $hauteur, false, "hauteur");
        }
        else mkInput("number", "hauteur", "", false, "hauteur");
    echo "</div>";

    echo "<div class=groupe1>";
        echo "Entrez la largeur de l'image désirée (mimum : 500)";
        if ($largeur = valider("largeur")){
        mkInput("number", "largeur", $largeur, false, "largeur");
        }
        else mkInput("number", "largeur", "", false, "largeur");
    echo "</div>";
echo "</div>";

echo "<div class=groupe1>";
    echo "Entrez la description du QR code (max:100 caractères)";
    if ($data = valider("data")){
        mkInput("text", "data", $data);
    }
    else mkInput("text", "data");
echo "</div>";

mkInput("hidden", "pos_qr", "1");
mkInput("hidden", "pos_titre", "1");
mkInput("submit", "action", "Suivant");

endForm()//fin du form
?>