<?php
//Auteurs OUAICHOUCHE

require_once("../lib/Identite.class.php");

header("Content-type: application/json;charset=UTF-8");

session_start();

$ident = $_SESSION['ident'];
$pseudo = $ident->getPseudo();
$_SESSION['ident'] = FALSE;
$reponse = array("status"=>"ok", "result"=>array("pseudo"=>$pseudo));
echo(json_encode($reponse));
return;
?>
