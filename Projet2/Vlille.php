<?php
    require('lib/functions.php');
    $reponse = json_decode(file_get_contents("http://vlille.fil.univ-lille1.fr"),true);//c est une var php
    $arrayFields= getArrayFields($reponse); //c est le tabl qui contient la valeur de field/pour construire liste
    $arrayCommune=getArrayPossibilites($arrayFields,"commune");//si $arrayFields[key][commune] n est pas une valeur du tab on la retourne ds un tab
    $arrayNoms = getArrayPossibilites($arrayFields,"nom");//si $arrayFields[key][nom] n est pas une valeur du tab on la retourne ds un tab
    require('views/vlilleHTML.php');

    //je dois avoir un resultat avec le formulaire ou il y a la commune et station choisis



?>
