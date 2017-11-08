<?php
    session_start();
    require_once 'connect.php';
    require_once 'auth.php';
    $app_login = isset($_SESSION['userId']) ? true : false;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, minimum-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Sistema Administrador Kanino">

    <meta name="msapplication-TileImage" content="dist/img/mobile/ms-icon-144x144.png">
    <meta name="msapplication-TileColor" content="#422b26">
    <meta name="theme-color" content="#422b26">

    <link rel="apple-touch-icon" sizes="57x57" href="dist/img/mobile/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="dist/img/mobile/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="dist/img/mobile/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="dist/img/mobile/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="dist/img/mobile/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="dist/img/mobile/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="dist/img/mobile/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="dist/img/mobile/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="dist/img/mobile/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="dist/img/mobile/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="dist/img/mobile/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="dist/img/mobile/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="dist/img/mobile/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="dist/img/mobile/favicon.ico">
    <link rel="manifest" href="dist/img/mobile/manifest.json">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,900">
    <link rel="stylesheet" href="dist/css/lib/reset.min.css">
    <link rel="stylesheet" href="dist/css/lib/default.min.css">
    <link rel="stylesheet" href="dist/css/lib/grid.min.css">
    <link rel="stylesheet" href="dist/css/lib/ibaro.icons.min.css">
    <link rel="stylesheet" href="dist/css/lib/ibaro.tipfy.min.css">
    <link rel="stylesheet" href="dist/css/lib/ibaro.validity.min.css">
    <link rel="stylesheet" href="dist/css/theme/style.min.css">
    <link rel="stylesheet" href="dist/css/theme/header.min.css">
    <link rel="stylesheet" href="dist/css/theme/footer.min.css">
    <link rel="stylesheet" href="dist/css/theme/extra/keyframes.min.css">
    <link rel="stylesheet" href="dist/css/theme/extra/responsive.min.css">
    <script src="dist/js/all.js"></script>

    <title>Kanino Pet Shop - Sistema Administrador</title>
</head>
<body>
    <noscript class="noscript ta-c"></noscript>
    <?php if($app_login){ ?>
        <div class="header">
            <div class="wrap">
                <nav class="header--menu d-ib va-b" data-menu>
                    <input class="header--check" type="checkbox" id="Menu">
                    <label for="Menu" class="header--icon fa fa-navicon d-ib va-m ta-c"></label>
                    <ul class="header--nav d-n">
                        <li class="header--item"><a class="d-b header--link fa fa-dashboard" href="./">Dashboard</a></li>
                        <li class="header--item"><a class="d-b header--link fa fa-users" href="user_list.php">Usuários</a></li>
                        <li class="header--item"><a class="d-b header--link fa fa-list" href="category_list.php">Categorias</a></li>
                        <li class="header--item"><a class="d-b header--link fa fa-shopping-bag" href="product_list.php">Produtos</a></li>
                        <li class="header--item-row"></li>
                        <li class="header--item"><a class="d-b header--link fa fa-user" href="meu-perfil.php">Meu Perfil</a></li>
                        <li class="header--item"><a class="d-b header--link fa fa-sign-out" href="includes/logout.php">Logout</a></li>
                    </ul>
                </nav>
                <div class="header--logo d-ib va-m">
                    <img src="dist/img/logo.svg" alt="Logotipo Kanino">
                </div>
                <div class="header--name d-ib va-m">
                    <?php
                    $app_user = odbc_exec($db, "
                        SELECT nomeUsuario, idUsuario
                        FROM Usuario
                        WHERE idUsuario = ".$_SESSION['userId']);
                    ?>
                    olá <?php echo odbc_fetch_array($app_user)['nomeUsuario'];?>
                </div>
                <form class="fl-r header--search">
                    <input class="d-b" type="search" name="Search" id="Search" placeholder="Buscar produtos">
                    <button class="fa fa-search"></button>
                </form>
            </div>
        </div>
    <?php } ?>