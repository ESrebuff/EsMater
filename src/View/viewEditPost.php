<?php $this->title = "Mon Blog";
$this->tiny = "https://cdn.tiny.cloud/1/r5mrv1noxmieyps0077inllwqbdi2iwzmlsn9kb97vjebkax/tinymce/5/tinymce.min.js";
$tools = new \MyApp\Tools\Tools();
$tools->logged_auth_only();
$tools->admin_only();
?>
<nav class="main-nav color-black">
    <div class="menu-icon">
        <i class="fa fa-bars fa-2x"></i>
    </div>
    <div class="logo">
        <a href="index.php">EsMater</a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="index.php?action=linkView&swicthTo=Presentation">Qui suis-je</a></li>
            <li><a href="index.php?action=page&number=1">Les activités</a></li>
            <?php if(isset($_SESSION["auth"])): ?>
            <li><a href="index.php?action=toAccount">Espace personnel</a></li>
            <?php else: ?>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a></li>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a></li>
            <?php endif; ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>
<div class="container edit-post-section">
    <div class="account-section">

        <div class="d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <img class="img-posts" src="src/Content/images/posts/<?= $post['img'] ?>" alt="post">
            </div>
        </div>

        <form method="post" action="index.php?action=updatePost&id=<?= $post['id'] ?>" enctype="multipart/form-data">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Titre de votre acticle">
            <textarea id="mytextarea" name="content" rows="4" placeholder="Ecrivez ou inserez du text ici">
        <?= $post['content'] ?>
        </textarea>
            <div class="form-group img-post-workshop-account">
                <input class="form-control input-img-avatar" name="img" type="file">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary post-workshop-button">Modifier l'atelier</button>
            </div>
        </form>
    </div>

