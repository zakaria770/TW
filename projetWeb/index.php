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
  	<script type="text/javascript" src="scripts/vlilleScript.js"></script>
  	<script type="text/javascript" src="scripts/VliveImage.js"></script>
</head>

<body>


	<table id="banner">
	  <tr>
	    <td width="60%"><img src="images/vLille4.jpg" height="500" width="850"></td>
	    <td style="font-family: 'Shrikhand', cursive; font-size: 40px;" width="40%"> Simplifiez-vous la vie !  <br> Simplifiez-vous le trajet!</td>
	  </tr>
	</table><br>


	<div style="text-align:center;">
		<a href="#mapDiv"><button class="button button3">Nos stations à votre disposition</button></a>

		<a href="#stationsTable"><button class="button button3">Notre réseau Vlille</button></a>

		<a href="#filterDiv"><button class="button button2">Filtrer</button></a>

		<a href="#footerDivID" ><button class="button button2">A propos</button></a>
	</div> <br>


	<?php 
			// $url = 'data.json'; // SOURCE SUR SERVEUR LOCAL 
			$url = 'http://vlille.fil.univ-lille1.fr'; // SUR SERVEUR WEBTP : http://vlille.fil.univ-lille1.fr
			$data = file_get_contents($url); 
			$stations = json_decode($data,true); 

			$station1Latitude = $stations[0]['fields']['localisation'][0];
			$station1Longitude = $stations[0]['fields']['localisation'][1];
			$nbrVelos = $station['fields']['nbvelosdispo'];
			$nbrPlaces = $station['fields']['nbplacesdispo'];
			// echo $station1;

	?>

	<div id="mapDiv" style="height: 800px;">
		
		<p>
		<ul id="villes" style="
			float: right; 
			width: 700px;
			height: 700px; 
			display: inline-block;
		    
		    padding: 0px;
		    list-style-type: circle;
		    margin: 0;
		    ">
			 <?php foreach ($stations as $index=>$station) : ?>
				<li style="display:inline;font-size: 15pt;
				    list-style-type: none;
				    padding: 0px 10px;
				    border: dotted 1px black;
				    border-radius: 60px;
				    width: 150px;
				    margin: 5px; "

				    data-geo="[<?php echo $station['fields']['localisation'][0]; ?> , <?php echo $station['fields']['localisation'][1]; ?>]" data-nbrVelos="<?php echo $station['fields']['nbvelosdispo']; ?> " > - <?php echo $station['fields']['nom']; ?>

					
				</li>

			<?php endforeach; ?>
	  
	  
		</ul>
		
		<div id="carte_campus" style="width : 600px; height : 600px;float: left; margin-right: 50px;">
			
		</div>

		<div>
			


			<script type="text/javascript">
				

					window.addEventListener('DOMContentLoaded', ()=>{
					      // 1 : création
					  maCarte = L.map('carte_campus');
					  
					      // 2 : choix du fond de carte
					  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					    attribution: '©️ OpenStreetMap contributors'
					  }).addTo(maCarte);
					  
					  let pointsList = [];
					  for (let item of document.querySelectorAll('#villes>li')){

					    let nom = item.textContent;
					    let geoloc = JSON.parse(item.dataset.geo);
					    // let nbrVelos = JSON.parse(item.dataset.nbrVelos);



					    // let marker = L.marker(geoloc).addTo(maCarte).bindPopup(nom);
					    // let marker = L.marker( geoloc, {icon:image.getLeafletIcon()} ).addTo(maCarte).bindPopup(nom);

					    let marker = L.marker(geoloc).addTo(maCarte).bindPopup(nom);
					    pointsList.push(geoloc);					    
					    setupListeners(item,marker);
					  }
					  if (pointsList.length>0)
					    maCarte.fitBounds(pointsList);
					 

					});


					function setupListeners(item, marker){
					    item.addEventListener('click', ()=>{
					      marker.openPopup();
					      setCurrent(item);
					      maCarte.setView(marker.getLatLng(),13);
					    });
					    marker.on("click", ()=>{
					      setCurrent(item);
					      maCarte.setView(marker.getLatLng(),13);
					    });
					}

					{
					let itemCourant = null;

					function setCurrent(item){
					    if (itemCourant)
					        itemCourant.classList.toggle('current');
					    itemCourant = item;
					    itemCourant.classList.toggle('current');  
					}
					}
			</script>
		</div>
	</p> 
	</div>



	<div id="filterDiv">
		<input type="text" id="nomStationInput" onkeyup="filterNomStation()" placeholder="Filtrer par nom de station" title="Type in a name" style="width: 250px; height:50px; font-size:20px;">

		<input type="text" id="communeInput" onkeyup="filterCommune()" placeholder="Filtrer par commune" title="Type in a name" style="width: 250px; height:50px; font-size:20px;">

		<input type="text" id="velosDispoInput" onkeyup="filterVelosDispo()" placeholder="Filtrer par vélos disponibles" title="Type in a name" style="width: 250px; height:50px; font-size:20px;">

		<input type="text" id="placesDispoInput" onkeyup="filterPlacesDispo()" placeholder="Filtrer par nombre de places" title="Type in a name" style="width: 250px; height:50px; font-size:20px;">

	<input type="text" id="etatInput" onkeyup="filterEtat()" placeholder="Filtrer par  état" title="Type in a name" style="width: 250px; height:50px; font-size:20px;">
	</div>

	<table id="stationsTable">
		<tbody>
			<tr class="tableRow header">
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
	</table> <br><br>

		<script>

			function filterNomStation() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("nomStationInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("stationsTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[1];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
			}

			function filterCommune() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("communeInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("stationsTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[2];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
			}

			function filterVelosDispo() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("velosDispoInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("stationsTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[3];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
			}


			function filterPlacesDispo() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("placesDispoInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("stationsTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[4];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
			}


			function filterEtat() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("etatInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("stationsTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[5];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
			}
	</script>


	


	<hr>
	<div class="footerDiv" id="footerDivID" style="background-color: white">
	  <table style="color: black;">
	  	<tr>
	  		<td style="width:1000px;">Nos services</td>
	  		<td >A propos</td>
	  	</tr>

	  	<tr>
	  		<td><a href="#banner">Accueil</a></td>
	  		<td><a href="credits.php">Crédits</a></td>
	  	</tr>

	  	<tr>
	  		<td><a href="#mapDiv">Nos stations à votre disposition</a></td>
	  	</tr>

	  	<tr>
	  		<td><a href="#stationsTable">Notre réseau MEL</a></td>
	  	</tr>
	  </table>
	</div>





</body>
</html>