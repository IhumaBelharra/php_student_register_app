<?php
require_once "models/EtudiantManager.class.php";

class EtudiantsController{
    private $etudiantManager;

    public function __construct(){
        $this->etudiantManager = new EtudiantManager;
        $this->etudiantManager->chargementEtudiants();
    }

    public function afficherEtudiants(){
        $etudiants = $this->etudiantManager->getEtudiants();
        require "views/etudiants.view.php";
    }

    public function afficherEtudiant($id){
        $etudiant = $this->etudiantManager->getEtudiantById($id);
        require "views/afficherEtudiant.view.php";
    }

    public function ajoutEtudiant(){
        require "views/ajoutEtudiant.view.php";
    }

    public function ajoutEtudiantValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        if ($_POST['genre'] === "Homme"){
            $final_genre = 0;
        }else{
            $final_genre = 1;
        }
        if ($_POST['codeFormation'] === 'SLAM 1'){
            $final_codeFormation = 1;
        }else{
            $final_codeFormation= 2;
        }
        $this->etudiantManager->ajoutEtudiantBd($_POST['nom'],$_POST['prenom'],$_POST['age'],$final_genre,$_POST['tel'],$_POST['adresse'],$_POST['email'],$nomImageAjoute,$final_codeFormation);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];
        
        header('Location: '. URL . "etudiants");
    }

    public function suppressionEtudiant($id){
        $nomImage = $this->etudiantManager->getEtudiantById($id)->getImage();
        unlink("public/images/".$nomImage);
        $this->etudiantManager->suppressionEtudiantBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "etudiants");
    }

    public function modificationEtudiant($id){
        $etudiant = $this->etudiantManager->getEtudiantById($id);
        require "views/modifierEtudiant.view.php";
    }

    public function modificationEtudiantValidation(){
        $imageActuelle = $this->etudiantManager->getEtudiantById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageToAdd = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        if ($_POST['genre'] === "Homme"){
            $final_genre = 0;
        }else{
            $final_genre = 1;
        }
        if ($_POST['codeFormation'] === 'SLAM 1'){
            $final_codeFormation = 1;
        }else{
            $final_codeFormation= 2;
        }
        $this->etudiantManager->modificationEtudiantBD($_POST['identifiant'],$_POST['nom'],$_POST['prenom'],$_POST['age'],$final_genre,$_POST['tel'],$_POST['adresse'],$_POST['email'],$nomImageToAdd,$final_codeFormation);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "modification Réalisée"
        ];
        
        header('Location: '. URL . "etudiants");
    }

    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }
}