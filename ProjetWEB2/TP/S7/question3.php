<?php
require_once("lib/db_parms.php");
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
try{
    $data = new DataLayer();
    $equipes = $data->getEquipes();

    $equipeChoisie = "";
    $equipeChoisie=$_GET["equipe"];
    if(getInfoEquipe($equipeChoisie)!=FALSE){
      $infoEquipe= getInfoEquipe($equipeChoisie);
    }

    require ('views/pageEquipes.php');
    require('views/components/sectionReponseEquipe.php');
} catch (PDOException $e){
    $errorMessage = $e->getMessage();
    require("views/pageErreur.php");
}

?>
