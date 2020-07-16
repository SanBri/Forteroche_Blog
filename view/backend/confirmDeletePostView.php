<?php session_start(); 
$title = 'Confirmation';
ob_start(); ?>

    <div class="container">
        <div class="error_block">
            <div class="article_content">
                <p><span class="warning"><i class="fas fa-exclamation-circle"></i></p>
                <p><span class="warning">Attention :</span> Êtes-vous sûr de vouloir supprimer ce chapitre ?</p>
                <p><strong>Le contenu, les images et les commentaires asssociés à celui-ci ne pourront pas être récupérés</strong></p>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><input type="button" value="Annuler" class="bttn"></a>
                <a href="index.php?action=deletePost&amp;id=<?= $_GET['id'] ?>&amp;img=<?= $_GET['img'] ?>&amp;token=<?= $_SESSION['token'] ?>"><input type="button" value="Confirmer" class="bttn red"></a>
            </div>
        </div>
    </div>


<?php $content = ob_get_clean(); 
require('view/frontend/Template.php'); ?>