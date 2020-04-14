<?php

  require_once('lib/initDataLayer.php');
  session_start();
  if (isset($_SESSION['ident'])) return;

  if ($login===''||$password===''){
    require('views/pageLogin.php');
    exit();
  }

  $personne = $data->authentifier($login,$password);
  if(! $personne){
    $_SESSION['echec']=true;
    require('views/pageLogin.php');
    exit();
  }

  $_SESSION['ident']=$personne;
  unset($_SESSION['echec']);

?>
