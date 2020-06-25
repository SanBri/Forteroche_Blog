<?php $title = 'Article Inconnu';

ob_start(); ?>

<div class="container">

    <div class="article">
        <div class="article_content">
                <p>Cet article n'existe pas !</p>
                <a href="index.php?action=posts"><input type="button" value="Retour aux Articles" class="bttn"></a>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); 
require('Template.php'); ?>