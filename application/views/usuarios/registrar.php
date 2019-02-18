<!doctype html>
<html lang="en">

    <head>
        <title>:: Mplify :: Sign Up</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
        <meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="/assets/mp/html/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/mp/html/assets/vendor/animate-css/animate.min.css">
        <link rel="stylesheet" href="/assets/mp/html/assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/mp/html/assets/vendor/toastr/toastr.min.css" />

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/mp/html/light/assets/css/main.css">
        <link rel="stylesheet" href="/assets/mp/html/light/assets/css/color_skins.css">
        <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 100%;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
        </style>
    </head>

    <body class="theme-blue">
        <!-- WRAPPER -->
        <div id="wrapper">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle auth-main">
                    <div class="auth-box">
                        <div class="mobile-logo"><a href="index.html"><img src="/assets/mp/html/assets/images/logo-icon.svg" alt="Mplify"></a></div>
                        <div class="auth-left">
                            <div class="left-top">
                                <a href="index.html">
                                    <img src="/assets/mp/html/assets/images/logo-icon.svg" alt="Mplify">
                                    <span>URBEAS</span>
                                </a>
                            </div>
                            <div class="left-slider">
                                <!-- Acá iría el mapa -->
                                <!--<iframe src="https://www.google.com/maps/embed?pb=Armenia+2121,+C1425FBC+CABA/@-34.5868451,-58.425443,17z/data=!3m1!4b1!4m5!3m4!1s0x95bcb586d453d2a5:0xfeb18dbe8712a8e8!8m2!3d-34.5868451!4d-58.4232543" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                                <div id="map"></div>
                                <!--<img src="/assets/mp/html/assets/images/login/1.jpg" class="img-fluid" alt="">-->
                            </div>
                        </div>

                        <div class="auth-right">
                            <div class="right-top">
                                <ul class="list-unstyled clearfix d-flex">
                                    <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li><a href="javascript:void(0);">Help</a></li>
                                    <li><a href="javascript:void(0);">Contact</a></li>
                                </ul>
                            </div>

                            <div class="card">
                                <div class="header">
                                    <p class="lead">Se parte de la Comunidad ¡Regístrate!</p>
                                </div>
                                <div class="body">
                                    <form class="form-auth-small">
                                        <div class="form-group">
                                            <input type="text" id="address" class="form-control" placeholder="Ingrese Dirección">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" placeholder="Ingrese Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <?php echo $widget; ?>
                                            <?php echo $script; ?>
                                        </div>
                                        <input type="hidden" id="place_id" value="">
                                        <input type="hidden" id="lat">
                                        <input type="hidden" id="lon">
                                        <input type="hidden" id="actualizar_mapa">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" id="registrarse">Registrarse</button>
                                        <button type="button" class="btn btn-primary btn-lg btn-block" id="registrarse_loading" style="display: none">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </button>
                                        <div class="bottom">
                                            <span class="helper-text">¿Ya tiene una cuenta? <a href="/usuarios/login/">Ingrese Aquí</a></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END WRAPPER -->
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$google_maps_api_key?>&sensor=false&libraries=places&language=es-AR&callback=initMap"></script>
<script src="/assets/mp/html/assets/vendor/toastr/toastr.js"></script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$google_maps_api_key?>&callback=initMap">-->
    </script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuMB_Fpcn6USQEoumEHZB_s31XSQeKQc0&libraries=places&language=es-AR" async defer ></script>-->

<script type="text/javascript" src="/assets/modulos/usuarios/js/registrar.js"></script>

