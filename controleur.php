<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/modele.php"; 
	include_once "libs/maLibSecurisation.php"; 
	// cf. injection de dépendances 


	$qs = "";
	$dataQS = array(); 
	
	// voir les entetes HTTP venant du client : 
	// tprint($_SERVER);
	// die("");

	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{
			
			// Connexion //////////////////////////////////////////////////
case 'Connexion':
    // Vérifie la présence des champs nom, prenom et motdepasse
    if ($nom = valider("nom"))
    if ($prenom = valider("prenom"))
    if ($motdepasse = valider("motdepasse"))
    {
        // Vérifie l'utilisateur (fonction à adapter dans ta lib de sécurisation)
		$tab = verifUser($nom, $prenom, $motdepasse);
        if ($tab) {

            // Si on veut se souvenir de la personne
            if (valider("remember")) {
                // Génération d'un token sécurisé pour le cookie
                $token = bin2hex(random_bytes(32)); // Génère un token aléatoire
                $expiry = time() + 60 * 60 * 24 * 30; // 30 jours

                // Stockage du token en base de données (à implémenter)
                // storeRememberToken($_SESSION["idUser"], $token, $expiry);

                // Stockage dans les cookies
                setcookie("nom", $nom, $expiry, "/", "", false, true); // HttpOnly
                setcookie("prenom", $prenom, $expiry, "/", "", false, true);
                setcookie("remember_token", $token, $expiry, "/", "", false, true);
                setcookie("remember", true, $expiry, "/", "", false, false);
            } else {
                // Suppression des cookies si "se souvenir" non coché
                setcookie("nom", "", time() - 3600, "/", "", false, true);
                setcookie("prenom", "", time() - 3600, "/", "", false, true);
                setcookie("remember_token", "", time() - 3600, "/", "", false, true);
                setcookie("remember", false, time() - 3600, "/", "", false, false);

                // Suppression du token en base (si tu implémentes la table remember)
                // deleteRememberToken($_SESSION["idUser"]);
            }

            // Redirection vers la vue d'accueil
            $qs = array(
                "view" => "accueil",
                "msg"  => "Connexion réussie, bienvenue $prenom $nom !"
            );
        } else {
            // Mauvaise combinaison nom/prénom/mot de passe
            $qs = array(
                "view" => "login",
                "msg"  => "Erreur de connexion, veuillez réessayer"
            );
        }
    }
break;


			case 'Logout' :
			case 'logout' :
				session_destroy();
				$qs = array("view" => "login",
				            "msg" => "Déconnexion réussie");
			break;
			case 'Suivant' : 
				$titre = valider("titre");
				$logo = valider("logo");
				$URL_image = valider("URL_image");
				$hauteur = valider("hauteur");
				$largeur = valider("largeur");
				$pos_qr = valider("pos_qr");
				$pos_titre = valider("pos_titre");
				$data = valider("data");
				if ((strlen($data) >= 100) || (strlen($titre) >= 100)) {
					$qs = array(
						"view" => "generer",
						"msg" => "Veuillez entrer des valeurs correctes",
						"titre" => $titre,
						"logo" => $logo,
						"URL_image" => $URL_image,
						"hauteur" => $hauteur,
						"largeur" => $largeur,
						"pos_qr" => $pos_qr,
						"pos_titre" => $pos_titre,
						"couleur" => "#0032d833",
						"police" => "14",
						"largeur_qr" => "150",
						"data" => $data
					);
				}
				else {
				if ($logo && $URL_image && $hauteur && ($hauteur>=300) && ($largeur>=500) && $largeur && $pos_qr && $pos_titre){
					$lastId = ajouter_qr($data);
					if($lastId){
						if ($titre)
						$id = ajouter_illu($_SESSION["idUser"], $largeur, $hauteur, "#0032d833", "14", $lastId, $logo, $URL_image, $pos_titre, $pos_qr, $titre);
						else $id = ajouter_illu($_SESSION["idUser"], $largeur, $hauteur, "#0032d833", "14", $lastId, $logo, $URL_image, $pos_titre, $pos_qr);
						$qs = array("view" => "QR_placement", "titre" => $titre, "logo" => $logo, "URL_image" => $URL_image, "hauteur" => $hauteur, "largeur" => $largeur, "pos_qr" => $pos_qr, "pos_titre" => $pos_titre, "couleur" => "#0032d833", "police" => "14", "id" => $id, "largeur_qr" => "150");
					}
					}
					else $qs = array("view" => "generer", "msg" => "Veuillez entrer des valeurs correctes", "titre" => $titre, "logo" => $logo, "URL_image" => $URL_image, "hauteur" => $hauteur, "largeur" => $largeur, "pos_qr" => $pos_qr, "pos_titre" => $pos_titre, "couleur" => "#0032d833", "police" => "14", "id" => $id, "largeur_qr" => "150", "data" => $data);
				}
				break;

			case 'Appliquer les modifications':
				$id = valider("id");
				$couleur = valider("color_row");
				$police = valider("size_font");
				$pos_qr = valider("posi_qr");
				$largeur_qr = valider("largeur_qr");
				$pos_titre = valider("posi_text");
				/*print($id);
				print($couleur);
				print($police);
				print($pos_qr);
				print($pos_titre);*/

				//die();

				if ($id && $couleur && $police && $pos_qr && $pos_titre && $largeur_qr) {
					modifier_illu($id, $couleur, $police, $pos_titre, $pos_qr, $largeur_qr);
					$result = recup_qr($id) ?: [];
					foreach($result as $res){
					$qs = array("view" => "QR_placement", "msg" => "Vos modifications ont été correctement appliquées et enregistrées", "titre" => $res["titre"], "logo" => $res["logo_url"], "URL_image" => $res["image_url"], "hauteur" => $res["hauteur_image"], "largeur" => $res["largeur_image"], "pos_qr" => $res["position_QR"], "pos_titre" => $res["position_texte"], "couleur" => $res["couleur_police"], "police" => $res["taille_police"], "id" => $id, "largeur_qr" => $res["largeur_qr"]);
				}
				}
				break;

			case 'Supprimer' : 
				$id = valider("id");
				if ($id){
					suppr_illu($id);
					$qs = array("view" => "accueil", "msg" => "Suppression effectué avec succès");
				}
				else $qs = array("view" => "accueil", "msg" => "Suppression échouée");

				break;
			///////////////////////////////////////////////////////////////////
            case 'Inscription':
				$nom = valider("nom");
				$prenom = valider("prenom");
				$promo = valider("promo");
				$passe = valider("password");
				$passe2 = valider("password2");
				if ($nom && $prenom && $promo && $passe && $passe2) {
					if($passe == $passe2){
					inscription($nom, $prenom, $passe, $promo);
					$qs = array("view" => "login", "msg" => "Inscription réussie");}
					else {$qs = array("view" => "inscription", "msg" => "Les mots de passe ne correspondent pas");}
				} else {
					$qs = array("view" => "inscription", "msg" => "Veuillez remplir tous les champs");
				}
				break;

				///////////////////////////////////////////////////////////////
			
			case 'Connectez-vous pour commencer' : 
				$qs = array("view" => "login");
				break;

			case "Accorder" :
				if ($idUser = valider("idUser"))
				if ($idImg = valider("idImg"))
				{
					accorderQR($idUser,$idImg);
					$qs = array("view" => "admin",
					"msg" => "Attribution réussi");
				}
				break;			
		}
	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments
	
	if ($qs == "") {
		// On renvoie vers la page précédente en se servant de HTTP_REFERER
		// attention : il peut y avoir des champs en + de view...
		$qs = parse_url($_SERVER["HTTP_REFERER"]. "&cle=val", PHP_URL_QUERY);
		$tabQS = explode('&', $qs);
		array_map('parseDataQS', $tabQS);
		$qs = "?view=" . $dataQS["view"];
	}

	rediriger($urlBase, $qs);

	// On écrit seulement après cette entête
	ob_end_flush();

	function parseDataQS($qs) {
		global $dataQS; 
		$t = explode('=',$qs);
		$dataQS[$t[0]]=$t[1]; 
	}
	
?>