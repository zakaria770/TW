<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="lib/style1.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
        <script type="text/javascript" src="lib/Vlille.js"></script>

    </head>

    <body id="body">
      <div id="contents" >
      <header>
        <form method="get" target="Vlille.php">
          <?php
            echo constructSelectForForm($arrayCommune,"commune");
            echo constructSelectForForm($arrayNoms,"nom");


           ?>
           <button type="submit">valider</button>
        </form>
      </header>

      <div id="carte"></div>
      <h1> ilevia : le transport de la <span id="mel">MEL</span><h1>
        <h2> louer nos velos..... decouvrez votre ville comme jamais auparavant <h2>
          <h3> nos stations lilloises : </h3>
    </div>

    
    <?php
    echo getListeHtml($arrayFields); ?>

    </body>
</html>
