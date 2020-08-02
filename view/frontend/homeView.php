<?php session_start(); 
$title = "Blog";
ob_start(); ?>

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
                <div class="space">
                <div class="introduction_navLogo">
                <?php if ( (isset($_COOKIE['actualChapter'])) && ($actualPost) )  { ?>
                    <div class="firstPost navLogo"> 
                        <h3>Reprendre la lecture :</h3>
                        <div class="short_line"></div>
                        <p>Chapitre <?= $actualPost['chapter'] ?></p>
                        <?php if ($actualPost['img'] != null) { ?>
                            <img src="public\images\posts_img\<?= $actualPost['img'] ?>" alt= <?= $actualPost['img'] ?> width="50px"><br />
                        <?php } ?>
                        <p><em>"<?= $actualPost['title'] ?>"</em></p>
                        <a href="index.php?action=post&amp;id=<?= $actualPost['id'] ?>"><input type="button" value="Reprendre la lecture" class="bttn"></a>
                    </div>
                <?php } else { ?>
                    <div class="firstPost navLogo">
                        <h3>Commencer le roman</h3>
                        <div class="short_line"></div>
                        <p>Chapitre <?= $firstPost['chapter'] ?></p>
                        <?php if ($firstPost['img'] != null) { ?> 
                            <img src="public\images\posts_img\<?= $firstPost['img'] ?>" alt= <?= $firstPost['img'] ?> width="50px"><br />
                        <?php } ?>
                        <p><em>"<?= $firstPost['title']; ?>"</em></p>
                        <a href="index.php?action=post&amp;id=<?= $firstPost['id'] ?>"><input type="button" value="Lire le premier chapitre" class="bttn"></a>
                    </div>
                <?php } ?>
                    <div class="lastPost navLogo">
                        <h3>Dernier chapitre paru</h3>
                        <div class="short_line"></div>
                        <p>Chapitre <?= $lastPost['chapter'] ?></p>
                        <?php if ($lastPost['img'] != null) { ?> 
                            <img src="public\images\posts_img\<?= $lastPost['img'] ?>" alt= <?= $lastPost['img'] ?> width="50px"><br />
                        <?php } ?>
                        <p><em>"<?= $lastPost['title']; ?>"</em></p>
                        <a href="index.php?action=post&amp;id=<?= $lastPost['id'] ?>"><input type="button" value="Lire le dernier chapitre" class="bttn"></a>
                    </div>
                    <div class="info navLogo">
                        <h3>Liste des chapitres</h3>
                        <div class="short_line"></div>
                        <p><i class="far fa-list-alt"></i></p>
                        <p><?php echo $nbPosts;
                        if ($nbPosts > 1) { ?> 
                            chapitres 
                        <?php } else { ?>
                            chapitre
                        <?php } ?> </p>
                        <a href="index.php?action=posts"><input type="button" value="Voir les chapitres" class="bttn"></a>
                    </div>
                </div>
            </div>
        </div> <!-- INTRODUCTION BLOCK END -->
    </section>

<?php $content = ob_get_clean(); 
require('Template.php'); ?>