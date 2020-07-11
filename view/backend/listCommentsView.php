<?php session_start();
$title = "Commentaires";
ob_start();
?>

<section>
    <div class="title">
    <h1>Liste des Commentaires</h1>
    </div>

    <div class="buttons_list">
        <a href="Index.php?action=post&amp;id=<?= $_GET['id'] ?>"><input type="button" value="Voir l'article" class="bttn"></a>
        <a href="Index.php?action=administration"><input type="button" value="Retour" class="bttn"></a>
    </div>


    <?php while ($comment = $comments->fetch() ) { ?>

            <div class="each_comment article">
                <div class="comment_info">
                    <p><?= '<strong>' . htmlspecialchars($comment['author']) .  '</strong> |  <em>' . $comment['creation_date_fr'] . '</em>'; ?></p>
                </div>
                <div class="comment_content">
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                </div>
                <div class="comment_icn icnInList">
                    <a href="Index.php?action=deleteComment&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-times deleteCommentIcn" title="Supprimer ce commentaire"></i></a>
                </div>
            </div>

    <?php } ?>

</section>

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>