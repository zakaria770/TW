<?php
//Auteurs OUAICHOUCHE

require_once("../lib/Identite.class.php");

header("Content-type: application/json;charset=UTF-8");

session_start();

if(isset($_SESSION['ident']) && $_SESSION['ident'] != FALSE){
	echo '{"status" : "error", "message" : "vous êtes déjà connecter à un compte."}';
	return;
}

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

$stmt = $connexion->prepare("select pseudo,password,nom,description from utilisateurs where pseudo = '".$pseudo."'");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_NUM);
while ($user = $stmt->fetch()){
  if ($pseudo==$user[0] && crypt($password, $user[1])==$user[1])
   {
     $id = new Identite($user[0],$user[2],$user[3]);
     $_SESSION['ident'] = $id;
     $reponse = array("status"=>"ok", "args"=>array("pseudo"=>$pesudo), "result"=>array("pseudo"=>$pseudo, "nom"=>$user[2]));
     echo(json_encode($reponse));
     return;
   }
 }
 echo '{"status" : "error", "message" : "pseudo ou mot de passe incorrect"}';
 return;
?>
