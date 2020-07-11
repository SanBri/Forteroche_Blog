<?php session_start();
$title = "Éditer un article";
ob_start(); ?>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: ' advlist link image lists',
    toolbar: 'undo redo | styleselect | bold italic underline | link image | alignleft aligncenter alignright alignjustify  | outdent indent',
    toolbar_mode: 'floating',
  });
</script>

<div class="title">
  <h1>Éditer l'article : </br><em>"<?= $post['title'] ?>"</em></h1>
</div>

<div class="createPost">
    <form enctype="multipart/form-data" action='Index.php?action=updatePost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>' method="post">
        <p><strong>Titre de l'article : </strong></br><input type="text" value="<?= $post['title'] ?>" name="title" maxlength=50 size=150/></p>
        <p><strong>Contenu de l'article : </strong></br><textarea name="content" rows=10 cols=40><?= $post['content'] ?></textarea></p>
        <p><strong>Image actuelle de l'article :</strong></p>
        <p><img src="/public/images/<?= $post['img'] ?>" alt="<?= $post['img'] ?>" width="350px"></p>
        <p>Modifier l'image : <input type="file" name="image"></p>
        <input type="hidden" name="postID" value="<?= $_GET['id'] ?>">
        <input type="submit" value="Valider" class="bttn">
    </form>
</div>


<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>