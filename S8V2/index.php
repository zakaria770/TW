<?php
// OUAICHOUCHE 

spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

  $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING,['options'=>['default'=>'']]);
  $password=filter_input(INPUT_POST,'password');
  require_once('lib/watchdog.php');
  require('views/pageAccueil.php');
?>
