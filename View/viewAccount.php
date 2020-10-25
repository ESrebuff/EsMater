<?php $this->title = "Mon Blog";
require_once 'Function/functions.php';
logged_auth_only();
?>
<a class="link link-posts" href="<?= "index.php?action=logout" ?>">Se déconnecter</a>
<div class="container">
    <h1>Bonjour <?= $_SESSION['auth']['username']; ?></h1>
    <img class="avatar-account avatar-posts rounded-circle" src="Content/images/avatars/<?= $_SESSION['auth']['avatar']; ?>" alt="avatar">
    <form method="POST" action="<?= "index.php?action=avatar&id={$_SESSION['auth']['id']}" ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Ajouter ou changer votre photo de profil :</label>
            <input class="form-control" type="file" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter une photo de profile</button>
    </form>

    <form action="<?= "index.php?action=updatePassword" ?>" method="POST">
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
        </div>
        <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>
    </form>
</div>
<?php
if($_SESSION['auth']['role'] == 'admin'){
?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=AddPost" ?>">Poster une activité</a><br>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=poste" ?>">Gerer les commentaires signalez</a>
<p>(Nombre de commentaire signalez : 0)</p>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=poste" ?>">Voir les inscris</a> <br>
<?php
} ?>
