<?php

date_default_timezone_set ('Europe/Paris');
set_include_path('..');
session_name('gacem');
session_start();
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineString('password');
$args->defineString('pseudo');
$args->defineString('description');
if(isset($_SESSION['ident'])){
  if ($args->isValid()) {
    try {
          $data = new DataLayer();
          $Resmsg = $data->setprofil($_SESSION['ident'],'',$args->pseudo,$args->description);
          produceResult($Resmsg);
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
