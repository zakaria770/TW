<?php
 /*
  * Attend les variables globales :
  *  - $listeEquipes : liste des équipes
  *  - $listeEtapes : liste des étapes
  *  - $stats : tableau de statistiques
  * Variable optionnelle :
  *  - $personne est définie si on est dans une session identifiée
  */
  require_once(__DIR__.'/lib/fonctionsHTML.php');
  $dataPersonne ="";    // si utilisateur non authentifié, data-personne n'est pas défini

  // dé-commenter pour la question 3 :
  if (isset($personne)) // l'utilisateur est authentifié
     $dataPersonne = 'data-personne="'.htmlentities(json_encode($personne)).'"'; // l'attribut data-personne contiendra l'objet personne, en JSON
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <meta charset="UTF-8" />
 <title>Course cycliste, équipe</title>
 <link rel="stylesheet" href="style/styleEquipe.css" />
 <script src="js/fetchUtils.js"></script>
 <script src="js/action_equipe.js"></script>
 <script src="js/action_etape.js"></script>
 <script src="js/action_stats.js"></script>
 <script src="js/gestion_log.js"></script>
</head>
<?php
  echo "<body $dataPersonne>";
?>

  <h1>Course cycliste</h1>
<section id="espace_fixe">
  <nav>
    <a id="bouton_equipe" href="#section_equipe">Équipe</a>
    <a id="bouton_etape" href="#section_etape">Étape</a>
    <a id="bouton_stats" href="#section_stats">Statistiques</a>
  </nav>
  <section id="section_equipe">
    <h2>Équipe</h2>
    <form action="services/getInfoEquipe.php" method = "get" id="form_equipe">
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
    <form action="services/getArrivee.php" method = "get" id="form_etape">
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
 </section>

  <section id="section_stats">
    <h2>Statistiques</h2>
    <div class="resultat">
      <p>Mise à jour :
        <time id="date_stats">
         <?php echo date('d/m/Y H:i:s'); ?>
       </time>
      </p>
      <?php
         echo genericTableToHTML($stats)
      ?>
    </div>
    <div>
     <button id="maj_stats">Mettre à jour</button>
    </div>
  </section>
</section>

<section id="espace_variable">
 <section class="deconnecte">
   <form method="POST" action="services/login.php"  id="form_login">
    <fieldset>
     <legend>Connexion</legend>
     <label for="login">Login :</label>
     <input type="text" name="login" id="login" required="" autofocus=""/></br>
     <label for="password">Mot de passe :</label>
     <input type="password" name="password" id="password" required="required" /></br>
     <button type="submit" name="valid">OK</button></br>
     <output  for="login password" name="message"></output>
    </fieldset>
   </form>
 </section>

 <section class="connecte">
  <img id="avatar" alt="mon avatar" src="" />
  <h2 id="titre_connecte"></h2>
  <button id="logout">Déconnexion</button>
  <div id="gestion_favoris">
    <div id="liste_favoris"></div>
    <form method="POST" action="services/addFavori.php" name="form_add_fav">
      <fieldset>
       <legend>Ajouter un favori </legend>
       <select name="coureur" required="">
       </select>
       <button type="submit" name="valid">Ajouter</button>
       <output name="message"></output>
      </fieldset>
    </form>
  </div>
 </section>
 </section>
</body>
</html>
