<?php 
ob_start(); 
?>
<form method="POST" action="<?= URL ?>admins/av" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Login : </label>
        <input type="text" class="form-control" id="login" name="login">
    </div>
    <div class="form-group">
        <label for="nbPages">Mot de passe : </label>
        <input type="password" class="form-control" id="pass" name="pass">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un utilisateur";
require "template.php";
?>