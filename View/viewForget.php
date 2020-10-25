<?php $this->title = "Mot de passe oublié";
require_once 'Function/functions.php';
sessionOn();
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
