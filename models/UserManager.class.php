<?php
require_once "Model.class.php";
require_once "User.class.php";

class UserManager extends Model{
    private $users;//tableau de Livre

    public function ajoutUser($user){
        $this->users[] = $user;
    }

    public function getUsers(){
        return $this->users;
    }

    public function chargementUsers(){
        $req = $this->getBdd()->prepare("SELECT * FROM users");
        $req->execute();
        $mesUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesUsers as $user){
            $l = new User($user['id'],$user['login'],$user['pass']);
            $this->ajoutUser($l);
        }
    }
    public function getUserById($id){
        for($i=0; $i < count($this->users);$i++){
            if($this->users[$i]->getId() == $id){
                return $this->users[$i];
            }
        }
        throw new Exception("L'utilisateur n'exise pas");
    }
    public function suppressionUserBD($id){
        $req = "
        Delete from users where id = :idUser
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idUser",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $user = $this->getUserById($id);
            unset($user);
        }
    }
    public function ajoutuserBd($login,$pass){
        $req = "
        INSERT INTO users (login, pass)
        values (:login, :pass)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":pass",$pass,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $user = new User($this->getBdd()->lastInsertId(),$login,$pass);
            $this->ajoutUser($user);
        }        
    }
    public function loginUserBd($login,$pass){
        $req = $this->getBdd()->prepare("
        SELECT * FROM users WHERE login ='$login' AND pass='$pass'");
        $req->execute();
        $myUser = $req->rowCount();
        $req->closeCursor();
        if($myUser > 0){
            return true;
        }

        
    }
}