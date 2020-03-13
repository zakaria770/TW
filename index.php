<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <title>Projet V'Lille</title>
        <meta charset='UTF-8'/>

        <link rel='stylesheet' href='style/projet.css' />
        <link rel='stylesheet' href='https://unpkg.com/leaflet@1.0.3/dist/leaflet.css' />

		<script src='https://unpkg.com/leaflet@1.0.3/dist/leaflet.js'></script>
		<script src='scripts/scriptCarteVLille.js'></script>
    </head>

    <body>
    
    
    <header>
        <p id='entete'>
            <a href='scripts/test.php'>Accueil</a>   <a href='scripts/formFilter.php'>Filtre</a> 
        </p>
    </header>


    <?php 
    	include 'scripts/data.php';
    ?>

    <!-- <nav id='tableauVLille'>		
    	<table id=tableJSON>
					<thead>
						<tr>
							<th>NameStation</th>
							<th>Commune</th>
							<th>Vélo disponibles</th>
							<th>Place disponibles</th>
						</tr>

					<tbody>
						<tr  data-lat='50.63589' data-lon='3.062471' data-nameStation="Rihour" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="ANGLE PLACE RIHOUR RUE JEAN ROISIN" data-typeCB='AVEC TPE' data-velodispo='21' data-espace='11' data-libelle='10' >
							<td>Rihour</td>
							<td>LILLE</td>
							<td>21</td>
							<td>11</td>
						</tr>

						<tr  data-lat='50.64584' data-lon='3.112744' data-nameStation="Mendes France" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="MONS EN BAROEUL" data-adresse="BD NAPOLEON 1ER" data-typeCB='SANS TPE' data-velodispo='6' data-espace='12' data-libelle='104' >
							<td>Mendes France</td>
							<td>MONS EN BAROEUL</td>
							<td>6</td>
							<td>12</td>
						</tr>

						<tr  data-lat='50.651337' data-lon='3.08945' data-nameStation="Avenue de Mormal" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="16, RUE DU BUISSON" data-typeCB='SANS TPE' data-velodispo='8' data-espace='10' data-libelle='113' >
							<td>Avenue de Mormal</td>
							<td>LILLE</td>
							<td>8</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.64891' data-lon='3.078336' data-nameStation="Botanique" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LA MADELEINE" data-adresse="185, AVENUE DE LA RÉPUBLIQUE" data-typeCB='SANS TPE' data-velodispo='11' data-espace='5' data-libelle='116' >
							<td>Botanique</td>
							<td>LA MADELEINE</td>
							<td>11</td>
							<td>5</td>
						</tr>

						<tr  data-lat='50.641834' data-lon='3.022364' data-nameStation="College Lavoisier" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LAMBERSART" data-adresse="56, RUE PAUL VAILLANT" data-typeCB='SANS TPE' data-velodispo='15' data-espace='2' data-libelle='118' >
							<td>College Lavoisier</td>
							<td>LAMBERSART</td>
							<td>15</td>
							<td>2</td>
						</tr>

						<tr  data-lat='50.644855' data-lon='3.013238' data-nameStation="Pont superieur" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LOMME" data-adresse="ANGLE DE LA RUE AUGUSTE BONTE  ET DU N°520 DE L’AVENUE DE DUNKERQUE" data-typeCB='AVEC TPE' data-velodispo='7' data-espace='9' data-libelle='121' >
							<td>Pont superieur</td>
							<td>LOMME</td>
							<td>7</td>
							<td>9</td>
						</tr>

						<tr  data-lat='50.665348' data-lon='3.075792' data-nameStation="Rue de l'Eglise" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="MARCQ EN BAROEUL" data-adresse="71, RUE NATIONALE" data-typeCB='AVEC TPE' data-velodispo='10' data-espace='7' data-libelle='123' >
							<td>Rue de l'Eglise</td>
							<td>MARCQ EN BAROEUL</td>
							<td>10</td>
							<td>7</td>
						</tr>

						<tr  data-lat='50.64057' data-lon='3.115571' data-nameStation="Le Polyedre" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="MONS EN BAROEUL" data-adresse="FACE AU 38, AVENUE RHIN ET DANUBE" data-typeCB='SANS TPE' data-velodispo='10' data-espace='6' data-libelle='126' >
							<td>Le Polyedre</td>
							<td>MONS EN BAROEUL</td>
							<td>10</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.61606' data-lon='3.132006' data-nameStation="Centre Commercial V2" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="VILLENEUVE D'ASCQ" data-adresse="BOULEVARD VALMY" data-typeCB='AVEC TPE' data-velodispo='13' data-espace='6' data-libelle='132' >
							<td>Centre Commercial V2</td>
							<td>VILLENEUVE D'ASCQ</td>
							<td>13</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.655098' data-lon='3.051201' data-nameStation="Bailly" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="SAINT ANDRE LEZ LILLE" data-adresse="FACE AU 4 RUE GAMBETTA" data-typeCB='SANS TPE' data-velodispo='12' data-espace='3' data-libelle='155' >
							<td>Bailly</td>
							<td>SAINT ANDRE LEZ LILLE</td>
							<td>12</td>
							<td>3</td>
						</tr>

						<tr  data-lat='50.673943' data-lon='3.163443' data-nameStation="Edhec" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="CROIX" data-adresse="272, RUE VERTE" data-typeCB='SANS TPE' data-velodispo='13' data-espace='17' data-libelle='201' >
							<td>Edhec</td>
							<td>CROIX</td>
							<td>13</td>
							<td>17</td>
						</tr>

						<tr  data-lat='50.688015' data-lon='3.174815' data-nameStation="Alfred Mongy" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="15, BOULEVARD DU GÉNÉRAL DE GAULLE" data-typeCB='SANS TPE' data-velodispo='11' data-espace='13' data-libelle='206' >
							<td>Alfred Mongy</td>
							<td>ROUBAIX</td>
							<td>11</td>
							<td>13</td>
						</tr>

						<tr  data-lat='50.64193' data-lon='3.061774' data-nameStation="Place du Concert" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="RUE ALPHONSE COLAS" data-typeCB='AVEC TPE' data-velodispo='9' data-espace='11' data-libelle='21' >
							<td>Place du Concert</td>
							<td>LILLE</td>
							<td>9</td>
							<td>11</td>
						</tr>

						<tr  data-lat='50.68859' data-lon='3.182028' data-nameStation="Lannoy" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="93, RUE DE LANNOY" data-typeCB='SANS TPE' data-velodispo='4' data-espace='14' data-libelle='213' >
							<td>Lannoy</td>
							<td>ROUBAIX</td>
							<td>4</td>
							<td>14</td>
						</tr>

						<tr  data-lat='50.6795' data-lon='3.179257' data-nameStation="Saint Jean-Baptiste" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="1, RUE LESUEUR" data-typeCB='AVEC TPE' data-velodispo='7' data-espace='5' data-libelle='214' >
							<td>Saint Jean-Baptiste</td>
							<td>ROUBAIX</td>
							<td>7</td>
							<td>5</td>
						</tr>

						<tr  data-lat='50.681797' data-lon='3.194122' data-nameStation="Fraternite" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="PLACE DE LA FRATERNITÉ" data-typeCB='AVEC TPE' data-velodispo='12' data-espace='4' data-libelle='216' >
							<td>Fraternite</td>
							<td>ROUBAIX</td>
							<td>12</td>
							<td>4</td>
						</tr>

						<tr  data-lat='50.64124' data-lon='3.064987' data-nameStation="Louise de Bettignies" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="PLACE LOUISE DE BETTIGNIES" data-typeCB='AVEC TPE' data-velodispo='16' data-espace='14' data-libelle='22' >
							<td>Louise de Bettignies</td>
							<td>LILLE</td>
							<td>16</td>
							<td>14</td>
						</tr>

						<tr  data-lat='50.6941' data-lon='3.172165' data-nameStation="Les Gobelins" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="32, RUE DE LA COMMUNAUTÉ URBAINE" data-typeCB='SANS TPE' data-velodispo='4' data-espace='8' data-libelle='222' >
							<td>Les Gobelins</td>
							<td>ROUBAIX</td>
							<td>4</td>
							<td>8</td>
						</tr>

						<tr  data-lat='50.683987' data-lon='3.16327' data-nameStation="Epeule Montesquieu" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="RUE INKERMAN" data-typeCB='SANS TPE' data-velodispo='10' data-espace='6' data-libelle='225' >
							<td>Epeule Montesquieu</td>
							<td>ROUBAIX</td>
							<td>10</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.699436' data-lon='3.159658' data-nameStation="Bvrd Armentieres" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="1, BOULEVARD D'ARMENTIÈRES" data-typeCB='SANS TPE' data-velodispo='5' data-espace='13' data-libelle='227' >
							<td>Bvrd Armentieres</td>
							<td>ROUBAIX</td>
							<td>5</td>
							<td>13</td>
						</tr>

						<tr  data-lat='50.639107' data-lon='3.065548' data-nameStation="Rue des Arts" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="41 RUE DES ARTS" data-typeCB='SANS TPE' data-velodispo='7' data-espace='11' data-libelle='23' >
							<td>Rue des Arts</td>
							<td>LILLE</td>
							<td>7</td>
							<td>11</td>
						</tr>

						<tr  data-lat='50.7004' data-lon='3.161378' data-nameStation="Alsace" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="ROUBAIX" data-adresse="89, BOULEVARD D'ARMENTIÈRES" data-typeCB='AVEC TPE' data-velodispo='8' data-espace='8' data-libelle='234' >
							<td>Alsace</td>
							<td>ROUBAIX</td>
							<td>8</td>
							<td>8</td>
						</tr>

						<tr  data-lat='50.72075' data-lon='3.152659' data-nameStation="Theatre Tourcoing" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="1, RUE DE L'ALMA" data-typeCB='AVEC TPE' data-velodispo='7' data-espace='10' data-libelle='238' >
							<td>Theatre Tourcoing</td>
							<td>TOURCOING</td>
							<td>7</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.718204' data-lon='3.15749' data-nameStation="Victoire" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="FACE AU 1 PLACE DE LA VICTOIRE" data-typeCB='SANS TPE' data-velodispo='5' data-espace='7' data-libelle='243' >
							<td>Victoire</td>
							<td>TOURCOING</td>
							<td>5</td>
							<td>7</td>
						</tr>

						<tr  data-lat='50.724686' data-lon='3.165703' data-nameStation="Jardin Botanique" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="126, RUE VERTE" data-typeCB='AVEC TPE' data-velodispo='4' data-espace='14' data-libelle='245' >
							<td>Jardin Botanique</td>
							<td>TOURCOING</td>
							<td>4</td>
							<td>14</td>
						</tr>

						<tr  data-lat='50.72271' data-lon='3.163794' data-nameStation="Cavell" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="FACE AU 49 RUE DE LA CLOCHE" data-typeCB='SANS TPE' data-velodispo='6' data-espace='6' data-libelle='246' >
							<td>Cavell</td>
							<td>TOURCOING</td>
							<td>6</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.728798' data-lon='3.158835' data-nameStation="Rue Saint Blaise" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="85, RUE DE GAND" data-typeCB='AVEC TPE' data-velodispo='4' data-espace='8' data-libelle='248' >
							<td>Rue Saint Blaise</td>
							<td>TOURCOING</td>
							<td>4</td>
							<td>8</td>
						</tr>

						<tr  data-lat='50.728798' data-lon='3.154051' data-nameStation="Rue de Menin" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="FACE AU 40 RUE JOURDAN" data-typeCB='SANS TPE' data-velodispo='3' data-espace='9' data-libelle='249' >
							<td>Rue de Menin</td>
							<td>TOURCOING</td>
							<td>3</td>
							<td>9</td>
						</tr>

						<tr  data-lat='50.63603' data-lon='3.069678' data-nameStation="Gare Lille Flandres" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="PLACE DE LA GARE" data-typeCB='AVEC TPE' data-velodispo='10' data-espace='10' data-libelle='25' >
							<td>Gare Lille Flandres</td>
							<td>LILLE</td>
							<td>10</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.72551' data-lon='3.156554' data-nameStation="Colbert" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="RUE DE GAND (FACE AU LYCÉE)" data-typeCB='SANS TPE' data-velodispo='7' data-espace='11' data-libelle='251' >
							<td>Colbert</td>
							<td>TOURCOING</td>
							<td>7</td>
							<td>11</td>
						</tr>

						<tr  data-lat='50.710735' data-lon='3.159881' data-nameStation="Carliers" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="TOURCOING" data-adresse="135, CHAUSSÉE GALILÉE" data-typeCB='AVEC TPE' data-velodispo='8' data-espace='4' data-libelle='258' >
							<td>Carliers</td>
							<td>TOURCOING</td>
							<td>8</td>
							<td>4</td>
						</tr>

						<tr  data-lat='50.63457' data-lon='3.068007' data-nameStation="Molinel" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="58 RUE DU MOLINEL" data-typeCB='SANS TPE' data-velodispo='12' data-espace='10' data-libelle='26' >
							<td>Molinel</td>
							<td>LILLE</td>
							<td>12</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.69626' data-lon='3.209156' data-nameStation="Stalingrad" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="WATTRELOS" data-adresse="38-4 RUE DE STALINGRAD" data-typeCB='SANS TPE' data-velodispo='6' data-espace='6' data-libelle='263' >
							<td>Stalingrad</td>
							<td>WATTRELOS</td>
							<td>6</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.63413' data-lon='3.041209' data-nameStation="Place Catinat" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="199 RUE COLBERT" data-typeCB='AVEC TPE' data-velodispo='10' data-espace='10' data-libelle='34' >
							<td>Place Catinat</td>
							<td>LILLE</td>
							<td>10</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.62224' data-lon='3.067004' data-nameStation="Rue d'Arras" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="4 RUE WAZEMMES" data-typeCB='AVEC TPE' data-velodispo='13' data-espace='12' data-libelle='50' >
							<td>Rue d'Arras</td>
							<td>LILLE</td>
							<td>13</td>
							<td>12</td>
						</tr>

						<tr  data-lat='50.6318' data-lon='3.071392' data-nameStation="Mairie de Lille" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="17 RUE SAINT SAUVEUR" data-typeCB='AVEC TPE' data-velodispo='0' data-espace='20' data-libelle='64' >
							<td>Mairie de Lille</td>
							<td>LILLE</td>
							<td>0</td>
							<td>20</td>
						</tr>

						<tr  data-lat='50.633728' data-lon='3.055307' data-nameStation="Place de Strasbourg" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="7 PLACE DE STRASBOURG" data-typeCB='SANS TPE' data-velodispo='6' data-espace='10' data-libelle='7' >
							<td>Place de Strasbourg</td>
							<td>LILLE</td>
							<td>6</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.634045' data-lon='3.030778' data-nameStation="Bois Blancs" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="122 AVENUE DE DUNKERQUE" data-typeCB='AVEC TPE' data-velodispo='3' data-espace='15' data-libelle='71' >
							<td>Bois Blancs</td>
							<td>LILLE</td>
							<td>3</td>
							<td>15</td>
						</tr>

						<tr  data-lat='50.637302' data-lon='3.024314' data-nameStation="Canteleu" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="237 AVENUE DE DUNKERQUE" data-typeCB='SANS TPE' data-velodispo='12' data-espace='6' data-libelle='72' >
							<td>Canteleu</td>
							<td>LILLE</td>
							<td>12</td>
							<td>6</td>
						</tr>

						<tr  data-lat='50.61307' data-lon='3.047221' data-nameStation="Cimetiere du Sud" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="65 RUE DU FAUBOURG DES POSTES" data-typeCB='AVEC TPE' data-velodispo='13' data-espace='7' data-libelle='79' >
							<td>Cimetiere du Sud</td>
							<td>LILLE</td>
							<td>13</td>
							<td>7</td>
						</tr>

						<tr  data-lat='50.63529' data-lon='3.115088' data-nameStation="Guinguette" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE HELLEMMES" data-adresse="RUE JACQUARD" data-typeCB='SANS TPE' data-velodispo='5' data-espace='5' data-libelle='81' >
							<td>Guinguette</td>
							<td>LILLE HELLEMMES</td>
							<td>5</td>
							<td>5</td>
						</tr>

						<tr  data-lat='50.63999' data-lon='3.075204' data-nameStation="Gare Lille Europe" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="299 BOULEVARD DE LEEDS" data-typeCB='AVEC TPE' data-velodispo='15' data-espace='17' data-libelle='82' >
							<td>Gare Lille Europe</td>
							<td>LILLE</td>
							<td>15</td>
							<td>17</td>
						</tr>

						<tr  data-lat='50.63665' data-lon='3.091106' data-nameStation="Rue de la Gaite" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="9 RUE MARCEAU" data-typeCB='SANS TPE' data-velodispo='10' data-espace='8' data-libelle='92' >
							<td>Rue de la Gaite</td>
							<td>LILLE</td>
							<td>10</td>
							<td>8</td>
						</tr>

						<tr  data-lat='50.63041' data-lon='3.097037' data-nameStation="Marbrerie" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE HELLEMMES" data-adresse="280 BIS RUE PIERRE LEGRAND" data-typeCB='AVEC TPE' data-velodispo='14' data-espace='4' data-libelle='95' >
							<td>Marbrerie</td>
							<td>LILLE HELLEMMES</td>
							<td>14</td>
							<td>4</td>
						</tr>

						<tr  data-lat='50.639828' data-lon='3.106677' data-nameStation="Lacordaire" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="MONS EN BAROEUL" data-adresse="44 RUE LACORDAIRE (FACE A LA PISCINE)" data-typeCB='SANS TPE' data-velodispo='6' data-espace='10' data-libelle='103' >
							<td>Lacordaire</td>
							<td>MONS EN BAROEUL</td>
							<td>6</td>
							<td>10</td>
						</tr>

						<tr  data-lat='50.63422' data-lon='3.096542' data-nameStation="Square des Meres" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="95 RUE DE LANNOY" data-typeCB='SANS TPE' data-velodispo='17' data-espace='8' data-libelle='91' >
							<td>Square des Meres</td>
							<td>LILLE</td>
							<td>17</td>
							<td>8</td>
						</tr>

						<tr  data-lat='50.63579' data-lon='3.033977' data-nameStation="Marx Dormoy" data-etat='EN SERVICE' data-connexion='CONNECTEE' data-commune="LILLE" data-adresse="RUE DE BORDEAUX" data-typeCB='SANS TPE' data-velodispo='8' data-espace='16' data-libelle='94' >
							<td>Marx Dormoy</td>
							<td>LILLE</td>
							<td>8</td>
							<td>16</td>
						</tr>

					</tbody>

		</table>

	</nav> -->



	<!-- <div id="dataTable">
		
		<table>
			<tbody>
				<tr>
					<th>Nom de station</th>
					<th>Communce</th>
					<th>Vélos disponibles </th>
					<th>Places disponibles</th>

				</tr>
				<?php 
				foreach ($stations as $station) : 
				?>
		        <tr>
		            <td> <?php 
		            		echo $station->fields->nom; 
		            		?> 
		            </td>

		            <td> <?php 
		            		echo $station->fields->commune; 
		            		?> 
		            </td>

		            <td> <?php 
		            		echo $station->fields->nbVelosDispo; 
		            		?> 
		            </td>

		            <td> <?php 
		            		echo $station->fields->nbPlacesDispo; 
		            		?> 
		            </td>

		        </tr>
				<?php 
					// endforeach; 
				?>
			</tbody>
		</table>
	</div> -->
	
	<section id= 'GrandeCarte'>
		    <div id='carteVLille'></div>
	
	<section id='infoComplete'>
	<div id='miniCarte'></div>
	
    
		<p id='Informations'></p>
	</section>
	</section>
	
	</div>

    </body>
</html>