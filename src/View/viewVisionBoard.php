<?php $this->title = "Vision Board"; ?>
<!--  Ici la nav-bar en full noir  -->
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

<div class="workshop-header"></div>
<div class="workshop-text-section">
    <h1>Vision Board</h1>
</div>

<div class="workshop-section-page">
    <div class="workshop-content text-who-am-i">
        <div class="container">
            <h2 class="way-from text-center">Ateliers Vision Board</h2>
            <p>L’atelier « Vision board » est parfait pour débuter l’année à venir, il permet de clarifier tous les domaines de sa vie : de sa santé à sa famille, de son couple à sa gestion du temps, de son job à ses activités….</p>
            <p>Quand est-ce qu’on prend le temps de faire un bilan et projeter les envies qui s’accordent à nos valeurs ?</p>
            <p>C’est un bon temps pour soi.</p>
            <p>Atelier en groupe, permet la co-créativité : 45 € l’atelier de 3H00 sur St Nazaire et presqu’île. 55€ à Paris et Rennes</p>
            <p>En individuel, mode cocooning : 90 à 150 €</p>
            <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>
        </div>
    </div>
</div>
