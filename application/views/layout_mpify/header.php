<!doctype html>
<html lang="en">

    <head>
        <title>:: Mplify :: Home</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
        <meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/animate-css/animate.min.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/summernote/dist/summernote.css"/>
        <link rel="stylesheet" href="/assets/mplifyadmin/html/assets/vendor/toastr/toastr.min.css" />

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/mplifyadmin/html/light/assets/css/main.css">
        <link rel="stylesheet" href="/assets/mplifyadmin/html/light/assets/css/color_skins.css">
    </head>



    <?php if (isset($css) && count($css) > 0) { ?>
        <!-- Carga de Scripts de la vista -->
        <?php foreach ($css as $c) { ?>
            <script type="text/javascript" src="<?= $c ?>"></script>
            <?php
        }
    }
    ?>


    <body class="theme-green">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="/assets/mplifyadmin/html/assets/images/thumbnail.png" width="48" height="48" alt="Mplify"></div>
                <p>Please wait...</p>        
            </div>
        </div>
        <!-- Overlay For Sidebars -->
        <div class="overlay" style="display: none;"></div>
