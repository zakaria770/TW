<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineNonEmptyString('searchedString');
if ($args->isValid()) {
  try {
    $data = new DataLayer();
    $ResUser = $data->findUser($args->searchedString);
    // $ResUser = $data->getProfileConnected($args->userId,'aporation');

      produceResult($ResUser);

  } catch (PDOException $e) {
    produceError($e->getMessage());
  }

}
else {
  produceError(implode (' ',$args->getErrorMessages()));
}




 ?>
