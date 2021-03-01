<?php $this->title = "Mot de passe oublié"; 
if(isset($_SESSION['auth'])){
    header("Location: index.php?action=toAccount");
}
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

<div class="login-section">
    <div class="card card-login">
        <div class="card-header">
            <h1>Mot de passe oublié</h1>
        </div>
        <div class="card-body card-body-login">
            <form action="<?= "index.php?action=forgot" ?>" method="POST">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" />
            </div>
            <button type="submit" class="btn btn-primary">Récupérer mon mot de passe</button>
        </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center links">
                Vous n'avez pas de compte ?<a href="<?= "index.php?action=linkView&swicthTo=Register" ?>">S'inscrire</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?= "index.php?action=linkView&swicthTo=Forget" ?>">Mot de passe oublié ?</a>
            </div>
        </div>
    </div>
</div>
