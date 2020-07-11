<?php session_start(); 
$title = $post['title'];
ob_start(); ?>

<div class="container">

    <section> <!--- POST SECTION --->
        <div class="article">

            <div class="article_title">
                <h2><?= $post['title'];?></h2>
            </div>

            <div class="article_img">   
                <img src="public\images\<?= $post['img'] ?>" alt= <?= $post['img'] ?> width="350px">
            </div>

            <div class="line"></div>


            <div class="article_content">
                <div class="article_text">
                    <p><?= $post['content']; ?></p>
                    <a href="index.php?action=posts"><input type="button" value="Retour aux Articles" class="bttn"></a>
                </div>
                <?php if ( isset($_SESSION['admin']) ) { ?> 
                    <div class="line up bottom"></div>
                    <div class="options_icn post_options">
                        <div class="editPost">
                            <a href="index.php?action=editPost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-edit" title="Modifier l'article"></i></a>                        
                        </div>
                        <div class="deletePost">
                        
                        <a href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>">
                            <i class="fas fa-trash-alt" title="Supprimer l'article"></i>
                        </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div> 
    </section> <!-- POST END --->

    <section> <!-- COMMENTS SECTION --->
        <div class="article">

            <div class="comments_title">
                <h2>Commentaires</h2>
            </div>

            <div class="add_comment_block">
                <h3>Ajouter un commentaire :</h3>
                <form action='Index.php?action=postComment&amp;id=<?= $_GET["id"] ?>' method="post">
                    <p><input type="text" placeholder="Nom d'utilisateur" name="userName" maxlength=20 size=15/></p>
                    <p><textarea placeholder="Veuillez rédiger votre commentaire" name="comment" rows=10 cols=40></textarea></p>
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div><br/>
                    <input type="hidden" name="postID" value="<?= $_GET['id'] ?>">
                    <input type="submit" value="Envoyer" id="redirCom">
                </form>
            </div> 

            <?php while ($comment = $comments->fetch() ) { ?>
                <div class="each_comment" >

                    <div class="line"></div>
                
                    <div class="comment_info">
                            <p><?= '<strong>' . htmlspecialchars($comment['author']) .  '</strong> |  <em>' . $comment['creation_date_fr'] . '</em>'; ?></p>
                    </div>

                    <div class="comment_content">
                        <div class="comment_text">
                            <p><?= htmlspecialchars($comment['comment']) ?></p>
                        </div>
                        <div class="comment_icn">
                            <?php if ( isset($_SESSION['admin']) ) { ?> 
                                <a href="Index.php?action=deleteComment&amp;comId=<?= $comment['id'] ?>&amp;token=<?= $_SESSION['token'] ?>"><i class="fas fa-times" title="Supprimer ce commentaire"></i></a>
                            <?php } else { 
                                if ( isset($_SESSION['"'.$comment['id'].'"']) && $_SESSION['"'.$comment['id'].'"'] === $comment['id'])  { ?>
                                    <a href="Index.php?action=cancelReportComment&amp;id=<?= $comment['id_posts'] ?>&amp;comId=<?= $comment['id'] ?>"><i class="far fa-check-circle" id="legitimateComment" title="Désignaler ce commentaire"></i></a>
                                <?php } else { ?>
                                    <a href="Index.php?action=reportComment&amp;id=<?= $comment['id_posts'] ?>&amp;comId=<?= $comment['id'] ?>"><i class="fas fa-exclamation-circle reportComment" title="Signaler ce commentaire"></i></a>
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
