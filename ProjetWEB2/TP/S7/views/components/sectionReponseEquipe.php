 <?php
 /*
  * Attend les variables globales :
  *  - $equipeChoisie : nom d'équipe recherchée (NULL ou "" si pas d'équipe choisie)
  *  - $infoEquipe : informations détaillées sur l'équipe, ou NULL si l'équipe n'existe pas
  *  
  *  - $members : liste des membres de l'équipe  (pour la question 4)
  */require_once('lib/fonctionsHTML.php');
 ?>
 <section id="reponse">
   <h4>Recherche de l'équipe <?php echo $equipeChoisie; ?></h4>
  <?php
  if ($infoEquipe != NULL) {
     echo equipeToHTML($infoEquipe);
     // question 4
   
     // fin question 4 
  }
  else
     echo "<p>Aucune équipe de ce nom n'existe</p>";
  ?>
</section>