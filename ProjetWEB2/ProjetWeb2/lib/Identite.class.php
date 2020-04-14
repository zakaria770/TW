<?php
//Auteurs Salah Zakaraia OUAICHOUCHE
class Identite { 
  public $login;
  public $nom;
  public $prenom;
  public function __construct($login,$nom,$prenom)
  {
    $this->login = $login;
    $this->nom = $nom;
    $this->prenom = $prenom;
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