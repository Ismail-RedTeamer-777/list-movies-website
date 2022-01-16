<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/inscription_style.css"/>
	<title>Inscrivez-vous!</title>
</head>
<body>

	<h1>Bienvenue sur la page d'inscription!</h1>
	<br>
	<div>
		<form action="./inscription.php" method="post">
			<label for="username"><b>Identifiant: </b></label>
			<input type="text" id="username" name="username" required>
			<br><br>
			<label for="pwd"><b>Mot de passe: </b></label>
			<input type="password" id="pwd" name="pwd" required>
			<br><br>
			<label for="email"><b>E-mail: </b></label>
			<input type="email" id="email" name="email" required>
			<br><br>
			<input type="submit" value="Valider" onclick="window.alert('INSCRIPTION EN COURS DE TRAITEMENT...');">
			<button type="reset">Reset</button>
		</form>
	</div>

	<?php
		require('fonctions.php');

		if(isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['email']))
		{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['pwd'] = $_POST['pwd'];
			$_SESSION['email'] = $_POST['email'];
			$bdd = connectionDatabase();
			user_inscription($bdd, $_SESSION['username'], $_SESSION['pwd'], $_SESSION['email']);
			header("location: ./authentification.php");
		}
	?>
	<br>
	<div>
	<a href="./authentification.php"><button>S'authentifier</button></a>
	</div>

</body>
</html>