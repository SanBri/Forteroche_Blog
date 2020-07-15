<?php $title = 'Erreur 403 : Accès Interdit';

ob_start(); ?>


    <div class="error_block">
        <div class="article_content">
            <p><span class="error"><i class="fas fa-hand-paper"></i></p>
            <p><span class="error">Erreur 403 :</span> Vous n'avez pas la permission d'accéder à ce contenu.</p>
            <a href="index.php?action=posts"><input type="button" value="Retour aux Articles" class="bttn"></a>
        </div>
    </div>


<?php $content = ob_get_clean(); 
require('Template.php'); ?>