<?php include("headerhc.php")?>
	<div class="données1">
		<form method="post" action="index.php">
			<label>Nom:
			<input type="text" name="nom" /></label><br>
			<label>Pr�nom:
			<input type="text" name="prenom" /></label><br>
			<label>Date de Naissance:
			<input type="text" name="naissance" /></label><br>
			<label>Num�ro de t�l�phone:
			<input type="text" name="numero" /></label><br>
			<label>Mot de Passe:
			<input type="password" name="password" /></label><br>
			<label>Confirmer mot de passe:
			<input type="password" name="passwordconfirmation" /></label><br>
			<input type="checkbox" name="CGU" />J'accepte les <a href="CGU.php">CGU</a><br>
			<input type="checkbox" name="Newsletter" />Je m'inscris à la Newsletter<br>
			<input type="submit" value="Continuer" />
		</form>
	</div>
<?php include("footer.php")?>