<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/formulaire_edit_style.css"/>
	<title>Formulaire des films!</title>
</head>
<body>

	<script>
		function user_infos()
		{
			var username = " *Username: <?php echo $_SESSION['username']; ?>\n";
			var pwd = " *Password: <?php echo $_SESSION['pwd']; ?>\n";
			var email = " *E-mail: <?php echo $_SESSION['email']; ?>\n";
			var str1 = "Voici vos informations de session:\n";
			var info = str1.concat(username, pwd, email);
			window.alert(info);
		}
	</script>

	<header>
		<a href="./authentification.php" onclick="alert('ÊTES-VOUS SÛR DE LA DÉCONNEXION?');">Déconnexion</a>
		<a href="#" onclick="user_infos();">Qui suis-je?</a>
	</header>

	<h1>Modifiez un film de votre collection!</h1>
	<a href="./index.php"><button>Back</button></a>
	<br><br>

	<?php 
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;
		$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
		$annee = isset($_POST['annee']) ? $_POST['annee'] : NULL;
		$score = isset($_POST['score']) ? $_POST['score'] : NULL;
		$nbvotes = isset($_POST['nbvotes']) ? $_POST['nbvotes'] : NULL;
	?>

	<form action="./page_confirmation.php" method="post">
		<input type="hidden" name="id" <?php echo 'value="'.$_POST['id'].'"'; ?>>
		<label for="Nom">Nom:</label>
		<input type="text" id="Nom" name="Nom" <?php echo 'value="'.$nom.'"'; ?> required><br><br>
		<label for="Annee">Année:</label>
		<input type="number" min="1935" id="Annee" name="Annee" <?php echo 'value="'.$annee.'"'; ?> required><br><br>
		<label for="_score">Score:</label>
		<input type="number" step="any" min="0" max="10" id="Score" name="Score" <?php echo 'value="'.$score.'"'; ?> required><br><br>
		<label for="Nbvotes">N° Votes:</label>
		<input type="number" min="0" id="Nbvotes" name="Nbvotes" <?php echo 'value="'.$nbvotes.'"'; ?> required><br><br>
		<button type="submit" onclick="confirm('ÊTES-VOUS SÛR DE CONTINUER LA MODIFICATION?');">Edit</button>
	</form>

</body>
</html>