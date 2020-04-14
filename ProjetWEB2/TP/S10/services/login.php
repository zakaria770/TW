<?php
set_include_path('..'.PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');


if ( ! isset($_SESSION['ident'])) {
  $args = new RequestParameters('POST');
  $args->defineNonEmptyString('login');
  $args->defineNonEmptyString('password');

  if (! $args->isValid()){
   produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
   return;
  }

  try{
      $data = new DataLayer();
      $ident = $data->authentifier($args->login, $args->password);
      if ($ident){
          $_SESSION["ident"]= $ident;
          //essayer avec ident.login, ident.nom ident.prenom
          produceResult($ident);
      }
      else
          //essayer avec password {$args->passeword}
          produceError("login {$args->login} and password not found");
  } catch (PDOException $e){
      produceError($e->getMessage());
  }

} else {
   produceError("déjà authentifié");
   return;
}
?>
