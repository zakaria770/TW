<?php
    set_include_path('..'.PATH_SEPARATOR);
    require('lib/watchdog.php');
    require_once('lib/common_service.php');
    
    $login = $_SESSION['ident'];
    session_destroy();
    produceResult($login);

?>
