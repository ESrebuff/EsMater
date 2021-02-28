<?php $this->title = "Espace personnel";
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

<div class="marge-account"></div>

<?php if($_SESSION["auth"]["role"] === "admin" ) { ?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="registrations" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Les inscrits a vos activités</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <h2 class="text-center">Nom des ateliers</h2>
                    </div>
                    <div class="col-6">
                        <h2 class="text-center">Nom des l'inscris</h2>
                    </div>
                </div>
                <?php foreach ($bookings as $booking): ?>
                <div class="all-bookings">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="text-center">
                                <a class="link" href="index.php?action=post&id=<?= $booking['post_id'] ?>"><?= $booking['title'] ?></a>
                            </h3>
                            <h3 class="text-center">
                                <a href="index.php?action=post&id=<?= $booking['post_id'] ?>"><img class="img-post rounded" src="src/Content/images/posts/<?=$booking['img']?>" alt="post"></a>
                            </h3>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="text-center"><?= $booking['username'] ?></h3>
                            <p class="text-center">
                                <img class="rounded-circle img-avatar" src="src/Content/images/avatars/<?=$booking['user_avatar']?>" alt="avatar">
                            </p>
                        </div>
                    </div>
                </div>
                <hr/>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
<?php } ?>

<!-- MODAL MY BOOKINGS -->
<div class="modal fade bd-example-modal-lg" id="registration" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vos prochaines activités</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <?php foreach ($myBookings as $myBooking): ?>
                <div class="my-bookings subscribeId<?= $myBooking['id'] ?>">
                    <a class="link" href="index.php?action=post&id=<?= $myBooking['post_id'] ?>">
                        <h2 class="text-center"><?= $myBooking['title'] ?></h2>
                    </a>
                    <a href="index.php?action=post&id=<?= $myBooking['post_id'] ?>"><img class="rounded mx-auto d-block" src="src/Content/images/posts/<?=$myBooking['img'] ?>"></a>
                    <br>
                    <p class="text-center"><a class="workshop-unsubscribe" href="index.php?action=deleteBooking&id=<?= $myBooking['id'] ?>">Se désinscrire</a></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
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
                        <input class="form-control" type="password" name="oldPassword" placeholder="Votre mot de passe *" required>
                    </div>

                    <div class="form-group">
                        <input id="password-register" type="password" name="password" class="form-control" placeholder="Nouveau mot de passe *" required />
                        <p>
                            Le mot de passe dois contenirs :
                            Au moins <span class="alert-danger" id="size-mdp">8 caractères </span><span class="alert-danger" id="maj-mdp">1 majuscule </span><span class="alert-danger" id="number-mdp">1 chiffre</span>
                        </p>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe* " required>
                    </div>
                    <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>
                </form>
            </div>
        </div>
        <div class="button-account">
            <!-- Button trigger modal1 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registration">Voir vos prochaines activités</button>

            <?php  if($_SESSION['auth']['role'] == 'admin'){ ?>
            <!-- Button trigger modal2 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrations">Voir les inscrits</button>
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
                        <textarea class="form-control" type="text" name="message" placeholder="Votre message *" required="required" data-validation-required-message="Sil-Vous plaît écrivez votre message."></textarea>
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
