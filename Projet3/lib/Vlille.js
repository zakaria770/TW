window.addEventListener('DOMContentLoaded', ()=>{
      // 1 : création
  let maCarte = L.map('carte');

      // 2 : choix du fond de carte
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '©️ OpenStreetMap contributors'
  }).addTo(maCarte);

      // 3 : réglage de la partie visible (centre, niveau de zoom)
  maCarte.setView([	50.628918, 	3.088147], 11);
  let marker = L.marker([50.609614, 3.136635]).addTo(maCarte);

     // ...
});
