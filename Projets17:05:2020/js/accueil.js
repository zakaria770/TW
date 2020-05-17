// gestionPageMonProfile//window.addEventListener("load",initLogin);
window.addEventListener("load",initState);
var user = null;
var indice = 1;
var debut = 0;
var saut = 15;
var state =true;
function initState(){ // initialise l'état de la page
  let identite = document.body.dataset.personne;
  if (identite == null)
    etatDeconnecte();
  else{
    identite = JSON.parse(identite);
    if (identite == null)
      etatDeconnecte();
    else
      etatConnecte(identite);

  }
}


function etatDeconnecte() { // passe dans l'état 'déconnecté'
    gestionFiltreAbonnement(true);
    // cache ou montre des éléments
    for (let elt of document.querySelectorAll('.connecte'))
       elt.hidden=true;
    for (let elt of document.querySelectorAll('.deconnecte'))
       elt.hidden=false;
    // nettoie la partie personnalisée :
    user = null;
    delete(document.body.dataset.personne);
    let buttonAccueil = document.getElementById('Fildemessage');
    buttonAccueil.style.backgroundColor = "blue";
    buttonAccueil.style.color = "white";


    loadPageAccueil('services/findMessages.php?count=15');
}

function etatConnecte(personne) { // passe dans l'état 'connecté'
    user = personne;
    gestionFiltreAbonnement(false);
    // cache ou montre des éléments
    for (let elt of document.querySelectorAll('.deconnecte'))
       elt.hidden=true;
    for (let elt of document.querySelectorAll('.connecte'))
       elt.hidden=false;
    loadPageAccueil('services/findFollowedMessages.php?count=15');
}


function loadPageAccueil(url,b){

  let buttonAccueil = document.querySelector("#Fildemessage");
  let msgformulaire = document.getElementById("userMessages");
  let msgSearch = document.getElementById("optionFiltre");
  let nextPrevbutton = document.getElementById(("numeroPg"));
  nextPrevbutton.hidden = false;
  msgformulaire.hidden = false;
  msgSearch.hidden =false;
  msgformulaire.textContent ='';
  msgSearch.backgroundColor = 'grey';
  let formulaires = document.getElementsByClassName("formulairehidden");
  for (var i = 0; i < formulaires.length; i++) {
    formulaires[i].hidden = true;
  }
  for (var elts of document.querySelectorAll("#userProfile,#userFollowers,#userTarget,#visitor,#msgformulaire,#authenfication,#msgcontent,#Sonprofil,#update")) {
      elts.hidden = true;
    }
    for (elts of document.querySelectorAll("nav>button")) {
      elts.style.backgroundColor = 'white';
      elts.style.color = "black";
    }
    buttonAccueil.style.backgroundColor = "blue";
    buttonAccueil.style.color = "white";
    // let url = 'services/findMessages.php?count=15';
    fetchFromJson(url)
    .then(processAnswer)
    .then(pageAccueil,pageErrorAccueil);
}




function processAnswer(answer) {
console.log(`${answer.status}`);
  if (answer.status == "ok") {
    return answer.result;
  }
  throw new Error(answer.message);
}

function gestionFil(resultat) {
  let sectionPoste = document.querySelector('#userMessages');

  let s = resultat.datetime
  if (/.*[+-][0-9]{2}$/.exec(s)){
    s+=':00';
  }
  let d = new Date(s);
  let dates = d.toLocaleString().split('à'); // renvoie "13/04/2020 à 22:40:28" // le time-shift ne comporte pas les minutes
  // ${dates[0]}
  let date = `<br><span> du ${dates[0]}  ${dates[1]}</span> `;
  h3 = document.createElement('h3');
  h3.innerHTML = `${resultat.author}  ${resultat.pseudo} - ${date}`;
  h3.id = `${resultat.author}`;
  fieldset = document.createElement('fieldset');
  p = document.createElement('p');
  p.textContent = `${resultat.content}`;
  h3.addEventListener('click',gestionOtherProfile);
  fieldset.appendChild(h3);
  fieldset.appendChild(p);
  sectionPoste.appendChild(fieldset);
}

function pageAccueil(resultat){
  for (elts of resultat) {
    gestionFil(elts);
  }
  }

function pageErrorAccueil(tabAnswer){

}
function gestionOtherProfile(){

  let sectionSonProfile = document.getElementById("visitor");
  sectionSonProfile.textContent = '';
  sectionSonProfile.hidden = false;
  let button = document.getElementById("Sonprofil");
  button.hidden = false;
  button.textContent = `@${this.id}`;
  for (var elts of document.querySelectorAll("#userProfile,#userMessages,#userTarget,#userFollowers,#msgformulaire,#authenfication,#numeroPg,#optionFiltre,#poster")) {
    elts.hidden = true;
  }
for (elts of document.querySelectorAll("nav>button")) {
    elts.style.backgroundColor = 'white';
    elts.style.color = "black";}

button.style.backgroundColor = "blue";
button.style.color = "white";

let url = `services/getProfile.php?userId=${this.id}`;
fetchFromJson(url)
.then(processAnswer)
.then((resultat) => {
  gestionPageMonProfile(resultat,sectionSonProfile)
});

}



function gestionSelectUrl() {
  let select = document.getElementById('optFiltre');
  let value = select.value;
  if (value == 'abonnements') {
    let url ='services/findFollowedMessages.php?count=';
    return url;
  }
  if (value == 'auteur') {
      return true
        // let author = document.getElementById('filtre').value.split(' ')[0];
    // let url =`services/findMessages.php?author=${author}&count=`;
    // return url;

  }
  else {
    let url ='services/findMessages.php?count=';
    return url;
  }

}
/*
  gestion du deroulement des pages et leurs boutons sur le fil de message
*/
function gestionSelect(){
  document.getElementById("next").addEventListener("click",nextPage);
  document.getElementById("prev").addEventListener("click",prevPage);
   indice = 1;
   debut = 0;
   saut = 15;
   state =true;
   let url =gestionSelectUrl();
   if (url === true) {
     let msgSearch = document.getElementById("msgcontent");
     msgSearch.hidden = false;
   }
   else{
      loadPageAccueil(url+`${saut}`);
      }
}


function nextPage() {
  if (state==false) {
    document.getElementById("prev").addEventListener("click",prevPage);
    state = true;
  }
  indice+=1;
  debut+=saut;
  let rep = saut*indice;
  let url = gestionSelectUrl();
  if (url === true) {
    let author = document.getElementById('filtre').value.split(' ')[0];
    url = `services/findMessages.php?author=${author}&count=`;
  }
  fetchFromJson(url+`${rep}`)
  .then(processAnswer)
  .then((resultat)=> {
    gestionDeroulementPage(resultat,rep);});
}
function prevPage() {
  if (state==false) {
    document.getElementById("next").addEventListener("click",nextPage);
    state =true;
  }
    indice-=1;
   debut-=saut;
   let rep = saut*indice;
   let url = gestionSelectUrl();
   if (url === true) {
     let author = document.getElementById('filtre').value.split(' ')[0];
     url = `services/findMessages.php?author=${author}&count=`;
   }
  fetchFromJson(url+`${rep}`)
  .then(processAnswer)
  .then((resultat) => {
    gestionDeroulementPage(resultat,rep);
  });
}

function isEmptyArray(tab){

  return tab.length == 0;
}

function gestionDeroulementPage(resultat,rep) {
  // let rep = saut*indice;
  let tab = resultat.slice(debut,rep+1);
  if (isEmptyArray(tab)) {
    state =false;

      if (debut == 0 || debut < 0 ) {
        indice+=1;
        debut+=saut;
         document.getElementById("prev").removeEventListener("click",prevPage);
       }
       else {
         indice-=1;
         debut-=saut;
         document.getElementById("next").removeEventListener("click",nextPage);
       }
  }
  else{
    if (debut == 0 || debut < 0 ) {
       document.getElementById("prev").removeEventListener("click",prevPage);
       state =false;
     }

  let sectionPoste = document.querySelector('#userMessages');
  sectionPoste.textContent ='';
  pageAccueil(tab);
}
}
