<?php $this->title = "Mon Blog - " . $post['title']; 
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
$date = date('Y/m/d ', strtotime($post['date'])) . "à " . date('H', strtotime($post['date'])) . "h" . date('m', strtotime($post['date']));
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
            <li><a href="<?= "index.php?action=toAccount" ?>">Espace personnel</a></li>
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
            <p><?= $post['content'] ?></p>
            <p class="text-center text-muted"><?= $date ?></p>



            <?php if(isset($_SESSION["auth"])): ?>
            <div class="row">
                <a href="index.php?action=booked&id=<?= $post['id'] ?>">S'inscrire à l'activité</a>
            </div>
            <?php else: ?>
            <div class="justify-content-center text-center">
                <div class="alert alert-danger">
                    Vous devez être connecté pour pouvoir vous inscrire
                    <a href="index.php?action=linkView&swicthTo=Login" class="text-end">Se connecter</a>
                </div>
            </div>
            <?php endif; ?>

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
                            <div class="center">
                                <?php 
                        if(isset($_SESSION["auth"])){
                            if($_SESSION["auth"]["id"] == $comment['user_id']){
                        ?>
                                <a class="edit-comment" href="index.php?action=editComment&idComment=<?= $comment['id'] ?>&id=<?= $post['id'] ?>">Modifier</a>
                                <a class="text-danger delete-comment" href="index.php?action=deleteComment&idComment=<?= $comment['id'] ?>&id=<?= $post['id'] ?>">Supprimer</a>
                                <?php
                        } else if($_SESSION["auth"]["role"] == "admin"){
                        ?>
                                <a class="text-danger delete-comment" href="index.php?action=deleteComment&idComment=<?= $comment['id'] ?>&id=<?= $post['id'] ?>">Supprimer</a>
                                <?php
                            }
                        }                   
                        ?>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <br>
                </div> <!-- Card -->
                <?php endforeach; ?>

                <?php if(isset($_SESSION["auth"])): ?>
                <form id="comment-post" method="post" action="index.php?action=comment">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10 col-10">
                            <input type="text" id="content" class="form-control" name="content" placeholder="Ecrivez votre commentaire ...">
                            <input type="hidden" id="author" name="id" value="<?= $post['id'] ?>" />
                            <div class="row">
                                <button type="submit" class="btn btn-primary post-workshop-button">Modifier l'atelier</button>
                            </div>
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
</div>
