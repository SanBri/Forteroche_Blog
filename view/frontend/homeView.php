<?php session_start(); 
$title = "Blog";
ob_start(); ?>

<div class="container">

<section>
        <div class="welcome_block">
                    <div class="welcome_content">
                        <div class="novel_title">
                            <h2>Billet simple pour l'Alaska</h2>
                        </div>
                        <div class="novel_author">
                            <h2>par Jean Forteroche</h2>
                        </div>
                    </div>
                    <div class="arrow_next">
                        <a href="index.php#ancre"><i class="fas fa-caret-down"></i></a>
                    </div>
        </div> <!-- WELCOME BLOCK END -->
    </section>

    <section>
        <div class="introduction_block">
            <div class="introduction_content">
                <div class="introduction_text">
                    <p id="ancre">VIVEZ UNE HISTOIRE UNIQUE...</p>
                    <p><span class="intro_text_2">QUE VOUS DÉCOUVRIREZ AU FIL DES SEMAINES... </p>
                </div>
                <div class="introduction_navLogo">
                    <div class="firstPost navLogo">
                        <div class="line"></div>
                        <h3>Commencer le roman</h3>
                        <img src="public\images\posts_img\<?= $firstPost['img'] ?>" alt= <?= $firstPost['img'] ?> width="50px"><br />
                        <p><?= $firstPost['title']; ?></p>
                        <a href="index.php?action=post&amp;id=<?= $firstPost['id'] ?>"><input type="button" value="Lire le premier chapitre" class="bttn"></a>
                        <div class="line"></div>
                    </div>
                    <div class="lastPost navLogo">
                        <div class="line"></div>
                        <h3>Dernier chapitre paru</h3>
                        <img src="public\images\posts_img\<?= $lastPost['img'] ?>" alt= <?= $lastPost['img'] ?> width="50px"><br />
                        <p><?= $lastPost['title']; ?></p>
                        <a href="index.php?action=post&amp;id=<?= $lastPost['id'] ?>"><input type="button" value="Lire le dernier chapitre" class="bttn"></a>
                        <div class="line"></div>
                    </div>
                    <div class="info navLogo">
                        <div class="line"></div>
                        <h3>Liste des chapitres</h3>
                        <p><i class="far fa-list-alt"></i></p>
                        <p><?php echo $nbPosts;
                        if ($nbPosts > 1) { ?> 
                            chapitres 
                        <?php } else { ?>
                            chapitre
                        <?php } ?> </p>
                        <a href="index.php?action=posts"><input type="button" value="Voir les chapitres" class="bttn"></a>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div> <!-- INTRODUCTION BLOCK END -->
    </section>

</div> <!-- CONTAINER END --> 

<?php $content = ob_get_clean(); 
require('Template.php'); ?>