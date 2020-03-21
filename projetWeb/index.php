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
			});

			// 4 : placer un marqueur
			// let marker = L.marker([50.609614, 3.136635]).addTo(maCarte);
			      // 5 : lui associer un popup
			// marker.bindPopup('Le bâtiment M5 <strong>Formations en Informatique</strong>');

		  
	</script> <br><br>

	<?php 
		// $url = 'data.json'; // ON WEBTP REPLACE WITH  http://vlille.fil.univ-lille1.fr
		$url = 'http://vlille.fil.univ-lille1.fr'; // REPLACE WITH  http://vlille.fil.univ-lille1.fr
		$data = file_get_contents($url); 
		$stations = json_decode($data,true); 


	?>

	<table id="stationsTable">
		<tbody>
			<tr class="tableRow">
				<th class="stationHeader">Numéro de station</th>
				<th class="stationHeader">Nom de station</th>
				<th class="stationHeader">Commune</th>
				<th class="stationHeader">Vélos disponibles</th>
				<th class="stationHeader">Places disponibles</th>
			</tr>
			<?php foreach ($stations as $index=>$station) : ?>
	        <tr class="tableRow">
	        	<td class="stationData"> <?php echo $index; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nom']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['commune']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nbvelosdispo']; ?> </td>
	            <td class="stationData"> <?php echo $station['fields']['nbvelosdispo']; ?> </td>
	        </tr>
			<?php endforeach; ?>
		</tbody>
	</table>





</body>
</html>