<?php $this->title = "Mon Blog"; 
require_once 'Function/functions.php';
sessionOn();
if(isset($_SESSION['auth'])){
    header("Location: index.php?action=linkView&swicthTo=Account");
    exit();
}
?>
<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Register" ?>">Crée un compte</a>

<div class="container">
    <h1>Se connecter</h1>
    <form action="<?= "index.php?action=login" ?>" method="POST">
        <div class="form-group">
            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Mot de passe <a href="<?= "index.php?action=linkView&swicthTo=Forget" ?>">(J'ai oublié mon mot de passe)</a> </label>
            <input type="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1" /> Se souvenir de moi
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
<?php 