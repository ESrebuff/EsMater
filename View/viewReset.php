<?php $this->title = "Mot de passe oublié";
require_once 'Function/functions.php';
sessionOn();
?>
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
