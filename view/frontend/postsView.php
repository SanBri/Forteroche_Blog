<?php session_start(); 
$title = "Blog";
ob_start(); ?>

<div class="container">

    <div class="bloc_articles">
    
        <?php while ($post = $posts->fetch() ) { ?>
        <div class="article">
            <div class="article_title">
                <h2><?php echo $post['title'];?></h2>
            </div>

            <div class="article_content">
                <div class="article_text">
                    <p><?php echo $post['content'];?></p>
                    <a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><input type="button" value="Lire la suite" class="bttn"></a>
                </div> 
            </div>
        </div>
        <?php } ?>
    
    </div>

</div>

<?php $content = ob_get_clean(); 
require('Template.php'); ?>


