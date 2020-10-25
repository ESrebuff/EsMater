<?php $this->title = "Mon Blog - " . $post['title']; 
require_once 'Function/functions.php';
sessionOn();
?>
<?php if(isset($_SESSION["auth"])): ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Account" ?>">Espace personnel</a>
<?php else: ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a>
<?php endif; ?>

<article>
    <header>
        <h1 class="titreBillet"><?= $post['title'] ?></h1>
        <time><?= $post['date'] ?></time>
    </header>
    <p><?= $post['content'] ?></p>
</article>
<hr />

<div class="d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">Derniers Commentaires</h4>
            </div>
            <?php foreach ($comments as $comment): ?>
            <div class="comment-widgets">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><img class="rounded-circle avatar-posts" src="Content/images/avatars/<?= $comment['user_avatar'] ?>" alt="avatar"></div>
                    <div class="comment-text">
                        <h6 class="font-medium"><?= $comment['author'] ?></h6> <span class="m-b-15 d-block"> <?= $comment['content'] ?> </span>
                        <div class="center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                            </svg><br>
                            <?php 
                        if(isset($_SESSION["auth"])){
                            if($_SESSION["auth"]["id"] == $comment['user_id']){
                        ?>
                            <a class="" href="index.php?action=editComment&idComment=<?= $comment['id'] ?>&id=<?= $post['id'] ?>">Modifier</a>
                            <a class="text-danger" href="index.php?action=deleteComment&idComment=<?= $comment['id'] ?>&id=<?= $post['id'] ?>">Supprimer</a>
                            <?php
                        } else if($_SESSION["auth"]["role"] == "admin"){
                        ?>
                            <a class="text-danger" href="">Supprimer</a>
                            <?php
                            }
                        }                   
                        ?>
                            <a class="text-danger" href="">Signalez</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Card -->
            <hr />
            <br>
            <?php endforeach; ?>
            <?php if(isset($_SESSION["auth"])): ?>
            <form method="post" action="index.php?action=comment">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-10 col-10">
                        <input type="text" class="form-control" name="content" placeholder="Ecrivez votre commentaire ...">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>" />
                        <input type="submit" value="Envoyer votre commentaire" />
                    </div>
                </div>
            </form>
            <?php else: ?>
            <div class="alert alert-danger">
                Vous devez être connecté pour pouvoir commenter
                <a href="index.php?action=linkView&swicthTo=Login" class="text-end">Se connecter</a>
            </div>
            <?php endif; ?>


        </div>
    </div>
</div>
