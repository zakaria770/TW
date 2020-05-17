<form action="services/getProfile.php" method="post" id = "formupdating">

<section id='rezozio'>
  <span> REZOZIO</span><br>
  <span>Mettez a jour votre Profile</span>

</section>
<section id= 'informations'>
  <span> Un nouveau pseudo ? </span>
  <input type="text" name="pseudo" id="pseudoUp" placeholder="pseudo"></br>
  <span> Un nouveau mot de passe ? </span>
  <input type="password" name="password" id="pswUp" required="required" placeholder="Password"/></br>
  <span> Une description sur vous ? </span>
  <input type="text" name="description"  placeholder="entrez votre description" id ="descriptionUp">
  <output  for="pseudo password description" name="message"></output>
</section>
<!-- <button type="button" name="buttonpasse" id= 'passe'> Continuer </button> -->
<button type="submit" name="valid" id="fin">Terminer</button></br>

  <!-- <button type="button" name="fin" id="fin"> Terminer</button> -->

</form>
