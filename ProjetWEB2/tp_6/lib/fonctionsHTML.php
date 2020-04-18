<?php
/*  argument : une liste (table) de coureurs.
 *  chaque élément de la liste est une table associative avec les clés 'equipe','dossard', 'nom'
 *  résultat : chaîne contenant le code HTML d'une table présentant ces infos
 */
function coureursToHTML($table){
    // compléter à la question 1
$string='<table>';
$s='';
$head='<tr>';
foreach ($table as $coureurs){
$head='<tr>';
$s.='<tr>';
foreach ($coureurs as $info=>$value){
$head.='<td>'.$info.'</td>';
$s.='<td>'.$value.'</td>';
    }
  }
$s.='</td>';
$string.=$head.'</tr>'.$s.'</table>';
return $string;}



/*  argument : une liste (table) d'équipes
 *  résultat : chaîne contenant le code HTML d'une liste d'<option>
 *  chaque option affiche le nom de l'équipe suivi, entre parenthèses, de la couleur de l'équipe
 *  l'attribut value aura pour contenu le nomde de l'équipe seul.
 */
function equipesToOptionsHTML($liste){
    // compléter à la question 2
}


/*
 * argument :  table associative avec les clés 'nom', 'couleur' 'directeur'
 * résultat : représentation HTML de ces informations (div contenant 3 span, par exemple)
 **/
function equipeToHTML($infoEquipe){
    // compléter à la question 3
}



?>
