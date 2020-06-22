<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Article</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/Blog.css">
</head>
<body>

<div class="container">

    <div class="header">
        <!-- < ? = // $header ?> -->
    </div>

    <div class="article">

        <div class="article_title">
            <h2><?= $post['title'];?></h2>
        </div>

        <div class="article_content">
            <div class="article_text">
                <p><?= $post['content']; ?></p>
                <p><a href="index.php?action=posts">Retour aux articles</a></p>
            </div>
        </div>

    </div> <!-- ARTICLE END --->

    <div class="article">

        <div class="comments_title">
            <h2>Commentaires</h2>
        </div>

        <div class="add_comment">
            <h3>Ajouter un commentaire :</h3>
            <form action="Cible.php" method="post">
                <p><input type="text" placeholder="Nom d'utilisateur" name="userName" maxlength=20 size=15/></p>
                <p><textarea placeholder="Veuillez rédiger votre commentaire" name="comment" rows=10 cols=40></textarea></p>
                <input type="hidden" name="postID" value="<?= $_GET['id'] ?>">
                <span class="emptyForm"><p>Veuillez renseigner tous les champs !</p></span>
                <input type="submit" id="redirCom">
            </form>
        </div> 


        <?php 
            while ($comment = $comments->fetch() ) { ?>
            <div class="each_comment">
                <div class="comment_info">
                        <p><?= '<strong>' . htmlspecialchars($comment['author']) .  '</strong> |  <em>' . $comment['creation_date_fr'] . '</em>'; ?></p>
                    </div>
                <div class="comment_content">
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                </div>
            </div>
        <?php } ?>

    </div> <!-- ARTICLE END --->

</div> <!-- CONTAINER END --->

<?php require('controller/commentsCtrlr.php'); ?>

</body>
</html>