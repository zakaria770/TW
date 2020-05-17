var pseudo = '';

























function gestionFiltreAbonnement(b){
    let option =document.getElementById("option_connecte");
    option.hidden =b;
  //   if (b) {
  //     document.getElementById("vide").value = 'all';
  //     document.getElementById("vide").textContent = 'Tous les message';
  //   }
  // else {
  //   document.getElementById("optFiltre").value = 'abonnements';
  //   document.getElementById("optFiltre").textContent = 'Abonnements';
  //
  // }

}

function gestionPageMonProfile(resultat,section){
  // section.textContent = '';
  let h1 = document.createElement("h1");
  let div = document.createElement("div");
  let p1 = document.createElement("p");
  let p2 = document.createElement("p");
  let buttonUpdate = document.createElement("button");
  buttonUpdate.id = 'boutonUpdate';
  div.id = `${resultat.userId}`;
  p1.id = 'bio';
  p2.id = "description";
  h1.id = 'name';
  buttonUpdate.textContent = 'Mettre a jour son Profil?';
  h1.textContent = `${resultat.userId}  ${resultat.pseudo}`;
  p1.textContent = 'Bio :';
  p2.textContent = `${resultat.description}`;
  section.appendChild(h1);
  div.appendChild(p1);
  div.appendChild(p2);
  div.appendChild(buttonUpdate);
  section.appendChild(div);
  buttonUpdate.addEventListener('click',gestionUpdate);
}
