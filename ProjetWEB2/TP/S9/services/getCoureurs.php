<?php
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
date_default_timezone_set ('Europe/Paris');

set_include_path('..');

header('Content-type: application/json; charset=UTF-8');


function answer($reponse){
    global $args;
    $reponse['args'] = $args->getValues();
    $reponse['time'] = date('d/m/Y H:i:s');
    echo json_encode($reponse);
}

function produceError($message){
    echo answer(['status'=>'error','message'=>$message]);
}
function produceResult($result){
    echo answer(['status'=>'ok','result'=>$result]);
}

$args = new RequestParameters();
$args->defineString('equipe');
if ($args->isValid())
    try{
      $data = new DataLayer();
      //var_dump($args->getValues()['equipe']);
      if ($args->getValues()['equipe']!="")
          $param = $args->getValues()['equipe'];

      $coureurs = $data->getCoureurs($param);

      //$result = json_encode($equipe);
      produceResult($coureurs);


    } catch (PDOException $e){
        produceError($e->getMessage());
    }
else
    produceError( implode(' ',$args->getErrorMessages()) );


?>
