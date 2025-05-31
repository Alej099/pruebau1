<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Registro</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>


</head>

<body id="top">
    <!-- preloader
    ================================================== -->
    <div id="preloader"> 
    	<div id="loader"></div>
    </div>
    <!-- header
    ================================================== -->
    <header class="s-header s-header--opaque">

        <div class="s-header__logo">
            <a class="logo" href="index.php">
                <img src="images/logo.png" alt="logo">
            </a>
        </div>

        <div class="row s-header__navigation">

            <nav class="s-header__nav-wrap">

                <h3 class="s-header__nav-heading h6">Navigate to</h3>

                <ul class="s-header__nav">
                    <li><a href="login.php" title="">Inicio Sesion</a></li>
                    <li><a href="contacto.php" title="">Ayuda/Soporte</a></li>
                    <li><a href="nosotros.php" title="">Nosotros</a></li>
                    <li><a href="index.php" title="">volver</a></li>
                </ul> <!-- end s-header__nav -->

                <a href="#0" title="Close Menu" class="s-header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end s-header__nav-wrap -->

        </div> <!-- end s-header__navigation -->

        <a class="s-header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>


    </header> <!-- end s-header -->


    <!-- content
    ================================================== -->
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry">

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title">Cada lector tiene una historia <br>¡Regístrate y comienza la tuya!</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__page-content">

                            <p class="lead">
                            Aquí podrás encontrar recomendaciones personalizadas, 
                            explorar tus géneros favoritos, y guardar aquellas historias que no quieres olvidar.
                            </p> 


                            <form name="registerForm" id="registerForm" class="s-content__form" method="post" action="validaciones.php">
                            <fieldset>
                                <!-- Nombre -->
                                <div class="form-field">
                                <input name="nombre" type="text" id="nombre" class="h-full-width h-remove-bottom" placeholder="Tu Nombre" required>
                                </div>

                                <!-- Correo -->
                                <div class="form-field">
                                <input name="correo" type="email" id="correo" class="h-full-width h-remove-bottom" placeholder="Tu Correo" required>
                                </div>

                                <!-- Contraseña -->
                                <div class="form-field" style="position: relative;">
                                    <input name="clave" type="password" id="clave" class="h-full-width h-remove-bottom" placeholder="Contraseña" required>
                                    <span class="toggle-password" onclick="togglePassword('clave')" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">👁️</span>
                                </div>

                                <!-- Confirmar contraseña -->
                                <div class="form-field" style="position: relative;">
                                    <input name="confirmar_clave" type="password" id="confirmar_clave" class="h-full-width h-remove-bottom" placeholder="Confirmar Contraseña" required>
                                    <span class="toggle-password" onclick="togglePassword('confirmar_clave')" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">👁️</span>
                                </div>

                            <!-- Género 1 (obligatorio) -->
                            <div class="form-field">
                                <select name="genero1" id="genero1" class="h-full-width h-remove-bottom" required>
                                    <option value="">Selecciona tu género favorito</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Policial">Policial</option>
                                    <option value="Ciencia Ficcion">Ciencia Ficción</option>
                                    <option value="Terror">Terror</option>
                                    <option value="Tragedia">Tragedia</option>
                                    <option value="comedia">comedia</option>
                                    <option value="Melodrama">Melodrama</option>
                                    <option value="Fantasia">Fantasia</option>
                                    <option value="Distopia">Distopia</option>
                                    
                                </select>
                            </div>

                            <!-- Género 2 (opcional) -->
                            <div class="form-field">
                                <select name="genero2" id="genero2" class="h-full-width h-remove-bottom">
                                    <option value="">Selecciona un segundo género (opcional)</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Policial">Policial</option>
                                    <option value="Ciencia Ficcion">Ciencia Ficción</option>
                                    <option value="Terror">Terror</option>
                                    <option value="Tragedia">Tragedia</option>
                                    <option value="comedia">comedia</option>
                                    <option value="Melodrama">Melodrama</option>
                                    <option value="Fantasia">Fantasia</option>
                                    <option value="Distopia">Distopia</option>
                                </select>
                            </div>

                            <br>
                            <button type="submit" class="submit btn btn--primary h-full-width">Registrarse</button>
                        </fieldset>
                
                    </form>



                        </div> <!-- end s-entry__page-content -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->


    <!-- footer
    ================================================== -->
<footer class="s-footer">

        <div class="s-footer__main">

            <div class="row">

                <div class="column large-3 medium-6 tab-12 s-footer__info">

                    <h5>Acerca de nosotros</h5>

                    <p>
                        "Tu próximo libro favorito te está esperando… <br>
                        Nosotros sabemos cuál es, porque entendemos tus pasiones, tus emociones y aquello que realmente
                        disfrutas leer. <br>
                        Déjanos guiarte a historias que parecen escritas para ti."
                    </p>

                </div> <!-- end s-footer__info -->

                <div class="column large-2 medium-3 tab-6 s-footer__site-links">

                    <h5>Generos disponibles</h5>

                    <ul>
                        <li><a href="#0">drama</a></li>
                        <li><a href="#0">policial</a></li>
                        <li><a href="#0">drama</a></li>
                        <li><a href="#0">drama</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>

                </div> <!-- end s-footer__site-links -->  

                <div class="column large-2 medium-3 tab-6 s-footer__social-links">

                    <h5>Siguenos</h5>

                    <ul>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Pinterest</a></li>
                        <li><a href="#0">Instagram</a></li>
                    </ul>

                </div> <!-- end s-footer__social links --> 

                <div class="column large-3 medium-6 tab-12 s-footer__subscribe">

                    <h5>Tu historia continúa aquí. </h5>

                    <p>Inicia sesión y sigue descubriendo.</p>

                    <div class="subscribe-form">
                
                        <form id="mc-form" class="group" onsubmit="window.location.href='login.php'; return false;" novalidate="true">
                        <input type="submit" name="login" value="iniciar sesion">
                        </form>

                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div> <!-- end row -->

        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="column">
                    <div class="ss-copyright">
                        <span>© Udenar Ext Ipiales</span> 
                        <span>Design by Tinta Paginas y Encuentros</span>
                    </div> <!-- end ss-copyright -->
                </div>
            </div> 

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path></svg>
                </a>
            </div> <!-- end ss-go-top -->
        </div> <!-- end s-footer__bottom -->

   </footer> <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>
    function togglePassword(idCampo) {
    const campo = document.getElementById(idCampo);
    if (campo.type === "password") {
        campo.type = "text";
    } else {
        campo.type = "password";
    }
    }
    </script>


</body>
</html>
