<?php
//Salah Zakaria OUAICHOUCHE
class RequeteToFields{
  private $fields=array();
  private $libelles;
  private $noms ;
  private $communes=array();
  private $adresses;

  function __construct($requete){
    $reponse = file_get_contents($requete);
    $tab = json_decode($reponse,true);

    for ($i=0; $i <count($tab) ; $i++) {
      $fields = $tab[$i]["fields"];
      $this->fields[] = $fields;
      $this->libelles[] = $fields["libelle"];
      $this->noms[] = $fields["nom"];
      $c = $fields["commune"];
      //eliminer les redondance des "commune", toutes les autres proprietés sont uniques
      if (! in_array($c,$this->communes))
        $this->communes[]=$c;
      $this->adresses[] = $fields["adresse"];


    }
  }

  //retourne les fields
  public function getFields(){
    return $this->fields;
  }

  //retroune les libelles
  public function getLibelles(){
    return $this->libelles;
  }

  //retourne les noms
  public function getNoms(){
    return $this->noms;
  }

  //retourne les commmunes
  public function getCommunes(){
    return $this->communes;
  }

  //retourne les adresses
  public function getAdresses(){
    return $this->adresses;
  }
}



 ?>
