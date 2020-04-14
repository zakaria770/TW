<?php
//Auteurs OUAICHOUCHE

require_once("../lib/Identite.class.php");
require_once("../lib/MessageMentions.class.php");
header("Content-type: application/json;charset=UTF-8");
date_default_timezone_set('Europe/Paris');

session_start();
if(! $_SESSION["ident"]){
	echo('{"status : "error", "message" : "vous n\'êtes pas connecté, veuillez actualiser la page."}');
	return;
}

$auteur = $_SESSION['ident']->getPseudo();
$source = $_POST["source"];
$datetime = date("Y-m-d H:i:s");

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

//Récuperation de tous les pseudos
$stmt = $connexion->prepare("select pseudo from utilisateurs");
$stmt->execute();
$users = array(1=>"a");
while($user = $stmt->fetch()){
	$users[] = $user["pseudo"];
}

//Récupération du message codé
$message = new MessageMentions($source);
$message->setMentions($users);
$contenu = $message->getEncodedMessage();

//Envoi dans la base de donnée
$stmt = $connexion->prepare("insert into messages (auteur, contenu, datetime) values('$auteur','$contenu','$datetime')");
$stmt->execute();

//recupération de l'identifiant
$stmt = $connexion->prepare("select currval('messages_id_seq') as id");
$stmt->execute();
$id = $stmt->fetch()["id"];

$reponse = array("status"=>"ok", "args"=>array("source"=>$source), "result"=>array("id"=>$id, "encodedMessage"=>$contenu));
echo(json_encode($reponse));
return;
?>
