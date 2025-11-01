<?php

include_once("maLibSQL.pdo.php");
function verifUserbdd($nom, $prenom, $motdepasse)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
		$dbh->exec("SET CHARACTER SET utf8");

		$sql = "SELECT id, mdp 
                FROM user 
                WHERE nom = ? AND prenom = ?";

		$stmt = $dbh->prepare($sql);
		$stmt->execute([$nom, $prenom]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);


		if ($result && $motdepasse === $result['mdp']) {
			return $result['id'];
		} else {
			return false;
		}

	} catch (PDOException $e) {
		die("<font color=\"red\">verifUserBddNomPrenom: Erreur de connexion : " . $e->getMessage() . "</font>");
	}
}

function isAdmin($idUser)
{
	// Vérifie si l'utilisateur est un administrateur
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
		$dbh->exec("SET CHARACTER SET utf8");

		// Utilisation d'une requête préparée pour éviter les injections SQL
		$sql = "SELECT id FROM user WHERE id = ? AND admin = '1'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute([$idUser]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result ? $result['id'] : false;
	} catch (PDOException $e) {
		die("<font color=\"red\">isAdmin: Erreur de connexion : " . $e->getMessage() . "</font>");
	}
}

function inscription($nom, $prenom, $passe, $promo)
{
	$SQL = "INSERT INTO user (nom, prenom, promo, admin, mdp) VALUES ('$nom', '$prenom', '$promo', '0', '$passe')";
	SQLInsert($SQL);
}


function lister_qr($id)
{
	$SQL = "SELECT QR FROM user
	JOIN qr ON user.id_qr = qr.id
	WHERE user.id = id";
	return SQLSelect($SQL);
}

function generer_qr($id, $condition)
{
	//$SQL = "INSERT INTO qr () "
}

function lister_image_cree($id_user)
{
	$SQL = "SELECT * FROM illustration WHERE illustration.id_user = $id_user";
	return SQLSelect($SQL);
}

function ajouter_illu($id_user, $largeur, $hauteur, $couleur, $taille_police, $qr_id, $logo_URL, $image_URL, $pos_text, $pos_im, $titre = "")
{
	if ($titre) {
		$SQL = "INSERT INTO illustration (logo_url, image_url, titre, hauteur_image, largeur_image, position_QR, position_texte, hauteur_qr, largeur_qr, id_qr, id_user, couleur_police, taille_police) VALUES ('$logo_URL', '$image_URL', '$titre', '$hauteur', '$largeur', '$pos_im', '$pos_text', '150', '150', '$qr_id', '$id_user', '$couleur', '$taille_police')";
	} else
		$SQL = "INSERT INTO illustration (logo_url, image_url, hauteur_image, largeur_image, position_QR, position_texte, hauteur_qr, largeur_qr, id_qr, id_user, couleur_police, taille_police) VALUES ('$logo_URL', '$image_URL', '$hauteur', '$largeur', '$pos_im', '$pos_text', '150', '150', '$qr_id', '$id_user', '$couleur', '$taille_police')";

	return SQLInsert($SQL);
}

function ajouter_qr($data)
{
	$SQL = "INSERT INTO QR (data, version, errorCorrectLevel, maskPattern) VALUES ('$data', '1', '2', '0')";
	$id = SQLInsert($SQL);
	return $id;
}

function modifier_illu($id_illu, $couleur, $police, $pos_titre, $pos_qr, $largeur_qr)
{
	$SQL = "UPDATE illustration SET couleur_police = '$couleur', taille_police = '$police', position_QR = '$pos_qr', position_texte = '$pos_titre', hauteur_qr = '$largeur_qr', largeur_qr = '$largeur_qr' WHERE id = '$id_illu'";
	SQLUpdate($SQL);
}

function recup_qr($id_illu)
{
	$SQL = "SELECT * FROM illustration WHERE id = $id_illu";
	return SQLSelect($SQL);
}

function select_data($id)
{
	$SQL = "SELECT data FROM QR JOIN illustration ON illustration.id_qr = QR.id WHERE illustration.id = $id";
	return SQLSelect($SQL);
}

function recup_illu($id)
{
	$SQL = "SELECT * FROM illustration JOIN QR ON illustration.id_qr = QR.id WHERE illustration.id = $id";
	return SQLSelect($SQL);
}

function suppr_illu($id){
$SQL = "

	DELETE FROM illustration WHERE id = $id;";

	SQLDelete($SQL);
}


// function listerElevesObtQR($idUser)
// {
// 	//elle affiche une liste des eleves ayant recu un QR Code avec la date de l'obtention
// 	//et ça pour chaque qr code que l'admin en question a créé

//  	$sql = "
//  		SELECT 
//  			user.nom AS 'NOM',
//  			user.prenom AS 'PRENOM',
//  			user.promo AS 'PROMO',
//  			QR_obtenu.date_obtention AS 'DATE OBTENTION DU QR CODE', 
//  			illustration.titre AS 'TITRE DU QR CODE'
//  		FROM user
//  			JOIN  QR_obtenu ON user.id = QR_obtenu.id_user
//  			JOIN illustration ON illustration.id = QR_obtenu.id_image
//  			JOIN QR ON QR.id = illustration.id_qr
//  		WHERE illustration.id_user='$idUser'";
//  	//echo $sql;
//  	return parcoursRs(SQLSelect($sql));
// }



// function listerTousLesEleves()
// {
// 	//affiche une liste de tout les eleves
// 	$sql = "
// 		SELECT 
// 			user.nom AS 'NOM',
// 			user.prenom AS 'PRENOM',
// 			user.promo AS 'PROMO'
// 		FROM user
// 		WHERE user.promo LIKE 'LE_' OR user.promo LIKE 'LA_'
// 		ORDER BY PROMO ASC, NOM ASC, PRENOM ASC ";
// 	//echo $sql;
// 	return parcoursRs(SQLSelect($sql));
// }


function listerEleves($idUser, $obt = 0)
{
	//Cette fonction affiche une liste de tous les eleves
	//Elle affiche aussi une liste des eleves ayant recu un QR Code avec la date de l'obtention
	//et ça pour chaque qr code que l'admin en question a créé

	$sql = "
		SELECT 
			user.id AS 'ID',
			user.nom AS 'NOM',
			user.prenom AS 'PRENOM',
			user.promo AS 'PROMO'";


	//Lorsque la variable $obt vaut 0, la fonction renvoie tous les élèves
	//lorsqu'elle vaut 1, la fonction renvoie les élèves ayant obtenu un QR Code

	if ($obt == 0)
		$sql = $sql . "FROM user WHERE user.promo LIKE 'LE_' OR user.promo LIKE 'LA_' ORDER BY PROMO ASC, NOM ASC, PRENOM ASC ";


	if ($obt == 1)
		$sql = $sql . ", QR_obtenu.date_obtention AS 'DATE OBTENTION DU QR CODE', illustration.titre AS 'TITRE DU QR CODE' FROM user JOIN  QR_obtenu ON user.id = QR_obtenu.id_user JOIN illustration ON illustration.id = QR_obtenu.id_image JOIN QR ON QR.id = illustration.id_qr WHERE illustration.id_user='$idUser' ORDER BY PROMO ASC, NOM ASC, PRENOM ASC ";

	//echo $sql;

	return parcoursRs(SQLSelect($sql));

}

function accorderQR($idUser, $idImg)
{
	$date = date("Y-m-d");
	$sql = "INSERT INTO QR_obtenu (id_user,date_obtention,id_image)	VALUES ('$idUser','$date','$idImg')";

	//echo $SQL;
	SQLInsert($sql);
}

function listerQR($idUser)
{
	$sql = "
		SELECT
			illustration.id AS 'ID',
			illustration.titre AS 'TITRE'
		FROM illustration
		WHERE illustration.id_user='$idUser'";

	//echo $sql;

	return parcoursRs(SQLSelect($sql));
}

?>