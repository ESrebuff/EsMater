<?php $this->title = "Les activités"; ?>
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
            <li><a href="<?= "index.php?action=toAccount" ?>">Espace personnel</a></li>
            <?php else: ?>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a></li>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a></li>
            <?php endif; ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="marge-top-posts">
    <?php if(isset($number)): ?>
    <div class="main-header-posts">
        <div class="header-text-posts">
            <h1>Les activités</h1>
            <p>Retrouver toutes les activités du site, vous pouvez vous y inscrire, je vous souhaite bonne navigation</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<header>
    <article>
        <div class="container">
            <div class="row">
                <?php 
                if($posts) :  
                foreach ($posts as $post): 
                $date = date('Y/m/d ', strtotime($post['date'])) . "à " . date('H', strtotime($post['date'])) . "h" . date('m', strtotime($post['date']));
                ?>
                <a class="style-link-none" href="<?= "index.php?action=post&id=" . $post['id'] ?>">
                    <div class="col-lg-6 mb-5 postId<?= $post['id'] ?>">
                        <div class="posts">
                            <img class="img-posts" src="src/Content/images/posts/<?= $post['img'] ?>" alt="">
                            <div class="card-body">
                                <div class="row">
                                    <img class="rounded-circle avatar-posts" src="src/Content/images/avatars/<?= $post['user_avatar'] ?>" alt="avatar">
                                    <div class="row style-link-none">
                                        <p class="name-avatar col-lg-12 mb-4 style-link-none"><?= $post['author'] ?></p>
                                        <time class="time-posts col-lg-12 mb-4 style-link-none"><?= $date ?></time>
                                    </div>
                                </div>
                                <div class="content-text-posts">
                                    <h4 class="card-title">
                                        <a class="link link-posts" href="<?= "index.php?action=post&id=" . $post['id'] ?>"><?= $post['title'] ?></a>
                                    </h4>
                                </div>
                                <div class="center">
                                    <?php 
                                if(isset($_SESSION["auth"])){
                                    if($_SESSION["auth"]["role"] == "admin"){
                                    ?>
                                    <a href="index.php?action=editPost&id=<?= $post['id'] ?>">Modifier</a>
                                    <a class="text-danger delete-post" href="index.php?action=deletePost&id=<?= $post['id'] ?>">Supprimer</a>
                                    <?php
                                    }
                                }                   
                                ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
                <?php endforeach;
                endif;?>
            </div>

            <!-- Paging -->
            <ul class="pagination justify-content-center">
                <?php for($i=1;$i<=$allPosts;$i++) {
                    echo '<li class="page-item">
                                <a class="page-link" href="index.php?action=page&number='.$i.'">'.$i.' </a>
                            </li>
                            '; 
                }; ?>
            </ul>

        </div>
    </article>
</header>
