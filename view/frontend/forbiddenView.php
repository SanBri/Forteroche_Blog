<?php $title = 'Erreur 403 : Accès Interdit';

ob_start(); ?>

<section>
    <div class="container">

        <div class="title">
            <h1>Accès Interdit</h1>
        </div>

        <div class="error_block">
            <div class="article_content">
                <p><span class="error"><i class="fas fa-hand-paper"></i></p>
                <p><span class="error">Erreur 403 :</span> Vous n'avez pas la permission d'accéder à ce contenu.</p>
                <a href="index.php?action=posts"><input type="button" value="Retour aux Articles" class="bttn"></a>
            </div>
        </div>

    </div>
</section>


<?php $content = ob_get_clean(); 
require('Template.php'); ?>