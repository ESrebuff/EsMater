<?php $this->title = "Mon Blog";
require_once 'Function/functions.php';
sessionOn();
?>
<div class="container">
    <img class="rounded-circle avatar-posts" src="Content/images/avatars/<?= $user['avatar'] ?>" alt="avatar">
    <p><?= $user['username'] ?></p>
    <p>Ne pas oublié d'ajouter un moyen d'afficher le profil de l'utilisateur (l'image de profile) <br>
    Aussi le nom etc...</p>
</div>