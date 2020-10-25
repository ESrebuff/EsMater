<?php 
/* 
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
ICI EST UNE COPIE DE L'AFFICHAGE DE viexPost EN SIMPLIFIER POUR MODIFIER LE CONTENU
IL SUFFIRA DE COPIER COLLER LE CONTENU DE LA PAGE viexPost ET DE MODIFIER LE FORMULAIRE AVEC CELUI QUI EST DEJA SUR CETTE PAGE, PENSE AUSSI A ENLEVER TOUT SYSTEME LIER AU COMMENTAIRE, ICI ON NE VEUX TRAITEZ QUE LE COMMENTAIRE CHOSI ET LE MODIFIER.
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/ 

$this->title = "Mon Blog - " . $post['title']; 
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
                    </div>
                </div>
            </div> <!-- Card -->
            <hr />
            <br>
            <?php endforeach; ?>
            <?php if(isset($_SESSION["auth"])): ?>
            <form method="post" action="index.php?action=updateComment">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-10 col-10">
                        <input type="text" class="form-control" name="content" value="<?= $updateComment['content'] ?>" >
                        <input type="hidden" name="id" value="<?= $updateComment['id'] ?>" />
                        <input type="hidden" name="postId" value="<?= $post['id'] ?>" />
                        <input type="hidden" name="user_id" value="<?= $updateComment['user_id'] ?>" />
                        <input type="submit" value="Modifier votre commentaire" />
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
