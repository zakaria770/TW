
window.addEventListener('load',initStat);

function initStat(){
  let button = document.querySelector('#maj_stats');
  button.addEventListener('click',sendStat);
}

function sendStat(ev){ // form event listener
  ev.preventDefault();
  let url = 'services/getStats.php';
  fetchFromJson(url)
  .then(processAnswerStat)
  .then(displayStat, displayErrorStat);
}

function processAnswerStat(answer){
 if (answer.status == 'ok')
    return [answer.result, answer.time];
  else {
    throw new Error(answer.message);
  }
}

function displayStat(statTime){
 let div  = document.querySelector('section#section_stats>div.resultat');
 let p = div.querySelector('p');
 div.textContent="";
 let time = p.querySelector('time');
 time.textContent = "";
 time.textContent= statTime[1];
 div.appendChild(p);
 let table = listToTable(statTime[0]);
 div.appendChild(table);
}

function displayErrorStat(error){
  let p = document.createElement('p');
  p.innerHTML = error.message;
  let cible  = document.querySelector('section#section_stats>div.resultat');
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
