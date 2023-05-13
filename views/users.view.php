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

<table class="table text-center">
    <tr class="table-dark">
        <th>ID</th>
        <th>Login</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for($i=0; $i < count($users);$i++) : 
    ?>
    <tr>
      <td class="align-middle"><?= $users[$i]->getId(); ?></td>
        <td class="align-middle"><?= $users[$i]->getLogin(); ?></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>admins/s/<?= $users[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>admins/a" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Utilisateurs";
require "template.php";
?>