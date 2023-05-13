<?php 
ob_start(); 
?>

<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>public/images/<?= $etudiant->getImage(); ?>">
    </div>
    <div class="col-6">
        <p>Nom : <?= $etudiant->getNom(); ?></p>
        <p>Prénom : <?= $etudiant->getPrenom(); ?></p>
        <p>Age : <?= $etudiant->getAge(); ?></p>
        <?php if ($etudiant->getGenre() === 0){?>
            <p>Genre : Homme</p>
                <?php } else{?>
                    <p>Genre : Femme</p>
                <?php }?>
        <p>Tel : <?= $etudiant->getTel(); ?></p>
        <p>Adresse : <?= $etudiant->getAdresse(); ?></p>
        <p>Email : <?= $etudiant->getEmail(); ?></p>
        <p>Image : <?= $etudiant->getImage(); ?></p>
        <?php if ($etudiant->getcodeFormation() === '1'){?>
            <p>Code formation : SLAM 1</p>
                <?php } else{?>
                    <p>Code formation : SLAM 2</p>
                <?php }?>
     
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $etudiant->getNom();
require "template.php";
?>