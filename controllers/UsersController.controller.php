<?php
require_once "models/UserManager.class.php";

class UsersController{
    private $userManager;

    public function __construct(){
        $this->userManager = new UserManager;
        $this->userManager->chargementUsers();
    }

    public function afficherUsers(){
        $users = $this->userManager->getUsers();
        require "views/users.view.php";
    }

    public function ajoutUser(){
        require "views/ajoutUser.view.php";
    }

    public function afficherLogin(){
        require "views/login.view.php";
    }
    public function suppressionUser($id){
        $this->userManager->suppressionUserBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "admins");
    }
    public function ajoutUserValidation(){
        $this->userManager->ajoutUserBd($_POST['login'],$_POST['pass']);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];
        
        header('Location: '. URL . "admins");
    }
    public function loginUser(){
        $userlogin = $this->userManager->loginUserBd($_POST['login'],$_POST['pass']);
        
        if($userlogin){
            $_SESSION['logged'] = true;
            header('Location: '. URL . "accueil");
        }else{
            header('Location: '. URL . "login");
        }
    }
    public function disconnectUser(){
        unset($_SESSION['logged']);
        header('Location: '. URL . "accueil");
    }
}