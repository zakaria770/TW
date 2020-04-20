window.addEventListener('load',initFormUpload);
/* 
* initialisation
*/
function initFormUpload(ev){ // ev : Event
  document.forms.upload_image.addEventListener('submit',sendForm);
}

/*
* Listener de l'évènement 'submit' sur le formulaire
* la fonction s'exécute donc dans le contexte du formulaire (this = le formulaire)
*/
function sendForm(ev){ // ev : Event
  ev.preventDefault(); // empêche l'envoi 'normal' du formulaire
  let formData = new FormData(this); // objet contenant les données du formulaire
  let url = this.action;
  fetchFromJson(url, {method : 'post', body : formData, 'credentials': 'same-origin'}).then(afficheResultat);
  // envoi du formulaire en mode post. la réponse, si elle est reçue, sera traitée par afficheResultat
}

/*
* Affiche dans la zone de message le résultat de l'opération
*/
function afficheResultat(resultat){ // resultat est l'objet JSON envoyé par le service uploadAvatar.php
  let texte;
  if (resultat.status == "ok")
    texte = "Avatar enregistré";
  else {
    texte = "Échec : " + resultat.message;
  }
  document.getElementById('message').textContent = texte;
}
