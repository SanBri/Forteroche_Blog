<?php session_start();
$title = "Commentaires";
ob_start();
?>

<section>

    <div class="container">

        <div class="title">
        <h1>Liste des Commentaires</h1>
        </div>

        <div class="buttons_list">
            <a href="Index.php?action=post&amp;id=<?= $_GET['id'] ?>"><input type="button" value="Voir l'article" class="bttn"></a>
            <a href="Index.php?action=administration"><input type="button" value="Retour" class="bttn"></a>
        </div>

        <div class="bloc_articles">
            <?php while ($comment = $comments->fetch() ) { ?>
            
                <div class="comment article">
                    <div class="comment_info">
                        <p><?= '<strong>' . htmlspecialchars($comment['author']) .  '</strong> |  <em>' . $comment['creation_date_fr'] . '</em>'; ?></p>
                        <div class="short_line"></div>
                    </div>
                    <div class="comment_content">
                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                    </div>
                    <div class="comment_icn icnInList">
                        <a href="Index.php?action=deleteComment&amp;from=listComments&amp;id=<?= $_GET['id'] ?>&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-times deleteCommentIcn" title="Supprimer ce commentaire"></i></a>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div> <!-- END CONTAINER -->

</section>

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>