<?php
session_name('gacem');
require_once("lib/common_service.php");
session_start();
if (isset($_SESSION['ident']))
  return;
produceError('not authentificated');
exit();

 ?>
