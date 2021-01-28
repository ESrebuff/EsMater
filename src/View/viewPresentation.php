<?php $this->title = "Qui suis-je"; 
$tools = new \MyApp\Tools\Tools();
$tools->sessionOn();
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
            <li><a class="main-yellow" href="index.php?action=linkView&swicthTo=Presentation">Qui suis-je</a></li>
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

<div class="container marge-top-posts">
    <div class="header-text-who-am-i text-center">
        <h1>Qui suis-je</h1>
    </div>

    <div class="col-lg-10 mx-auto align-items-center">
        <img class="img-workshop" src="src/Content/images/web/portrait-patricia-mareau.jpg" alt="patricia-mareau">
    </div>

    <h2 class="way-from text-center">Mon parcours</h2>

    <div class="text-who-am-i">
        <p>Facilitatrice en communication depuis 2007, j’ai tout d’abord exercé comme préparatrice en pharmacie de 1992 à 1998.<br />
            J’ai ensuite co-créé plusieurs associations :</p>
        <ul>
            <li>MIAM de 1999 à 2001 (Maman qui Informent sur l’Allaitement Maternel),</li>
            <li>Parents autrement depuis 2007,</li>
            <li>SPE Mater de 2009 à 2017.</li>
            <li>Animatrice bénévole de 2002 à 2014 dans l’association LLLI ( La Leche League international ),</li>
        </ul>

        <p>je suis également membre de réseaux :</p>
        <ul>
            <li>Rezo Animation aux Editions du Phare (Canada),</li>
            <li>L’Atelier des parents.(apcom.fr)</li>
            <li>Réseaux : <a href="http://www.rebozoaufeminin.fr/">Rebozo au feminin.fr</a></li>
            <li><a href="https://lerebozo.fr/">Le Rebozo.fr</a></li>
        </ul>
        <p>Formée par Christine Koelher, exécutive coach à LLLI (Leche League International), formation Facilitator en 2006.</p>
        <p>En 2011, praticienne de soins Rebozo.</p>
        <p>En 2013, conseillère en image.</p>
    </div>

    <h2 class="way-from text-center accompagnement">Accompagnement</h2>
    <div class="text-who-am-i">
        <ul>
            <li>J’accompagne les femmes via les ateliers et cercles que j’anime.</li>
            <li>J’accompagne les parents et ceux qui travaillent auprès des enfants, soucieux d’améliorer ou ayant besoin d’être soutenus dans la communication respectueuse.</li>
            <li>Je pratique le soin, via le soin et les techniques du Rebozo.</li>
        </ul>
        <p>Je suis mère de 4 enfants, éducatrice en perpétuelle recherche et dans une ouverture constante.<br />
            Et, au gré de mes voyages, je découvre les conférences de Bernadette de Gasquet, Michel Odent, Mona Hébert, Monica Tesone, Miranda Gray, Olivier Maurel ….</p>
        <p>C’est de ces rencontres et formations que je réunis les outils pour à mon tour en semer des graines autour de moi et créer mon entreprise en 2013.<br />
            C’est un chemin perpétuel d’apprentissage que j’ai à cœur de vous transmettre.</p>

        <div class="text-muted">
            <p>Mes phrases chéries :</p>
            <p>« Que chacun reste unique, authentique et libre d’être ».</p>
            <p>« Chasser les rôles qu’on se donne en devenant soi-même ».</p>
            <p>« Notre peur la plus profonde est que nous sommes puissants au-delà de toutes limites. C’est notre propre lumière qui nous effraie le plus. » <br />extrait de Williamson.</p>
        </div>

        <p>Quelquefois, un petit coup de pouce, et c’est reparti, ce que j’appelle, la piqûre de rappel.<br /> D’autres fois, une immersion dans un groupe et c’est une nouvelle prise de conscience, de nouveaux outils et mises en place qui s’installent.<br />
            C’est en cela que je souhaite au mieux vous aider, vous accompagner, vous soutenir dans votre chemin.</p>
        <p><span class="text-muted">« On ne peut transmettre que ce que l’on a vécu ou vu »</span>, qu’est ce que vous voulez transmettre ?</p>
        <p>Dans mes ateliers , vous allez vivre des situations, entendre des témoignages, les jouer, vous entraîner.</p>
        <p>Je vous invite à venir aux présentations afin d’évaluer si vous avez envie de faire un bout de chemin avec d’autres personnes et moi même.</p>
    </div>
</div>
