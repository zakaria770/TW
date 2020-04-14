<!DOCTYPE html>
<!--Salah Zakaria OUAICHOUCHE & Chaymaa ZOUHRI-->
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <title>Projet V'Lille</title>
        <meta charset='UTF-8' />
        <link rel="shortcut icon" href='../images/icon.png'>
        <link rel='stylesheet' href='../style/projet.css' />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
		    <script  type="text/javascript"  src="../script/projet.js"></script>


    </head>

    <body>

    <div id="content">
      <div class="entete">
        <div class="logo">
          <img src="../images/vlille.png" alt="logo">
        </div>
        <div class="texte">
          <p>V'Lille</p>
          <p>Disponibilité en temps réel</p>
        </div>
      </div>

      <div class="ligne"></div>

      <?php
      if (isset($errorMessage)){
         echo "<section id='errorMessage'>\n";
         echo "  	<p> Erreur : $errorMessage</p>\n"; // à améliorer
         echo "</section>\n";
      }
       ?>

      <div id="formulaire">
        <form action="vlille.php" method = "get">
          <fieldset id="formulaire">
            <legend> Choisissez vos critères </legend>

            <?php
            require('lib/functions.php');

            echo InputTypeText("libelle", "libelle", "Libelle");
            echo InputTypeText("nom", "nom", "Nom");
            echo InputTypeText("commune", "commune", "Commune");
            echo InputTypeText("adresse", "adresse", "Adresse");

            echo listToCheckBox('type', TYPES);
            echo listToCheckBox('etat', ETATS);


            echo InputTypeText("nbvelosdispo", "nbvelosdispo", "nb Vélos disponibles");
            echo InputTypeText("nbplacesdispo", "nbplacesdispo", "nb places disponibles");
            ?>
          </fieldset>


          <fieldset>
            <legend> Trier par </legend>
              <select name="tri">
                <?php
                echo selectOption("libelle", "Libelle", true);
                echo selectOption("nom", "Nom");
                echo selectOption("commune", "Commune");
                echo selectOption("adresse", "Adresse");
                echo selectOption("nbVelos", "Nb Vélos dispo");
                echo selectOption("nbPlaces", "Nb places dispo");
                ?>
              </select>
          </fieldset>

          <fieldset>
            <button type="reset">Effacer</button>
            <button type="submit" name="valid" value="envoyer">Envoyer</button>
          </fieldset>

        </form>
      </div>

      <nav>
      <?php
         echo fieldsToTable($fields);
       ?>
     </nav>

     <div id='GrandeCarte'></div>

     <footer>
       <div class="footer">
         <img src="../images/MEL.png" alt="logo MEL">
         <div><a href="../credit/credit.php">crédit</a></div>
       </div>
    </footer>
  </div>

</body>
</html>
