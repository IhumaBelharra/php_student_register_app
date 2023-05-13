<?php 
ob_start(); 
?>
<form method="POST" action="<?= URL ?>etudiants/av" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom : </label>
        <input type="text" class="form-control" id="prenom" name="prenom">
    </div>
    <div class="form-group">
        <label for="age">Age : </label>
        <input type="number" class="form-control" id="age" name="age">
    </div>
    <div class="form-group">
        <label for="genre">Genre : </label>
        <input type="text" class="form-control" id="genre" name="genre">
    </div>
    <div class="form-group">
        <label for="tel">Tel : </label>
        <input type="text" class="form-control" id="tel" name="tel">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse  : </label>
        <input type="text" class="form-control" id="adresse" name="adresse">
    </div>
    <div class="form-group">
        <label for="email">Email  : </label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="codeFormation">Code formation  : </label>
        <input type="text" class="form-control" id="codeFormation" name="codeFormation">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un étudiant";
require "template.php";
?>