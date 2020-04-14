<?php
require_once("lib/db_parms.php");

Class DataLayer{
    private $connexion;
    public function __construct(){

            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                       ]
                     );
            //$this->connexion->query("SET search_path = public,s8");


    }

       /*  Récupère une liste des coureurs ordonnée par equipe puis par nom
     *  résultat : liste (table) de coureurs. Chaque élément est une table associative (clés 'equipe', 'nom' et 'dossard')
     */
   function getTableQ1c(){
        $sql = <<<EOD
        select
        equipe, dossard, nom
        from coureurs
        order by equipe, nom
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        $res = [];
        while ($coureur = $stmt->fetch()) {
            $res[]= $coureur;
        }
        return $res;
        // ou return $stmt->fetchAll();
    }


    /* Récupère les informations de base sur l'équipe passée en paramètre
     * paramètre : nom d'une équipe
     * résultat : table associative (clés 'nom', 'couleur' et 'directeur')
     *   ou false si l'équipe n'existe pas
     */
    function getInfoEquipe($equipe){
        $sql = <<<EOD
        select
        nom, couleur, directeur
        from equipes
        where nom = :equipe
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':equipe', $equipe);
        $stmt->execute();
        return $stmt->fetch();
        }


    /* Récupère la liste des coureurs de l'équipe passée en paramètre
     * paramètre : nom d'une équipe
     * résultat : liste (table) de coureurs. Chauqe élément est une table associative (clés 'nom' et 'dossard')
     *   ou false si l'équipe n'existe pas
     */
    function getMembers($equipe){
        $sql = <<<EOD
       select
          nom, dossard
          from coureurs
          where equipe = :equipe
          order by dossard
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':equipe', $equipe);
        $stmt->execute();
        $res = [];
        while ($coureur = $stmt->fetch()) {
            $res[]= $coureur;
        }
        return $res;
        // ou return $stmt->fetchAll();
    }


    /* Récupère la liste des équipes
     * résultat : liste (table) d'équipes'. Chauqe élément est une table associative
     * (clés : ensemble des attributs de la table, dont 'nom', couleur' et 'directeur')
     */
    function getEquipes(){
        $sql =  "select * from equipes";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


   /* Récupère la liste de étapes
     * résultat : liste (table) des étapes
     */
    function getEtapes(){
        $sql =  "select * from etapes order by numero";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* Récupère la liste des coureurs
     * résultat : liste (table) des coureurs
     */
    function getCoureurs($equipe = NULL){
        $sql  = "select * from coureurs";
        if (!is_null($equipe))
          $sql .= " where equipe=:equipe";
        $sql .= " order by dossard";
        $stmt = $this->connexion->prepare($sql);
        if (!is_null($equipe))
          $stmt->bindValue(":equipe",$equipe);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* Ajoute une étape
     * argument : nom de l'étape
     * résultat : booléen indiquant si l'opération s'est bien déroulée
     */
    function addEtape($nom){
        $sql =  "insert into etapes(nom) values (:nom)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':nom',$nom);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }

    /* Enregistre un chrono
     * arguments : étape (numero), dossard, temps
     * résultat : booléen indiquant si l'opération s'est bien déroulée
     **/
    function addChrono($etape, $dossard, $chrono = NULL){
      $sql = <<<EOD
       insert into
         releves (etape, dossard, chrono)
         values (:etape,:dossard,:chrono)
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':etape',$etape);
        $stmt->bindValue(':dossard',$dossard);
        $stmt->bindValue(':chrono',$chrono);
        $stmt->execute();
        return $stmt->rowCount() == 1;
   }

    /* Efface tous les relevés
     */
    function resetReleves(){
        $stmt = $this->connexion->query("truncate table releves");
    }

    /* Efface toutes les étapes
     */
    function resetEtapes(){
      $stmt = $this->connexion->query("truncate table etapes restart identity cascade");
    }

    function getStats(){
      $avecNomV2 = <<<EOD
       select nom as "étape", etape as "numéro", min(chrono) as "temps mini",  max(chrono) as "temps maxi",  avg(chrono) as "temps moyen", count(*) as "coureurs au départ", count(chrono) as "coureurs arrivés"
         from releves
         join etapes on etape = etapes.numero
         group by etape, nom
         order by etape
EOD;

        $stmt = $this->connexion->prepare($avecNomV2);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    function getArrivee($etape){
      $sql = <<<EOD
       select coureurs.dossard, coureurs.nom as coureur, releves.chrono, equipes.nom as équipe , equipes.couleur as maillot
         from coureurs
         join releves on releves.dossard = coureurs.dossard
         join equipes on equipes.nom = coureurs.equipe
         where etape = :etape and chrono is not null
         order by chrono
EOD;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':etape',$etape);
      $stmt->execute();
      return $stmt->fetchAll();
    }


   /*
    * Test d'authentification
    * $login, $password : authentifiants
    * résultat :
    *    Instance de Personne représentant l'utilsateur authentifié, en cas de succès
    *    NULL en cas d'échec
    */
   function authentifier($login, $password){ // version password hash
        $sql = <<<EOD
        select
        login, nom, prenom, password
        from "s8_users"
        where login = :login
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $info = $stmt->fetch();
        if ($info && crypt($password, $info['password']) == $info['password'])
              return new Identite($info['login'], $info['nom'], $info['prenom']);
        else
          return NULL;
    }

   /*
    * Récupère l'avatar d'un utilisateur
    * $login : login de l'utilisateur
    * résultat :
    *   si l'utilisateur existe : table assoc
    *    'mimetype' : mimetype de l'image
    *    'data' : flux ouvert en lecture sur les données binaires de l'image
    *     si l'utilisateur n'a pas d'avatar, 'mimetype' et 'data' valent NULL
    *   si l'utilisateur n'existe pas : le résultat vaut NULL
    */
   function getAvatar($login){
      $sql = <<<EOD
      select mimetype, avatar
      from s8_users
      where login=:login
EOD;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':login', $login);
      $stmt->bindColumn('mimetype', $mimeType);
      $stmt->bindColumn('avatar', $flow, PDO::PARAM_LOB);
      $stmt->execute();
      $res = $stmt->fetch();
      if ($res)
         return ['mimetype'=>$mimeType,'data'=>$flow];
      else
         return false;
    }

    //--------------------------------------------------------------

    /*
     * Liste des favoris d'un utilisateur
     * $user : l'utilisateur
     * $opposite : si true : renvoie la liste complémentaire (ceux qui ne sont pas favoris)
     *
     */
   function getFavoris($user, $opposite = false){

      $sql = <<<EOD
      select {$this->profilCoureur}  from coureurs
      join favoris on coureurs.dossard = favoris.coureur
      where favoris."user" = :user
      order by dossard
EOD;
      if ($opposite)
           $sql = "select {$this->profilCoureur}  from coureurs except  $sql" ;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':user',$user);
      $stmt->execute();
      return $stmt->fetchAll();
    }


   /*
    * Supprime un favori
    */
   function removeFavori($user, $coureur){
      $sql = <<<EOD
      delete from favoris
      where coureur=:coureur and "user"=:user
EOD;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':coureur',$coureur);
      $stmt->bindValue(':user',$user);
      $stmt->execute();
      return $stmt->rowCount() == 1;
    }

    /*
     * Ajoute un favori
     */
   function addFavori($user, $coureur){
      $sql = <<<EOD
      insert into favoris (coureur, "user") values (:coureur, :user)
EOD;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(':coureur',$coureur);
      $stmt->bindValue(':user',$user);
      try {
         $stmt->execute();
         return $stmt->rowCount() == 1;
      } catch (PDOException $e) {
         if ($e->getCode()=='23505'){
            // violation de contrainte d'unicité : le couple (coureur, user) existait déjà
            // ajout impossible
          return false;
         }
         throw $e; // autre erreur : pas de traitement adéquat => on propage
      }
   }

}
?>
