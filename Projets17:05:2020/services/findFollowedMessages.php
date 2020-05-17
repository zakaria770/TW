<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
session_name('gacem');
session_start();
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineString('before');
$args->defineString('count');
if(isset($_SESSION['ident'])){
  if ($args->isValid()) {
    try {
      $data = new DataLayer();
      if ($args->count== NULL) {
        $val= TRUE;
        $args->count = "15";

      }
      if ($args->before == NULL) {
        $Resmsg = $data->findFollowedMessages($_SESSION['ident'],$args->count);
      }
      else if ($args->before != ''){
        $Resmsg = $data->findFollowedMessages($_SESSION['ident'],$args->count,$args->before);
      }

      // $ResUser = $data->getProfileConnected($args->userId,'aporation');
        if ($val){
          produceDefaultResult($Resmsg,"15");
        }
        else{
          produceResult($Resmsg);

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
