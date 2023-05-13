<?php 
ob_start(); 
?>

<form method="POST" action="<?= URL ?>etudiants/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $etudiant->getNom() ?>">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom : </label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $etudiant->getPrenom() ?>">
    </div>
    <div class="form-group">
        <label for="age">Age : </label>
        <input type="number" class="form-control" id="age" name="age" value="<?= $etudiant->getAge() ?>">
    </div>
    <div class="form-group">
        <label for="genre">Genre : </label>
        <?php if ($etudiant->getGenre() === '0'){?>
            <input type="text" class="form-control" id="genre" name="genre" value="Homme">
                <?php } else{?>
                    <input type="text" class="form-control" id="genre" name="genre" value="Femme">
                <?php }?>
    </div>
    <div class="form-group">
        <label for="tel">Tel : </label>
        <input type="text" class="form-control" id="tel" name="tel" value="<?= $etudiant->getTel() ?>">
    </div>    
    <div class="form-group">
        <label for="adresse">Adresse : </label>
        <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $etudiant->getAdresse() ?>">
    </div>
    <div class="form-group">
        <label for="email">Email : </label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $etudiant->getEmail() ?>">
    </div>
    <div class="form-group">
        <label for="codeFormation">Code formation : </label>
        <?php if ($etudiant->getcodeFormation() === '1'){?>
            <input type="text" class="form-control" id="codeFormation" name="codeFormation" value="SLAM 1">
                <?php } else{?>
                    <input type="text" class="form-control" id="codeFormation" name="codeFormation" value="SLAM 2">
                <?php }?>
    </div>

    <h3>Images : </h3>
    <img src="<?= URL ?>public/images/<?= $etudiant->getImage() ?>">
    <div class="form-group">
        <label for="image">Changer l'image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $etudiant->getId(); ?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Modification étudiant : ".$etudiant->getId();
require "template.php";
?>