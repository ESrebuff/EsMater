<?php $this->title = "Espace personnel";
$tools = new \MyApp\Tools\Tools();
$tools->logged_auth_only();
$this->tiny = "https://cdn.tiny.cloud/1/r5mrv1noxmieyps0077inllwqbdi2iwzmlsn9kb97vjebkax/tinymce/5/tinymce.min.js";
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
            <li><a class="main-yellow" href="index.php?action=toAccount">Espace personnel</a></li>
            <?php else: ?>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a></li>
            <li><a href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a></li>
            <?php endif; ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>
<!-- Pensez a recuperer l'image de l'avatar dans le booking a surtout l'inserez -->
<div class="marge-account"></div>
<div class="account-background"></div>
<div class="workshop-registratio-background hide"></div>
<div class="account-section">

    <div class="section-workshop-registration hide">
        <p class="close-workshop"><a href="" class="text-white"><i class="fas fa-times hide-workshop"></i></a></p>
        <div class="container">
            <h1 class="text-center">Vos prochaines activités</h1>

            <?php foreach ($myBookings as $myBooking): ?>
            <div class="workshop-registration subscribeId<?= $myBooking['id'] ?>">
                <a href="index.php?action=post&id=<?= $myBooking['post_id'] ?>" class="workshop-link-section">
                    <h2 class="text-center"><?= $myBooking['title'] ?> <img class="inscription-avatar rounded-circle" src="src/Content/images/posts/<?=$myBooking['img']?>" alt="post-img"></h2>
                </a>
                <a href="index.php?action=deleteBooking&id=<?= $myBooking['id'] ?>" class="workshop-unsubscribe">Se désinscrire</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section-workshops-registrations hide">
        <p class="close-workshop"><a href="" class="text-white"><i class="fas fa-times hide-workshops"></i></a></p>
        <div class="container">
            <h1 class="text-center">Les inscrits a vos activités</h1>
            <?php  if($_SESSION['auth']['role'] == 'admin'){ ?>
            <div class="workshop-registration">
                <div class="row">
                    <div class="col-lg-6 link-registrations">
                        <a href="">
                            <p>Nom des ateliers</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <p>Nom des l'inscris</p>
                    </div>
                </div>
            </div>
            <?php foreach ($bookings as $booking): ?>
            <div class="workshop-registration">
                <div class="row">
                    <div class="col-lg-6 link-registrations">
                        <a href="index.php?action=post&id=<?= $booking['post_id'] ?>">
                            <p><?= $booking['title'] ?></p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <p><img class="inscription-avatar rounded-circle" src="src/Content/images/avatars/<?=$booking['user_avatar']?>" alt="avatar"><?= $booking['username'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; } ?>
        </div>
    </div>

    <div class="container">
        <div class="marge-account"></div>
        <div class="text-center">
            <h1>Espace personnel</h1>
            <div class="profile-account">
                <img class="avatar-account avatar-posts rounded-circle" src="src/Content/images/avatars/<?= $_SESSION['auth']['avatar']; ?>" alt="avatar">
                <p>Bonjour <?= $_SESSION['auth']['username']; ?></p>
            </div>
            <div class="first-dropdown-account">
                <div class="section-dropdown-account avatar-edit">
                    <p>Changer sa photo de profil<i class="fas fa-sort-down"></i></p>
                </div>

                <div class="account-edit avatar-edit-form hide">
                    <form method="POST" action="<?= "index.php?action=avatar&id={$_SESSION['auth']['id']}" ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="form-control input-img-avatar" type="file" name="avatar" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter une photo de profil</button>
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
                            <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe *" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe* " required>
                        </div>
                        <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>
                    </form>
                </div>
            </div>
            <div class="button-account">
                <button class="btn btn-primary btn-xl show-workshop-registration">Voir vos prochaines activités</button>
                <?php  if($_SESSION['auth']['role'] == 'admin'){ ?>
                <button class="btn btn-primary btn-xl show-workshops-registrations">Voir les inscrits</button>
                <?php } ?>
            </div>


        </div>
        <?php  if($_SESSION['auth']['role'] == 'admin'){ ?>
        <h2 class="text-center title-post-section-account">Poster une activité</h2>


        <div class="text-center">
            <form method="post" action="index.php?action=addPost" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Titre de votre acticle">
                <textarea id="mytextarea" name="content" rows="4" placeholder="Ecrivez ou inserez du text ici" required>
            </textarea>
                <div class="form-group img-post-workshop-account">
                    <input class="form-control input-img-avatar" name="img" type="file" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary post-workshop-button">Poster l'activité</button>
                </div>
            </form>
        </div>
        <h2 class="text-center header-send-support">Envoyer un message depuis le site</h2>
        <div class="support-send">
        <form action="<?="index.php?action=sendFromSupport" ?>" method="POST">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-12">
                   <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="l'email *" required="required" data-validation-required-message="Sil-Vous plaît entre l'adresse email.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group form-group-textarea mb-md-0">
                        <textarea class="form-control" placeholder="Votre message *" required="required" data-validation-required-message="Sil-Vous plaît écrivez votre message."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div id="success"></div>
                <button class="btn btn-primary btn-xl" type="submit">Envoyer le message</button>
            </div>
        </form>
        </div>
        <?php } ?>
        <p class="text-right"><a href="<?= "index.php?action=logout" ?>">Se déconnecter</a></p>

    </div>
</div>
