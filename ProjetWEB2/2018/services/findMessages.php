<?php
//Auteurs OUAICHOUCHE

header("Content-type: application/json;charset=UTF-8");

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

//recupération de l'identifiant
$stmt = $connexion->prepare("select max(id) as id from messages");
$stmt->execute();
$id = $stmt->fetch()["id"];

//Récuperation du message
$stmt = $connexion->prepare("select * from messages where id > $id-10 order by id desc");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$messages = array();
while($message = $stmt->fetch()){
	$messages[] = $message;

}

$reponse = array("status"=>"ok", "result"=>$messages);
echo(json_encode($reponse));
return;
?>
