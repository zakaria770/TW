<?php

const SITE = "le site d'origine";

/*
renvoie une table php  indexé par des entiers successifs. Chaque element du tableau est un tableau
php associatif représentant les crédits.
*/
function readCredit($file){
  $str = fgets($file);
  if ($str==FALSE)
    return FALSE;
  else {
    $i=0;
    while ($str!=FALSE) {
      if (trim($str)==""){
        $str=fgets($file);
        $i+=1;
      }
      else {
        $pos = strpos($str, ":");
        if ($pos==FALSE){
          throw new Exception("La description de ligne est incorrecte");
        }
        else{
          $name= trim(substr($str,0,$pos));
          $value = trim(substr($str,$pos+1));
          if ($name=="Auteur" || $name=="url" || $name=="Licence")
            $credit[$i]["caract"][$name]=$value;
          else
            $credit[$i][$name]=$value;
          $str = fgets($file);
          $found = TRUE;
          }
      }
    }
  }
  if ($found==false)
    return $found;
  else
    return $credit;

}

/*renvoie le tableau associatif au fichier dont le nom est donné en paramètre
une exception si le fichier n'existe pas ou si il est vide.
*/
function loadCredits($fileName){
  $file = fopen($fileName, 'r');
  if ($file==false){
    throw new Exception("file ".$fileName." not found");
  }
  else {
    $credits = readCredit($file);
    if ($credits==false)
      throw new Exception("pas de crédits");
    else
      return $credits;
  }


}

/*retourne une balise a dont l'url est donné en paramètre*/
function toLink($url){
  return "<a href=\"".$url."\">".SITE."</a>";
}

/*retourne un element de liste dont le contenu est donné en paramètre*/
function toListElement($content){
  return "<li>".$content."</li>";
}


/*renvoie une chaine de caractère qui contient le code HTML présentant un crédit
*/
function creditToHTML($credit){
  $res= "<ul>\n";
  //print_r($array);
  foreach ($credit as $key => $value) {
    if ($key=="Description" || $key=="Auteur" || $key=="Licence")
      $res.= toListElement($key.": ".$value);
    else if ($key=="url")
      $res.= toListElement(toLink($value));
    else if ($key=="caract")
      $res.= creditToHTML($value);

  }
  $res.="</ul>\n";
  return $res;
}
/*renvoie une chaine de caractère qui contient le code HTML présentant l'ensemble
des crédits du tableau $credits
*/
function creditsToHTML($credits){
  $res = "";
  for ($i=0; $i<count($credits) ; $i++) {
    $res.=creditToHTML($credits[$i]);
  }
  return $res;
}





 ?>
