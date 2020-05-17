window.addEventListener('load',displayPagePost);

function displayPagePost(){
  document.getElementById('poster').addEventListener("click",pagePoste);
  document.forms.msg.addEventListener('submit',connectInPoste);
  // document.getElementById('formMsg').addEventListener("click",pagePosteMsg);
}
function pagePoste(){
  let formPoste = document.getElementById('msgformulaire');
  formPoste.hidden = false;
  for (var elts of document.querySelectorAll("#userProfile,#userFollowers,#visitor,#msgcontent,#authenfication,userTarget,#creercompte,#userMessages,#optionFiltre,#numeroPg,#update")) {
      elts.hidden = true;
    }
    for (elts of document.querySelectorAll("header>nav>button,#creercompte")) {
      elts.style.color = "black";
      elts.style.backgroundColor = "white";
    }

}

function connectInPoste(ev){
ev.preventDefault();
let url = "services/postMessage.php";
fetchFromJson(url, {method:"post",body:new FormData(this),credentials:'same-origin'})
.then(processAnswer)
.then(displayPagePosteOk,(error) => {});
}

function displayPagePosteOk(resultat){

  let sectionPoste = document.querySelector('#userMessages');
  sectionPoste.hidden = false;
  for (var elts of document.querySelectorAll("#userProfile,#userFollowers,#visitor,#msgcontent,#msgformulaire,#authenfication,userTarget,#creercompte,#msgformulaire,#optionFiltre,#Sonprofil,#numeroPg")) {
      elts.hidden = true;
    }
    for (elts of document.querySelectorAll('header>nav>button')) {
      elts.style.color = "black";
      elts.style.backgroundColor = "white";
    }
    let buttonAccueil = document.getElementById('Fildemessage');
    buttonAccueil.style.backgroundColor = "blue";
    buttonAccueil.style.color = "white";
    let url = `services/getMessage.php?messageId=${resultat.idMessage}`;
    fetchFromJson(url)
    .then(processAnswer)
    .then(gestionFil)
}
