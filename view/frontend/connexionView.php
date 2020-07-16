<?php $title = "Connexion"; 
ob_start(); ?>

<div class="title">
    <h1>Connexion</h1>
</div>

<div class="connexion_block">
    <form action='Index.php?action=checkConnexion'  method='post'>
        <p>Identifiant : <input type="text" name="login" required></p>
        <p>Mot de passe : <input type="password" name="password" required></p>
        <input type="submit" value="Valider" class="bttn">
        <a href="index.php"><input type="button" value="Retour" class="bttn"></a>
    </form>
</div>

<?php $content = ob_get_clean();
require('Template.php');

