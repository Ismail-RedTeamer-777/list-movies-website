<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/formulaire_style.css"/>
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

	<h1>Ajoutez un film dans votre collection!</h1>
	<div>
		<a href="./index.php"><button>BACK</button></a>
	</div>
	<br><br>

	<div class="form">
		<form action="./formulaire.php" method="post">
			<label for="nom">NOM:</label>
			<input type="text" id="nom" name="nom" required><br><br>
			<label for="annee">ANNÉE:</label>
			<input type="number" min="1935" id="annee" name="annee" required><br><br>
			<label for="score">SCORE:</label>
			<input type="number" step="any" min="0" max="10" id="score" name="score" required><br><br>
			<label for="nbvotes">N° VOTES:</label>
			<input type="number" min="0" id="nbvotes" name="nbvotes" required><br><br>
			<input type="submit" value="AJOUTER" onclick="confirm('ÊTES-VOUS SÛR DE CONTINUER?');"/>
			<button type="reset">RESET</button>
		</form>
	</div>

	<?php
		require('fonctions.php');
		$bdd = connectionDatabase();
		if(isset($_POST['nom']) && isset($_POST['annee']) && isset($_POST['score']) && isset($_POST['nbvotes']))
		{
			add_table($bdd, $_POST['nom'], $_POST['annee'], round($_POST['score'], 1), $_POST['nbvotes']);
			header("Location: ./page_confirmation.php");
		}
	?>

</body>
</html>