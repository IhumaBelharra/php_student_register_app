<?php 
ob_start(); 
?>

<form method="POST" action="<?= URL ?>login/c" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Identifiant : </label>
        <input type="text" class="form-control" id="login" name="login" value="">
    </div>
    <div class="form-group">
        <label for="nbPages">Mot de passe : </label>
        <input type="password" class="form-control" id="pass" name="pass" value="">
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Connexion : ";
require "template.php";
?>