<?php
class Etudiant{
    private $id;
    private $nom;
    private $prenom;
    private $age;
    private $genre;
    private $tel;
    private $adresse;
    private $email;
    private $image;
    private $codeFormation;

    public function __construct($id,$nom,$prenom,$age,$genre,$tel,$adresse,$email,$image,$codeFormation){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->genre = $genre;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->image = $image;
        $this->codeFormation=$codeFormation;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}

    public function getPrenom(){return $this->prenom;}
    public function setPrenom($prenom){$this->prenom = $prenom;}

    
    public function getAge(){return $this->age;}
    public function setAge($age){$this->age = $age;}

    
    public function getGenre(){return $this->genre;}
    public function setGenre($genre){$this->genre = $genre;}

    
    public function getTel(){return $this->tel;}
    public function setTel($tel){$this->tel = $tel;}

    
    public function getAdresse(){return $this->adresse;}
    public function setAdresse($adresse){$this->adresse = $adresse;}

    
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}

    public function getcodeFormation(){return $this->codeFormation;}
    public function setcodeFormation($codeFormation){$this->codeFormation = $codeFormation;}
}