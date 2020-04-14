<?php
//Salah Zakaria OUAICHOUCHE

//renvoie le code HTML d'un input de type texte dont l'id, le nom da variable et le nom du champ sont donnés en paramètre
function InputTypeText($id, $name, $fieldName){
  $s= '<label for ="'.$id.'">'.$fieldName."</label>\n";
  $s.= '<input type="text" size="28" placeholder="entrez vos choix séparés par une virgule " name="'.$name."\">\n";
  $s.="<br/>";
  return $s;
}

//revoie le code HTML d'une liste à une liste de checkbox dont le nom de la variable et les valeurs sont donnés en paramètre
function listToCheckBox($name, $values){
  $res = "";
  for ($i=0;$i<count($values);$i++){
    $value = '"'.$values[$i].'"';
    $res.= '<label for='.$value.'>'. $values[$i].'</label>'."\n";
    $res.= '<input type="checkbox" name="'.$name.'[]" id='.$value. 'value='.$value.'/>';
  }
  $res .= "<br/>";
  return $res;
}

//renvoie le code html d'une option de selection (selon si elle sera selectionné ou non)
function selectOption($value, $selectName, $selected=false){
  if ($selected==false)
    return "<option value=\"".$value."\">".$selectName."</option> \n";
  else
    return "<option value=\"".$value."\" selected = \"selected\">".$selectName."</option> \n";
}


//renvoie le code HTML d'une cellule de table td
function fieldToCell($field){
  return "<td>".$field."</td>";
}

//renvoie le code HTML d'une cellule de table th
function fieldToThCell($field){
  return "<th>".$field."</th>";
}

//renvoie le code HTML d'une ligne de table
function lineToTableLine($line){
  return "<tr>".$line."</tr>\n";
}

//renvoie le code HTML d'une ligne de table avec les datas en classes
function lineWithDataClasstoTabLine($line, $data){
  $dataLine ="";
  foreach ($data as $key => $value) {
    $dataLine.= "data-".$key.'="'.$value.'" ';
  }
  return "<tr ".$dataLine. ">".$line."</tr>\n";
}


//traduit les fields en code HTML d'une table
function fieldsToTable($fields){
  $s = "<table id=\"tableauVLille\">\n";
  $s .= "<thead>\n";
  $line = fieldToThCell("Libelle").fieldToThCell("Nom").fieldToThCell("Commune").fieldToThCell("Adresse").fieldToThCell("Type").fieldToThCell("Etat").fieldToThCell("Etat Connexion").fieldToThCell("nb Vélos dispo").fieldToThCell("nb Places dispo");


  $s .= lineToTableLine($line);
  $s .= "</thead>\n";
  $s .= "<tbody>\n";

  for ($i=0; $i <count($fields) ; $i++) {


    $geo = $fields[$i]["localisation"];
    $libelle= $fields[$i]["libelle"];
    //$libelle = fieldToCell($fields[$i]["libelle"]);

    $nom=$fields[$i]["nom"];
    $commune=$fields[$i]["commune"];
    $adresse = $fields[$i]["adresse"];
    $type = $fields[$i]["type"];
    $etat = $fields[$i]["etat"];
    $etatConnexion = $fields[$i]["etatconnexion"];


    $nbVelo = $fields[$i]["nbvelosdispo"];
    $nbPlace = $fields[$i]["nbplacesdispo"];

    //ajouter libelle!!!!!!!!!!!!et le reste!!!!!!!
    $data = array("geo"=>json_encode($geo), "libelle"=>$libelle, "nom"=>$nom, "etat"=>$etat, "connexion"=>$etatConnexion, "commune"=>$commune, "adresse"=>$adresse, "type"=>$type, "velos"=>$nbVelo, "places"=>$nbPlace);
    $line = fieldToCell($libelle).fieldToCell($nom).fieldToCell($commune).fieldToCell($adresse).fieldToCell($type).fieldToCell($etat).fieldToCell($etatConnexion).fieldToCell($nbVelo).fieldToCell($nbPlace);

    $s.= lineWithDataClasstoTabLine($line, $data);
  }
  $s .= "</tbody>\n";
  $s.="</table>\n";

  return $s;
}


 ?>
