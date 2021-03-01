<?php $this->title = "Modifier le commentaire"; ?>
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
            <li><a class="main-yellow" href="index.php?action=page&number=1">Les activités</a></li>
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
            <div><?= $post['content'] ?></div>
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
                <form id="comment-post" method="post" action="index.php?action=updateComment">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10 col-10">
                            <input type="text" id="content" class="form-control" name="content" value="<?= $updateComment['content'] ?>">
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
