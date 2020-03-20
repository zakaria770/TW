<?php


//fct qui prend un tab de 2 dimention , return un tab
  function getArrayFields($param){
    $array=array();
    foreach ($param as $key => $value){ //
      $array[]=$param[$key]["fields"];


    }
    return $array;

  }
  //prend une cle et un tab de 2 dim, retourne un tab qui a les valeurs
  //chaque valeur des cle de array du parametre, sont des tab de deux dim
  function getArrayPossibilites($array1,$prop){
    $array=array();
    foreach ($array1 as  $value){ //value c est les val de tab array ,tp c est des tab de 2dim en gros les valeur du tab array sont des tab 2dim
      if(! (in_array($value[$prop],$array))){ //cad si value[prop] n est pas une valeur de array on la met dans un tab
      $array[]=$value[$prop];
}

    }
    return $array;

  }
  //return code html contenant liste conteneant nom/commune/nbr velo/adresse
  //elle prend le fichier qui a comme cle :etat/etatConnexion/nbVelo/nbPlace
  //commune/type/libelle/dateMiseAJour/localisation/Nom/Adresse/Geo/Geometry/record_timestamp
  function getListeHtml($array){
    $res="";
    foreach ($array as $key => $value) {
                $res.="<tr >";// data-lat=$array['geo'][0] data-lon= $array['geo'][1]  data-nameStation=$array['nom'] data-etat=$array['etat'] data-connexion=$array['etatConnexion'] data-commune=$array['commune'] data-adresse=$array['adresse'] CB={$array['type']} data-velodispo=$array['nbvelosdispo']  data-espace=$array['nbplacesipo'] data-libelle=$array['libelle']" >":
                $res.="<td>{$value["nom"]}</td>";
                $res.="<td>{$value["commune"]}</td>";
                $res.="<td>{$value["nbvelosdispo"]}</td>";
                $res.="<td>{$value["nbplacesdispo"]}</td>";
                $res.="</tr>";
            }
            return $res;

          }


  //renvoie un formulaire
  function constructSelectForForm($array,$name){
    $res="<label for=\"{$name}\">$name => </label>";
    $res.="<select name={$name}>";
    foreach ($array as $value){ //pour les choi multiple qu on va propose
      $res.="<option value=\"$value\">$value</value>";} //on les ajoute dans res


    $res.="</select>";
    return $res;
  }

  function resFormulaire($array){
    $commune=$_GET['commune'];
    $nom=$_GET['nom'];
    $res="";
    foreach ($array as $key => $value) {
      if($value['nom']==$nom && $value['commune']==$commune){
        $res.="<tr >";// data-lat=$array['geo'][0] data-lon= $array['geo'][1]  data-nameStation=$array['nom'] data-etat=$array['etat'] data-connexion=$array['etatConnexion'] data-commune=$array['commune'] data-adresse=$array['adresse'] CB={$array['type']} data-velodispo=$array['nbvelosdispo']  data-espace=$array['nbplacesipo'] data-libelle=$array['libelle']" >":
        $res.="<td>nom</td>";
        $res.="<td>commune</td>";
        $res.="<td>{$value["nbvelosdispo"]}</td>";
        $res.="<td>{$value["nbplacesdispo"]}</td>";
        $res.="</tr>";
      }
    }
    return $res;
          }



 ?>
