<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="src/Content/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="<?= $tiny ?>" referrerpolicy="origin"></script>
    <title><?= $title ?></title> <!-- Élément spécifique -->
</head>

<body data-spy="scroll" id="page-top">
    <div id="container">
        <div class="container">
            <?php if(isset($_SESSION["flash"])): ?>
            <?php foreach($_SESSION["flash"] as $type => $message): ?>
            <div class="flash-message alert alert-<?= $type; ?>">
                <?= $message; ?>
                <p class="close-message text-muted" href=""><i class="fas fa-times"></i></p>
            </div>
            <?php endforeach; ?>
            <?php unset($_SESSION["flash"]); ?>
            <?php endif; ?>
        </div>
        <?= $content ?>
        <!-- Élément spécifique -->
    </div>

    <script type="text/javascript" src="src/Content/js/DeleteAjax.js"></script>
    <script type="text/javascript" src="src/Content/js/ShowBooked.js"></script>
    <script type="text/javascript" src="src/Content/js/WorkshopsSwitch.js"></script>
    <script type="text/javascript" src="src/Content/js/Dropdown.js"></script>
    <script type="text/javascript" src="src/Content/js/app.js"></script>
</body>

</html>
