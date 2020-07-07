<?php session_start();
$title = "Nouvel Article";
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
  <h1>Ajouter un Article</h1>
</div>

<div class="createPost">
    <form action='Index.php?action=newPost' method="post" enctype="multipart/form-data"> 
        <p><input type="text" placeholder="Titre de l'article" name="title" maxlength=50 size=150/></p>
        <p><textarea placeholder="" name="content" rows=10 cols=40></textarea></p>
        <input type="submit" value="Valider" class="bttn">
    </form>
</div>


<?php $content = ob_get_clean();
require('view/frontend/Template.php'); ?>