<?php
//Auteurs OUAICHOUCHE

header("Content-type: application/json;charset=UTF-8");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$pseudo = $_GET["pseudo"];
	if(isset($_GET["type"]))
		$type = $_GET["type"];
	else
		$type = "short";
}else{
	$pseudo = $_POST["pseudo"];
	if(isset($_POST["type"]))
		$type = $_POST["type"];
	else
		$type = "short";
}

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

if($type == "short")
	$stmt = $connexion->prepare("select pseudo,nom from utilisateurs where pseudo='$pseudo'");
else
	$stmt = $connexion->prepare("select pseudo,nom,description from utilisateurs where pseudo='$pseudo'");
$stmt->execute();
$user = $stmt->fetch();
if(! $user){
	echo('{"status" : "error", "message" : "ce pseudo n\'existe pas dans la base de données"}');
	return;
}
$reponse = array("status"=>"ok", "args"=>array("pseudo"=>$pseudo,"type"=>$type), "result"=>$user);
echo(json_encode($reponse));
return;
?>
