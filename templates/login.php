<?php
// Redirection si la page est appelée directement
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}

// Chargement éventuel des cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE");
$checked = valider("remember", "COOKIE") ? "checked" : "";
?>
<?php 
echo "<div class='form-card'>";
mkForm("controleur.php");
       echo "<h1 class='text-center'>Connexion</h1>";
       echo "Nom d'utilisateur";
        mkInput("text", "login", $login);
        echo "Mot de passe";
        mkInput("password", "passe", $passe) ;
        echo "Se souvenir de moi  " ;
        mkInput("checkbox", "remember", "1", $checked);
        mkInput("submit", "action", "Connexion");

        echo "<p class='mt-3 text-center'>";
            echo "Pas encore inscrit ? <a href='index.php?view=inscription'>Inscrivez-vous</a>";
        echo "</p>";
    endForm();
echo "</div>";

?>