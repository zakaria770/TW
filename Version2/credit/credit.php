<?php
try{

  require('views/pageCredit.php');

}catch (Exception $e){
  $errorMessage = $e->getMessage();
  echo "<section id='errorMessage'>\n";
  echo "  	<p> Erreur : $errorMessage</p>\n"; // à améliorer
  echo "</section>\n";
}
 ?>
