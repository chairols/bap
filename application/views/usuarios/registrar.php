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

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/mp/html/light/assets/css/main.css">
        <link rel="stylesheet" href="/assets/mp/html/light/assets/css/color_skins.css">
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
                                    <span>Mplify</span>
                                </a>
                            </div>
                            <div class="left-slider">
                                <img src="/assets/mp/html/assets/images/login/1.jpg" class="img-fluid" alt="">
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
                                    <p class="lead">Create an account</p>
                                </div>
                                <div class="body">
                                    <form class="form-auth-small">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="signup-email" placeholder="Ingrese Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="address" class="form-control" placeholder="Ingrese Dirección">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="signup-password" placeholder="Contraseña">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Registrarse</button>
                                        <div class="bottom">
                                            <span class="helper-text">¿Ya tiene una cuenta? <a href="/usuarios/login/">Ingrese Aquí</a></span>
                                        </div>
                                    </form>
                                    <div class="separator-linethrough"><span>OR</span></div>
                                    <button class="btn btn-signin-social"><i class="fa fa-facebook-official facebook-color"></i> Sign in with Facebook</button>
                                    <button class="btn btn-signin-social"><i class="fa fa-twitter twitter-color"></i> Sign in with Twitter</button>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCuMB_Fpcn6USQEoumEHZB_s31XSQeKQc0&sensor=false&libraries=places&language=en-AU"></script> 
<script>
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
</script> 
