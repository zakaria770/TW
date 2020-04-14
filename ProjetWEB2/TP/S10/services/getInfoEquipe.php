<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');

$args = new RequestParameters();
$args->defineNonEmptyString('equipe');

if (! $args->isValid()){
  produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
  return;
}

try{
    $data = new DataLayer();
    $infoEquipe = $data->getInfoEquipe($args->equipe);
    if ($infoEquipe)
        produceResult($infoEquipe);
    else
        produceError("equipe {$args->equipe} not found");
} catch (PDOException $e){
    produceError($e->getMessage());
}

?>
