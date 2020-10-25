<?php $this->title = "Mon Blog";
require_once 'Function/functions.php';
sessionOn();
?>
<?php if(isset($_SESSION["auth"])): ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Account" ?>">Espace personnel</a>
<?php else: ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a>
<?php endif; ?>

<header>
    <article>
        <div class="container">
            <div class="row">
                <?php foreach ($posts as $post): ?>
                <a class="style-link-none" href="<?= "index.php?action=post&id=" . $post['id'] ?>">
                    <div class="col-lg-6 mb-4">
                        <div class="posts">
                            <img class="img-posts" src="Content/images/posts/<?= $post['img'] ?>" alt="">
                            <!-- src="http://placehold.it/700x400" à remplacer par son id href-->
                            <div class="card-body">
                                <div class="row">
                                    <img class="rounded-circle avatar-posts" src="Content/images/avatars/<?= $post['user_avatar'] ?>" alt="avatar">
                                    <div class="row style-link-none">
                                        <p class="name-avatar col-lg-12 mb-4 style-link-none"><?= $post['author'] ?></p>
                                        <time class="time-posts col-lg-12 mb-4 style-link-none"><?= $post['date'] ?></time>
                                    </div>
                                </div>
                                <div class="content-text-posts">
                                    <h4 class="card-title">
                                        <a class="link link-posts" href="<?= "index.php?action=post&id=" . $post['id'] ?>"><?= $post['title'] ?></a>
                                    </h4>
                                </div>
                                <div class="center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                </svg><br>
                                <?php 
                                if(isset($_SESSION["auth"])){
                                    if($_SESSION["auth"]["role"] == "admin"){
                                    ?>
                                    <a href="index.php?action=editPost&id=<?= $post['id'] ?>">Modifier</a>
                                    <a class="text-danger" href="index.php?action=deletePost&id=<?= $post['id'] ?>">Supprimer</a>
                                    <?php
                                    }
                                }                   
                                ?>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </article>
</header>
