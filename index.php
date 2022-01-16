<?php
	session_start();

	if(!isset($_SESSION['username']) && !isset($_SESSION['pwd'])) 
	{
		header("location: ./authentification.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./assets/css/index_style.css"/>
	<title>Liste de films!</title>
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

	<h1>Voici votre liste de films préférés!</h1>
	<div>
		<a href="./formulaire.php"><button>ADD FILM</button></a>
	</div>

	<br><br>

	<?php 
		require('fonctions.php');
		$bdd = connectionDatabase();
	  	$query = $bdd->query('SELECT * FROM film');
	?>

 	<table border=5>
		<thead>
			<tr>
				<th>ID</th>
				<th>NOM</th>
				<th>ANNÉE</th>
				<th>SCORE</th>
				<th>N° VOTES</th>
				<th colspan="2">ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($data = $query->fetch()) {
				$id = $data["id"]?>
				<tr>
					<td><?php echo $data["id"]; ?></td>
					<td><?php echo $data["nom"]; ?></td>
					<td><?php echo $data["annee"]; ?></td>
					<td><?php echo $data["score"]; ?></td>
					<td><?php echo $data["nbVotants"]; ?></td>
					<td>
						<form action="./formulaire_edit.php" method="post">
							<input type="hidden" name="id" <?php echo 'value="'.$data["id"].'"';?>>
							<input type="hidden" name="nom" <?php echo 'value="'.$data["nom"].'"';?>>
							<input type="hidden" name="annee" <?php echo 'value="'.$data["annee"].'"';?>>
							<input type="hidden" name="score" <?php echo 'value="'.$data["score"].'"';?>>
							<input type="hidden" name="nbvotes" <?php echo 'value="'.$data["nbVotants"].'"';?>>
							<input type="submit" value="Edit" class="submit">
						</form>
					</td>
					<td>
						<form action="./index.php" method="post">
							<input type="hidden" name="id" <?php echo 'value="'.$data["id"].'"';?>>
							<input type="submit" value="Delete" class="submit" onclick="window.confirm('ÊTES-VOUS SÛR DE PROCÉDER À LA SUPPRESSION?');">
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php
		if(isset($_POST['id']))
		{
			delete_table($bdd, $_POST['id']);?>
			<script>
				window.location.href = "./page_confirmation.php";
			</script>
		<?php }
	?>

</body>
</html>