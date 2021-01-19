<?php $this->title = "Mot de passe oublié";
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
if(isset($_SESSION['auth'])){
    header("Location: index.php?action=toAccount");
}
?>

<div class="container">
    <h1>Mot de passe oublié</h1>
    <form action="<?= "index.php?action=forgot" ?>" method="POST">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Récuperer mon mot de passe</button>
    </form>
</div>
