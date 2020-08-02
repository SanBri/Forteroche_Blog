<?php session_start(); 
$title = $post['title'];
ob_start(); ?>

<div class="container">

    <section> <!--- POST SECTION --->
        <div class="light_block">
            <div class="lightMode">
                <i class="far fa-lightbulb" id="bright" title="Allumer la lumière"></i>
                <i class="fas fa-lightbulb" id="dark" title="Éteindre la lumière"></i>
            </div>
        </div>
    
        <div class="article each_post">

            <div class="nav_chapters">
               <?php if ($_GET['id'] != $firstPost['id']) { ?>
                <a href="index.php?action=previousPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="< Chapitre Précédent" class="bttn"></a>
                <?php } ?>
                <a href="index.php?action=posts"><input type="button" value="Retour aux Chapitres" class="bttn"></a>
                <?php if ($_GET['id'] != $lastPost['id']) { ?>
                <a href="index.php?action=nextPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="Chapitre Suivant >" class="bttn"></a> 
                <?php } ?>
            </div>
            <div class="nav_chapters_smartphone on_top"> <!-- NAVIGATION SMARTPHONE -->
               <?php if ($_GET['id'] != $firstPost['id']) { ?>
                <a href="index.php?action=previousPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="< Précédent" class="bttn"></a>
                <?php } ?>
                <a href="index.php?action=posts"><input type="button" value="Chapitres" class="bttn"></a>
                <?php if ($_GET['id'] != $lastPost['id']) { ?>
                <a href="index.php?action=nextPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="Suivant >" class="bttn"></a> 
                <?php } ?>
            </div>

            <div class="article_content">
                
                <div class="line top bottom"></div>
                <div class="article_title">
                    <h2><em>Chapitre <?= $post['chapter'] ?></em><br />
                    <?= $post['title'];?></h2>
                </div>
            
                <?php if ($post['img'] != null) { ?> 
                    <div class="article_img">   
                        <img src="public\images\posts_img\<?= $post['img'] ?>" alt= <?= $post['img'] ?> >
                    </div>
                <?php } ?>

                <div class="article_text">
                    <p><?= $post['content']; ?></p>
                </div>
                <div class="line top bottom"></div>

                <?php if ( isset($_SESSION['admin']) ) { ?> 
                    <div class="options_icn post_options">
                        <div class="editPost">
                            <a href="index.php?action=editPost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-edit" title="Modifier l'article"></i></a>                        
                        </div>
                        <div class="deletePost">
                            <a href="index.php?action=confirmDeletePost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>">
                            <i class="fas fa-trash-alt" title="Supprimer l'article"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div> 
                
            <div class="nav_chapters">
                <?php if ($_GET['id'] != $firstPost['id']) { ?>
                    <a href="index.php?action=previousPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="< Chapitre Précédent" class="bttn"></a>
                <?php } ?>
                    <a href="index.php?action=posts"><input type="button" value="Retour aux Chapitres" class="bttn"></a>
                <?php if ($_GET['id'] != $lastPost['id']) { ?>
                    <a href="index.php?action=nextPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="Chapitre Suivant >" class="bttn"></a> 
                <?php } ?>
            </div>
            <div class="nav_chapters_smartphone"> <!-- NAVIGATION SMARTPHONE -->
               <?php if ($_GET['id'] != $firstPost['id']) { ?>
                <a href="index.php?action=previousPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="< Précédent" class="bttn"></a>
                <?php } ?>
                <a href="index.php?action=posts"><input type="button" value="Chapitres" class="bttn"></a>
                <?php if ($_GET['id'] != $lastPost['id']) { ?>
                <a href="index.php?action=nextPost&amp;id=<?=  $post['id'] ?>"><input type="button" value="Suivant >" class="bttn"></a> 
                <?php } ?>
            </div>


        </div> 
    </section> <!-- POST END --->

    <section> <!-- COMMENTS SECTION --->
        <div class="article comment">

            <div class="comments_title">
                <h2>Commentaires</h2>
            </div>

            <div class="add_comment_block">
                <h3>Ajouter un commentaire :</h3>
                <form action='index.php?action=postComment&amp;id=<?= $_GET["id"] ?>' method="post">
                    <p><input type="text" placeholder="Nom d'utilisateur" name="userName" maxlength=20 size=15/ required></p>
                    <p><textarea placeholder="Veuillez rédiger votre commentaire..." name="comment" rows=10 cols=40 required></textarea></p>
                    <div class="g-recaptcha" data-sitekey="6LesybMZAAAAAO9I7Krz8C7b3SQe0lRqAp_XNd04"></div><br/>
                    <input type="hidden" name="postID" value="<?= $_GET['id'] ?>">
                    <input type="submit" class="bttn" value="Envoyer" id="redirCom">
                </form>
            </div> 

            <?php while ($comment = $comments->fetch() ) { ?>
                <div class="each_comment" >

                    <div class="line"></div>
                
                    <div class="comment_info">
                            <p><?= '<strong>' . htmlspecialchars($comment['author']) .  '</strong> |  <em>' . $comment['creation_date_fr'] . '</em>'; ?></p>
                            <div class="short_line"></div>
                    </div>



                    <div class="comment_content">
                        <div class="comment_text">
                            <p><?= htmlspecialchars($comment['comment']) ?></p>
                        </div>
                        <div class="comment_icn">
                            <?php if ( isset($_SESSION['admin']) ) { ?> 
                                <a href="index.php?action=deleteComment&amp;from=post&amp;id=<?= $post['id'] ?>&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-times" title="Supprimer ce commentaire"></i></a>
                            <?php } else { 
                                if ( isset($_SESSION['"'.$comment['id'].'"']) && $_SESSION['"'.$comment['id'].'"'] === $comment['id'])  { ?>
                                    <a href="index.php?action=cancelReportComment&amp;id=<?= $comment['id_posts'] ?>&amp;comId=<?= $comment['id'] ?>"><i class="far fa-check-circle" id="legitimateComment" title="Désignaler ce commentaire"></i></a>
                                <?php } else { ?>
                                    <a href="index.php?action=reportComment&amp;id=<?= $comment['id_posts'] ?>&amp;comId=<?= $comment['id'] ?>"><i class="fas fa-exclamation-circle reportComment" title="Signaler ce commentaire"></i></a>
                                <?php }
                            } ?>
                        </div>
                    </div>
                
                </div>
            <?php } ?>

        </div> 
    </section> <!-- COMMENTS END --->

</div> <!-- CONTAINER END --->

<?php $content = ob_get_clean(); 
require('Template.php'); ?>