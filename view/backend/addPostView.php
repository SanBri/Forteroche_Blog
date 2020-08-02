<?php 
session_start();
$title = "Nouvel Article";
ob_start();
if ($lastPost) {
  $newChapter = $lastPost['chapter'] + 1;
} ?>

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
    <h1>Ajouter un Article </h1>
  </div>

  <div class="createPost">
      <form action='index.php?action=newPost&amp;token=<?= $_SESSION['token'] ?>' method="post" enctype="multipart/form-data"> 
          <p><input type="text" placeholder="Titre du chapitre" name="title" maxlength=50 size=150 required></p>
          <p><strong>Numéro de Chapitre : </strong><input type="number" name="chapter" 
          <?php if ($lastPost) { ?>
            value="<?= $newChapter ?>" 
          <?php } else { ?> 
            value="1" <?php 
          } ?> min="0" max="9999" size="3"  required></p>
          <p><textarea placeholder="" name="content" rows=10 cols=40></textarea></p>
          <p><input type="file" name="image"></p>
          <a href="index?action=administration"><input type="button" value="Annuler" class="bttn"></a>
          <input type="submit" value="Valider" class="bttn">
      </form>
  </div>

</div>

<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>