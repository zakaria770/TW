## Projet n°1 TW2
#nom: projet vLille
#realisée par: Salah Zakaria OUAICHOUCHE (groupe 3)
			   Chaymaa ZOUHRI (groupe1)

## Comment lancer le projet
- Taper dans l'url de votre navigateur pour accéder à la page d'accueil
```sh
http://webtp.fil.univ-lille1.fr/~ouaichouche/ProjetWeb/accueil/vlille.php
```

## Deroulement du projet
On peut utiliser le formulaire pour accéder à une liste de stations selon les critères qu'on rentre.
Si on ne remplit pas le formulaire toutes les stations vont être affichées.

Pour choisir des stations selon leur libelle on rentre les numéros des stations dans la partie "libelle".
On peut rentrer plusieurs "libelles" séparés par une virgule.
Si le numéro de la station n'existe pas ou si ce n'est pas entier une erreur correspondante s'affiche.

Pour choisir des stations selon leur nom on rentre les noms des stations (comme sous chaines des noms complets).
On peut rentrer plusieurs "noms" séparés par une virgule.
Si le nom n'existe pas (les données rentrées comme sous chaine ne correspondent à aucun nom) une erreur correspondante s'affiche.

Pour choisir des stations selon les communes on rentre les données comme étant des préfixes des communes.
On peut rentrer plusieurs "communes" séparés par une virgule.
Si les prefixes rentrées n'existe pas (ne corresponde à aucune commune) une erreur correspondante s'affiche.

Pour choisir des stations selon l'adresse ça se passe exactement pareil comme les noms.

On peut filtrer les stations selon si elles on un TPE ou pas.
On peut filtrer les stations selon si elle sont en service, en maintenance ou hors servie.

Pour choisir des stations selon le nombre des vélos disponibles il suffit de rentrer le nombre minimale des vélos qu'on veut avoir. On peut rentrer plusieurs entiers et ça sera le plus petit entier qui va être pris en considérations. Si les données rentrées ne sont pas des entiers une erreur s'affiche.

Pour choisir des stations selon le nombre de places disponibles ça se passe exactement pareil comme pour choisir les stations selon le nombre des vélos disponibles.

On peut trier les données affichés selon les libelles, les noms, les communes, les adresses, le nb des vélos disponibles et le nombre de places disponibles.

La liste des stations selon les critères rentrées est affichée à gauche et la carte correspondate avec les icones mentionnant les disponibilités est affichée à droite.

Si on clique sur une icone sur la carte ou sur la station dans la liste le popup correspondant s'ouvre et la station dans la liste est mise en "sur brillance" et sera visible dans le centre de la liste.

## Problèmes rencontrés
L'analyse du projet était dure. Mais cela s'est estompé petit à petit en faisant une tâche à la fois.
Le sujet semble à premier abord dur à comprendre mais on analysant bien le demandé le travail s'avère simple.

## Les fonctionnalités auxquelles on a pensé pour ameliorer le projet
L'affichage d'une liste déroulante (sorte de datalist) pour principalement les champs de saisie (nom, commune, adresse) qui s'affiche même après avoir rentrer la première donnée suivi d'une virgule (l'affichage de datalist si elle a était implémentée est possible seulement pour entrer la première donnée du coup on a jugé de ne pas mettre une datalist).


## les fonctionnalités éventuellement non demandées qu'on a jugé bon d'ajouter
Principalement le tri.
Et la génération de la page crédit. Pour qu'elle ne soit pas du pure HTML.

## Remarque sur le style
Le style des pages est inspiré de la page https://opendata.lillemetropole.fr/pages/home/ (les couleurs et un peu la mise en page). Mais on a rien copié du site. Tout était implémenter par nous même.

## Pour accéder à la page de crédit
Le lien vers la page de crédit se trouve tout en bas de la page d'accueil (CRÉDIT).
Ou bien en rentrant comme url
```sh
http://webtp.fil.univ-lille1.fr/~ouaichouche/ProjetWeb/credit/credit.php
```
Pour revenir à la page d'accueil cliquez sur sur "retour à la page d'accueil"
