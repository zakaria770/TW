window.addEventListener('load',finalSet);



function finalSet(){
      document.querySelector("#Fildemessage").addEventListener('click',gestionloadPageAccueil);
    	document.forms.formlogin.addEventListener('submit',connectInLogin); // envoi
      document.forms.formupdating.addEventListener('submit',connectUpdate); // envoi
      document.forms.formupdating.addEventListener('input',function(){this.message.value='';}); // envoi
      document.forms.formlogin.addEventListener('input',function(){this.message.value='';}); // effacement auto du message
  	  document.forms.form_register.addEventListener('input',function(){this.message.value='';}); // effacement auto du message
      document.forms.form_register.addEventListener('submit',registerUser);
      document.getElementById('trie').addEventListener('click',gestionSelect);
      // document.getElementById('fin').addEventListener('click',update);
		  document.getElementById('creercompte').addEventListener("click",pageRegister);
      document.getElementById('deconnexion').addEventListener('click',connectInLogout);
      document.getElementById("connexion").addEventListener("click",pageLogin);
      document.getElementById("next").addEventListener("click",nextPage);
      document.getElementById("prev").addEventListener("click",prevPage);
      document.getElementById("filtre").addEventListener('input',gestionOptions);
      document.getElementById("Ok").addEventListener("click",gestionMessagesByAuthor); // envoi
}

function connectInLogin(ev){
  ev.preventDefault();
  let url = "services/login.php";
  fetchFromJson(url, {method:"post",body:new FormData(this),credentials:'same-origin'})
  .then(processAnswer)
  .then(displayPageLoginOk,displayPageError);

}

function displayPageLoginOk(){
  //initState();
  //recuperer input
  let login = document.getElementById('loginInput');
  let buttonProfil = document.getElementById("Monprofil");
  let sectionChoix =document.getElementById("optionFiltre");
  buttonProfil.textContent = `@${login.value}`;
  //let id = login.split(" ");
  etatConnecte(login.value);
  loadPageAccueil();
  document.getElementById("Fildemessage").hidden = false;
  sectionChoix.hidden = false;
  sectionChoix.backgroundColor = 'grey';
  document.getElementById("userProfile").hidden = false;
  for (var elts of document.querySelectorAll("#userProfile,#userFollowers,#userTarget,#visitor,#msgformulaire,#authenfication,#msgcontent")) {
      elts.hidden = true;
    }
}

function displayPageError(error){
  let loginform = document.forms.formlogin.message;
  loginform.value = "Authenfication  echoue : " + error.message;
  loginform.style.color = 'red';

}

function connectInLogout (ev){
  ev.preventDefault();
  let url = "services/logout.php";
  fetchFromJson(url, {credentials:'same-origin'})
  .then(processAnswer)
  .then(() => {
    etatDeconnecte();
    // loadPageAccueil();
    document.getElementById("msgcontent").hidden = false;
    document.getElementById("Fildemessage").hidden = false;
  } );
  for (elts of document.querySelectorAll('header>nav>button','#creercompte')) {
    elts.style.color = "black";
    elts.style.backgroundColor = "white";
  }

}

function pageLogin(){
  // decoloriation des autres button
  for (elts of document.querySelectorAll('header>nav>button')) {
    elts.style.color = "black";
    elts.style.backgroundColor = "white";
  }
  // coloriation du button
  buttonconnexion = document.getElementById("connexion");
  buttonconnexion.style.color = "white";
  buttonconnexion.style.backgroundColor = "blue";
  buttonCreeCompte = document.getElementById("creercompte");
  buttonCreeCompte.hidden = false;
  // #msgcontent,#userProfile,#userTarget,#userMessages,#userFollowers,#register,#msgformulaire,#visitor
for (elts of document.querySelectorAll(" #msgcontent,#userProfile,#userTarget,#userMessages,#userFollowers,#register,#msgformulaire,#visitor,#numeroPg,#optionFiltre")){
  elts.hidden = true;
  }
document.getElementById("formlogin").hidden = false;
for (elts of document.querySelectorAll("input")) {
    elts.value = '';
    document.forms.form_register.message.value ='';
}




}


function registerUser(ev){
  ev.preventDefault();
  let url = "services/createUser.php";
  fetchFromJson(url,{method:"post",body:new FormData(this),credentials:'same-origin'})
  .then(processAnswer)
  .then(() => {
     pageLogin();
    let res = document.forms.formlogin.message;
    res.value = `votre compte a ete cree avec succes ${user} !`;
    res.style.color = "green";
  });
}


function pageRegister(){
// buttoncreation = document.getElementById ("creercompte");
// buttoncreation.st
for (elts of document.querySelectorAll('header>nav>button')) {
  elts.style.color = "black";
  elts.style.backgroundColor = "white";
}
registre = document.getElementById("register");
registre.hidden = false;
let formulaires = document.querySelectorAll("#msgformulaire,#formlogin,#userProfile,#userMessages,#userFollowers,#userTarget,#visitor,#msgcontent,#creercompte");
for (elts of formulaires){
    elts.hidden = true;
}
for (elts of document.querySelectorAll("input")) {
    elts.value = '';
    document.forms.form_register.message.value ='';
}


}


function gestionOptions(){
  let input =   document.getElementById("filtre");
  let datalist= document.getElementById('users');
  let url = `services/findUsers.php?searchedString=${input.value}`;
  fetchFromJson(url)
  .then(processAnswer)
  .then((res) => {
    datalist.textContent = '';
    for (elts of res) {
      let option = document.createElement('option');
      option.textContent = `${elts.userId} ${elts.pseudo}`;
      datalist.appendChild(option);
    }

  });
}
function gestionMessagesByAuthor(){
    let author = document.getElementById('filtre').value.split(' ')[0];
      gestionFiltre(author);
}
function gestionFiltre(author){
    let url = `services/findMessages.php?author=${author}&count=`;
    fetchFromJson(url+`${saut}`)
    .then(processAnswer)
    .then((res) => {
      let sectionPoste = document.querySelector('#userMessages');
      sectionPoste.textContent = '';
      pageAccueil(res);

    });
    return url;

}
function gestionloadPageAccueil() {
  let nextPrevbutton = document.getElementById(("numeroPg"));
  nextPrevbutton.hidden = false;
  if (user !== null) {
    document.getElementById('poster').hidden = false;
    loadPageAccueil(`services/findFollowedMessages.php?count=${saut}`);
  }
  else{
    document.getElementById('poster').hidden = true;
    loadPageAccueil(`services/findMessages.php?count=${saut}`);
  }
}
