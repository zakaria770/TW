<section id="authentification" >
   <form method="POST" action="services/login.php"  id="formlogin" class="formulairehidden">
    <fieldset>
     <!-- <legend>Connexion</legend> -->
     <h3> Se connecter a Rezozio </h3>
     <!-- <label for="login">Login :</label> -->
     <input type="text" name="login" id="loginInput" required="" autofocus="" placeholder="login"/></br>
     <!-- <label for="password">Mot de passe :</label> -->
     <input type="password" name="password" id="password" required="required" placeholder="password" /></br>
     <button type="submit" name="valid">se connecter</button></br>
     <output  for="login password" name="message"></output>
    </fieldset>
   </form>
   <!-- <p> <strong><button type="button" name="button"> Creer un Compte ? </button></strong> </p> -->
 </section>

 <section id="register" class="formulairehidden" >
    <form method="POST" action="services/createUser.php"  id="form_register">
     <fieldset>
       <h3>Creer votre compte</h3>
      <input type="text" name="userId" id="login" required="" autofocus="" placeholder="Login"/></br>
      <input type="text" name="pseudo" id="pseudo" required="" autofocus="" placeholder="Pseudo"/></br>
      <input type="password" name="password" id="password" required="required" placeholder="Password"/></br>
      <button type="submit" name="valid">Creer votre compte </button></br>
      <output  for="login password" name="message"></output>
     </fieldset>

    </form>
  </section>
