<?php
//Auteurs OUAICHOUCHE

header("Content-type: application/json;charset=UTF-8");


$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$nom = $_POST['nom'];

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

//verification de la presence d'un utilisateur du même pseudo.
$stmt = $connexion->prepare("select pseudo from utilisateurs where pseudo = '".$pseudo."'");
$stmt->execute();
if($stmt->fetch()){
	echo('{"status" : "error", "message" : "ce pseudo existe déjà"}');
	return;
}

//generation de salage
$alphanum = "abcdefghijklmnopqrstuvwxyz0123456789";
$salt = "$2a$10$";
for($i = 0; $i<22; $i++){
   $salt .= substr($alphanum, rand(0,35), 1);
}

$stmt = $connexion->prepare("insert into utilisateurs (pseudo,password,nom,description) values ('".$pseudo."','".crypt($password, $salt)."', '".$nom."', '');");
$stmt->execute();

$reponse = array("status"=>"ok", "args"=>array("pseudo"=>$pseudo, "nom"=>$nom), "result"=>array("pseudo"=>$pseudo, "nom"=>$nom));
echo(json_encode($reponse));
return;
?>
