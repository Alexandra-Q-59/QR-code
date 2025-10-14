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
			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login,$passe)) {
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) {
							// Génération d'un token sécurisé pour le cookie
							$token = bin2hex(random_bytes(32)); // Génère un token aléatoire
							$expiry = time()+60*60*24*30; // 30 jours
							
							// Stockage du token en base de données (à implémenter)
							// storeRememberToken($_SESSION["idUser"], $token, $expiry);
							
							// Stockage du login et du token dans les cookies
							setcookie("login", $login, $expiry, "/", "", false, true); // HttpOnly pour sécurité
							setcookie("remember_token", $token, $expiry, "/", "", false, true); // HttpOnly pour sécurité
							setcookie("remember", true, $expiry, "/", "", false, false);
						} else {
							// Suppression des cookies
							setcookie("login", "", time()-3600, "/", "", false, true);
							setcookie("remember_token", "", time()-3600, "/", "", false, true);
							setcookie("remember", false, time()-3600, "/", "", false, false);
							
							// Suppression du token en base de données (à implémenter)
							// deleteRememberToken($_SESSION["idUser"]);
						}
				    // On redirigera vers la page index automatiquement, avec la vue d'accueil
				    $qs = array("view" => "accueil",
				                "msg" => "Connexion réussie, bienvenue $login !");
					} else {
				    $qs = array("view" => "login",
				                "msg" => "Erreur de connexion, veuillez réessayer");
					}
				}
			break;

			case 'Logout' :
			case 'logout' :
				session_destroy();
				$qs = array("view" => "login",
				            "msg" => "Déconnexion réussie");
			break;

			///////////////////////////////////////////////////////////////////
            case 'Inscription':
				$user = valider("user");
				$email = valider("email");
				$passe = valider("password");
				$passe2 = valider("password2");
				if ($user && $email && $passe && $passe2) {
					if($passe == $passe2){
					inscription($user, $email, $passe);
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