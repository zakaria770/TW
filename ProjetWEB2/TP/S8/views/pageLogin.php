
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Authentifiez-vous</title>
</head>
<body>
<?php
 if (isset($_SESSION['echec']))
   echo "<p class='message'>Les login et mot de passe précédemment fournis étaient incorrects</p>";
?>
<h2>Authentifiez-vous</h2>

<form method="POST" action="">
 <fieldset>
  <label for="login">Login :</label>
  <input type="text" name="login" id="login" required="required" autofocus/>
  <label for="password">Mot de passe :</label>
  <input type="password" name="password" id="password" required="required" />
  <button type="submit" name="valid">OK</button>
 </fieldset>
</form>
<p>Pas encore inscrit ? <a href="createUser.php">créez un compte.</a></p>
</body>
</html>


