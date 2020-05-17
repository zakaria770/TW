<?php

  $dataPersonne ="";    // si utilisateur non authentifié, data-personne n'est pas défini

  // dé-commenter pour la question 3 :
  if (isset($personne)) // l'utilisateur est authentifié
    $dataPersonne = 'data-personne="'.htmlentities(json_encode($personne)).'"'; // l'attribut data-personne contiendra l'objet personne, en JSON
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <meta charset="UTF-8" />
 <title>Rezozio</title>
 <!-- <link rel="stylesheet" href="style/styleEquipe.css" /> -->
 <script src="js/fetchUtils.js"></script>
 <script src="js/help.js"></script>
 <script src="js/accueil.js"></script>
 <script src="js/getprofile.js"></script>
 <script src="js/log.js"></script>
 <script src="js/gestion_abonnement.js"></script>
 <script src="js/gestion_abonne.js"></script>
 <script src="js/gestion_poste.js"></script>
 <script src="js/gestionUpdate.js"></script>

</head>
<?php
  echo "<body $dataPersonne>";
?>

<header id="menu">
  <h1 id= "titre"> Rezozio </h1>
  <nav>
    <button type="button" name="button1" id= "Fildemessage"> Fil des Messsages</button>
    <button type="button" name="button2" id= "connexion" class="deconnecte"> Connexion</button>
    <button type="button" name="button5" id= "Monprofil" class="connecte"> Mon Profil</button>
    <button type="button" name="button6" id= "Sonprofil" class="connecte"> Son Profil</button>
    <button type="button" name="button7" id= "abonnement" class="connecte"> Mes Abonnements</button>
    <button type="button" name="button8" id= "abonnes" class="connecte"> Mes Abonnes</button>
    <button type="button" name="button3" id= "deconnexion" class="connecte"> Deconnexion</button>
  </nav>
</header>
<button type="button" name="button" id="poster" class="connecte">Poster du contenu</button>
<section id="userProfile" class="connecte">

</section>

  <section id="optionFiltre">
    <span>Trier Message par : </span>
    <select id="optFiltre" name="" >
      <option value="vide" id="vide"> </option>
      <option value="abonnements" id="option_connecte"> Abonnements </option>
      <option value="all" class="on_off"> Tous les  messages </option>
      <option value="auteur" class="on_off">  Auteur </option>
    </select>
    <button type="button" name="button" id="trie">ok</button>
  </section>
  <section id="msgcontent" >
    <input type="text" name="searchedString" placeholder="saissisez ici le nom d'un utilisateur" list="users" id = 'filtre'>
    <datalist id="users">


    </datalist>
    <button type="submit" name="valid" id="Ok">OK</button></br>

  </section>
  <button type="button" name="button9" id= "creercompte" class="deconnecte"> S'inscrire</button>

<!-- // importer la page de connexion et deconnexion  -->

  <?php
    require_once('views/formMessage.php');
  ?>
  <?php
  require_once('views/formUserProfil.php');
  ?>


  <section id="userMessages" class="connecte">

  </section>

  <section id= 'numeroPg'>
    <button type="button" name="prev" id="prev"> < </button>
    <button type="button" name="next" id="next"> > </button>
  </section>

  <section id="userFollowers" class="connecte">

  </section>
  <section id="userTarget" class="connecte">

  </section>

  <section id="visitor" class="connecte">

  </section>

<section id= 'update' class="connecte">
  <?php
    require_once('views/pageUpdateProfile.php');
  ?>

</section>




























</body>
</html>
