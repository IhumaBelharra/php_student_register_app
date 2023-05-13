<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/EtudiantsController.controller.php";
require_once "controllers/UsersController.controller.php";
$etudiantController = new EtudiantsController;
$userController = new UsersController;

try{
    if(empty($_GET['page'])){
        require "views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);

        switch($url[0]){
            case "accueil" : require "views/accueil.view.php";
            break;
            case "etudiants" :
                if (isset($_SESSION['logged'])){
                if(empty($url[1])){
                    $etudiantController->afficherEtudiants();
                } else if($url[1] === "l") {
                    $etudiantController->afficherEtudiant($url[2]);
                } else if($url[1] === "a") {
                    $etudiantController->ajoutEtudiant();
                } else if($url[1] === "m") {
                    $etudiantController->modificationEtudiant($url[2]);
                } else if($url[1] === "s") {
                    $etudiantController->suppressionEtudiant($url[2]);
                } else if($url[1] === "av") {
                    $etudiantController->ajoutEtudiantValidation();
                } else if($url[1] === "mv") {
                    $etudiantController->modificationEtudiantValidation();
                }
                else {
                    throw new Exception("La page n'existe pas");
                }
            }else{
                if(empty($url[1])){
                    $etudiantController->afficherEtudiants();
                }else if($url[1] === "l") {
                    $etudiantController->afficherEtudiant($url[2]);
                }
                else{
                    require "views/accueil.view.php";
                }
            }
            break;
            case "admins":
                if (isset($_SESSION['logged'])){
                    if(empty($url[1])){
                        $userController->afficherUsers();
                    }
                    else if($url[1] === "s") {
                        $userController->suppressionUser($url[2]);
                    }
                    else if($url[1] === "a") {
                        $userController->ajoutUser();
                    }
                    else if($url[1] === "av") {
                        $userController->ajoutUserValidation();
                    }
                    else {
                        throw new Exception("La page n'existe pas");
                    }
                }else{
                    require "views/accueil.view.php";
                }
            break;
            case "login":
                if(empty($url[1])){
                    $userController->afficherLogin();
                }
                else if($url[1] === "c") {
                    $userController->loginUser();
                }
                else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            case "disconnect":
                if(empty($url[1])){
                    $userController->disconnectUser();
                }
                else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            default : throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
