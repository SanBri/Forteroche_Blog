<?php $title = 'Article Inconnu';

ob_start(); ?>


<section>
    <div class="container">

        <div class="title">
            <h1>Article Inconnu</h1>
        </div>

        <div class="error_block">
            <div class="article_content">
                <p><span class="error"><i class="fas fa-question-circle"></i></p>
                <p><span class="error">Erreur 404 :</span> Ce chapitre n'existe pas !</p>
                <a href="index.php?action=posts"><input type="button" value="Retour aux Chapitres" class="bttn"></a>
            </div>
        </div>

    </div>
</section>


<?php $content = ob_get_clean(); 
require('Template.php'); ?>