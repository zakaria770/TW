<?php
require_once("lib/db_parms.php");
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
try{
    $data = new DataLayer();
    $equipes = $data->getEquipes();
    
    $equipeChoisie = ""; 
    // pour la question 3, code à insérer ci-dessous
    
    require ('views/pageEquipes.php');
} catch (PDOException $e){
    $errorMessage = $e->getMessage();
    require("views/pageErreur.php");
}

?>