window.addEventListener('load',finalSet);

function finalSet(){
    document.getElementById('abonnement').addEventListener("click",displayPageAbonnement);
    // document.getElementById('abonnes').addEventListener("click",displayPageAbonnes);
}


function displayPageAbonnement() {
let url = `services/getSubscriptions.php?`;
fetchFromJson(url)
.then(processAnswer)
.then(pageAbonnement);
}

function pageAbonnement(resultat) {
  sectionTarget = document.querySelector("#userTarget");
  sectionTarget.textContent = '';
  sectionTarget.hidden = false;
  boutonAbonnement = document.getElementById('abonnement');
  boutonAbonnement.style.backgroundColor = "blue";
  boutonAbonnement.style.color = "white";
  for (var elts of document.querySelectorAll("#Fildemessage,#connexion,#Mesmsg,#Sonprofil,#Monprofil,#abonnes,#deconnexion")) {
    elts.style.backgroundColor = "white";
    elts.style.color = "black";
  }
  for (var elts of document.querySelectorAll("#userProfile,#userMessages,#userFollowers,#visitor,#msgcontent,#msgformulaire,#authenfication,#Sonprofil,#optionFiltre,#numeroPg,#poster,#update")) {
      elts.hidden = true;
    }
let div = document.createElement('div');
div.id = 'following';
if (resultat.length != 0) {
  for (elts of resultat) {
    span = document.createElement('span');
    span.textContent = `${elts.userId} ${elts.pseudo}`;
    span.style.fontWeight = "bolder";
    span.addEventListener('click',sectionTarget);
    bouton = document.createElement('button');
    bouton.type= "text";
    bouton.name = '' +  `${elts.userId}`;
    bouton.id = "boutonfollowing";
    bouton.textContent = "Following";
    bouton.style.backgroundColor = "aqua";
    bouton.style.color= "white";
    br= document.createElement('br');
    div.appendChild(span);
    div.appendChild(bouton);
    div.appendChild(br);
    bouton.addEventListener("click",followState);
    bouton.addEventListener("mouseover",colorState);
    bouton.addEventListener("mouseleave",unColorState);
  }
}
else {
  p = document.createElement('p');
  p.textContent = "vous ne dsposez d'aucun abonnement pour le moment";
  div.appendChild(p);
}
sectionTarget.appendChild(div);
}

function colorState(event){
if (this.textContent === "Following") {
  // this.removeEventListener("mouseover",unColorState);
  this.style.backgroundColor = "red";
  this.textContent = "Unfollow";
}

}

function unColorState(event){
  if (this.textContent === "Unfollow") {
  // this.removeEventListener("mouseover",colorState);
  this.style.backgroundColor = "aqua";
  this.textContent = "Following";
}

}



function followState(){
  if (this.textContent === "Unfollow") {
    let url = `services/unFollow.php?target=${this.name}`;
    this.textContent = "Follow ?";
    fetchFromJson(url)
    .then(processAnswer);
    this.style.backgroundColor = "yellow";
    this.removeEventListener("mouseover",colorState);
    this.removeEventListener("mouseleave",unColorState);
    // this.style.fontColor = "aqua";

  }
else{
  let url = `services/follow.php?target=${this.name}`;
  this.textContent = "Unfollow";
  fetchFromJson(url)
  .then(processAnswer);
  this.style.backgroundColor = "aqua";
  this.textContent = "Following";
  this.addEventListener("mouseover",colorState);
  this.addEventListener("mouseleave",unColorState);
}

}
