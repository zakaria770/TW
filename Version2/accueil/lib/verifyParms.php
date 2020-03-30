<?php
// Salah Zakaria OUAICHOUCHE
//script invoqué par le script principal

//création de la classe Exception spécifique

require("lib/RequeteToFields.class.php");
require("lib/FieldsToRequete.class.php");

class ParmsException extends Exception{};

const METHOD = INPUT_GET;


const REQUETE = "http://vlille.fil.univ-lille1.fr";
$requeteToFields = new RequeteToFields(REQUETE);

//definition des "constante"
$libelles = $requeteToFields->getLibelles();
$noms = $requeteToFields->getNoms();
$communes = $requeteToFields->getCommunes();
$adresses =  $requeteToFields->getAdresses();

const TYPES = ["AVEC TPE", "SANS TPE"];
const ETATS = ["EN SERVICE", "EN MAINTENANCE", "HORS SERVICE"];
const ETATCONNEXIONS = ["CONNECTED", "DISCONNECTED"];



//teste si les valeur de $name séparés par des virgules sont entieres et si elles existent parmis les valeurs prédéfinies $values
  function intExactFilter($name, $values){
    if (! isset($_GET[$name]) || $_GET[$name]=="")
        $value = [];
    else{
      $valueTab = explode(",", $_GET[$name]);
      for ($i=0; $i<count($valueTab); $i++){
        $s = trim($valueTab[$i]);
        //votre nieme valeur est incorrecte
        if (! (is_numeric($s)))
          throw new ParmsException("param '".$name."' : valeur non numerique à la position ".$i);
        else if (!(in_array($s, $values))) {
            throw new ParmsException("param '".$name."' : valeur inexistante à la position ".$i);
          }
        else {
          $value[]=$name."=".$s;
        }
      }
    }
    return $value;
  }

//teste si les valeur de $name séparés par des virgules sont des sous chaines des valeurs prédefinies $values
  function subStringFilter($name,$values){
    if (! isset($_GET[$name]) || $_GET[$name]==""){
        $value = [];
      }
    else {
      $valueTab = explode(',', $_GET[$name]);
      for ($j=0; $j<count($valueTab); $j++){
        $s = strtoupper(trim($valueTab[$j]));

        $found = false;
        for ($i=0; $i<count($values); $i++){
          $pos = strpos($values[$i], $s);
          if ($pos!==false){
            $value[] = $name.'='.$values[$i];
            $found = true;
          }
        }
        if ($found == false){
          throw new ParmsException("param '".$name."' : valeur inexistante à la position ".$j);
        }

      }
    }
    return $value;
  }

//teste si les valeurs de $name sont des préfixes des valeurs prédefinies $values
  function prefixFilter($name, $values){
    if (! isset($_GET[$name]) || $_GET[$name]==""){
        $value = [];
      }
    else {
      $valueTab = explode(',', $_GET[$name]);
      for ($j=0; $j<count($valueTab); $j++){
        $s = strtoupper(trim($valueTab[$j]));

        $found = false;
        for ($i=0; $i<count($values); $i++){
          $pos = strpos($values[$i], $s);
          if ($pos === 0){
            $value[] = $name."=".$values[$i];
            $found = true;
          }

        }
        if ($found == false){
          throw new ParmsException("param '".$name."' : valeur inexistante à la position ".$j);
        }

        }
    }
    return $value;
  }


//teste si les valeur de name sont mis dans une table et existent dans les valeurs prédefinies $values
  function exactStringFilter($name, $values){
    $value = filter_input(METHOD,$name,FILTER_UNSAFE_RAW, ['flags'=> FILTER_REQUIRE_ARRAY]);
    if ($value === NULL)
      $value=[];
    else if ($value===false)
        throw new ParmsException("param '".$name."' : valeur incorrecte");
      else {
        for ($i=0;$i<count($value);$i++){
          if (! in_array($value[$i], $values))
            throw new ParmsException("param '".$name."' : valeur inexistante");
          else {
            $value[$i]=$name."=".$value[$i];
          }
        }
      }
      return $value;
  }

  //teste si les valeurs de $name sont des valeurs numériques (pas besoin de tester si la valeur est minimale ou pas vu que de toutes façons le serveur affiche à partir de min(les valeurs données))
  function intMinFilter($name){
      if (! isset($_GET[$name]) || $_GET[$name]=="")
        $value = [];
      else{
      $valueTab = explode(",", $_GET[$name]);
      for ($i=0; $i<count($valueTab); $i++){
        $s = trim($valueTab[$i]);
        //votre nieme valeur est incorrecte
        if (! (is_numeric($s)))
          throw new ParmsException("param '".$name."' : valeur non numerique à la position ".$i);
        else {
          $value[]=$name."=".$s;
        }
      }
    }
    return $value;
  }


  //filter les valeurs de "libelle"
  $libelle = intExactFilter("libelle", $libelles);


  //filtrer les valeurs de "nom"
  $nom = subStringFilter('nom', $noms);


  //filtrer les valeurs de "commune"
  $commune = prefixFilter("commune", $communes);


  //filtrer les valeurs de "adresse"
  $adresse = subStringFilter('adresse', $adresses);

  //filtrer les valeurs de "type"
  $type = exactStringFilter('type', TYPES);

  //filtrer les valeurs de "etat"
  $etat = exactStringFilter('etat', ETATS);


  //filtrer les valeurs de "nbvelosdispo"
  $nbVelosDispo = intMinFilter('nbvelosdispo');

  //filtrer les valeurs de "nbplacesdispo"
  $nbPlacesDispo = intMinFilter('nbplacesdispo');



  $fieldsToRequete = new FieldsToRequete($libelle, $nom, $commune, $adresse, $type, $etat, $nbVelosDispo, $nbPlacesDispo);
  $requete = $fieldsToRequete->toRequete();
  $requeteToFields = new RequeteToFields($requete);
  $fields= $requeteToFields->getFields();




  //compare deux fields de $name dans l'ordre croissant on supposant que ce sont representés par des nombres
  function compareFieldsNumber($field1, $field2, $name){
    return $field1[$name]-$field2[$name];
  }

  //compare deux fields de $name dans l'ordre lexicographique on supposnat que ce sont representés par des string
  function compareFieldsString($field1, $field2, $name){
    return strcmp($field1[$name],$field2[$name]);
  }

  //compare deux fields selon "libelle"
  function compareFieldsLibelle($field1,$field2){
    return compareFieldsNumber($field1, $field2, "libelle");
  }

  //compare deux fields selon "nom"
  function compareFieldsNom($field1,$field2){
    return compareFieldsString($field1, $field2, "nom");
  }

  //compare deux fields selon "commune"
  function compareFieldsCommune($field1,$field2){
    return compareFieldsString($field1, $field2, "commune");
  }

  //compare deux fields selon "adresse"
  function compareFieldsAdresse($field1,$field2){
    return compareFieldsString($field1, $field2, "adresse");
  }

  //compare deux fields selon "nbvelosdispo"
  function compareFieldsNbVelos($field1,$field2){
    return compareFieldsNumber($field1, $field2, "nbvelosdispo");
  }

  //compare deux fields selon "nbplacesdispo"
  function compareFieldsNbPLaces($field1,$field2){
    return compareFieldsNumber($field1, $field2, "nbplacesdispo");
  }


  $tri = $_GET["tri"];

  if ($tri=="nom")
    usort($fields, compareFieldsNom);
  else if ($tri=="commune")
    usort($fields, compareFieldsCommune);
  else if ($tri=="adresse")
    usort($fields, compareFieldsAdresse);
  else if ($tri=="nbVelos")
    usort($fields, compareFieldsNbVelos);
  else if ($tri=="nbPlaces")
    usort($fields, compareFieldsNbPLaces);
  else
    usort($fields, compareFieldsLibelle);

 ?>
