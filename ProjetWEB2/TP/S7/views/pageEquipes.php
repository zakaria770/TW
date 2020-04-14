<?php
 /*
  * Attend la variable globale :
  *  - $equipes : liste des équipes
  *
  * Prend en compte les variables optionnelles suivantes (questions 3 et 4)
  *  - $equipeChoisie : nom d'équipe recherchée (NULL ou "" si pas d'équipe choisie)
  *  - $infoEquipe : informations détaillées sur l'équipe, ou NULL si l'équipe n'existe pas
  *  - $members : liste des membres de l'équipe (pour la question 4)
  *
  *  NB : à la question 2, seule la variable $equipeChoisie est définie
  */
  require_once('lib/fonctionsHTML.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <meta charset="UTF-8" />
 <title>Course cycliste, équipe</title>
 <link rel="stylesheet" href="style/styleEquipe.css" />
</head>

<body>
 <form action="" method = "get">
   <fieldset>
      <legend>Équipe</legend>
      <label>Nom  de l'equipe:
       <select name="equipe">
        <?php
         echo equipesToOptionsHTML($equipes);
        ?>
       </select>
      </label>
      <button type="reset">Effacer</button>
      <button type="submit" name="valid" value="envoyer">Envoyer</button>
   </fieldset>
 </form>
 
  <?php
    if (isset($equipeChoisie) && $equipeChoisie != "")
       require(__DIR__.'/components/sectionReponseEquipe.php');
       // NB : __DIR__ désigne le path du fichier contenant le script en cours d'exécution.
  ?>
</body>
