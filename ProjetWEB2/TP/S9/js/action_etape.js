
window.addEventListener('load',initArrivee);

function initArrivee(){
  document.forms.form_etape.addEventListener('submit',sendFormEtape);
}

function sendFormEtape(ev){ // form event listener
  ev.preventDefault();
  let url = 'services/getInfoArrivee.php?'+formDataToQueryString(new FormData(this));
  fetchFromJson(url)
  .then(processAnswer)
  .then(displayInfoArrivee, displayErrorArrivee);
}

function processAnswer(answer){
 if (answer.status == 'ok')
    return answer.result;
  else {
    throw new Error(answer.message);
  }
}

function displayInfoArrivee(infoArrivee){
 let div  = document.querySelector('section#section_etape>div.resultat');
 div.textContent="";
 //comment traiter si infoArrivee est vide??
 let table = listToTable(infoArrivee);
 div.appendChild(table);
}

function displayErrorArrivee(error){
  let p = document.createElement('p');
  p.innerHTML = error.message;
  let cible  = document.querySelector('section#section_etape>div.resultat');
  cible.textContent=''; // effacement
  cible.appendChild(p);
}


// -------- utilitaire (question 2 et 3)
/*
 * list : un tableau usuel non vide, donc chaque élément est un objet simple
 * résultat : une table (objet DOM) représentant les données de la table.
 *            les en-têtes de colonnes sont les noms d'attributs des objets
 */
function listToTable(list){
  let table = document.createElement('table');
  let row = table.createTHead().insertRow();
  for (let x of Object.keys(list[0]))
    row.insertCell().textContent = x;
  let body = table.createTBody();
  for (let line of list){
    let row = body.insertRow();
    for (let x of Object.values(line))
      row.insertCell().textContent = x;
  }
  return table;
}
