<?php
/**
 *Salah Zakaria OUAICHOUCHE 
 */
class FieldsToRequete
{
  private $libelle;
  private $nom;
  private $commune;
  private $adresse;
  private $type;
  private $etat;
  private $nbVelosDispo;
  private $nbPlacesDispo;

  function __construct($libelle, $nom, $commune, $adresse, $type, $etat, $nbVelosDispo, $nbPlacesDispo){
    $this->libelle = $libelle;
    $this->nom = $nom;
    $this->commune = $commune;
    $this->adresse = $adresse;
    $this->type = $type;
    $this->etat = $etat;
    $this->nbVelosDispo = $nbVelosDispo;
    $this->nbPlacesDispo = $nbPlacesDispo;
  }

  //implode un tableau avec "&"
  private function tabToRequete($tab){
    return implode('&',$tab);

  }

  //retourne un tableau de $this avec les clés les noms de variables et les valeurs leurs valeurs
  private function toArray(){
    foreach ($this as $key => $value) {
        $tabRequete["$key"]= $this->tabToRequete($value);
      }
    foreach ($tabRequete as $key => $value) {
      if($tabRequete[$key]==""){
          unset($tabRequete[$key]);
        }
    }

    return $tabRequete;
  }

  //retourne la suite de la requete avec laquelle on va interroger le serveur
  public function suiteRequete(){
    //print_r($this->tabToRequete($this->toArray()));
    return $this->tabToRequete($this->toArray());
  }

  //retourne la requete avec laquelle on va interroger le serveur
  public function toRequete(){
    $requete = REQUETE."?";
    $requete.= $this->suiteRequete();
    return str_replace(" ", "%20", $requete);

  }
}

 ?>
