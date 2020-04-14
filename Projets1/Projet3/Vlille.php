<?php
    require('lib/functions.php');
    $reponse = json_decode(file_get_contents("http://vlille.fil.univ-lille1.fr"),true);
    $arrayFields= getArrayFields($reponse);
    $arrayCommune=getArrayPossibilites($arrayFields,"commune");
    $arrayNoms = getArrayPossibilites($arrayFields,"nom");
    require('views/vlilleHTML.php');

 ?>
