<?php
/*  argument : une liste (table) de coureurs.
 *  chaque élément de la liste est une table associative avec les clés 'equipe','dossard', 'nom'
 *  résultat : chaîne contenant le code HTML d'une table présentant ces infos
 */
function coureursToHTML($table){
    $res="";
    $res.="<table>";
    $res.="<tr>";
    $res.="<th>Equipe</th>";
    $res.="<th>Dossard</th>";
    $res.="<th>Nom</th>";
    $res.="</tr>";
    for ($i=0; $i <count($table) ; $i++) {
      $res.="<tr>";
      $res.="<td>{$table[$i]["equipe"]}</td>";
      $res.="<td>{$table[$i]["dossard"]}</td>";
      $res.="<td>{$table[$i]["nom"]}</td>";
      $res.="</tr>";
    }
    $res.="</table>";
    return $res;
}

/*  argument : une liste (table) d'équipes
 *  résultat : chaîne contenant le code HTML d'une liste d'<option>
 *  chaque option affiche le nom de l'équipe suivi, entre parenthèses, de la couleur de l'équipe
 *  l'attribut value aura pour contenu le nomde de l'équipe seul.
 */
function equipesToOptionsHTML($liste){
    $res="";
    for ($i=0; $i <count($liste) ; $i++){
      $res.="<option value=\"{$liste[$i]["nom"]}\">{$liste[$i]["nom"]}</option>";
    }
    return $res;
}


/*
 * argument :  table associative avec les clés 'nom', 'couleur' 'directeur'
 * résultat : représentation HTML de ces informations (div contenant 3 span, par exemple)
 **/
function equipeToHTML($infoEquipe){
    // compléter à la question 3
}



?>
