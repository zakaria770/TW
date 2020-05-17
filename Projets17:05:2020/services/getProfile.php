<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
require_once("lib/common_service.php");
session_name('gacem');
session_start();

$args = new RequestParameters();
$args->defineNonEmptyString('userId');
if ($args->isValid()) {
  try {
    $data = new DataLayer();
    if(isset($_SESSION['ident'])){
      $ResUser = $data->getProfileConnected($args->userId,$_SESSION['ident']);

    }
    else {
      $ResUser = $data->getProfileUnConnected($args->userId);
    }
    if ($ResUser) {
      produceResult($ResUser);
    }
    else{
      produceError("login {$args->userId} not found");
    }
  } catch (PDOException $e) {
    produceError($e->getMessage());
  }

}
else {
  produceError(implode (' ',$args->getErrorMessages()));
}




 ?>
