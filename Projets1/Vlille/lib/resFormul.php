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
      <!--<header>
        <form method="get" target="../Vlille.php">



            //ici  je dois afficher le formulaire a remplir
            //en utulisant la fonction qui cree le formulaire a partir
            //echo constructSelectForForm($arrayCommune,"commune");
            //echo constructSelectForForm($arrayNoms,"nom");



           <button type="submit">valider</button>
        </form>
      </header> -->

      <div id="carte"></div>
      <h1> ilevia : le transport de la <span id="mel">MEL</span><h1>
        <h2> louer nos velos..... decouvrez votre ville comme jamais auparavant <h2>
          <h3> nos stations lilloises : </h3>
    </div>




      	<table border="2" id=tableJSON>
					<thead>
						<tr>
							<th>NameStation</th>
							<th>Commune</th>
							<th>Vélo disponibles</th>
							<th>Place disponibles</th>
						</tr>

					<tbody>
            <?php
            //ici j appele la fct qui cree la liste (nom de station/commune/velo disponible/place disponible)
            require('lib/functions.php');
            $reponse = json_decode(file_get_contents("http://vlille.fil.univ-lille1.fr"),true);//c est une var php
            $arrayFields= getArrayFields($reponse);
            echo resFormulaire($arrayFields);


             ?>

          </tbody>

        </table>

    </nav>

    </body>
</html>
