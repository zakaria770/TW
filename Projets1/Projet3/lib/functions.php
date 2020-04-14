<?php



  function getArrayFields($param){
    $array=array();
    foreach ($param as $key => $value){
      $array[]=$param[$key]["fields"];


    }
    return $array;

  }
  function getArrayPossibilites($array1,$prop){
    $array=array();
    foreach ($array1 as  $value){
      if(! (in_array($value[$prop],$array))){
      $array[]=$value[$prop];
}

    }
    return $array;

  }

  function getListeHtml($array){
    $res="";
    foreach ($array as  $key => $value){
      $res.="<ul >";
      $res.="<li> nom  : {$value["nom"]} </li>";
      $res.="<li> commune :{$value["commune"]} </li>";
      $res.="<li> nombre de velo dispo :{$value["nbvelosdispo"]} </li>";
      $res.="<li> adresse :{$value["adresse"]} </li>";
      $res.="</ul>";






    }
    return $res;
  }


  function constructSelectForForm($array,$name){
    $res="<label for=\"{$name}\">$name => </label>";
    $res.="<select name={$name}>";
    foreach ($array as $value){
      $res.="<option value=\"$value\">$value</value>";}


    $res.="</select>";
    return $res;
  }



 ?>
