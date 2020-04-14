<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');

$args = new RequestParameters();
$args->defineInt('etape');

if (! $args->isValid()){
  produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
  return;
}

try{
  $data = new DataLayer();
  $arrivee = $data->getArrivee($args->etape);
  produceResult($arrivee);    
}
catch (PDOException $e){
  produceError($e->getMessage());
}

?>
