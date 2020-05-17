<?php
 date_default_timezone_set ('Europe/Paris');
 header('Content-type: application/json; charset=UTF-8');

 spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
 });


 function answer($reponse){
  global $args;
  if (is_null($args))
    $reponse['args'] = [];
  else {
    $reponse['args'] = $args->getValues();
    unset($reponse['args']['password']);
  }
  $reponse['time'] = date('d/m/Y H:i:s');
  echo json_encode($reponse);
 }

 function produceError($message){
    answer(['status'=>'error','message'=>$message]);
 }
 function produceResult($result){
    answer(['status'=>'ok','result'=>$result]);
 }

 function Resanswer($reponse,$defaultvalue){
  global $args;
  if (is_null($args))
    $reponse['args'] = [];
  else {
    $reponse['args'] = $args->getValues();
    unset($reponse['args']['password']);
    unset($reponse['args']['count']);
    $reponse['args']['count'] = $defaultvalue;

  }
  $reponse['time'] = date('d/m/Y H:i:s');
  echo json_encode($reponse);
 }



 function produceDefaultResult($res,$val){
  Resanswer(['status'=>'ok','result'=>$res],$val);
 }
?>
