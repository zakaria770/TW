//Auteurs OUAICHOUCHE

var formu = null;

function setupListeners(){
  formu = document.getElementById("formulaire");
   var form = document.getElementById("inscription");
   if (form){
    form.addEventListener("click",displayFormSignIn);
  }
   var form1 = document.getElementById("connexion");
   if (form1)
    form1.addEventListener("click",displayFormConnect);
   var form2 = document.getElementById("modification");
   if(form2){
    form2.addEventListener("click", displayFormModif);
    displayInfos({pseudo:document.getElementById("pseudo").textContent, nom:document.getElementById("nom").textContent});
  }
   var deco = document.getElementById("deconnexion");
   if(deco)
    deco.addEventListener("click", logout);
   document.getElementById("recherche").addEventListener("submit", findUsers);
   form3 = document.getElementById("poster");
   if (form3)
    form3.addEventListener("submit", sendMessage);
   findMessages();
   /*document.querySelector('input[name="searched"]').addEventListener("keyup", function(){document.getElementById("recherche").submit();});*/
}




function findUsers(ev){
		ev.preventDefault();
		var req = new XMLHttpRequest();
		req.open("POST","services/findUsers.php");
		req.timeout=1000;
		req.addEventListener("load",afficheProfils);
		req.addEventListener("error",erreur);
		var data = new FormData(this);
    req.send(data);
}

function findAUser(ev){
    ev.preventDefault();
    var pseudo = this.dataset.ident;
    var req = new XMLHttpRequest();
    req.open("GET","services/findUsers.php?scope=ident&searched="+pseudo);
    req.timeout=1000;
    req.addEventListener("load",displayProfil);
    req.addEventListener("error",erreur);
    req.send();
}

function createUser(ev){
    ev.preventDefault();
    var req = new XMLHttpRequest();
    req.open("POST","services/createUser.php");
    req.timeout=1000;
    req.addEventListener("load",reponseInscrit);
    req.addEventListener("error",erreurInscription);
    var data = new FormData(this);
    req.send(data);

}

function login(ev){
  ev.preventDefault();
  var req = new XMLHttpRequest();
  req.open("POST","services/login.php");
  req.timeout = 1000;
  req.addEventListener("load",reponseLogin);
  req.addEventListener("error", erreurConnexion);
  var data = new FormData(this);
  req.send(data);
}

function logout(ev){
  ev.preventDefault();
  var req = new XMLHttpRequest();
  req.open("POST","services/logout.php");
  req.timeout = 1000;
  req.addEventListener("load",reponseLogout);
  req.addEventListener("error", erreurConnexion);
  req.send();
}

function setProfil(ev){
  ev.preventDefault();
  var req = new XMLHttpRequest();
  req.open("POST","services/setProfil.php");
  req.timeout = 1000;
  req.addEventListener("load",reponseSetProfil);
  req.addEventListener("error", erreur);
  var data = new FormData(this);
  req.send(data);
}

function uploadAvatar(ev){
  ev.preventDefault();
  var req = new XMLHttpRequest();
  req.open("POST","services/uploadAvatar.php");
  req.timeout = 1000;
  req.addEventListener("load",reponseUploadAvatar);
  req.addEventListener("error", erreur);
  var data = new FormData(this);
  req.send(data);
}

function sendMessage(ev){
  ev.preventDefault();
  var req = new XMLHttpRequest();
  req.open("POST", "services/postMessage.php");
  req.addEventListener("load", findMessages);
  req.addEventListener("error", erreur);
  var data = new FormData(this);
  req.send(data);
}

function getMessage(id){
  var req = new XMLHttpRequest();
  req.open("GET", "services/getMessage.php?id="+id);
  req.addEventListener("load", afficheMessage);
  req.addEventListener("error", erreur);
  req.send();
}

function findMessages(){
  var req = new XMLHttpRequest();
  req.open("GET", "services/findMessages.php");
  req.addEventListener("load", afficheMessages);
  req.addEventListener("error", erreur);
  req.send();
}

function disableForm(form, setDisable){
  for (var field of form)
     field.disabled = setDisable;
}

function erreur(){
  div = formu;
  div.clearMessage();
  div.innerHTML += '<p class="infoMessage">Erreur : la requête a échoué</p>';
}

function erreurInscription(form){
  document.forms.inscription.innerHTML += '<p class="infoMessage">Erreur : la requête a échoué</p>';
  disableForm(document.forms.inscription, false);
}

function erreurConnexion(form){
  document.forms.connexion.innerHTML += '<p class="infoMessage">Erreur : la requête a échoué</p>'
  disableForm(document.forms.connexion, false);
}

function reponseInscrit(ev){
  var reponse;
  try {
      reponse = JSON.parse(this.responseText);
  } catch(e) {
      reponse = null;
  }
  if ( !reponse || !reponse.status || reponse.status !="ok"){
      if(!reponse){
        document.forms.inscription.innerHTML += '<p class="infoMessage">Erreur : l\'inscription a échoué</p>';
      }else{

        document.forms.inscription.innerHTML += '<p class="infoMessage">Erreur : ' + reponse.message + '</p>';
      }
  } else {
      document.forms.inscription.innerHTML += '<p class="infoMessage">vous êtes inscrit.</p>';
  }
}

function reponseLogin(ev){
  var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
  }
  if ( !reponse || !reponse.status || reponse.status !="ok"){
      if(!reponse){
        document.forms.connexion.innerHTML += '<p class="infoMessage">Erreur : la connexion a échoué</p>';
      }else{
        document.forms.connexion.innerHTML += '<p class="infoMessage">Erreur : ' + reponse.message + '</p>';
      }
  } else {
      //document.forms.connexion.innerHTML += '<p class="infoMessage">vous êtes connecté(e).</p>'
      displayMessageZone();
      formu.innerHTML = '<button id="modification">Modifier mon profil</button>';
      document.getElementById("modification").addEventListener("click", displayFormModif);
      displayInfos(reponse.result);
  }
}

function reponseLogout(){
  var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
  }
  if ( !reponse || !reponse.status || reponse.status !="ok"){
      document.getElementById("banner").innerHTML += '<p class="infoMessage">Erreur : la déconnexion a échoué</p>';
  } else {
      document.getElementById("banner").innerHTML = "<h1>"+ reponse.result.pseudo +" est Déconnecté</h1>";
      displayButtons();
      document.querySelector(".colonne").removeChild(document.getElementById("poster"));
  }
}

function reponseSetProfil(){
  var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
  }
  if ( !reponse || !reponse.status || reponse.status !="ok"){
    if (!reponse){
      formu.innerHTML += '<p class="infoMessage">Erreur : la modification à échouée.</p>';
    }else{
       formu.innerHTML += '<p class="infoMessage">Erreur : ' + reponse.message + '</p>'
    }
  } else {
      formu.innerHTML = '<button id="modification">Modifier mon profil</button>';
      document.getElementById("modification").addEventListener("click", displayFormModif);
      displayInfos(reponse.result);
    }
}

function reponseUploadAvatar(){
  var reponse;
  try{
  reponse = JSON.parse(this.responseText);}
  catch(e){
    reponse = null;
     formu.innerHTML += '<p class="infoMessage">Erreur : la modification d\'avatar à échouée.</p>';
  }
}

function afficheProfils(){
	var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
    formu.innerHTML+= '<p class="infoMessage">Erreur</p>';
  }
  if(reponse.status == "ok"){
    clearProfils();
  	for(var i = 0; i<reponse.result.length; i++){
	  	user2Element(reponse.result[i]);
  	}
  }
}

function afficheMessages(){
  var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
    document.getElementById("messages").innerHTML+= '<p class="infoMessage">Erreur d\'envoie</p>';
  }

  if (reponse.status == "ok"){
    document.getElementById("messages").innerHTML = "";
    for (i of reponse.result){
      a(i);
    }
  }
}

function a(i){
  var message = new MessageDisplay(i.contenu);
      var img = document.createElement("img");
      img.alt = "avatar";
      var pseudo = document.createElement("span");
      pseudo.classList.add("pseudo");
      pseudo.textContent = i.auteur;
      message.article.insertBefore(pseudo, message.article.firstChild);
      var r = new XMLHttpRequest();
      r.open("GET","services/getAvatar.php?pseudo="+i.auteur);
      r.responseType="blob";
      r.addEventListener("load",function(ev){ ev.preventDefault(); img.src = URL.createObjectURL(this.response);
        message.article.insertBefore(img,pseudo);
        document.getElementById("messages").appendChild(message.article);});
      r.send();
}

function user2Element(user){
	var div = document.createElement("div");
	div.classList.add("utilisateur");
	var img = document.createElement("img");
	img.alt = "avatar";
  //récuperation de l'image
  var r = new XMLHttpRequest();
  r.open("GET","services/getAvatar.php?pseudo="+user.pseudo);
  r.responseType="blob";
  r.addEventListener("load",function(ev){ ev.preventDefault(); var im = URL.createObjectURL(this.response);
  img.src = im;
  var pseudo = document.createElement("span");
  pseudo.classList.add("pseudo");
  pseudo.dataset.ident=user.pseudo;
  pseudo.textContent = user.pseudo;
  var nom = document.createElement("span");
  nom.classList.add("nom");
  nom.textContent = user.nom;

  div.appendChild(img);
  div.appendChild(nom);
  div.appendChild(pseudo);
  document.getElementById("recherche").appendChild(div); });
  r.send();
}

function clearProfils(){
  var profils = document.querySelectorAll(".utilisateur");
  div = document.getElementById("recherche");
  for(var i=0;i<profils.length;i++){
    div.removeChild(profils[i]);
  }
}

function addMessage(form, message, isError){
  var zone = document.createElement('p');
  zone.textContent = message;
  zone.classList.add("infoMessage");
  if (isError){
      zone.classList.add("error");
  }
  form.appendChild(zone);
}
function displayInfos(infos){

  var zone = '<div id ="nom">' + infos.nom + '</div><div id ="pseudo">'+ infos.pseudo + '</div>' + "\n";
  zone += '<button id="deconnexion">Déconnexion</button>'
  document.getElementById("banner").innerHTML = '<img alt="avatar" id="avatar" src=""/>';
  document.getElementById("banner").innerHTML += zone;
  document.getElementById("deconnexion").addEventListener("click", logout);
  requestAvatar(infos.pseudo);

}

function displayButtons(){
  formu.innerHTML = '<button id = "connexion">Se connecter</button>\n<button id = "inscription">S\'inscrire</button>\n';
  document.getElementById("connexion").addEventListener("click", displayFormConnect);
  document.getElementById("inscription").addEventListener("click", displayFormSignIn);
}

function displayFormModif(){
  formu.innerHTML = '<form id="modification" enctype="multipart/form-data" method="post" action="">\
      <label for="description">Description :</label><input type="text" name="description" width="200px heigth="200px"/>\
      <br/><label for="password">Mot de passe :</label><input type="text" name="password" />\
      <br/><label for="nom">Nom:</label><input type="text" name="nom"/><br>\
      <label for="avatar">Avatar:</label><input type="file" name="avatar"/>\
      <div><input type="submit" value="Modifier votre profil"/></div>\
    </form>';
  formu.innerHTML += '<br/><button id=retour>retour</button>';
  document.getElementById("retour").addEventListener("click", function(){ formu.innerHTML = '<button id="modification">Modifier mon profil</button>';
      document.getElementById("modification").addEventListener("click", displayFormModif);});
  document.getElementById("modification").addEventListener("submit", setProfil);
  document.getElementById("modification").addEventListener("submit", uploadAvatar);
}

function displayFormConnect(){
  formu.innerHTML = '<form id="connexion" method="post" action="">\
      <label for="pseudo">Pseudo :</label><input type="text" name="pseudo" required="required" autofocus="autofocus"/>\
      <br/><label for="password">Mot de passe :</label><input type="text" name="password" required="required" />\
      <div><input type="submit" value="Se connecter"/></div>\
    </form>'
    formu.innerHTML += '<br/><button id=retour>retour</button>';
  document.getElementById("retour").addEventListener("click", displayButtons);
    document.getElementById("connexion").addEventListener("submit", login);
}

function displayFormSignIn(){
  formu.innerHTML = '<form id="inscription" enctype="multipart/form-data" method="post" action="">\
      <label for="pseudo">Pseudo :</label><input type="text" name="pseudo" required="required" autofocus="autofocus"/>\
      <br/><label for="password">Mot de passe :</label><input type="text" name="password" required="required" />\
      <br/><label for="nom">Nom:</label><input type="text" name="nom" required="required"/><br>\
      <label for="avatar">Avatar:</label><input type="file" name="avatar"/>\
      <div><input type="submit" value="S\'inscrire"/></div>\
    </form>';
  formu.innerHTML += '<br/><button id=retour>retour</button>';
  document.getElementById("retour").addEventListener("click", displayButtons);
  document.getElementById("inscription").addEventListener("submit", createUser);
  document.getElementById("inscription").addEventListener("submit", uploadAvatar);
}

function displayMessageZone(){
  document.querySelector(".colonne").innerHTML = '<form id="poster" method="post" action="">\
      <label for="source">Votre message:</label><br/>\
      <input type="text" maxlength="140" name="source" required="required"/>\
      <div><input type="submit" value="Envoyer"/></div>\
    </form>' + document.querySelector(".colonne").innerHTML;
  document.getElementById("poster").addEventListener("submit", sendMessage);
}

function displayProfil(){
  var reponse;
  try{
    reponse = JSON.parse(this.responseText);
  } catch(e){
    reponse = null;
    formu.innerHTML+= '<p class="infoMessage">Erreur</p>';
  }
  if(reponse.status == "ok"){
    var profil = document.getElementById("profil");
    profil.innerHTML = "";
    var i = reponse.result[0];
      var img = document.createElement("img");
      img.alt = "avatar";
      var pseudo = document.createElement("span");
      pseudo.classList.add("pseudo");
      pseudo.textContent = i.pseudo;
      var nom = document.createElement("span");
      nom.classList.add("nom");
      nom.textContent = i.nom;
      var r = new XMLHttpRequest();
      r.open("GET","services/getAvatar.php?size=large&pseudo="+i.pseudo);
      r.responseType="blob";
      r.addEventListener("load",function(ev){ ev.preventDefault(); img.src = URL.createObjectURL(this.response);
        profil.appendChild(img);profil.appendChild(nom);profil.appendChild(pseudo);});
      r.send();
  }
}

function clearMessage(){ // eventListener de "change" sur un champ de saisie
  var zone = this.querySelectorAll(".infoMessage");
  for (var i=0; i<zone.length(); i++){
    this.removeChild(zone[i]);
  }
}

/*----- exemple de récupération d'une image via XMLHttpRequest---*/

function requestAvatar(pseudo){ // envoi de la requête
  var r = new XMLHttpRequest();
  r.open("GET","services/getAvatar.php?pseudo="+pseudo);
  r.responseType="blob";  // on précise que la donnée reçue devra être rangée dans un Blob (Binary Large OBject)
  r.addEventListener("load",receiveAvatar);
  r.send();
}
function receiveAvatar(ev){
  var sr = URL.createObjectURL(this.response);
  document.getElementById("avatar").src = sr;
}
window.addEventListener("load",setupListeners);
