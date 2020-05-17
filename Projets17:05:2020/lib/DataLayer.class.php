<?php
require_once ("lib/db_params.php");
class DataLayer{
  private $connexion;
    public function __construct(){
            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                       ]
                     );
    }
    function getUser($login){
      $sql=<<<EOD
    select login as "userId",pseudo
    from rezozio.users where login = :log;
EOD;
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':log',$login);
    $stmt->execute();
    $res= $stmt->fetch();
    return $res;
    }


    /*
    *------------------------------------------------------------
     ** recupere le login,pseudo d'un user    */


    function getProfileUnConnected($login){
      $sql=<<<EOD
    select login as "userId",pseudo,description
    from rezozio.users where login = :log;
EOD;

    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':log',$login);
    $stmt->execute();
    $res= $stmt->fetch();
    return $res;
    }

/*
*------------------------------------------------------------
 ** recupere le login,pseudo et un booleen si le user est connecte
 select login as userId,pseudo,target = :idtarget as isFollower
 from rezozio.users,rezozio.subscriptions where login = :log;

*/


    function getProfileConnected($login,$follower){
      $sql=<<<EOD
      select
       users.login as "userId", users.pseudo, users.description,
       s1.target is not null as "followed",
       s2.target is not null as "isFollower"
    from rezozio.users
    left join rezozio.subscriptions as s1 on rezozio.users.login = s1.target and s1.follower = :current
    left join rezozio.subscriptions as s2 on rezozio.users.login = s2.follower and s2.target = :current
    where rezozio.users.login = :userId
EOD;
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':current',$follower);
    $stmt->bindValue(':userId',$login);
    $stmt->execute();
    $res= $stmt->fetch();
    return $res;
    }

    function getMessage($idMessage){
      $sql=<<<EOD
    select id as "messageId",author,pseudo,content,datetime
    from rezozio.users,rezozio.messages where rezozio.users.login = rezozio.messages.author and rezozio.messages.id = :msg;

EOD;
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':msg',$idMessage);
    $stmt->execute();
    $res= $stmt->fetch();
    return $res;
    }
    function createUser($login,$password,$pseudo){
      $sql=<<<EOD
      insert into rezozio.users(login, password,pseudo)
      values (:l,:p,:ps)
EOD;
      $stmt=$this->connexion->prepare($sql);
      $stmt->bindValue(':l',$login);
      $stmt->bindValue(':p',$password);
      $cryptword = password_hash($password,CRYPT_BLOWFISH);
      $stmt->bindValue('p',$cryptword);
      $stmt->bindValue(':ps',$pseudo);
      try {
        $stmt->execute();
        return True;
      } catch (PDOException $e) {
        return False;
      }
    }
    function findUser($searchedString){
      $sql=<<<EOD
      select login as "userId", pseudo from rezozio.users where login like :sub  or pseudo like
   :sub
EOD;
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':sub','%'.$searchedString.'%');
    $stmt->execute();
    $res= $stmt->fetchAll();
    return $res;

    }
    function authentifier($login,$password){
      $sql=<<<EOD
      select login,password from rezozio.users
      where login like :log
EOD;
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':log',$login);
    $stmt->execute();
    $res=$stmt->fetch();
    if ($res === FALSE) return NULL;
    $correctpwd = crypt($password,$res["password"]) == $res['password'];
    if($correctpwd){
      return $res['login'];
    }
    return FALSE;
  }
  // function correctChaine($chaine){
  //   $chaine1 = 'select id as "messageId" ,author,content,datetime,pseudo
  //    from rezozio.messages join rezozio.users on login = author
  //    where ' . $chaine;
  //    // $stmt = $this->connexion->prepare($sql);
  //    return  $chaine1;
  // }
  function findMessageswithoutAuthor($before,$count){
    $sql=<<<EOD
    select id as "messageId" ,author,content,datetime,pseudo
     from rezozio.messages join rezozio.users on login = author
     where  id < :nbre order by datetime desc limit :lt;
EOD;
  $stmt=$this->connexion->prepare($sql);
  $stmt->bindValue(':nbre',$before);
  $stmt->bindValue(':lt',$count);
  $stmt->execute();
  $res=$stmt->fetchAll();
  return $res;
  }

// find messages  with $before = ' '
function findMessageswithoutBefore($author,$count){
  $sql=<<<EOD
  select id as "messageId" ,author,content,datetime,pseudo
   from rezozio.messages join rezozio.users on login = author
   where   author  = :log order by datetime desc limit :lt;
EOD;
  $stmt=$this->connexion->prepare($sql);
  $stmt->bindValue(':log',$author);
  $stmt->bindValue(':lt',$count);
  $stmt->execute();
  $res=$stmt->fetchAll();
  return $res;
}

// find messages  with login ='' and before =' '

function findMessageswithoutBeforeAuthor($count){
  $sql=<<<EOD
  select id as "messageId" ,author,content,datetime,pseudo
   from rezozio.messages join rezozio.users on login = author
    order by datetime desc limit :lt;
EOD;
  $stmt=$this->connexion->prepare($sql);
  $stmt->bindValue(':lt',$count);
  $stmt->execute();
  $res=$stmt->fetchAll();
  return $res;
}




  function findMessages($count,$before,$author){
    $sql=<<<EOD
    select id as "messageId" ,author,content,datetime,pseudo
     from rezozio.messages join rezozio.users on login = author
     where  author  =:log and id < :nbre order by datetime desc limit :lt ;
EOD;
  $stmt=$this->connexion->prepare($sql);
  $stmt->bindValue(':log',$author);
  $stmt->bindValue(':nbre',$before);
  $stmt->bindValue(':lt',$count);
  $stmt->execute();
  $res=$stmt->fetchAll();
  return $res;

}



function findFollowedMessages($login,$count,$before=''){
  $chaine ='select id as "messageId",author,pseudo,content,datetime
    from rezozio.messages join rezozio.users on login = author
    join rezozio.subscriptions on login = target
    where follower = :log ';
  if ($before !== '') {
    $chaine.='and id < :nbre
    order by datetime desc limit :lt';
  }
  else {
    $chaine.='order by datetime desc limit :lt';
  }
  $sql=<<<EOD
  $chaine;
EOD;
$stmt=$this->connexion->prepare($sql);
if ($before !== '') {
  $stmt->bindValue(':nbre',$before);
}
$stmt->bindValue(':log',$login);
$stmt->bindValue(':lt',$count);
$stmt->execute();
$res=$stmt->fetchAll();
return $res;

}



function createPost($login,$content){
  $sql=<<<EOD
  insert into rezozio.messages(author,content)
  values (:login,:content) returning  id as "idMessage"
EOD;
$stmt=$this->connexion->prepare($sql);
$stmt->bindValue(':login',$login);
$stmt->bindValue(':content',$content);
$stmt->execute();
$res=$stmt->fetch();
return $res;


}



// function getPostMessage($login){
//   $sql=<<<EOD
//   select id as "idMessage" from rezozio.messages where author = :login
//   ORDER by datetime desc limit 1
// EOD;
// $stmt=$this->connexion->prepare($sql);
// $stmt->bindValue(':login',$login);
// $stmt->execute();
// $res=$stmt->fetch();
// return $res;
//
// }



function follow($login,$target){
  $sql=<<<EOD
  insert into rezozio.subscriptions(follower,target)
  values (:login,:content)

EOD;
$stmt=$this->connexion->prepare($sql);
$stmt->bindValue(':login',$login);
$stmt->bindValue(':content',$target);
try {
  $stmt->execute();
  return True;
} catch (PDOException $e) {
  return False;
}



}
function unFollow($login,$target){
  $sql=<<<EOD
  delete from rezozio.subscriptions where
  follower= :login and target= :content
EOD;
$stmt=$this->connexion->prepare($sql);
$stmt->bindValue(':login',$login);
$stmt->bindValue(':content',$target);
$stmt->execute();
return $stmt->rowCount() == 1;

}


function getFollowers($login){
  $sql=<<<EOD
    select users.login as "userId", users.pseudo, t2.follower is not null as "mutual"
   from rezozio.subscriptions as t1
   left join rezozio.subscriptions as t2 on t1.follower = t2.target and t2.follower = :target
   join rezozio.users on login = t1.follower
   where t1.target = :target
EOD;
$stmt=$this->connexion->prepare($sql);
$stmt->bindValue(':target',$login);
$stmt->execute();
$res=$stmt->fetchAll();
return $res;


}


function getSubscriptions($login){
  $sql=<<<EOD
  select login as "userId", pseudo from rezozio.subscriptions join rezozio.users
  on login = target where follower = :log
EOD;
$stmt=$this->connexion->prepare($sql);
$stmt->bindValue(':log',$login);
$stmt->execute();
$res=$stmt->fetchAll();
return $res;


}

function setprofil($author,$password='',$pseudo='',$description=''){
      $chaine ='update rezozio.users set';
      $chaine1='';
      $chaine2='';
      $chaine3='';

      if ($password !== '') {
        $chaine1.='  password = :psw';
        $chaine2.=',';
      }
      if ($pseudo !=='') {
        $chaine2.='  pseudo = :pseud';
        $chaine3.=',';
      }
      if ($description !=='') {
        $chaine3.='  description = :descript ';
      }
      $chaine.= $chaine1.$chaine2.$chaine3.' where login = :log returning login as userId,pseudo';
      $sql=<<<EOD
      $chaine
EOD;
      $stmt=$this->connexion->prepare($sql);
      $stmt->bindValue(':log',$author);
      if ($pseudo !== '') {
        $stmt->bindValue(':pseud',$pseudo);
      }
      if ($description !== '') {
        $stmt->bindValue(':descript',$description);
      }

      if ($password !== '') {
        $stmt->bindValue(':psw',$password);
        $cryptword = password_hash($password,CRYPT_BLOWFISH);
        $stmt->bindValue('psw',$cryptword);
      }
      $stmt->execute();
      $res=$stmt->fetchAll();
      return $res;

}












}
?>
