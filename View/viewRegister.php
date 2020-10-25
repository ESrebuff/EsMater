<?php $this->title = "Mon Blog"; 
require_once 'Function/functions.php';
sessionOn();
?>

<a class="link link-posts" href="<?= "index.php?action=linkView&swicthTo=Login" ?>">Se connecter</a>


<div class="container">
   <h1>S'inscrire</h1>
   
   <?php if(!empty($errors)): ?>
   <div class="alert alert-danger">
       <p>Vous n'avez pas remplis le formulaire correctement</p>
       <ul>
       <?php foreach($errors as $error): ?>
       <li><?= $error; ?></li>
       <?php endforeach; ?>
       </ul>
   </div>
   <?php endif; ?>
   
    <form action="<?= "index.php?action=register" ?>" method="POST">
        <div class="form-group">
            <label for="">Pseudo</label>
            <input type="text" name="username" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Confirmer votre mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">M'inscrire</button>
    </form>
</div>
