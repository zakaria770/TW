<?php
//Salah Zakaria OUAICHOUCHE & Chaymaa ZOUHRI
try{
  require('lib/verifyParms.php');
//require('views/pageVlille.php');
  require('views/pageVlille.php');

}catch (ParmsException $e){
  $errorMessage = $e->getMessage();
	require('views/pageVlille.php');
}
 ?>
