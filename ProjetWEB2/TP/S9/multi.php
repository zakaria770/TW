<?php
/* Salah Zakaria OUAICHOCUHE */
require_once("lib/db_parms.php");
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
date_default_timezone_set ('Europe/Paris');
try{
    $data = new DataLayer();
    $listeEquipes = $data->getEquipes();
    $listeEtapes = $data->getEtapes();
    $stats = $data->getStats();
    require ('views/pageMulti.php');
} catch (PDOException $e){
    $errorMessage = $e->getMessage();
    require("views/pageErreur.php");
}

?>
