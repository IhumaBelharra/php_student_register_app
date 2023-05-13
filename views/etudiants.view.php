<?php 
ob_start(); 

if(!empty($_SESSION['alert'])) :
?>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>
<?php 
unset($_SESSION['alert']);
endif; 
?>

<div class="row">
  <?php 
    for($i=0; $i < count($etudiants);$i++) : 
    ?>
      <div class="col">
        <div class="card p-1 m-1" style="width: 18rem;">
          <img height="300px" src="<?= URL ?>public/images/<?= $etudiants[$i]->getImage(); ?>" class="card-img-top" alt="image">
          <div class="card-body">
            <h5 class="card-title"><?= $etudiants[$i]->getNom(); ?></h5>
            <p class="card-text"><?= $etudiants[$i]->getPrenom(); ?></p>
            <?php if ($etudiants[$i]->getcodeFormation() === '1'){?>
            <p>SLAM 1</p>
                <?php } else{?>
                    <p>SLAM 2</p>
                <?php }?>
            <a href="<?= URL ?>etudiants/l/<?= $etudiants[$i]->getId(); ?>" class="btn btn-outline-primary btn-sm">Détail</a>
            <?php if (isset($_SESSION['logged'])){?>
            <a href="<?= URL ?>etudiants/m/<?= $etudiants[$i]->getId(); ?>" class="btn btn-outline-success btn-sm">Modifier</a>
            <a href="<?= URL ?>etudiants/s/<?= $etudiants[$i]->getId(); ?>" class="btn btn-outline-danger btn-sm">Supprimer</a>
            <?php }?>
          </div>
        </div>
      </div>
    <?php endfor;?>
  </div>
<?php if (isset($_SESSION['logged'])){?>
<a href="<?= URL ?>etudiants/a" class="btn btn-success d-block">Ajouter</a>
<?php }?>
<?php
$content = ob_get_clean();
$titre = "Les étudiants de la formation";
require "template.php";
?>