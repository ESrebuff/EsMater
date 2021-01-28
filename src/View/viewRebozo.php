<?php $this->title = "Rituel Rebozo";
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
?>
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
    <h1>Rituel Rebozo</h1>
    <p>Soin Mexicain</p>
</div>

<div class="workshop-section-page">
    <div class="workshop-content text-who-am-i">
        <div class="container">

            <h2 class="way-from text-center">Ateliers Rebozo</h2>
            <p>Le soin Rebozo vient du Rebozo qui est un tissu coloré en coton ou en laine qui accompagne les femmes mexicaines au quotidien en châle sur les épaules, en porte-bébé, en soutien du corps de la femme enceinte ou en porte-provisions.</p>
            <p>Le soin Rebozo s’adresse à toute femme venant d’accoucher.</p>
            <p>En France, il est pratiqué à tout moment de la vie d’une femme qui en ressent le besoin ou l’envie.</p>
            <p>Il s’adresse à toutes les femmes qui vivent une étape dans leur vie de femme (ex : naissance), une épreuve (ex : deuil) ou encore un changement d’état (ex : mariage, ménopause, séparation, changement professionnel …) et à toute femme qui souhaite prendre du temps pour elle, faire une pause, se ressourcer.</p>
            <h2>Le rituel Rebozo :</h2>
            <p>Il est donné par deux femmes pour une autre femme.<br />
                Il se déroule en 3 phases et dure trois heures, dans la pénombre, à la lueur de bougies.</p>
            <ul class="text-muted">
                <li>Un modelage aux huiles tiédies, à quatre mains, pour se relaxer. (Le corps est enveloppé de couvertures, seules, les zones massées sont dévoilées au fur et à mesure.)</li>
                <li>Un bain vapeur/sudation aux plantes.</li>
                <li>Un enveloppement/resserrage du corps avec le Rebozo en sept points clés du corps (tête, épaules, ventre, bassin, cuisses, genoux, pieds).</li>
            </ul>
            <h2>Ses bienfaits :
            </h2>
            <ul class="text-muted">
                <li>Se recentrer (retour sur soi, retour en soi)</li>
                <li>Réintégrer votre vitalité dispersée dans vos différents rôles, de femme, d’épouse, de mère …</li>
                <li>Recontacter votre libido</li>
                <li>Partager votre vécu</li>
                <li>Accepter un temps juste pour vous, comme un cadeau</li>
                <li>Clore un cycle et d’en accueillir un nouveau</li>
            </ul>
            <p>Ce jour-là, prévoyez 3h au moins pour le soin et peu d’activités pour le reste de la journée.<br />
                Mangez léger avant et après le soin.<br />
                Entourez -vous de chaleur les 3 jours suivants.</p>
            <p>Tarif : 285€,</p>
            <p>Avec une amie ou votre conjoint : 185 €</p>
            <p>Saint Nazaire, Pornichet chez Oveho, à domicile , 20 minutes autour de Saint Nazaire,</p>
            <p>au delà de 20 km, frais kilométriques en plus</p>
            <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>

        </div>
    </div>
</div>
