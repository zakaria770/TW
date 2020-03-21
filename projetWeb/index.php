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

		  
	</script>





</body>
</html>