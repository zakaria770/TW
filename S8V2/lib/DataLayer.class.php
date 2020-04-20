<?php

Class DataLayer{
    private $connexion;

    public function __construct(){
            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                       ]
                     );
    }

    

    function authentifier($login,$password){
      $sql = <<<EOD
      select login,nom,prenom,password
      from s8_users
      where login=:login
EOD;
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindValue(":login",$login,PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetch();
      if (crypt($password,$res['password'])==$res['password'])
        return new Identite($login,$res['nom'],$res['prenom']);
      else return NULL;
    }

   
    function createUser($login,$password,$nom,$prenom){
      try{
        $empreinte = password_hash($password,CRYPT_BLOWFISH);
        $sql = "insert into s8_users(login,password,nom,prenom) values (:login,:password,:nom,:prenom)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":password",$empreinte,PDO::PARAM_STR);
        $stmt->bindValue(":nom",$nom,PDO::PARAM_STR);
        $stmt->bindValue(":prenom",$prenom,PDO::PARAM_STR);
        $stmt->execute();
        return TRUE;
      }
      catch (PDOException $e){
        return FALSE;
      }
    }

  
    function storeAvatar($imageSpec,$login){
      $sql = <<<EOD
      update s8_users
        set avatar=:image, mimetype=:type
        where login=:login
EOD;
      $stmt=$this->connexion->prepare($sql);
      $stmt->bindValue(":login",$login,PDO::PARAM_STR);
      $stmt->bindValue(":type",$imageSpec['mimetype'],PDO::PARAM_STR);
      $stmt->bindValue(":image",$imageSpec['data'],PDO::PARAM_LOB);
      try {
        return $stmt->execute();
      }
      catch (PDOException $e){
        return false;
      }
    }

    
    function getAvatar($login){
      $sql = <<<EOD
      select avatar,mimetype
      from s8_users
      where login=:login
EOD;
      $stmt=$this->connexion->prepare($sql);
      $stmt->bindValue(":login",$login,PDO::PARAM_STR);
      $stmt->execute();
      $stmt->bindColumn("mimetype",$type);
      $stmt->bindColumn("avatar",$flux,PDO::PARAM_LOB);
      $res=$stmt->fetch();
      $avatar = array('data'=>$flux,'mimetype'=>$type);
      if ($res){
        return $avatar;
      }
      else{
        return FALSE;
      }
    }


  }
?>
