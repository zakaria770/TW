<?php 

	$url = 'http://vlille.fil.univ-lille1.fr'; 		// path to MEL V'lille stations
	$data = file_get_contents($url); 
	$stations = json_decode($data); 

	

	// foreach ($stations as $station) {
	// 	echo $character->recordid . '<br>';
	// }

?>