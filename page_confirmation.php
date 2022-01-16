<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/page_confirmation_style.css"/>
	<title>Succès!</title>
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

	<h1>OPÉRATION RÉUSSIE!</h1>
	<?php
		require('fonctions.php');
		$bdd = connectionDatabase();

		if(isset($_POST['id']) && isset($_POST['Nom']) && isset($_POST['Annee']) && isset($_POST['Score']) && isset($_POST['Nbvotes']))
		{
			edit_table($bdd, $_POST['id'], $_POST['Nom'], $_POST['Annee'], $_POST['Score'], $_POST['Nbvotes']);
		}
	?>
	<p>VOUS VENEZ DE METTRE À JOUR VOTRE LISTE DE FILMS PREFÉRÉS!</p>
	<br>
	<a href="./index.php"><button>Back</button></a>

</body>
</html>