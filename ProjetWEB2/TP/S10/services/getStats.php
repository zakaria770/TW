<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');

try{
    $data = new DataLayer();
    $stats = $data->getStats();
    produceResult($stats);
}
catch (PDOException $e){
    produceError($e->getMessage());
}



?>
