<!DOCTYPE html>
<html>
<head>
	<title>VLille </title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="Projet Vlille" />
	<meta name="keywords" content="station vélo lille,vélo lille" />
	<meta name="author" content="Salah Zakaria OUAICHOUCHE">
	<link rel="stylesheet" type="text/css" href="style.css">

	<link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">

	<!-- intégration de la map leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
  	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>

  	<script type="text/javascript" src="scripts/vlilleScript.php"></script>
</head>

<body>


	<table id="banner">
	  <tr>
	    <td width="60%"><img src="images/vLille1.jpg" height="500" width="850"></td>
	    <td style="font-family: 'Shrikhand', cursive; font-size: 40px;" width="40%"> Simplifiez-vous la vie !  <br> Simplifiez-vous le trajet!</td>
	  </tr>
	</table><br>


	<div style="text-align:center;">
		<button class="button button3">Notre réseau Vlille</button>
		<button class="button button2">Filtrer</button>
	</div> <br>

	<div id="carte_campus" >
		
	</div>

	<?php 
		// $url = 'data.json'; // SOURCE SUR SERVEUR LOCAL 
		$url = 'http://vlille.fil.univ-lille1.fr'; // SUR SERVEUR WEBTP : http://vlille.fil.univ-lille1.fr
		$data = file_get_contents($url); 
		$stations = json_decode($data,true); 

		$station1Latitude = $stations[0]['fields']['localisation'][0];
		$station1Longitude = $stations[0]['fields']['localisation'][1];
		// echo $station1;

	?>

	<!-- Ajout des marqueurs sur la carte -->
	



	<ul id="villes">
		 <?php foreach ($stations as $index=>$station) : ?>
			<li data-geo="[<?php echo $station['fields']['localisation'][0]; ?> , <?php echo $station['fields']['localisation'][1]; ?>]"><?php echo $station['fields']['nom']; ?></li>

		<?php endforeach; ?>
	  
	  <!-- <li data-geo="[50.62278,3.14417]">Villeneuve-d'Ascq</li> -->
	  
	</ul>

	<script type="text/javascript">



			window.addEventListener('DOMContentLoaded', ()=>{
			      // 1 : création
			  let maCarte = L.map('carte_campus');
			  
			      // 2 : choix du fond de carte
			  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			    attribution: '©️ OpenStreetMap contributors'
			  }).addTo(maCarte);
			    
			      // 3 : réglage de la partie visible (centre, niveau de zoom)
			  maCarte.setView([50.61, 3.14], 14);

			  // placerMarqueurs(maCarte);
			  // 4 : placer un marqueur
			var station1LatitudeLiteral="<?php echo $station1Latitude; ?>";
			var station1LongitudeLiteral="<?php echo $station1Longitude; ?>";
			// alert(station1LatitudeLiteral);
			// alert(station1LongitudeLiteral);

			// let marker = L.marker([50.609614, 3.136635]).addTo(maCarte);
		    // 5 : lui associer un popup
		  	// marker.bindPopup('Le bâtiment M5 <strong>Formations en Informatique</strong>');




		  	let pointsList = [];
			 for (let item of document.querySelectorAll('#villes>li')){
			    // item est le noeud DOM d'un <li>
			    let nom = item.textContent;
			    let geoloc = JSON.parse(item.dataset.geo);
			    L.marker(geoloc).addTo(maCarte).bindPopup(nom);
			    pointsList.push(geoloc);
			}
			       // réglage de la partie visible
			if (pointsList.length>0)
			    maCarte.fitBounds(pointsList);
			});


		  
	</script> <br><br>


	

	<table id="stationsTable">
		<tbody>
			<tr class="tableRow">
				<th class="stationHeader">Numéro de station</th>
				<th class="stationHeader">Nom de station</th>
				<th class="stationHeader">Commune</th>
				<th class="stationHeader">Vélos disponibles</th>
				<th class="stationHeader">Places disponibles</th>
				<th class="stationHeader">Etat</th>
			</tr>

			<?php foreach ($stations as $index=>$station) : ?>

	        <tr class="tableRow">
	        	<td class="stationData"> <?php echo $index; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nom']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['commune']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nbvelosdispo']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nbvelosdispo']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['etat']; ?> </td>
	        </tr>

			<?php endforeach; ?>
		</tbody>
	</table>

	





</body>
</html>