<?php
date_default_timezone_set ('Europe/Paris');
set_include_path('..');
require_once("lib/common_service.php");
$args = new RequestParameters();
$args->defineString('author');
$args->defineString('before');
$args->defineString('count');
if ($args->isValid()) {
  try {
    $data = new DataLayer();
    if ($args->count== NULL) {
      $val= TRUE;
      $args->count = 15;
    }
     if ($args->author == NULL) {
      if ($args->before == NULL ) {
        $Resmsg = $data->findMessageswithoutBeforeAuthor($args->count);
      }
      else if ($args->before !== ""){
        $Resmsg = $data->findMessageswithoutAuthor($args->before,$args->count);
      }
    }
    else if ($args->author !== "")  {
      if ($args->before == NULL){
       $Resmsg = $data->findMessageswithoutBefore($args->author,$args->count);
     }
     else if ($args->before !== "") {
       $Resmsg = $data->findMessages($args->count,$args->before,$args->author);
       // $Resmsg = $data->findMessages($args->count,$args->before,$args->$author);
     }
   }

    // if ($args->before == "") {
    //   if ($args->author == "") {
    //
    //   }
    //   $Resmsg = $data->findMessageswithoutBefore($args->author,$args->count);
    //
    // }

    // $ResUser = $data->getProfileConnected($args->userId,'aporation');
      if ($val){
        produceDefaultResult($Resmsg,15);
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




 ?>
