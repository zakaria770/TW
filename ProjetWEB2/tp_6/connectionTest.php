<!DOCTYPE html>
<html>
<head>
	<title>Script Connexion</title>
</head>
<h3>Informations sur les equipes: </h3>
<body>
<?php
	require_once("lib/db_parms.php");
	try{
		$connexion = new PDO(
		DB_DSN, DB_USER, DB_PASSWORD,
		[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);
		
		$sql = $connexion->prepare("SELECT dossard, nom, equipe FROM coureurs ORDER BY equipe, nom");
		$sql->execute();
		echo "<ul>";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo "<li>";
			echo "Nom: " . $row['nom'] . ", Dossard: " . $row['dossard'] . ", Equipe: " . $row['equipe'];
			echo "</li>";
		}
		echo "</ul>";
	}
	catch (PDOException $e){
		die("Erreur de connexion : " . $e->getMessage());
	}
?>
</body>
</html>
