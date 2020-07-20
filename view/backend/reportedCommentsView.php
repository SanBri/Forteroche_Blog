<?php 
$title = "Commentaires signalés";
ob_start(); ?>

<div class="title">
    <h1>Commentaires Signalés</h1>
</div>

<?php if ($nbReportedComments > 0) { ?>
    <?php while ( $comment = $comments->fetch() ) { ?>

        <div class="article">

            <p>Ce commentaire a été signalé <strong><?= $comment['reported'] ?></strong> fois :</p><em>" <?= htmlspecialchars($comment['comment']) ?> "</em> <br /> 
            <strong>Auteur :</strong> <em> <?= htmlspecialchars($comment['author']) ?> </em></p>

            <div class="options_icn comment_options icnInList">

                <div class="deleteCommentIcn">
                    <a href="Index.php?action=deleteComment&amp;from=reportedComments&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-times" title="Supprimer ce commentaire"></i>
                </div>

                <div class="legitimateComment">
                    <a href="Index.php?action=legitimateComment&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="far fa-check-circle" title="Légitimer ce commentaire"></i></a>
                </div>

            </div>

            <a href="Index.php?action=post&amp;id=<?= $comment['id_posts'] ?>#<?= $comment['id'] ?>"><input type="button" value="Voir l'article" class="bttn"></a>

        </div>

        <?php } 

} else { ?>
    <div class="article">
        <p>Aucun commentaire signalé !</p>
        <a href="Index.php?action=administration"><input type="button" value="Retour à l'administration" class="bttn"></a>
    </div>

<?php } 

$content = ob_get_clean();
require('view/frontend/Template.php'); ?>
