<?php $this->title = "Communiquation non violante"; ?>
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
    <h1>Communication non violente</h1>
    <p>Retrouvez sur cette page mes différents ateliers sur la communication non violente</p>
</div>

<div class="workshop-section-page">
    <div class="container">
        <div class="workshops-nav">
            <div class="menu">
                <ul class="picto">
                    <li><a class="main-yellow btn btn-secondary picto-item workshops-item1" aria-label="L'workshop spécial ado">L'atelier spécial ado</a></li>
                    <li><a class="btn btn-secondary picto-item workshops-item2" aria-label="workshops Faber et Mazlish : Parler pour que les enfants écoutent, écouter pour qu’ils vous parlent">Parler pour que les</a></li>
                    <li><a class="btn btn-secondary picto-item workshops-item3" aria-label="workshops Faber et Mazlish : Jalousies et rivalités entre frères et sœurs">Jalousies et rivalités</a></li>
                    <li><a class="btn btn-secondary picto-item workshops-item4" aria-label="Groupe YAPP : Y’a Personne de Parfait !">Personne de Parfait</a></li>
                </ul>
                <div class="dropdown hide">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Faire défiler
                            <span class="sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="menu">
                            <a class="dropdown-item workshops-item1" href="#">L'ateliers spécial ado</a>
                            <a class="dropdown-item workshops-item2" href="#">Atelier Faber et Mazlish : Parler pour que les enfants écoutent,<br /> écouter pour qu’ils vous parlent</a>
                            <a class="dropdown-item workshops-item3" href="#">Atelier Faber et Mazlish : Jalousies et rivalités entre frères et sœurs</a>
                            <a class="dropdown-item workshops-item4" href="#">Groupe YAPP : Y’a Personne de Parfait !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="workshop-content text-who-am-i">
            <div class="workshop-comm1">
                <h2 class="way-from text-center">L’atelier spécial ado</h2>
                <p>On dit souvent que l’amour que l’on porte à nos enfants suffit, pourtant de plus en plus de parents ressentent le besoin d’être accompagnés, d’être soutenus.<br />
                    Avec humour et pertinence, cet atelier aborde les différents aspects de l’adolescence et invite à s’interroger sur notre façon de communiquer avec les ados. Il permet surtout de découvrir des clés pragmatiques et concrètes pour se sentir mieux armé face à cette période : un atelier novateur et très efficace.</p>
                <p>Communiquer avec les adolescents et les aider à se construire.<br />
                    Poser un cadre tout en favorisant estime de soi et autonomie.<br />
                    C’est ce que vous propose l’Atelier des Parent d’Ado !</p>
                <p>
                    Un atelier se compose d’un module de 2 journées ou 5 rencontres de 3h<br />
                    et d’un module d’approfondissement sur 2 journées ou 5 rencontres de 3h
                </p>

                <h3>Module 1 : L’adolescence, une question de dosage</h3>
                <ol class="text-muted">
                    <li>- Je découvre mon rôle de parent d’ado, l’adolescence et mon ado.</li>
                    <li>- Je délimite, je pose le cadre, c’est ma responsabilité.</li>
                    <li>- Je décode, j’apprends à écouter.</li>
                    <li>- Je fais baisser la pression, je décris pour mieux communiquer.</li>
                    <li>- Je donne du lien.</li>
                </ol>

                <p>Ce premier module permet d’aborder des outils-clés de communication dans le but<br />
                    d’instaurer, restaurer ou renforcer un climat de communication bienveillante dans la<br />
                    famille. Il permet également de dénouer une grande partie des « nœuds » rencontrés par<br />
                    les parents.</p>

                <p>Module de 5 séances de 2h30.</p>
                <p>Groupe de 6 à 10 personnes, avec livret pédagogique en couleur.</p>
                <p>5 séancesde 2h 30 ou 2 jours</p>

                <h3>Module 2 : Approfondissement</h3>
                <ol class="text-muted">
                    <li>- Les conduites à risque, de l’expérience aux transgressions</li>
                    <li>- L’estime de soi, la développer, la renforcer</li>
                    <li>- L’autonomie, la route vers l’indépendance</li>
                    <li>- La motivation</li>
                    <li>- Révision finale</li>
                </ol>
                <p>La communication et le lien déjà abordés dans le module 1 sont traités plus en<br />
                    profondeur, à travers de nouvelles thématiques, centrés sur la construction et le<br />
                    développement personnel des adolescents (estime de soi-motivation…). Ces<br />
                    approfondissements sont aussi proposés à la carte.
                </p>
                <p>Tarif à la carte : <a href="index.php#contact">me contacter.</a></p>
                <p>Objectifs de l’atelier :<br />
                    Pour ceux qui ont la chance d’être parents d’ados ou de travailler auprès d’eux, un atelier spécial « Parent d’Ado » a été créé.<br />
                    Il fournit des informations sur le déroulement de l’adolescence, et permet de s’interroger sur notre façon de communiquer avec eux. On y<br />
                    découvre de nouvelles façons d’aborder les difficultés. On y apprend à :</p>
                <ul class="text-muted">
                    <li>Recréer ou maintenir le lien, même dans les situations délicates.</li>
                    <li>Appréhender l’adolescent autrement.</li>
                    <li>Tisser avec lui une relation basée sur la confiance et le respect mutuel.</li>
                    <li>L’accompagner dans des moments difficiles (colères, frustrations, opposition), dans ses premières fois.</li>
                    <li>Définir et mettre en place, avec bienveillance, un cadre qui encourage l’adolescent à se sentir responsable de son comportement.</li>
                    <li>Susciter l’estime de soi des ados et parents.</li>
                    <li>Apprendre à gérer les conflits de manière positive et constructive pour tous.</li>
                </ul>
            </div>

            <div class="workshop-comm2 hide">
                <h2 class="way-from text-center">Atelier Faber et Mazlish : Parler pour que les enfants écoutent, écouter pour qu’ils vous parlent</h2>
                <h3>Histoire</h3>
                <p>Les ateliers Faber et Mazlish existent depuis 50 ans dans de nombreux pays. Ils ont été élaborés par 2 mamans (A. Faber et E. Mazlish) ayant suivi des cours de guidance parentale avec le Dr Haim Ginott, pour fournir des outils pouvant aider à faire face aux petits et grands tracas de la vie au quotidien avec des enfants.
                    Ils existent en France depuis 2006.</p>
                <p>« L’atelier des parents d’ados » a été conçu et réalisé par « l’Atelier des Parents », composé du Dr Sophie Benkemoun et de Nadège Larcher, Francine Lavergne et Marie-Charlotte Clerf.</p>
                <p>Aujourd’hui, ces ateliers de parents contribuent à ce que le Conseil de l’Europe appelle « le soutien à la parentalité positive ».
                    Les Ateliers Communication Bienveillante s’adressent aux parents d’ados : « Acquérir des outils pour bien communiquer avec les ados ! »</p>
                <h3>Au cours de ces ateliers, vous apprendrez :</h3>
                <ul class="text-muted">
                    <li>Comment s’y prendre avec les sentiments négatifs de l’enfant : ses frustrations, ses déceptions, sa colère…</li>
                    <li>Comment susciter chez l’enfant son désir de coopérer</li>
                    <li>Comment mettre des limites fermes tout en conservant un climat d’ouverture</li>
                    <li>Comment éviter les recours à la punition, ou aux menaces.</li>
                    <li>Comment favoriser l’image positive de l’enfant</li>
                    <li>Comment résoudre les conflits familiaux</li>
                </ul>
                <p>7 rencontres de 2h30
                    ou 3 journées</p>
                <p>Groupe de 8 à 12 personnes, avec livret pédagogique.
                    Tarif : <a href="index.php#contact">me contacter.</a></p>
                <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>
            </div>

            <div class="workshop-comm3 hide">
                <h2 class="way-from text-center">Atelier Faber et Mazlish : Jalousies et rivalités entre frères et sœurs</h2>
                <p>Basés sur des outils pratiques et concrets, ces ateliers se décomposent en 6 rencontres.
                    Lors de chaque rencontre, un thème différent est traité au travers d’exercices, de mises en situation, de jeux et d’échanges entre les parents.</p>
                <p>Les thèmes abordés sont :</p>
                <ul class="text-muted">
                    <li>Les sentiments pénibles entre frères et sœurs</li>
                    <li>Comprendre les sources de la rivalité entre frères et sœurs. Comment aider les enfants à soulager les sentiments hostiles qu’ils éprouvent les uns par rapport aux autres.</li>
                    <li>Chaque enfant est une personne distincte.</li>
                    <li>Comprendre comment la comparaison alimente la rivalité ; apprendre à éviter les comparaisons ; comprendre qu’aux yeux des enfants, donner la même chose, c’est toujours donner moins. Comment faire pour ne pas tomber dans le piège ?</li>
                    <li>Les rôles que l’on joue entre frères et sœurs.</li>
                    <li>Les enfants ont tendance à adopter des rôles différents pour se sentir uniques dans une famille. Comment éviter d’encourager ces rôles, surtout quand certains sont bourreaux et d’autres victimes. Des outils qui offrent à chaque enfant la liberté de devenir davantage lui-même.</li>
                    <li>Quand les enfants se disputent</li>
                    <li>Comment intervenir de façon utile pour réduire l’agressivité entre les enfants, les aider à résoudre eux-mêmes leurs conflits sans prendre parti, même quand un des enfants demande de l’aide.</li>
                    <li>Résolution de problème.
                        Une approche simple qui permet aux adultes d’aider les jeunes « combattants » à résoudre eux-mêmes leurs conflits.</li>
                </ul>
                <p>6 rencontres de 2h30
                    ou 2 journées, avec livret pédagogique.</p>
                <p>Groupe de 8 à 12 personnesAteliers Communication Bienveillante Ados. Tarif : <a href="index.php#contact">me contacter.</a></p>
                <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>
            </div>

            <div class="workshop-comm4 hide">
                <h2 class="way-from text-center">Groupe YAPP : Y’a Personne de Parfait !</h2>
                <p>Rencontres mensuelles pour échanger sur les petits tracas et chercher ensemble des pistes pour surmonter ou éviter les difficultés quotidiennes.
                    Inspirés des ateliers d’analyse de pratique professionnelle, les groupes YAPP favorisent la prise de recul et la réflexion sur des situations données. Ils permettent également de capitaliser les expériences et savoir-faire.
                    (Conception : Elisabeth Gavaldon)</p>
                <p>Sessions à partir de 6 personnes sur Saint-Nazaire et la Loire Atlantique.</p>
                <p>Groupe réservé aux personnes ayant déjà participé à des ateliers de communication.</p>
                <p>Pour plus de renseignements, vous pouvez m’envoyer un mail <a href="index.php#contact">ici</a> ou m’appeler au 06 28 32 89 70.</p>
            </div>
        </div>
    </div>
</div>
