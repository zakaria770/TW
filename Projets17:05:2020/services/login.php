<?php
set_include_path('..'.PATH_SEPARATOR);
session_name('gacem');
session_start();
require_once('lib/common_service.php');
// require_once('lib/session_start.php');


if ( ! isset($_SESSION['ident'])) {
  $args = new RequestParameters();
 $args->defineNonEmptyString('login');
  $args->defineNonEmptyString('password');

  if (! $args->isValid()){
   produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
   return;
  }
  try {
    // $_SESSION['ident']
    $data=new DataLayer();
    $tab = $data->authentifier($args->login,$args->password);
    if ($tab!==NULL) {
      $_SESSION['ident']=$tab;
      produceResult($tab);
      return;
    }
    produceError("Identifiants/mots de passe  incorrects");
    return;

  } catch (PDOException $e) {
    produceError("Echec de connexion");
    return;


  }


  // compléter

} else {
   produceError("déjà authentifié");
   return;
}

?>
