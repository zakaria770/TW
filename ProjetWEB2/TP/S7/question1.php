<?php
require_once("lib/db_parms.php");
require_once("lib/DataLayer.class.php");
try{
    $data = new DataLayer();
    $tableCoureurs = $data->getCoureursQ1();
    require("views/pageCoureurs.php");
} catch (PDOException $e){
    $errorMessage = $e->getMessage();
    require("views/pageErreur.php");
}
?>
