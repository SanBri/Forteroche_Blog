<?php $title = "Connexion"; 
ob_start(); ?>

<div class="connexion_block">
    <form action='Index.php?action=checkConnexion'  method='post'>
        <p>Identifiant : <input type="text" name="login"></p>
        <p>Mot de passe : <input type="password" name="password"></p>
        <input type="submit" value="Valider" class="bttn">
        <a href="index.php?action=posts"><input type="button" value="Retour" class="bttn"></a>
    </form>
</div>



<?php $content = ob_get_clean();
require('Template.php');