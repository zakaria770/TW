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
$args->defineNonEmptyString('equipe');
if ($args->isValid())
    try{
      $data = new DataLayer();

      $equipe = $data->getInfoEquipe($args->getValues()['equipe']);

      //$result = json_encode($equipe);
      produceResult($equipe);


    } catch (PDOException $e){
        produceError($e->getMessage());
    }
else
    produceError( implode(' ',$args->getErrorMessages()) );


?>
