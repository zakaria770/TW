<?php
//Auteurs OUAICHOUCHE

require_once("lib/Identite.class.php");
session_start();
if(! isset($_SESSION['ident'])){
  $_SESSION['ident'] = FALSE;
}
?>
<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml">
  <head>
  <title>Page D'accueuil</title>
  <meta charset="utf-8"/>
  <meta name = "authors" content = "KATCHALA MELE Daouda et SACI Thileli"/>
  <link rel="stylesheet" type="text/css" href="data/menu.css"/>
  <script type="text/javascript" src="messageDisplay.js"></script>
  <script type="text/javascript" src="data/menu.js"></script>
  </head>
  <body>
  <div class="colonne">
  <div id="banner">
  <?php
  if ($_SESSION['ident'] != FALSE) {
    echo('<img alt="avatar" id="avatar" src=""/>'."\n");
    echo('<div id ="nom">'.$_SESSION['ident']->getNom().'</div><div id ="pseudo">'.$_SESSION['ident']->getPseudo().'</div>'."\n");
    echo('<button id="deconnexion">Déconnexion</button>');
  }else{
    echo('<h2>Déconnecté</h2>');
  }
  ?>
  </div>
  <?php if($_SESSION['ident'] != FALSE){?>
    <form id="poster" method="post" action="">
      <label for="source">Votre message:</label><br/>
      <input type="text" maxlength="140" name="source" required="required"/>
      <div><input type="submit" value="Envoyer"/></div>
    </form>
    <?php }?>
  <div id="messages"></div>
  </div>
  <div id="utilisateurs" class="colonne">
    <div id = "formulaire">
    <?php
    if ($_SESSION['ident'] == FALSE){
    echo('<button id = "connexion">Se connecter</button><button id = "inscription">S\'inscrire</button>');
    }else{
      echo('<button id="modification">Modifier mon profil</button>');
    }
    ?>
    </div>
    <div id="profil"></div>
    <form id="recherche" method="post" action="">
    	<h4>Rechercher des utilisateurs</h4>
    	<input type="text" name="searched"/><br/>
    	<fieldset>
    	<legend></legend>
    		<input type="radio" name="scope" value="both" checked>les deux</input>
    		<input type="radio" name="scope" value="ident">pseudo</input>
    		<input type="radio" name="scope" value="name">nom</input>
    	</fieldset>
    	<input type="submit" value="rechercher"/></div>
    </form>
  </div>
  </body>
</html>
