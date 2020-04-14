<?php
/*
 Script de test
 */

header('Content-type: text/plain;charset=utf-8');

require_once("lib/db_parms.php");
require_once("lib/DataLayer.class.php");

try{
    $data = new DataLayer();
    var_dump ($data->getEquipes());
} catch (PDOException $e) {
    echo $e->getMessage();
}

// résultat attendu pour getCoureursQ0() :
/*
array(7) {
  [0]=>
  array(2) {
    ["dossard"]=>
    int(1)
    ["nom"]=>
    string(5) "alain"
  }
  [1]=>
  array(2) {
    ["dossard"]=>
    int(2)
    ["nom"]=>
    string(8) "alphonse"
  }
  [2]=>
  array(2) {
    ["dossard"]=>
    int(3)
    ["nom"]=>
    string(7) "germain"
  }
  [3]=>
  array(2) {
    ["dossard"]=>
    int(4)
    ["nom"]=>
    string(9) "théodule"
  }
  [4]=>
  array(2) {
    ["dossard"]=>
    int(5)
    ["nom"]=>
    string(6) "albert"
  }
  [5]=>
  array(2) {
    ["dossard"]=>
    int(6)
    ["nom"]=>
    string(5) "louis"
  }
  [6]=>
  array(2) {
    ["dossard"]=>
    int(7)
    ["nom"]=>
    string(5) "léon"
  }
}
*/


// résultat attendu pour getCoureursQ1() :

/*
array(7) {
  [0]=>
  array(3) {
    ["equipe"]=>
    string(13) "LavePlusBlanc"
    ["dossard"]=>
    int(1)
    ["nom"]=>
    string(5) "alain"
  }
  [1]=>
  array(3) {
    ["equipe"]=>
    string(13) "LavePlusBlanc"
    ["dossard"]=>
    int(6)
    ["nom"]=>
    string(5) "louis"
  }
  [2]=>
  array(3) {
    ["equipe"]=>
    string(10) "PicsouBank"
    ["dossard"]=>
    int(5)
    ["nom"]=>
    string(6) "albert"
  }
  [3]=>
  array(3) {
    ["equipe"]=>
    string(10) "PicsouBank"
    ["dossard"]=>
    int(2)
    ["nom"]=>
    string(8) "alphonse"
  }
  [4]=>
  array(3) {
    ["equipe"]=>
    string(10) "PicsouBank"
    ["dossard"]=>
    int(3)
    ["nom"]=>
    string(7) "germain"
  }
  [5]=>
  array(3) {
    ["equipe"]=>
    string(14) "SuperCarburant"
    ["dossard"]=>
    int(7)
    ["nom"]=>
    string(5) "léon"
  }
  [6]=>
  array(3) {
    ["equipe"]=>
    string(14) "SuperCarburant"
    ["dossard"]=>
    int(4)
    ["nom"]=>
    string(9) "théodule"
  }
}
*/
?>
