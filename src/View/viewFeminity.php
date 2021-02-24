<?php $this->title = "Atelier féminité et Cercle de Femmes"; ?>
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
    <h1>Féminité et Cercle de Femmes</h1>
</div>

<div class="workshop-section-page">
    <div class="workshop-content text-who-am-i">
        <div class="container">

            <h2 class="way-from text-center">Ateliers Féminité</h2>
            <h2>Cercle de Femmes</h2>
            <p>Le cercle de femmes, est un temps privilégié pour les femmes, qui se réunissent afin de se recentrer sur et de reprendre contact avec leur propre féminité. L’intimité et l’écoute bienveillante favorisent une expression libre, régénératrice pour chacune et pour toutes. Chaque parole déposée fait écho au groupe, le nourrit et favorise de belles libérations et prises de consciences individuelles.ateliers féminité</p>
            <p>Dans ce cercle, il y aura de la danse, des massages, des temps de pause, une rencontre des archétypes, des lunes, discussions sexualité …</p>
            <p>Mes enseignements et expériences: Monica Tesone, Bernadette de Gasquet, Mona Hébert, Miranda Gray, Sarina Stone, LLL France … et aussi Michel Odent, et dernièrement, Gaëlle Baldassari</p>
            <p>Pour toutes, dès l’âge des menstruations, ayant enfanté ou non.</p>
            <p>Ces ateliers féminité sont inspirés par ma rencontre avec Monica Tesone (psychologue, thérapeute sexuel, médiatrice familiale et coordinatrice internationale de LLL).</p>
            <h2>Leurs Buts :</h2>
            <p>Communiquer sur les 5 dimensions de la femme :</p>
            <ul class="text-muted">
                <li>sa naissance</li>
                <li>sa sexualité</li>
                <li>sa maternité (grossesse, accouchement, allaitement)</li>
                <li>sa ménopause</li>
            </ul>
            <p>Rencontre de femmes, dans la sécurité d’ un petit groupe avec un climat confidentiel.
                Échanger sur (ou réveiller) notre pouvoir de mettre au monde ou de se donner naissance à soi-même</p>
            <p>Ateliers de 3h00, 9 sessions : 270 €, séance découverte 15 €</p>
            <p>A l’issu de ses ateliers, vous serez davantage en lien avec vous mêmes, vous aurez appris tant dans un climat de sécurité où vous avez écouté et ressenti, partagé vos ressentis et accepté ceux ci. Votre « puissance » et votre « énergie » seront boostées pour accompagner qui vous êtes vraiment.</p>
            <p>Ce climat de sororité vous chamboulera , vous chouchoutera, vous métamorphosera. Venez vivre cette expérience unique.</p>
            <h2>Exemple d’atelier sur une soirée</h2>
            <ul class="text-muted">
                <li>spécial « menstruations »</li>
                <li>discussion entre femmes</li>
                <li>danse de bien-être féminin ( danse des organes)</li>
                <li>exercices auto- Shiatsu</li>
            </ul>
            <p>Tarif : <a href="index.php#contact">me contacter.</a></p>
            <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>
        </div>
    </div>
</div>
