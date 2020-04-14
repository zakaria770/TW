<?php
//Auteurs OUAICHOUCHE

require_once("../lib/Identite.class.php");
header("Content-type: application/json;charset=UTF-8");

session_start();
if ($_SESSION['ident'])
  $pseudo = $_SESSION['ident']->getPseudo();
else
  $pseudo = $_POST['pseudo'];

if(empty($_FILES['avatar']["name"])){
	echo(json_encode(array("status"=>"ok", "result"=>FALSE)));
	return;
}

$nom = $_FILES["avatar"]["name"];
$type = $_FILES["avatar"]["type"];
$tmp_name = $_FILES["avatar"]["tmp_name"];

if(strpos($type, 'png')){
  $image = imagecreatefrompng($tmp_name);
}elseif (strpos($type,'jpeg')) {
  $image = imagecreatefromjpeg($tmp_name);
}elseif (strpos($type,'gif')) {
  $image = imagecreatefromgif($tmp_name);
}elseif (strpos($type,'bmp')) {
  $image = imagecreatefrombmp($tmp_name);
}else{
  echo('{"status":"error", "message": "ce type d\'image n\'est pas pris en charge"}');
  return;
}

$avatar = imagecreatetruecolor(256, 256);
$avatarSmall= imagecreatetruecolor(48, 48);

list($width,$heigth) = getimagesize($tmp_name);

imagecopyresampled($avatar, $image, 0,0,0,0, 256, 256, $width, $heigth);
imagecopyresampled($avatarSmall, $image, 0,0,0,0, 48, 48, $width, $heigth);

imagepng($avatar, "avatar.png");
imagepng($avatarSmall, "avatar_small.png");

$flux = fopen("avatar.png","r");
$fluxSmall = fopen("avatar_small.png", "r");

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

$stmt = $connexion->prepare("select pseudo from avatars where pseudo='$pseudo'");
$stmt->execute();
$has_avatar = $stmt->fetch();

if ($has_avatar){
  $stmt = $connexion->prepare("update avatars set nom = :nom, type = :type, contenu= :contenu, \"contenu-small\" = :contenusmall where pseudo='$pseudo'");
}else{
  $stmt = $connexion->prepare("insert into avatars (pseudo,nom,type,contenu,\"contenu-small\") values (:pseudo,:nom,:type,:contenu,:contenusmall)");
  $stmt->bindValue(':pseudo', $pseudo);
}

$stmt->bindValue(':nom', $nom);
$stmt->bindValue(':type', $type);
$stmt->bindValue(':contenu', $flux, PDO::PARAM_LOB );
$stmt->bindValue(':contenusmall', $fluxSmall, PDO::PARAM_LOB );
$stmt->execute();
fclose($flux);
fclose($fluxSmall);

$reponse = array("status"=>"ok","args"=>array("name"=>$nom,"type"=>$type,"size"=>$_FILES['avatar']['size']),"result"=>true);
echo(json_encode($reponse));
return;
?>
