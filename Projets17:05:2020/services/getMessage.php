<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineNonEmptyString('messageId');
if ($args->isValid()) {
  try {
    $data = new DataLayer();
    $Resmsg = $data->getMessage($args->messageId);
    // $ResUser = $data->getProfileConnected($args->userId,'aporation');
    if ($Resmsg) {
      produceResult($Resmsg);
    }
    else{
      produceError("Message  {$args->messageId} not found");
    }
  } catch (PDOException $e) {
    produceError($e->getMessage());
  }

}
else {
  produceError(implode (' ',$args->getErrorMessages()));
}




 ?>
