<?php include("headerhc.php")?>
	<div class="titre">
		<span>Créer mon profil</span>
	</div>
	<?php
			session_start();

	?>
	<div class="confirmation">
		<form method="post" action="index1.php">
			<label>E-mail:
			<input type="text" name="email" /></label><br>
			<label>Code d'activation:
			<input type="text" name="code" /></label><br>
			<input type="submit" value="Valider" />
		</form>
	</div>
<?php include("footer.php")?>
