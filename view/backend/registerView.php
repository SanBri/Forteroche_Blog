<?php $title = "Nouvel Administrateur"; 
ob_start(); ?>

<section>
    <div class="title">
        <h1>Ajout d'un nouvel administrateur</h1>
    </div>

    <div class="connexion_block">
        <form action='Index.php?action=addAdmin'  method='post'>
            <p>Identifiant : <input type="text" name="login"></p>
            <p>Mot de passe : <input type="password" name="password"></p>
            <input type="submit" value="Valider" class="bttn">
            <a href="index.php?action=administration"><input type="button" value="Retour" class="bttn"></a>
        </form>
    </div>
</section>

<?php $content = ob_get_clean();
require('view/frontend/Template.php');