<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/Blog.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>

    <header> 
    <?php 
    if ( isset($_SESSION['admin']) ) { ?>
            <div class="admin_connected">
            <?php if (isset($_GET['action']) && $_GET['action'] === "administration") { ?>
                <a href='Index.php'><input type="button" value="Retour au Blog" class="bttn"></a>
                <a href='Index.php?action=deconnexion'><input type="button" value="Déconnexion" class="bttn"></a>
            <?php } else { ?>
                <a href='Index.php?action=administration'><input type="button" value="Administration" class="bttn"></a>
                <a href='Index.php?action=deconnexion'><input type="button" value="Déconnexion" class="bttn"></a>
            <?php } ?>
            </div>
    <?php } else {     
        if ( isset($_GET['action']) && $_GET['action'] === "connexion") {
                // "Connexion" n'apparaît pas depuis la page de connexion
            } else { ?>  
                <div class="admin_connexion">
                    <a href='Index.php?action=connexion'><input type="button" value="Connexion" class="bttn"></a>
                </div>
            <?php } 
        } ?>
    </header>

    <?= $content ?>

</body>
</html>