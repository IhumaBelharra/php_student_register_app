<?php 
ob_start(); 
?>
 <img src="public/images/logo-ep.png" alt="Ecole Pratique" class="mt-5 rounded mx-auto d-block"> 
<?php
$content = ob_get_clean();
$titre = "Gestion étudiants";
require "template.php";
?>