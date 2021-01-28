<?php $this->title = "S'inscrire"; 
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
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
            <li><a class="main-yellow" href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a></li>
            <?php endif; ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="login-section">
    <div class="card card-register">
        <div class="card-header">
            <h1>Se connecter</h1>
        </div>
        <div class="card-body card-body-login">

            <form action="<?="index.php?action=register" ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Pseudo *" required />
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email *" required />
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe *" required />
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirmer votre mot de passe *" required />
                </div>

                <div class="form-group">
                    <div class="button-submit">
                        <button type="submit" class="btn login_btn">
                            <p>M'inscrire</p>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="errors-register">
            <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <p>Vous n'avez pas rempli le formulaire correctement</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                    <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center links">
                <a href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Vous avez déjà un compte ?</a>
            </div>
        </div>
    </div>
    <div class="marge-register"></div>
</div>
