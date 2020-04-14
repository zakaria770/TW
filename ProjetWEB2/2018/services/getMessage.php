<?php
//Auteurs OUAICHOUCHE

header("Content-type: application/json;charset=UTF-8");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$id = $_GET['id'];
}else{
	$id = $_POST['id'];
}

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

//Récuperation du message
$stmt = $connexion->prepare("select * from messages where id='$id'");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$message = $stmt->fetch();
if(! $message){
	echo('{"status" : "error", "message" : "le message d\'id $id n\'existe pas dans la base de données"}');
	return;
}

$reponse = array("status"=>"ok", "args"=>array("id"=>$id), "result"=>$message);
echo(json_encode($reponse));
return;

?>
