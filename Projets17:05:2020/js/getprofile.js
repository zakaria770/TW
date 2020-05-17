window.addEventListener("load",listennergetprofile);

function listennergetprofile() {

  var monprofil = document.getElementById("Monprofil");
  monprofil.addEventListener('click',setprofil);

}

function setprofil(){
  let buttonProfile = document.getElementById("Monprofil");
  let sectionprofil = document.getElementById('userProfile');
  sectionprofil.hidden = false;
  sectionprofil.textContent = '';
  buttonProfile.style.backgroundColor = "blue";
  buttonProfile.style.color = "white";

  for (var elts of document.querySelectorAll("#userMessages,#userFollowers,#userTarget,#visitor,#msgcontent,#Sonprofil,#optionFiltre,#numeroPg,#poster,#update")) {
    elts.hidden = true;
  }

  for (var elts of document.querySelectorAll("#Fildemessage,#connexion,#Mesmsg,#Sonprofil,#abonnement,#abonnes,#deconnexion")) {
    elts.style.backgroundColor = "white";
    elts.style.color = "black";

  }
  let url = `services/getProfile.php?userId=${user}`;
  fetchFromJson(url)
  .then(processAnswer)
  .then((resultat) => {

    gestionPageMonProfile(resultat,sectionprofil)});
}



function pageErrorProfil(tabAnswer){



}
