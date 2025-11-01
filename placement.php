<?php
require_once("libs/maLibUtils.php");
require_once("libs/qr_2i.php");
$texte = valider("titre");
$id = valider("id");
$url_image = valider("URL_image");
$logo_name = valider("logo");
$hauteur = valider("hauteur");
$largeur = valider("largeur");
$largeur_qr = valider("largeur_qr");
$pos_qr = valider("pos_qr");
$color = valider("couleur");
$pos_texte = valider("pos_titre");
$taille_police = valider("police");
if (!isset($_GET["debug"]))
	header("Content-type: image/jpeg");




$image = imagecreatefromjpeg("ressources/$url_image");
$image = imagescale($image, $largeur, $hauteur);


if ($logo_name !== "Aucun_logo.png") {
    $logo = imagecreatefrompng("ressources/$logo_name");
    $logoWidth = imagesx($logo);
    $logoHeight = imagesy($logo);
    $logoMaxWidth = $largeur * 0.4;
    $logoMaxHeight = $hauteur * 0.4;
$scaleX = $logoMaxWidth / $logoWidth;
$scaleY = $logoMaxHeight / $logoHeight;
$scale = min($scaleX, $scaleY, 1); // ne jamais dépasser 1
$newLogoWidth = intval($logoWidth * $scale);
$newLogoHeight = intval($logoHeight * $scale);



 imagecopyresampled($image, $logo, 10, 10, 0, 0, $newLogoWidth, $newLogoHeight, $logoWidth, $logoHeight);
}


$versionNumber = 7; 
$errorCorrectLevel = QR_ERROR_CORRECT_LEVEL_H; 
$phrase = "http://localhost/QR-code/index.php?view=descriptif&id=" . $id;
$data = $phrase;
$maskPattern = QR_MASK_PATTERN000;

$moduleCount = $versionNumber * 4 + 17;
$modules = create_matrix($moduleCount);

setupFinderPattern($modules,0, 0);
setupFinderPattern($modules,$moduleCount - 7, 0);
setupFinderPattern($modules,0, $moduleCount - 7);

setupAlignmentPatterns($modules, $versionNumber);
setupTimingPatterns($modules);
setupFormatPatterns($modules, $errorCorrectLevel, $maskPattern);
setupVersionPatterns($modules,$versionNumber);

$dataQR = createData($versionNumber, $errorCorrectLevel, $data); 
mapData($modules, $dataQR, $maskPattern);

$qrSize = $largeur_qr; 
$qrImage = imagecreatetruecolor($qrSize, $qrSize);
$white = imagecolorallocate($qrImage, 255,255,255);
$black = imagecolorallocate($qrImage, 0,0,0);
imagefill($qrImage, 0,0, $white);


$modulePixel = $qrSize / $moduleCount;
for ($y=0; $y<$moduleCount; $y++){
    for ($x=0; $x<$moduleCount; $x++){
        if ($modules[$y][$x] === 1) {
            imagefilledrectangle($qrImage, intval($x*$modulePixel), intval($y*$modulePixel), intval(($x+1)*$modulePixel-1), intval(($y+1)*$modulePixel-1), $black);
        }
    }
}


switch($pos_qr){
    case 1: $qrX=10; $qrY=10; break;
    case 2: $qrX=$largeur-$qrSize-10; $qrY=10; break;
    case 3: $qrX=10; $qrY=$hauteur-$qrSize-10; break;
    case 4: $qrX=$largeur-$qrSize-10; $qrY=$hauteur-$qrSize-10; break;
}


imagecopy($image, $qrImage, $qrX, $qrY, 0,0, $qrSize, $qrSize);


list($r,$g,$b) = sscanf($color, "#%02x%02x%02x");
$textColor = imagecolorallocate($image, $r,$g,$b);


switch($pos_texte){
    case 1: $textX=50; $textY=50; break;
    case 2: $textX=$largeur/2; $textY=$hauteur/2; break;
    case 3: $textX=50; $textY=$hauteur-50; break;
}


$fontFile = "ressources/ARIAL.TTF"; 
imagettftext($image, $taille_police, 0, $textX, $textY, $textColor, $fontFile, $texte);

	imagejpeg($image);
    //imagedestroy($im);
    imagedestroy($image);

    //imagedestroy($image);
imagedestroy($qrImage);
if(isset($logo)) imagedestroy($logo);
?>