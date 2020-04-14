<?php
/* Page demandée à la question 1
* Ce script attend une variable globale $tableCoureurs : liste de coureurs
*    chaque élément de la liste est une table associative avec au minimum les clés 'equipê' 'dossard', 'nom'
*/
 require_once('lib/fonctionsHTML.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Résultat de la requête</title>
        <link rel="stylesheet" href="style/styleQ1.css" />
    </head>

    <body>
        <?php
            echo coureursToHTML($tableCoureurs);
        ?>
    </body>
</html>