<?php
/* Salah Zakaria OUAICHOCUHE */
 /*
  * Attend les variables globales :
  *  - $listeEquipes : liste des équipes
  *  - $listeEtapes : liste des étapes
  *  - $stats : tableau de statistiques
  */
  require_once(__DIR__.'/lib/fonctionsHTML.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <meta charset="UTF-8" />
 <title>Course cycliste, équipe</title>
 <link rel="stylesheet" href="style/styleEquipe.css" />
 <!--<script src="js/switching.js"></script>-->
 <script src="js/fetchUtils.js"></script>
 <script src="js/action_equipe.js"></script>
 <script src="js/action_etape.js"></script>
 <script src="js/action_stats.js"></script>
</head>

<body>
  <h1>Course cycliste</h1>
  <nav>
    <a id="bouton_equipe" href="#section_equipe">Équipe</a>
    <a id="bouton_etape" href="#section_etape">Étape</a>
    <a id="bouton_stats" href="#section_stats">Statistiques</a>
  </nav>
  <section id="section_equipe">
    <h2>Équipe</h2>
    <form action="" method = "get" id="form_equipe">
     <fieldset>
        <legend>Équipe</legend>
        <select name="equipe">
         <?php echo equipesToOptionsHTML($listeEquipes); ?>  
        </select><br />
        <button type="submit" name="valid" value="envoyer">Envoyer</button>
      </fieldset>
    </form>
    <div class="resultat"></div>
  </section>

  <section id="section_etape">
    <h2>Arrivée d'étape</h2>
    <form action="" method = "get" id="form_etape">
     <fieldset>
        <legend> Étape</legend>
        <select name="etape">
           <?php echo etapesToOptionsHTML($listeEtapes); ?>
        </select><br />
        <button type="submit" name="valid" value="envoyer">Envoyer</button>
      </fieldset>
    </form>
    <div class="resultat">
    </div>

<section id="section_stats">
    <h2>Statistiques</h2>
    <div class="resultat">
      <p>Mise à jour : <time id="date_stats">
       <?php echo date('d/m/Y H:i:s'); ?>
      </time></p>

      <?php
         echo genericTableToHTML($stats)
      ?>
    </div>
    <div>
     <button id="maj_stats">Mettre à jour</button>
    </div>

  </section>

 </body>
