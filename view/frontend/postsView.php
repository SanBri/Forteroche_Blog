<?php session_start(); 
$title = "Liste des Chapitres";
ob_start(); ?>

<section>
    <div class="container">

        <div class="title">
            <h1>Liste des Chapitres</h1>
        </div>

        <div class="bloc_articles">
            <?php while ($post = $posts->fetch() ) { ?>
            <div class="article">

                <div class="article_title">
                    <h2>Chapitre <?= $post['chapter'] ?> : <?= $post['title']; ?></h2>
                </div>

                <div class="article_content">
                    <div class="article_img">
                    <?php if ($post['img'] != null) { ?>
                        <p><img src="public\images\posts_img\<?= $post['img'] ?>" alt= <?= $post['img'] ?> width="100px"></p>
                    <?php } ?>
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
</section>

<?php $content = ob_get_clean(); 
require('Template.php'); ?>