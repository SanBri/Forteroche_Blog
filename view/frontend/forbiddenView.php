<?php $title = 'Erreur 403 : Accès Interdit';

ob_start(); ?>

<div class="container">

    <div class="article">
        <div class="article_content">
            <p><span class="error_403"><i class="fas fa-hand-paper"></i></p>
            <p><span class="error_403">Erreur 403 :</span> Vous n'avez pas la permission d'accéder à ce contenu.</p>
            <a href="index.php?action=posts"><input type="button" value="Retour aux Articles" class="bttn"></a>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); 
require('Template.php'); ?>