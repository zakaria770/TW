<?php
//Auteurs OUAICHOUCHE

class Identite {
  private $pseudo;
  private $nom;
  private $description;
  public function __construct($pseudo,$nom,$description)
  {
    $this->pseudo = $pseudo;
    $this->nom = $nom;
    $this->description = $description;
  }
  public function getPseudo(){
    return $this->pseudo;
  }
  public function getNom(){
    return $this->nom;
  }
  public function getDescription(){
    return $this->description;
  }
}
?>
