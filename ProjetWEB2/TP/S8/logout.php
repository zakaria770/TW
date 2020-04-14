<?php

spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

  $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
  $password=filter_input(INPUT_POST,'password');
  require_once('lib/watchdog.php');
  unset($_SESSION['ident']);
  session_destroy();
  require("views/pageDeconnexion.php");
?>
