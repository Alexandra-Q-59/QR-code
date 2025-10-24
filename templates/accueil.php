<?php
$id_user = $_SESSION["idUser"];
$liste = lister_image_cree($id_user);
if ($liste){
    foreach($liste as $list){
        echo $list['titre'] . "<BR>";
    }
}


?> 
<a href='index.php?view=generer.php'  style='text-decoration: none; color: inherit;'>GENERER UN NOUVEAU QR CODE</a>
