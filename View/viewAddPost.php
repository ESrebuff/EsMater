<?php $this->title = "Mon Blog";
$this->tiny = "https://cdn.tiny.cloud/1/r5mrv1noxmieyps0077inllwqbdi2iwzmlsn9kb97vjebkax/tinymce/5/tinymce.min.js";
require_once 'Function/functions.php';
logged_auth_only();
admin_only()
?>
<div class="container">
    <form method="post" action="index.php?action=addPost" enctype="multipart/form-data">
        <div>
            <label for="files" class="btn  btn-primary">Sélectionner une image</label>
            <input id="files" name="img" style="visibility:hidden;" type="file">
        </div>
        <input type="text" name="title" placeholder="Titre de votre acticle">
        <textarea id="mytextarea" name="content" rows="4" placeholder="Ecrivez ou inserez du text ici" required>
        </textarea>
        <input type="submit" value="Envoyer" />
    </form>
</div>
