<?php
//Auteurs OUAICHOUCHE

//récuperation des parametre
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$pseudo = $_GET["pseudo"];
	if(isset($_GET["size"]))
		$size = $_GET["size"];
	else
		$size = "short";
}else{
	$pseudo = $_POST["pseudo"];
	if(isset($_POST["size"]))
		$size = $_POST["size"];
	else
		$size = "short";
}

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}


if ($size=="short")
	$requete = $connexion->prepare("select type, \"contenu-small\" as avatar from avatars where pseudo='$pseudo'");
else
	$requete = $connexion->prepare("select type, contenu as avatar from avatars where pseudo='$pseudo'");

$flux = fopen("user_default_$size.jpeg", "r");
$requete->bindColumn('avatar', $flux, PDO::PARAM_LOB);
$requete->execute();
$requete->bindColumn('type', $mimetype);
$requete->fetch();
header("Content-Type : image/png");
fpassthru($flux);
fclose($flux);
return;
?>
