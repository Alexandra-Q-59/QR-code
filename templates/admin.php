<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=login");
	die("");
}

?>

<div class="page-header" 
style='
    display: flex; 
    flex-wrap: wrap; 
    gap: 30px; 
    justify-content: center; 
    padding: 20px;
    background: #f9fafb;'
>

	<h1>Administration</h1>
</div>
</br>

<!-- elle affiche une liste de tout les eleves -->
<h2 style="text-align:center;"> Liste de tous les élèves</h2>
<!-- 
<div>
	<form role="form" action="controleur.php">
		//<div class="form-group">
		//	<input type="button" class="form-control" name="listeEleve" value="Liste de tous les élèves">
		//</div>
		<button type="submit" name="action" value="listeEleve" class="btn btn-default">Liste de tous les élèves</button>
	</form> 
</div> -->


<div style='display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px; background: #f9fafb;'>
	<?php
	echo "Liste des Élèves ayant un compte :<br><br>";
	$tousLesEleves = listerEleves($_SESSION["idUser"], 0);
	if (empty($tousLesEleves)) {
		echo "<p><em>Aucun élève ne s'est encore inscrit.</em></p>";
		echo "<hr />";
	} else {
		mkTable($tousLesEleves, ['NOM', 'PRENOM', 'PROMO']);
		echo "<hr />";
	}
	?>
</div>
</br>


<h2 style="text-align:center;"> Liste des élèves ayant recu un QR Code</h2>
<!-- voit ceux qui l'ont déjà reçu avec la date de l'obtention et ça pour chaque qr code que l'admin en question a créé -->

<div style='display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px; background: #f9fafb;'>
	<?php
	echo "<br><br>";
	$Obtention = listerEleves($_SESSION["idUser"], 1);
	if (empty($Obtention)) {
		echo "<p><em>Aucun élève n'a encore obtenu l'un de vos QR Codes.</em></p>";
		echo "<hr />";
	} else {
		mkTable($Obtention, ['NOM', 'PRENOM', 'PROMO', 'DATE OBTENTION DU QR CODE', 'TITRE DU QR CODE']);
		echo "<hr />";
	}
	?>
</div>
</br>


<h2 style="text-align:center;">Attribution des QR Code</h2>
<!-- peut accorder des qr code -->

<form role="form" action="controleur.php" style='display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px; background: #f9fafb;'>
	<select name="idUser">
		<?php
		$tousLesEleves = listerEleves($_SESSION["idUser"], 0);
		foreach ($tousLesEleves as $dataUser) {
			if ($dataUser['ID'] == $idUser)
				$sel = "selected";
			else
				$sel = "";

			echo "<option $sel value=\"$dataUser[ID]\">";
			echo "$dataUser[NOM] $dataUser[PRENOM]";
			echo "</option>";
		}
		?>
	</select>
	<select name="idImg">
		<?php
		$tousQR = listerQR($_SESSION["idUser"]);
		foreach ($tousQR as $dataQR) {
			if ($dataQR['ID'] == $idImg)
				$sel = "selected";
			else
				$sel = "";

			echo "<option $sel value=\"$dataQR[ID]\">";
			echo $dataQR['TITRE'];
			echo "</option>";
		}
		?>
	</select>

	<input type="submit" name="action" value="Accorder" />
</form>
