window.addEventListener('load',finalfolowSet);

function finalfolowSet(){

    document.getElementById('abonnes').addEventListener("click",displayPageAbonnes);
}


function displayPageAbonnes() {
let url = `services/getFollowers.php?`;
fetchFromJson(url)
.then(processAnswer)
.then(pageAbonnes);
}

function pageAbonnes(resultat) {
  boutonAbonnement = document.getElementById('abonnes');
  boutonAbonnement.style.backgroundColor = "blue";
  boutonAbonnement.style.color = "white";
  for (var elts of document.querySelectorAll("#Fildemessage,#connexion,#Mesmsg,#Sonprofil,#Monprofil,#abonnement,#deconnexion,#update")) {
    elts.style.backgroundColor = "white";
    elts.style.color = "black";
  }
  for (var elts of document.querySelectorAll("#userProfile,#userMessages,#userTarget,#visitor,#msgcontent,#msgformulaire,#authenfication,#optionFiltre,#Sonprofil,#numeroPg,#poster")) {
      elts.hidden = true;
    }
sectionFollowers = document.querySelector("#userFollowers");
sectionFollowers.textContent = '';
sectionFollowers.hidden = false;
let div = document.createElement('div');
 div.class = 'followers';
if (resultat.length != 0) {
  for (elts of resultat) {
    span = document.createElement('span');
    span.textContent = `${elts.userId} ${elts.pseudo}`;
    span.style.fontWeight = "bolder";
    span.addEventListener('click',sectionFollowers);
    bouton = document.createElement('button');
    bouton.type= "text";
    bouton.name = '' +  `${elts.userId}`;
    bouton.id = "boutonfollowers";
    if ((`${elts.mutual}` == 'true' )) {
      bouton.textContent = "Unfollow";
    }
    else {
      bouton.textContent = "Follow";

    }
    bouton.style.backgroundColor = "aqua";
    bouton.style.color= "white";
    br= document.createElement('br');
    span.addEventListener("clik",gestionOtherProfile);
    div.appendChild(span);
    div.appendChild(bouton);
    div.appendChild(br);
    bouton.addEventListener("click",targetState);
    // bouton.addEventListener("mouseover",colorState);
    // bouton.addEventListener("mouseleave",unColorState);
  }
}
else {
  p = document.createElement('p');
  p.textContent = `vous ne dsposez d'aucun Followers pour le moment,${elts.userId}`;
  div.appendChild(p);
}
sectionFollowers.appendChild(div);
}

// function colorState(event){
// if (this.textContent === "Following") {
//   // this.removeEventListener("mouseover",unColorState);
//   this.style.backgroundColor = "red";
//   this.textContent = "Unfollow";
// }
//
// }
//
// function unColorState(event){
//   if (this.textContent === "Unfollow") {
//   // this.removeEventListener("mouseover",colorState);
//   this.style.backgroundColor = "aqua";
//   this.textContent = "Following";
// }
//
// }
//
//

function targetState(){
  if (this.textContent === "Unfollow") {
    let url = `services/unFollow.php?target=${this.name}`;
    this.textContent = "Follow ?";
    fetchFromJson(url)
    .then(processAnswer);
    // this.style.backgroundColor = "yellow";
    // this.removeEventListener("mouseover",colorState);
    // this.removeEventListener("mouseleave",unColorState);
    // this.style.fontColor = "aqua";

  }
else{
  let url = `services/follow.php?target=${this.name}`;
  this.textContent = "Unfollow ?";
  fetchFromJson(url)
  .then(processAnswer);
  // this.style.backgroundColor = "aqua";
  // this.textContent = "Following";
  // this.addEventListener("mouseover",colorState);
  // this.addEventListener("mouseleave",unColorState);
}

}
