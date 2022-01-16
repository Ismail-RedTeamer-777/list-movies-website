<?php  
	//connection base de donneés
	function connectionDatabase()
	{
		/*$host = 'iutdoua-web.univ-lyon1.fr';  //connection BD IUT
		$user = 'p1907545';
		$pwd = '445887';
		$db = 'p1907545';*/
		$host = 'localhost'; //connection BD local
		$user = 'root';
		$pwd = '';
		$db = 'Ismail_Database';

		try 
		{
			$bdd = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $bdd;
		} 
		catch (PDOException $e) 
		{
			exit('Erreur de connection: '.$e->getMessage());
		}
	}

	//authentification user
	function user_auth($bdd, $username, $pwd)
	{
		$query = $bdd->prepare('SELECT username, pwd FROM users WHERE username = ? AND pwd = ?');
		$query->execute(array($username, $pwd));
		$bool = ($query->fetch() == false) ? false : true;
		//récupération e-mail en cas d'authentification
		$query = $bdd->prepare('SELECT email FROM users WHERE username = ? AND pwd = ?');
		$query->execute(array($username, $pwd));

		if($bool)
		{
			$data = $query->fetch();
			return $data["email"];
		}
		else
		{
			return false;
		}
	}

	//inscription utilisateur
	function user_inscription($bdd, $username, $pwd, $email)
	{
		$query = $bdd->prepare('INSERT INTO users(username, pwd, email) VALUES(?, ?, ?)');
		$query->execute(array($username, $pwd, $email));
	}

	//ajout d'un film
	function add_table($bdd, $nom, $annee, $score, $nbvotes)
	{
		try
		{
			$query = $bdd->prepare('INSERT INTO film (nom, annee, score, nbVotants) VALUES(?, ?, ?, ?)');
			$query->execute(array($nom, $annee, $score, $nbvotes));
			return true;
		}
		catch(PDOException $e)
		{
			exit("Erreur d'insertion de données: ".$e->getMessage());
			return false;	
		}
	}

	//modification d'un film
	function edit_table($bdd, $id, $nom, $annee, $score, $nbVotants)
	{ 
		try
		{
			$query = $bdd->prepare('UPDATE film SET nom = ?, annee = ?, score = ?, nbVotants = ? WHERE id = ?');
			$query->execute(array($nom, $annee, $score, $nbVotants, $id));
			return true;
		}
		catch(PDOException $e)
		{
			exit("Erreur de mise à jour de données: ".$e->getMessage());
			return false;
		}
	}
	
	//suppression d'un film
	function delete_table($bdd, $id)
	{
		try
		{
			$query = $bdd->prepare('DELETE FROM film WHERE id = ?');
			$query->execute(array($id));
			return true;
		}
		catch(PDOException $e)
		{
			exit("Erreur de suppression de données: ".$e->getMessage());
			return false;
		}
	}

?>