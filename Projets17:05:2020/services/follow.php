<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
session_name('gacem');
session_start();
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineNonEmptyString('target');
if(isset($_SESSION['ident'])){
  if ($args->isValid()) {
    try {
      $data = new DataLayer();
      $Resmsg = $data->follow($_SESSION['ident'],$args->target);

      // $ResUser = $data->getProfileConnected($args->userId,'aporation');
      if ($Resmsg === True) {

          produceResult($Resmsg);

      }
      else{
        produceError("problemes survenue lors de l'insertion: cet abonnement existe deja");
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
