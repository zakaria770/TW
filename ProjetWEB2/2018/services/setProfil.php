<?php
//Auteurs OUAICHOUCHE

require_once("../lib/Identite.class.php");

header("Content-type: application/json;charset=UTF-8");

session_start();

if(! (isset($_SESSION['ident']) && $_SESSION['ident']!=FALSE)){
  echo('{"status":"error", "message":"vous n\'êtes pas connecté(e), veuillez actualiser la page."}');
  return;
}

$description = $_POST['description'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$pseudo = $_SESSION['ident']->getPseudo();

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

if ($description != ""){
  $stmt = $connexion->prepare("update utilisateurs set description='".$description."' where pseudo='".$pseudo."'");
  $stmt->execute();
}

if ($nom != ""){
  $stmt = $connexion->prepare("update utilisateurs set nom='".$nom."' where pseudo='".$pseudo."'");
  $stmt->execute();
}

if ($password != ""){
  //generation de salage
  $alphanum = "abcdefghijklmnopqrstuvwxyz0123456789";
  $salt = "$2a$10$";
  for($i = 0; $i<22; $i++){
     $salt .= substr($alphanum, rand(0,35), 1);
  }

  $stmt = $connexion->prepare("update utilisateurs set password='".crypt($password, $crypt)."' where pseudo='".$pseudo."'");
  $stmt->execute();
}

$stmt = $connexion->prepare("select nom,description from utilisateurs where pseudo='".$pseudo."'");
$stmt->execute();
$tab = $stmt->fetch();
$nom1 = $tab['nom']; $description1 = $tab['description'];
$reponse = array("status"=>"ok", "args"=>array("nom"=>$nom, "description"=>$description), "result"=>array("pseudo"=>$pseudo,"nom"=>$nom1,"description"=>$description1));
echo(json_encode($reponse));
return;
?>
