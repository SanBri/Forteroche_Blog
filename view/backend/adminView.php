<?php 
$title = "Administration du Blog";
ob_start(); ?>

<section>
    <div class="container">

        <div class="title">
            <h1>Administration</h1>
        </div>

        <?php if ( $nbReportedComments > 0 ) { ?>
            <div class="reportedComments_block">
                <?php if ($nbReportedComments > 1) { ?>
                    <p><?= $nbReportedComments ?> commentaires ont été signalés
                    <a href="index.php?action=reportedComments"><input type="button" class="bttn reported" value="Voir les commentaires"></p></a>
                <?php } else { ?> 
                    <p>1 commentaire a été signalé
                    <a href="index.php?action=reportedComments"><input type="button" class="bttn reported" value="Voir le commentaire"></p></a>
                <?php } ?>
            </div> <!-- reportedComments_block END -->
        <?php } ?> <!-- IF END -->

        <div class="addPost block"><a href="Index.php?action=createPost">
        <p><i class="fas fa-plus-square"></i>Ajouter un article</p>
        </a></div> <!-- addPost_block END -->

        <?php while ($post = $posts->fetch() ) { ?>

            <div class="article">

                <h3><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"> Chapitre <?= $post['chapter']; ?> : <br /><?= $post['title']; ?></a></h3>
                <p><em>Posté <?= $post['creation_date_fr']; ?></em></p>

                <div class="options_icn post_options">
                    <div class="editPost">
                        <a href="index.php?action=editPost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-edit" title="Modifier l'article"></i></a>                        
                    </div>
                    <div class="deletePost">
                        <a href="index.php?action=confirmDeletePost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-trash-alt" title="Supprimer l'article"></i></a>
                    </div>
                    <div class="deleteComment">
                        <a href="index.php?action=listComment&amp;id=<?= $post['id'] ?>"><i class="fas fa-comment-slash" title="Supprimer un commentaire"></i></a>
                    </div>
                </div> <!-- OPTIONS_ICN END -->
                
            </div> <!-- ARTICLE END -->

        <?php } ?> <!-- WHILE END -->

        <div class="pagination_block">
                
                <?php if ($currentPage > 1) { ?> 
                    <a href="Index.php?action=administration&amp;page=<?= $currentPage - 1 ?>"><input type="button" value="« Page précédente" class="bttn"></a>
                    <a href="Index.php?action=administration&amp;page=1"><input type="button" value="1" class="bttn"></a>

                <?php } ?>
                <!-- PAGE ACTUELLE -->
                <input type="button" value="<?= $currentPage?>" class="bttn current">
                <!-- PAGE ACTUELLE -->
                <?php if ($currentPage < $pages) { ?>
                    <a href="Index.php?action=administration&amp;page=<?= $pages ?>"><input type="button" value="<?= $pages ?>" class="bttn"></a>   
                    <a href="Index.php?action=administration&amp;page=<?= $currentPage + 1 ?>"><input type="button" value="Page suivante »" class="bttn"></a> 
                <?php }   ?>

        </div> <!-- PAGINATION_BLOCK END -->

    <!--  
        <div class="addAdmin block"><a href="Index.php?action=registerAccess">
            <i class="fas fa-user-lock"></i>
            <p>Ajouter un administrateur</p>
        </a></div> <! -- addAdmin block END 
    -->

    </div> <!-- CONTAINER END -->
</section>

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>