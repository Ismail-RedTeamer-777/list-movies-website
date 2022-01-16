<?php
	session_start();

	if(isset($_SESSION))
	{
		unset($_SESSION['username']);
		unset($_SESSION['pwd']);
		unset($_SESSION['email']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/authentification_style.css"/>
	<title>Authentification!</title>
</head>
<body>

	<h1>Bienvenue sur la page d'authentification!</h1>
	<br>
	<div>
		<form action="./authentification.php" method="post">
			<label for="username"><b>Identifiant: </b></label>
			<input type="text" id="username" name="username" required>
			<br><br>
			<label for="pwd"><b>Mot de passe: </b></label>
			<input type="password" id="pwd" name="pwd" required>
			<br><br>
			<input type="submit" value="Valider">
			<button type="reset">Reset</button>
		</form>
	</div>
	
<?php
	require('fonctions.php');

	if(isset($_POST['username']) && isset($_POST['pwd']))
	{
		$bdd = connectionDatabase();
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];
		$bool = user_auth($bdd, $username, $pwd);
		if($bool)
		{
			$_SESSION['username'] = $username;
			$_SESSION['pwd'] = $pwd;
			$_SESSION['email'] = $bool;
			header("location: ./index.php");
		}
		else
		{?>
			<script>
				window.alert('IDENTIFIANT ET/OU MOT DE PASSE INCORRECTS! VEUILLEZ RÉESSAYEZ SVP...');
			</script>
		<?php }
	}
?>
	<br>
	<div>
		<a href="./inscription.php"><button>S'inscrire</button></a>
	</div>

</body>
</html>