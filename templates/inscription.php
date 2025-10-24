<?php 
echo '<div class="form-card">';
mkForm("controleur.php", "get", "form-connexion");
echo "<h1>Inscription</h1>";
echo "<BR> Nom d'utilisateur : <BR>";
mkInput("text", "user");
echo "<BR> Mot de passe : <BR>";
mkInput("password", "password");
echo "<BR> Confirmez le mot de passe : <BR>";
mkInput("password", "password2");
echo "<BR>";
mkInput("submit", "action", "Inscription");
echo "Déjà inscrit ? <a href='index.php?view=login'>Connectez-vous</a>";
endForm();
echo '</div>';
?>