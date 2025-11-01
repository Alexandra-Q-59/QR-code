<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
  header("Location:../index.php");
  die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>2iGoodies</title>

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="shortcut icon" href="./ressources/icone.png">

  <meta name="description"
    content="Un site web permettant de créer des illustrations et des QR Codes pour des goodies. Ces goodies seront offerts aux élèves répondant aux questions et aux problèmes des cours. 2iGoodies permet de répertorier tous ceux ayant reçu un QR Code et d’en créer ou générer." />
  <meta name="keywords" content="QR Code, IG2I, illustrations, goodies" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Liaisons aux fichiers css de Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  


  <!-- Scripts JS -->
  <script src="js/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script src="js/header.js" defer></script>

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->

<body>

  <!-- Wrap all page content here -->
  <div id="wrap">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
            aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- lien-protege rajouté car on veut que l'utilisateur soit connecté -->
          <a class="navbar-brand lien-protege" href="index.php?view=accueil" style="margin-right: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-qr-code-icon lucide-qr-code">
              <rect width="5" height="5" x="3" y="3" rx="1" />
              <rect width="5" height="5" x="16" y="3" rx="1" />
              <rect width="5" height="5" x="3" y="16" rx="1" />
              <path d="M21 16h-3a2 2 0 0 0-2 2v3" />
              <path d="M21 21v.01" />
              <path d="M12 7v3a2 2 0 0 1-2 2H7" />
              <path d="M3 12h.01" />
              <path d="M12 3h.01" />
              <path d="M12 16v.01" />
              <path d="M16 12h1" />
              <path d="M21 12v.01" />
              <path d="M12 21v-1" />
            </svg>
            <span class="navbar-brand-text" style="font-weight: bold; font-size: 1.2em;">2iGoodies</span>
          </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" style="display: flex; justify-content: center; width: 60%; margin: 0 auto;">

            <?php if (valider("connecte", "SESSION")) { ?>
              <li><a href="index.php?view=accueil">Accueil</a></li>
            <?php } ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php if (valider("connecte", "SESSION")) { ?>
              <?php if (isAdmin($_SESSION["idUser"])) { ?>
                <li><a href="index.php?view=admin"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>
                <li><a href="index.php?view=generer">Générer</a></li>
              <?php } ?>
              <li><a href="controleur.php?action=Logout">Déconnexion</a></li>
            <?php } else { ?>
              <li><a href="index.php?view=login">Connexion</a></li>
              <li><a href="index.php?view=inscription" 
                  style="color: white; margin-top: 8px; margin-left: 10px; padding: 6px 12px;background-color:rgb(85,141,12); border-radius:10px;">Inscription</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Content container -->



    <!-- Begin page content -->
    <div class="container">

      <?php
      if ($msg = valider("msg")) {
        echo "<div class=\"alert alert-warning\">$msg</div>\n";
      }

      ?>

      <!-- création d'une constante pour les conditions d'accès à l'accueil par l'icone-->
      <script>
        const utilisateurEstConnecte = <?= isset($_SESSION['idUser']) ? 'true' : 'false' ?>;
      </script>