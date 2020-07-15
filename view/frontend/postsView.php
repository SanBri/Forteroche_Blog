<?php session_start(); 
$title = "Blog";
ob_start(); ?>

<div class="container">

    <div class="bloc_lastPost article">
        <h3>Dernier chapitre publié :</h3>
        <p><img src="public\images\posts_img\<?= $lastPost['img'] ?>" alt= <?= $lastPost['img'] ?> width="100px"></p>
        <p><strong><?= $lastPost['title']; ?></strong></p>
        <a href="index.php?action=post&amp;id=<?= $lastPost['id'] ?>"><input type="button" value="Lire le dernier chapitre" class="bttn"></a>
    </div> <!--- LASTPOST END --->

    <div class="bloc_articles">
    
        <?php while ($post = $posts->fetch() ) { ?>
        <div class="article">
            <div class="article_title">
                <h2><?php echo $post['title'];?></h2>
            </div>

            <div class="article_content">
                <div class="article_img">
                <p><img src="public\images\posts_img\<?= $post['img'] ?>" alt= <?= $post['img'] ?> width="250px"></p>
                <a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><input type="button" value="Lire le chapitre" class="bttn"></a>
                </div> 
            </div>
        </div>
        <?php } ?>

        <div class="pagination_block">
            
            <?php if ($currentPage > 1) { ?> 
                <a href="Index.php?action=posts&amp;page=<?= $currentPage - 1 ?>"><input type="button" value="« Page précédente" class="bttn"></a>
                <a href="Index.php?action=posts&amp;page=1"><input type="button" value="1" class="bttn"></a>

            <?php } ?>
            <!-- PAGE ACTUELLE -->
            <input type="button" value="<?= $currentPage?>" class="bttn current">
            <!-- PAGE ACTUELLE -->
            <?php if ($currentPage < $pages) { ?>
                <a href="Index.php?action=posts&amp;page=<?= $pages ?>"><input type="button" value="<?= $pages ?>" class="bttn"></a>   
                <a href="Index.php?action=posts&amp;page=<?= $currentPage + 1 ?>"><input type="button" value="Page suivante »" class="bttn"></a> 
            <?php }   ?>

        </div> <!-- PAGINATION_BLOCK END -->
    
    </div> <!-- BLOC_ARTICLES END -->

</div> <!-- CONTAINER END !-->

<?php $content = ob_get_clean(); 
require('Template.php'); ?>