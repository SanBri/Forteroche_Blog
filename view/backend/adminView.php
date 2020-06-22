<?php
$title = "Administration du Blog";
ob_start(); ?>

<div class="title">
    <h1>Administration</h1>
</div>

    <?php if ( $nbReportedComments > 0 ) { ?>
        <div class="reportedComments_block">
        <?php if ($nbReportedComments > 1) { ?>
            <p><?= $nbReportedComments ?> commentaires ont été signalés
        <?php } else { ?> 
            <p>1 commentaire a été signalé
        <?php } ?>
            <a href="index.php?action=reportedComments"><input type="button" class="bttn reported" value="Voir les commentaires"></p></a>
        </div>
    <?php } ?>

    <div class="addPost_block"><a href="Index.php?action=createPost">
        <i class="fas fa-plus-square"></i>
        <p>Ajouter un article</p>
    </a></div>


    <?php while ($post = $posts->fetch() ) { ?>
        <div class="article">
            <h3><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"> <?= $post['title']; ?></a></h3>
            <p><em>Posté <?= $post['creation_date_fr']; ?></em></p>

            <div class="options_icn post_options">

                <div class="editPost">
                    <i class="fas fa-edit" title="Modifier l'article"></i>
                </div>
                <div class="deletePost">
                    <a href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>"><i class="fas fa-trash-alt" title="Supprimer l'article"></i></a>
                </div>
                <div class="deleteComment">
                    <a href="index.php?action=listComment&amp;id=<?= $post['id'] ?>"><i class="fas fa-comment-slash" title="Supprimer un commentaire"></i></a>
                </div>

            </div>

        </div>
    <?php } ?>
</div>
<!--  -->

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>