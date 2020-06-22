<?php session_start();
$title = "Nouvel Article";
ob_start(); ?>

<form action='Index.php?action=newPost' method="post">
    <p><input type="text" placeholder="Titre" name="title" maxlength=50 size=15/></p>
    <p><textarea placeholder="Veuillez rédiger votre article" name="content" rows=10 cols=40></textarea></p>
    <input type="submit" value="Envoyer">
</form>

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>