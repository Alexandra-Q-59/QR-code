<?php

include_once("maLibSQL.pdo.php");
function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
		$dbh->exec("SET CHARACTER SET utf8");
		
		// Utilisation d'une requête préparée pour éviter les injections SQL
		$sql = "SELECT id, password_hash FROM users WHERE username = ?"; 
		$stmt = $dbh->prepare($sql);
		$stmt->execute([$login]);
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// Vérification du mot de passe avec password_verify
		if ($result && password_verify($passe, $result['password_hash'])) {
			return $result['id'];
		} else {
			return false;
		}
	} catch (PDOException $e) {
		die("<font color=\"red\">verifUserBdd: Erreur de connexion : " . $e->getMessage() . "</font>");
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
		$sql = "SELECT id FROM users WHERE id = ? AND role = 'admin'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute([$idUser]);
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result ? $result['id'] : false;
	} catch (PDOException $e) {
		die("<font color=\"red\">isAdmin: Erreur de connexion : " . $e->getMessage() . "</font>");
	}
}


function inscription($user, $email, $passe){
	// Utilisation de requêtes préparées pour éviter les injections SQL
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;
	
	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base", $BDD_user, $BDD_password);
		$dbh->exec("SET CHARACTER SET utf8");
		
		// Hachage sécurisé du mot de passe avec password_hash
		$password_hash = password_hash($passe, PASSWORD_DEFAULT);
		
		// Requête préparée pour l'insertion
		$sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
		$stmt = $dbh->prepare($sql);
		$result = $stmt->execute([$user, $email, $password_hash]);
		
		if ($result) {
			return $dbh->lastInsertId();
		} else {
			return false;
		}
	} catch (PDOException $e) {
		die("<font color=\"red\">inscription: Erreur de connexion : " . $e->getMessage() . "</font>");
	}
}

?>
