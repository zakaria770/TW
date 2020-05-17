// window.addEventListener("load",gestionUpdateListenner);

// function gestionUpdateListenner(){
//   boutonUpdt = document.getElementById("boutonUpdate");
//   boutonUpdt.addEventListener('click',gestionUpdate);
// }
// let newwin = window.open('views/pageUpdateProfile.php', '', 'resizable=no, location=no, width=850, height=850, menubar=no, status=no, scrollbars=no, menubar=no, toolbar =no');
// if(newwin){
//   // newwin.onfocus();
//   // element.style.zIndex = 2000;
//   // element.style.zIndex = 0;
//   window.onfocus=function(){newwin.window.close()}
// }
function gestionUpdate(){
  let sectionUpdate = document.getElementById('update');
  sectionUpdate.hidden = false;
  for (var elts of document.querySelectorAll("#Fildemessage,#connexion,#Mesmsg,#Sonprofil,#abonnement,#deconnexion,#abonnes")) {
    elts.style.backgroundColor = "white";
    elts.style.color = "black";
  }
  for (var elts of document.querySelectorAll("#userProfile,#userMessages,#userTarget,#userFollowers,#visitor,#msgcontent,#msgformulaire,#authenfication,#optionFiltre,#Sonprofil,#numeroPg,#poster")) {
      elts.hidden = true;
    }

}

function connectUpdate(ev){
  ev.preventDefault();
  let url = `services/setProfile.php`;
  fetchFromJson(url, {method:"post",body:new FormData(this),credentials:'same-origin'})
  .then(processAnswer)
  .then(setprofil)
  .then(update);


}




function update(){

  // .then(() => {
    let pseudo = document.getElementById
    let sectionprofil = document.getElementById('userProfile');
    sectionprofil.hidden =false;
    p = document.createElement("p");
    p.textContent = "Vous avez realise la mises a jour de votre profile avec succes";
    p.style.backgroundColor = 'green';
    h1 = document.getElementById("name");
    sectionprofil.insertBefore(p,h1);
  // });

}
