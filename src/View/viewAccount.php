<?php $this->title = "Mon Blog";
$tools = new \MyApp\Tools\Tools();
$tools->logged_auth_only();
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
            <li><a class="main-yellow" href="<?= "index.php?action=toAccount" ?>">Espace personnel</a></li>
            <?php else: ?>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a></li>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a></li>
            <?php endif; ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>






<div class="account-background">
</div>
<div class="container account-section">
    <div class="text-center">
        <h1>Espace personnel</h1>
        <img class="avatar-account avatar-posts rounded-circle" src="src/Content/images/avatars/<?= $_SESSION['auth']['avatar']; ?>" alt="avatar">
        <h2>Bonjour <?= $_SESSION['auth']['username']; ?></h2>
        <div class="first-dropdown-account">
            <div class="section-dropdown-account avatar-edit">
                <p>Changer votre photo de profile<i class="fas fa-sort-down"></i></p>
            </div>
            <div class="account-edit avatar-edit-form hide">
                <form method="POST" action="<?= "index.php?action=avatar&id={$_SESSION['auth']['id']}" ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control input-img-avatar" type="file" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter une photo de profile</button>
                </form>
            </div>
        </div>



        <div class="second-dropdown-account">
            <div class="section-dropdown-account password-edit">
                <p>Changer votre mot de passe<i class="fas fa-sort-down"></i></p>
            </div>
            <div class="account-edit password-edit-form hide">
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
        </div>

    </div>









    <div class="container">
        <h1>Vos prochaines activitées</h1>

        <?php foreach ($myBookings as $myBooking): ?>
        <div class="col-lg-6 mb-4">
            <div class="posts">
                <img class="img-posts" src="src/Content/images/posts/<?=$myBooking['img']?>" alt="">
            </div>
        </div>
        <?php endforeach;
                 
if($_SESSION['auth']['role'] == 'admin'){
?>
        <a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=AddPost" ?>">Poster une activité</a><br>
        <br>
        <h3 class="d-flex justify-content-center">Les inscrits</h3>
        <?php foreach ($bookings as $booking): ?>
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="row justify-content-center">
                        <p><?= $booking['username'] ?> </p>
                        <a href="<?= "index.php?action=post&id=" . $booking['post_id'] ?>">
                            <p><?=$booking['title']?></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;
} ?>
    </div>

    <a class="link link-posts" href="<?= "index.php?action=logout" ?>">Se déconnecter</a>










</div>
