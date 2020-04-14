<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Crédit projet V'Lille</title>
    <p>Salah Zakaria OUAICHOUCHE(G3) & Chaymaa ZOUHRI(G1)</p>
    
    <meta charset='UTF-8' />
    <link rel="shortcut icon" href='../images/icon.png'/>
    <link rel='stylesheet' href='../style/projet.css' />

  </head>
  <body>
    <div class="ligne">
     <p><a href="../accueil/vlille.php">Retour à la page d'acceuil</a></p>
    </div>
    <div id="main">

      <?php
      require_once("lib/functionsCredit.php");
      $credits = loadCredits("data/credit.txt");
      echo creditsToHTML($credits);
       ?>

    </div>

  </body>
</html>
