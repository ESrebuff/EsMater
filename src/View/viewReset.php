<?php $this->title = "Mot de passe oublié";
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
if(isset($_SESSION['auth'])){
    header("Location: index.php?action=toAccount");
}
?>
<nav class="main-nav">
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
            <li><a class="to-contact-section" href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Réinitialiser mon mot de passe</h1>

    <div class="container">

        <form action="<?= "index.php?action=reset&id={$user['id']}" ?>" method="POST">
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Confirmation du mot de passe</label>
                <input type="password" name="password_confirm" class="form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Réinitialiser votre mot de passe</button>
        </form>
    </div>
</div>

<footer class="footer py-2">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">Copyright © Your Website 2020</div>
            <div class="col-lg-4 my-3">
                <a class="btn btn-dark btn-social mx-2 rounded-circle" href="https://www.facebook.com/patricia.mareau.37"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2 rounded-circle" href="https://www.instagram.com/mareaupatricia/?hl=fr"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a class="mr-3" href="#!">Politique de la vie privée</a>
                <a href="#!">Conditions d'utilisation</a>
            </div>
        </div>
    </div>
</footer>
