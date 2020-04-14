<?php
set_include_path('..'.PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');


if ( isset($_SESSION['ident'])) {

  try{
      $data = new DataLayer();
      $user = $_SESSION['ident']->login;
      $fav = $data->getFavoris($user);
      if ($fav){

          produceResult($fav);
      }
      else{
        produceError("no fav found for {$user}");
      }

  } catch (PDOException $e){
      produceError($e->getMessage());
  }

} else {
   produceError("Vous n'êtes pas authentifié");
   return;
}
?>
