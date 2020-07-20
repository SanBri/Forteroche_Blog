<?php
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

<div class="container">

  <div class="title">
    <h1>Éditer l'article : </br><em>"<?= $post['title'] ?>"</em></h1>
  </div>

  <div class="createPost">
    <form enctype="multipart/form-data" action='Index.php?action=updatePost&amp;id=<?= $post['id'] ?>&amp;img=<?= $post['img'] ?>&amp;token=<?= $_SESSION['token'] ?>' method="post">
      <p><strong>Titre du chapitre : </strong></br><input type="text" value="<?= $post['title'] ?>" name="title" maxlength=50 size=150 required></p>
      <p><strong>Numéro de Chapitre : </strong></br><input type="number" value="<?= $post['chapter'] ?>" name="chapter" min=0 max="9999" size=5  required></p>
      <p><strong>Contenu de l'article : </strong></br><textarea name="content" rows=10 cols=40 required> <?= $post['content'] ?></textarea></p>
      <div class="img_article_content">
        <?php if ($post['img'] != null ) { ?> 
          <p id="actualImageText"><strong>Image actuelle du chapitre :</strong></p>
          <div class="articleImage">
            <i class="fas fa-times" title="Supprimer cette image" id="deletePostImgIcn"></i>
            <p id="actualPostImage"><img src="/public/images/posts_img/<?= $post['img'] ?>" alt="<?= $post['img'] ?>" width="200" ></p>
            <input type="checkbox" name="deletedImageCheck" id="deletedImageCheck"> <!--checkbox pour valeur JS-->
          </div>
          <p>Modifier l'image :
        <?php } else { ?>
          <p>Ajouter une image pour le chapitre :
        <?php } ?> 
        <input type="file" name="image" id="imgPostInput"></p>
      </div>
      <input type="hidden" name="postID" value="<?= $_GET['id'] ?>">
      <a href="index?action=administration"><input type="button" value="Annuler" class="bttn"></a>
      <input type="submit" value="Valider" class="bttn">
    </form>

  </div>

</container>



<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>
