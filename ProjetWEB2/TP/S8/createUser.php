<?php
// OUAICHOUCHE 
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });
 require_once('lib/initDataLayer.php');

$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,'password');
$nom = filter_input(INPUT_POST,'nom');
$prenom = filter_input(INPUT_POST,'prenom');


$res = $data->createUser($login,$password,$nom,$prenom);
$notres = !($res) ;
if((isset($_POST['valid'])) && $notres){
  $erreurCreation = "Erreur";
}
else if($res){
  require("views/pageCreateOK.php");
  exit();
}
require('views/pageRegister.php');

 ?>
