<?php
require_once "Model.class.php";
require_once "Etudiant.class.php";

class EtudiantManager extends Model{
    private $etudiants;//tableau de étudiants

    public function ajoutEtudiant($etudiant){
        $this->etudiants[] = $etudiant;
    }

    public function getEtudiants(){
        return $this->etudiants;
    }

    public function chargementEtudiants(){
        $req = $this->getBdd()->prepare("SELECT * FROM etudiant");
        $req->execute();
        $mesEtudiants = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesEtudiants as $etudiant){
            $e = new Etudiant($etudiant['id'],$etudiant['nom'],$etudiant['prenom'],$etudiant['age'],$etudiant['genre'],$etudiant['tel'],$etudiant['adresse'],$etudiant['email'],$etudiant['image'],$etudiant['codeFormation']);
            $this->ajoutEtudiant($e);
        }
    }

    public function getEtudiantById($id){
        for($i=0; $i < count($this->etudiants);$i++){
            if($this->etudiants[$i]->getId() == $id){
                return $this->etudiants[$i];
            }
        }
        throw new Exception("L'étudiant n'existe pas");
    }

    public function ajoutEtudiantBd($nom,$prenom,$age,$genre,$tel,$adresse,$email,$image,$codeFormation){
        $req = "
        INSERT INTO etudiant (nom, prenom, age, genre, tel, adresse, email, image, codeFormation)
        values (:nom, :prenom, :age, :genre, :tel, :adresse, :email, :image, :codeFormation)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom",$nom,PDO::PARAM_STR);
        $stmt->bindValue(":prenom",$prenom,PDO::PARAM_STR);
        $stmt->bindValue(":age",$age,PDO::PARAM_INT);
        $stmt->bindValue(":genre",$genre,PDO::PARAM_INT);
        $stmt->bindValue(":tel",$tel,PDO::PARAM_STR);
        $stmt->bindValue(":adresse",$adresse,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":codeFormation",$codeFormation,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $etudiant = new Etudiant($this->getBdd()->lastInsertId(),$nom,$prenom,$age,$genre,$tel,$adresse,$email,$image,$codeFormation);
            $this->ajoutEtudiant($etudiant);
        }        
    }

    public function suppressionEtudiantBD($id){
        $req = "
        Delete from etudiant where id = :idEtudiant
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idEtudiant",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $etudiant = $this->getEtudiantById($id);
            unset($etudiant);
        }
    }

    public function modificationEtudiantBD($id,$nom,$prenom,$age,$genre,$tel,$adresse,$email,$image,$codeFormation){
        $req = "
        update etudiant 
        set nom = :nom, prenom = :prenom, age = :age, genre = :genre, tel = :tel, adresse = :adresse, email = :email, image = :image, codeFormation = :codeFormation
        where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":nom",$nom,PDO::PARAM_STR);
        $stmt->bindValue(":prenom",$prenom,PDO::PARAM_STR);
        $stmt->bindValue(":age",$age,PDO::PARAM_INT);
        $stmt->bindValue(":genre",$genre,PDO::PARAM_INT);
        $stmt->bindValue(":tel",$tel,PDO::PARAM_STR);
        $stmt->bindValue(":adresse",$adresse,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":codeFormation",$codeFormation,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getEtudiantById($id)->setNom($nom);
            $this->getEtudiantById($id)->setPrenom($prenom);
            $this->getEtudiantById($id)->setAge($age);
            $this->getEtudiantById($id)->setGenre($genre);
            $this->getEtudiantById($id)->setTel($tel);
            $this->getEtudiantById($id)->setAdresse($adresse);
            $this->getEtudiantById($id)->setEmail($email);
            $this->getEtudiantById($id)->setImage($image);
            $this->getEtudiantById($id)->setcodeFormation($codeFormation);
        }
    }
}