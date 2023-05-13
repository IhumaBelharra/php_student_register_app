<?php
class User{
    private $id;
    private $login;
    private $pass;

    public function __construct($id,$login,$pass){
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getLogin(){return $this->login;}
    public function setLogin($login){$this->login = $login;}

    public function getPass(){return $this->pass;}
    public function setPass($pass){$this->pass = $pass;}
}