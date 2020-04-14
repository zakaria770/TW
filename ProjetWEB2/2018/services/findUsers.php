<?php
//Auteurs OUAICHOUCHE

header("Content-type: application/json;charset=UTF-8");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$searched = $_GET["searched"];
	if(isset($_GET["scope"]) && $_GET["scope"]!="")
		$scope = $_GET["scope"];
	else
		$scope = "both";
	if(isset($_GET["type"]) && $_GET["type"]!="")
		$type = $_GET["type"];
	else
		$type = "short";
}else{
	$searched = $_POST["searched"];
	if(isset($_POST["scope"]) && $_POST["scope"]!=""){
		$scope = $_POST["scope"];
	}else{
		$scope = "both";
	}
	if(isset($_POST["type"]) && $_POST["type"]!=""){
		$type = $_POST["type"];
	}else{
		$type = "short";
	}
}

//Connexion à la base de donnée
try { $connexion= new PDO("pgsql:host=localhost;dbname=katchalamele","katchalamele","22041997dkm");
} catch (PDOException $e) {
	echo("Erreur connexion ".$e->getMessage());
    exit();
}

if($type == "short")
	$select = "pseudo,nom";
else
	$select = "pseudo,nom,description";

if ($scope == "both")
	$condition = "position('$searched' in pseudo)>0 or position('$searched' in nom)>0";
elseif ($scope == "name") {
	$condition = "position('$searched' in nom)>0";
}else{
	$condition = "position('$searched' in pseudo)>0";
}

$stmt = $connexion->prepare("select $select from utilisateurs where $condition");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$users = array();
while($user = $stmt->fetch()){
	$users[] = $user;
}
$reponse = array("status"=>"ok", "args"=>array("searched"=>$searched, "scop"=>$scope, "type"=>$type), "result"=>$users);

echo(json_encode($reponse));
return;
?>
