<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Tinta Paginas y Encuentros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- JS -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>
</head>

<body id="top">

    <div id="preloader"> 
    	<div id="loader"></div>
    </div>

    <header class="s-header">
        <div class="s-header__logo">
            <a class="logo" href="index.php">
                <img src="images/logo.png" alt="Homepage">
            </a>
        </div>

        <div class="row s-header__navigation">
            <nav class="s-header__nav-wrap">
                <h3 class="s-header__nav-heading h6">Navegar a</h3>
                <ul class="s-header__nav">
                    <li><a href="login.php">Iniciar sesión</a></li>
                    <li><a href="registro.php">Registro</a></li>
                    <li><a href="contacto.php" title="">Ayuda/Soporte</a></li>
                    <li><a href="nosotros.php" title="">Nosotros</a></li>
                
                </ul>
                <a href="#0" class="s-header__overlay-close close-mobile-menu">Cerrar</a>
            </nav>
        </div>
        <a class="s-header__toggle-menu" href="#0"><span>Menu</span></a>
    </header>

    <section id="hero" class="s-hero">
        <div class="s-hero__slider">

            <!-- Slide 1 -->
            <div class="s-hero__slide">
                <div class="s-hero__slide-bg" style="background-image: url('images/slider/slide1-bg-3000.jpg');"></div>
                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="byline">La Divina Comedia <span class="author"><a href="#">Dante Alighieri</a></span></span>
                        </div>
                        <h1 class="s-hero__slide-text"><a href="#">"El amor mueve el sol y las demás estrellas."</a></h1>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="s-hero__slide">
                <div class="s-hero__slide-bg" style="background-image: url('images/slider/slide2-bg-3000.jpg');"></div>
                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="byline">Cien años de soledad <span class="author"><a href="#">Gabriel García Márquez</a></span></span>
                        </div>
                        <h1 class="s-hero__slide-text"><a href="#">"El mundo era tan reciente que muchas cosas carecían de nombre."</a></h1>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="s-hero__slide">
                <div class="s-hero__slide-bg" style="background-image: url('images/slider/slide3-bg-3000.jpg');"></div>
                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="byline">El Principito <span class="author"><a href="#">Antoine de Saint-Exupéry</a></span></span>
                        </div>
                        <h1 class="s-hero__slide-text"><a href="#">"Lo esencial es invisible a los ojos."</a></h1>
                    </div>
                </div>
            </div>

        </div>

        <div class="nav-arrows s-hero__nav-arrows">
            <button class="s-hero__arrow-prev">←</button>
            <button class="s-hero__arrow-next">→</button>
        </div>
    </section>

    <section class="s-content s-content--no-top-padding">
        <div class="s-bricks">
            <div class="masonry">
                <div class="bricks-wrapper h-group">

                    <div class="grid-sizer"></div>

                    <!-- Ejemplo artículo -->
                    <article class="brick entry" data-aos="fade-up">
                        <div class="entry__thumb">
                            <a href="#" class="thumb-link">
                                <img src="images/thumbs/libros/atomicos.jpeg" 
                                     srcset="images/thumbs/libros/atomicos.jpeg 1x, images/thumbs/libros/atomicos.jpeg 2x" 
                                     alt="libro1">
                            </a>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="#">Hábitos atómicos</a></h1>
                                <div class="entry__meta">
                                    <span class="byline">By: <span class='author'><a href="#">James Clear</a></span></span>
                                    <span class="cat-links"><a href="#">El más leído en Colombia</a></span>
                                </div>
                            </div>
                            <div class="entry__excerpt"><p>Una guía práctica sobre cómo pequeños cambios generan grandes resultados. Ideal para quienes buscan mejorar su vida, con estrategias respaldadas por ciencia. Líder en ventas por su impacto positivo.</p></div>
                            <a class="entry__more-link" href="#">Ver más</a>
                        </div>
                    </article>
                    
                    <article class="brick entry" data-aos="fade-up">
                        <div class="entry__thumb">
                            <a href="#" class="thumb-link">
                                <img src="images/thumbs/libros/sombra.jpeg" 
                                     srcset="images/thumbs/libros/sombra.jpeg 1x, images/thumbs/libros/sombra.jpeg 2x" 
                                     alt="ilibro2">
                            </a>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="#">En la sombra</a></h1>
                                <div class="entry__meta">
                                    <span class="byline">By: <span class='author'><a href="#">Príncipe Harry</a></span></span>
                                    <span class="cat-links"><a href="#">El más buscado en línea</a></span>
                                </div>
                            </div>
                            <div class="entry__excerpt"><p>Una autobiografía reveladora que expone los desafíos de la realeza desde dentro. Controvertido, honesto y emocional. Fue el libro más buscado por su contenido íntimo y mediático.</p></div>
                            <a class="entry__more-link" href="#">Ver más</a>
                        </div>
                    </article>

                    <article class="brick entry" data-aos="fade-up">
                        <div class="entry__thumb">
                            <a href="#" class="thumb-link">
                                <img src="images/thumbs/libros/cris.jpeg" 
                                     srcset="images/thumbs/libros/cris.jpeg 1x, images/thumbs/libros/cris.jpeg 2x" 
                                     alt="iibro3">
                            </a>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="#">Crisálida </a></h1>
                                <div class="entry__meta">
                                    <span class="byline">By: <span class='author'><a href="#">Fernando Navarro</a></span></span>
                                    <span class="cat-links"><a href="#"> Uno de los más atractivos según libreros</a></span>
                                </div>
                            </div>
                            <div class="entry__excerpt"><p>Una novela intensa sobre transformación personal y redención. Narrada con sensibilidad y profundidad, explora el renacer interior en momentos de crisis. Conmueve por su fuerza emocional y belleza literaria.</p></div>
                            <a class="entry__more-link" href="#">Ver más</a>
                        </div>
                    </article>

                    <!-- Agrega más artículos si quieres -->

                </div>
            </div>
        </div>
    </section>

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

                <div class="column large-3 medium-3 tab-6 s-footer__site-links">

                    <h5>Generos disponibles</h5>

                    <ul>
                        <li><a href="#0">Drama</a></li>
                        <li><a href="#0">Policial</a></li>
                        <li><a href="#0">Romance</a></li>
                        <li><a href="#0">Ciencia Ficcion</a></li>
                        <li><a href="#0">Terror</a></li>
                        <li><a href="#0">Tragedia</a></li>
                        <li><a href="#0">Comedia</a></li>
                        <li><a href="#0">Melodrama</a></li>
                        <li><a href="#0">Fantasia</a></li>
                        <li><a href="#0">Distopia</a></li>
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

                    <h5>Inicia tu viaje literario</h5>

                    <p>Crea tu cuenta y deja que las historias te encuentren a ti.</p>

                    <div class="subscribe-form">
                
                        <form id="mc-form" class="group" onsubmit="window.location.href='registro.php'; return false;" novalidate="true">
                        <input type="submit" name="Registrarse" value="Registrarse">
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
            </div> <!-- subir  -->
        </div> <!-- end s-footer__bottom -->

   </footer> <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>