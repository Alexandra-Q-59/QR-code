<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CentralePopotte</title>
	
	<!-- Liaisons aux fichiers css de Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style_inscription.css">
	
	
	<!-- Scripts JS -->
	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

<!-- Wrap all page content here -->
<div id="wrap">
  
  <!-- Navbar -->
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php?view=accueil" style="margin-right: 20px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FF6B35" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
            <path d="M7 2v20"/>
            <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
          </svg>
          <span class="navbar-brand-text" style="font-weight: bold; font-size: 1.2em;">CentralePopotte</span>
        </a>
      </div>
      
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav" style="display: flex; justify-content: center; width: 60%; margin: 0 auto;">
          <li><a href="index.php?view=ToutesNosRecettes">Toutes les Recettes</a></li>
          <li><a href="index.php?view=frigo">J'ai quoi au frigo?</a></li>
          <?php if (valider("connecte", "SESSION")) { ?>
          <li><a href="index.php?view=creer_recette">Ajouter une Recette</a></li>
          <li><a href="index.php?view=planning">Mon Planning</a></li>
          <li><a href="index.php?view=Mes_recettes">Mes recettes</a></li>
          <?php } ?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php if (valider("connecte", "SESSION")) { ?>
            <li><a href="index.php?view=favoris">Mes Favoris</a></li>
            <?php if (isAdmin($_SESSION["idUser"])) { ?>
            <li><a href="index.php?view=admin"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>
            <?php } ?>
            <li><a href="controleur.php?action=Logout">Déconnexion</a></li>
          <?php } else { ?>
            <li><a href="index.php?view=login">Connexion</a></li>
            <li><a href="index.php?view=inscription" class="btn btn-danger" style="color: white; margin-top: 8px; margin-left: 10px; padding: 6px 12px;">Inscription</a></li>
          <?php } ?>
        </ul>
      </div>
      </div>
    </nav>
      
    <!-- Content container -->
  


  <!-- Begin page content -->
  <div class="container">
  
  <?php
    if ($msg = valider("msg")) {
      echo "<div class=\"alert alert-warning\">$msg</div>\n";
    }
  
  ?>







