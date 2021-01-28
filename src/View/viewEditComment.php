<?php 
$this->title = "Modifier le commentaire"; 
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
$date = date('Y/m/d ', strtotime($post['date'])) . "à " . date('H', strtotime($post['date'])) . "h" . date('m', strtotime($post['date']));
?>
<?php if(isset($_SESSION["auth"])): ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Account" ?>">Espace personnel</a>
<?php else: ?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a>
<?php endif; ?>

<div class="worshop-section-post">
    <div class="container marge-top-posts">
        <div class="col-lg-10 mx-auto align-items-center">
            <div class="row">
                <div class="mx-auto title-post">
                    <h1 class="text-center"><?= $post['title'] ?></h1>
                </div>
                <img class="img-workshop" src="src/Content/images/posts/<?= $post['img'] ?>" alt="post">
            </div>

            <div class="row author-section-post">
                <div class="p-2"><img class="rounded-circle avatar-post" src="src/Content/images/avatars/<?= $post['user_avatar'] ?>" alt="avatar"></div>
                <div class="author-post">
                    <p class="text-muted">Auteur:</p>
                    <h6 class="name-author-post"><?= $post['author'] ?></h6>
                </div>
            </div>
            <p><?= $post['content'] ?></p>
            <p class="text-center text-muted"><?= $date ?></p>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="card-title">Les Commentaires</h2>
                </div>
                <?php foreach ($comments as $comment): ?>
                <div class="comment-widgets msgId<?= $comment['id'] ?>">
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img class="rounded-circle avatar-posts" src="src/Content/images/avatars/<?= $comment['user_avatar'] ?>" alt="avatar"></div>
                        <div class="comment-text">
                            <h6 class="font-medium"><?= $comment['author'] ?></h6>
                            <span class="m-b-15 d-block"> <?= $comment['content'] ?> </span>
                        </div>
                    </div>
                    <hr />
                    <br>
                </div> <!-- Card -->
                <?php endforeach; ?>

                <?php if(isset($_SESSION["auth"])): ?>
                <form id="comment-post" method="post" action="index.php?action=updateComment">>
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10 col-10">
                            <input type="text" id="content" class="form-control" name="content" placeholder="Ecrivez votre commentaire ...">
                            <input type="hidden" id="author" name="id" value="<?= $post['id'] ?>" />
                            <input type="hidden" name="id" value="<?= $updateComment['id'] ?>" />
                            <input type="hidden" name="postId" value="<?= $post['id'] ?>" />
                            <input type="hidden" name="user_id" value="<?= $updateComment['user_id'] ?>" />
                            <div class="row">
                                <button type="submit" class="btn btn-primary post-workshop-button">Modifier le commentaire</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php else: ?>
                <div class="alert alert-danger">
                    Vous devez être connecté pour pouvoir modifier votre commentaire
                    <a href="index.php?action=linkView&swicthTo=Login" class="text-end">Se connecter</a>
                </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>
