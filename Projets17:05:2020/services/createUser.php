<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineNonEmptyString('userId');
$args->defineNonEmptyString('password');
$args->defineNonEmptyString('pseudo');

if ($args->isValid()) {
  try {
    $data = new DataLayer();
    $resultat = $data->createUser($args->userId,$args->password,$args->pseudo);
    if ($resultat) {
      produceResult(["userId"=>$args->userId,"pseudo"=>$args->pseudo]);
    }
    else{
      produceError("This login: {$args->userId} is already used ");
    }
  } catch (PDOException $e) {
    produceError($e->getMessage());
  }

}
else {
  produceError(implode (' ',$args->getErrorMessages()));
}


 ?>
