<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
session_name('gacem');
session_start();
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineNonEmptyString('source');
if(isset($_SESSION['ident'])){
  if ($args->isValid()) {
    try {
      $data = new DataLayer();
      $Resmsg = $data->createPost($_SESSION['ident'],$args->source);
      // $Resmsg = $data->getPostMessage($_SESSION['ident']);

      // $ResUser = $data->getProfileConnected($args->userId,'aporation');
      if ($Resmsg) {

          produceResult($Resmsg);

      }
      else{
        produceError("Aucun resultat");
      }
    } catch (PDOException $e) {
      produceError($e->getMessage());
    }

  }
  else {
    produceError(implode (' ',$args->getErrorMessages()));
  }

}
else {
  produceError ("Vous ne pouvez pas acceder a ce service, vous n'etes pas connecte");
}


 ?>
