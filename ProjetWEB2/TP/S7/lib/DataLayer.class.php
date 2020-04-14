<?php
Class DataLayer{
    private $connexion;

    // établit la connexion à la base en utilisant les infos de connexion des constantes DB_DSN, DB_USER, DB_PASSWORD
    // susceptible de déclencher une PDOException
    public function __construct(){
            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // déclencher une exception en cas d'erreur
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // chaque ligne du résultat sera une table associative
                       ]
                     );

    }

    /*  Récupère une liste des coureurs
     *  résultat : liste (table) de coureurs.
     *  Chaque élément est une table associative (clés "dossard" et "nom")
     */
   function getCoureursQ0(){
         // commande SQL : (la syntaxe heredoc permet d'écrire des chaînes multilignes, pour une meilleure lisibilité, cf documentation PHP)
        $sql = <<<EOD
        select dossard, nom
        from coureurs
EOD;
        $stmt = $this->connexion->prepare($sql); // préparation de la requête
        $stmt->execute();                        // exécution de la requête
        $res = $stmt->fetchAll();                // récupération de la table résultat
        return $res;
    }
    /*
     * voici la forme de la table renvoyée par fetchAll  dans la fonction getTableQ1a():
     [
      ["dossard"=>1, "nom"=>"alain"],
      ["dossard"=>2, "nom"=>"alphonse"],
         ... etc ...
     ]
     */

    /*  Récupère une liste des coureurs ordonnée par equipe puis par nom
     *  résultat : liste (table) de coureurs.
     *  Chaque élément est une table associative (clés "equipe", "dossard" et "nom")
     */
   function getCoureursQ1(){
     $sql = <<<EOD
     select equipe, dossard , nom
     from coureurs

EOD;
     $stmt = $this->connexion->prepare($sql); // préparation de la requête
     $stmt->execute();                        // exécution de la requête
     $res = $stmt->fetchAll();                // récupération de la table résultat
     return $res;
    }

    /* Récupère la liste des équipe, attributs nom et couleur
     * résultat : liste (table) d'équipes'.
     * Chaque élément est une table associative (clés : "nom", "couleur"))
     */
   function getEquipes(){
     $sql = <<<EOD
     select nom, couleur
     from equipes

EOD;
     $stmt = $this->connexion->prepare($sql); // préparation de la requête
     $stmt->execute();                        // exécution de la requête
     $res = $stmt->fetchAll();                // récupération de la table résultat
     return $res;
   }

    /* Récupère les informations de base sur l'équipe passée en paramètre
     * paramètre : nom d'une équipe
     * résultat : table associative (clés 'nom', 'couleur' et 'directeur')
     *   ou FALSE si l'équipe n'existe pas
     */
   function getInfoEquipe($equipe){
     $sql = <<<EOD
     select *
     from equipes where equipe= :equipe
EOD;
    $sql.bindValue(':equipe', $equipe);
    $stmt = $this->connexion->prepare($sql); // préparation de la requête
    $stmt->execute();                        // exécution de la requête
    $res = $stmt->fetchAll();                // récupération de la table résultat
    return $res;
   }

    /* Récupère la liste des coureurs de l'équipe passée en paramètre
     * paramètre : nom d'une équipe
     * résultat : liste (table) de coureurs ordonnée par n° de dossard
     * Chaque élément est une table associative (clés "nom" et "dossard")
     *   ou FALSE si l'équipe n'existe pas
     */
    function getMembers($equipe){
      // compléter à la question 4
     }



}
?>
