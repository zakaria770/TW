<?php

spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

require("lib/watchdog_service.php");
$image= ['data'=>fopen($_FILES['image']['tmp_name'],"rb"),'mimetype' => $_FILES['image']['type']];
$login = $_SESSION['ident']->login;
$res = $data->storeAvatar($image,$login);
if ($res===false) echo json_encode(['status'=>'error', 'message'=>'Echec de l\'envoi d\'image']);
else if ($res===true) echo json_encode(['status'=>'ok']);
?>
