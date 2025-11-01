<?php 
$liste = lister_image_cree($_SESSION["idUser"]) ?: [];

echo "<div style='
    display: flex; 
    flex-wrap: wrap; 
    gap: 20px; 
    justify-content: center; 
    padding: 20px;
    background: #f9fafb;
'>";

foreach($liste as $im) {
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
    $id = $im["id"];

    $phrase = "placement.php?"
        . "titre=" . urlencode($titre ?? "")
        . "&logo=" . urlencode($logo)
        . "&URL_image=" . urlencode($URL_image)
        . "&hauteur=310"
        . "&largeur=500"
        . "&couleur=" . urlencode($couleur)
        . "&police=" . urlencode($police)
        . "&pos_titre=" . urlencode($pos_titre)
        . "&id=" . urlencode($id)
        . "&largeur_qr=" . urlencode($largeur_qr)
        . "&pos_qr=" . urlencode($pos_qr);

    echo "
    <div style='
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 320px;
        transition: transform 0.2s ease;
    ' 
    onmouseover=\"this.style.transform='scale(1.03)'\" 
    onmouseout=\"this.style.transform='scale(1)'\">
        <iframe 
            src='$phrase' 
            name='zone_contenu' 
            width='100%' 
            height='200' 
            style='border: none; border-bottom: 1px solid #eee;'>
        </iframe>
        <div style='padding: 10px 15px; text-align: center;'>
            <h3 style='font-size: 16px; color: #333; margin: 8px 0;'>$titre</h3>
            "?>
            <form action="controleur.php">
                <?php 
            echo "<a href='index.php?view=QR_placement&titre=$titre&logo=$logo&URL_image=$URL_image&hauteur=$hauteur&largeur=$largeur&pos_qr=$pos_qr&pos_titre=$pos_titre&couleur=" . urlencode($couleur) . "&police=$police&id=$id&largeur_qr=$largeur_qr' 
                style='
                    display: inline-block;
                    margin-top: 8px;
                    padding: 6px 12px;
                    border-radius: 8px;
                    background: rgb(85, 141, 12);
                    color: white;
                    text-decoration: none;
                    font-size: 13px;
                '>
                Modifier
            </a>";

            mkInput("hidden", "id", $id);
            ?>
            
            <input type="submit" name="action" value="Supprimer"style='
                    display: inline-block;
                    margin-top: 8px;
                    padding: 6px 12px;
                    border-radius: 8px;
                    background: rgb(85, 141, 12);
                    color: white;
                    text-decoration: none;
                    font-size: 13px;
                    width: auto;
                '>
            </form>
            
        </div>
    </div>
<?php
}

echo "</div>";
?>
