<?php
 
include('conexion.php');
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit;
}

$correo = $_SESSION['correo'];

// Obtener el ID del usuario usando su correo
$query = "SELECT id FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();


// Validar que se pasó el ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM libros WHERE id_libro = $id";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $libro = mysqli_fetch_assoc($resultado);
    } else {
        echo "Libro no encontrado.";
        exit;
    }
} else {
    echo "ID de libro no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Standard Post - Calvin</title>
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
                    <li><a href="nosotros.php" title="">Nosotros</a></li>
                    <li><a href="soporte.php" title="">Ayuda/Soporte</a></li>
                    <li><a href="categorias.php" title="">Volver</a></li>
                </ul> <!-- end s-header__nav -->

                <a href="#0" title="Close Menu" class="s-header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end s-header__nav-wrap -->

        </div> <!-- end s-header__navigation -->


    </header> <!-- end s-header -->


    <!-- content
    ================================================== -->
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry format-standard">

                    <div class="s-content__media">
                        <div class="s-content__post-thumb">
                            <img src="<?php echo $libro['imagen'] ? $libro['imagen'] : 'images/thumbs/default.jpg'; ?>" 
                                srcset="<?php echo $libro['imagen'] ? $libro['imagen'] : 'images/thumbs/default.jpg'; ?> 2100w" 
                                sizes="(max-width: 2100px) 200vw, 2100px" alt="Imagen del libro">
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title s-content__title--post">
                            <?php echo htmlspecialchars($libro['titulo']); ?>
                        </h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__entry-content">

                            <p class="lead">
                                <?php echo nl2br(htmlspecialchars($libro['descripcion'])); ?>
                            </p> 

                        <p>
                            <?php echo nl2br(htmlspecialchars($libro['contenido'])); ?>
                        </p>

                            
                        </div> <!-- end s-entry__entry-content -->

                        <div class="s-content__entry-meta">

                        <div class="entry-author meta-blk">
                            <div class="author-avatar">
                                <img class="avatar" src="images/logo.png" alt="Avatar del autor">
                            </div>
                            <div class="byline">
                                <span class="bytext">Autor:</span>
                                <a href="#0"><?php echo htmlspecialchars($libro['autor']); ?></a>
                            </div>
                        </div>

                        <div class="meta-bottom">

                            <div class="entry-cat-links meta-blk">
                                <div class="cat-links">
                                    <span>Género:</span> 
                                    <a href="#0"><?php echo htmlspecialchars($libro['genero']); ?></a>
                                </div>

                                <span>Año:</span>
                                <?php echo htmlspecialchars($libro['año_publicacion']); ?>
                            </div>
                        </div>
                    
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->

            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="column">

                    <h3>
                            "Cada libro que lees te transforma un poco… <br>
                            ¡comparte lo que sentiste y haz que esa historia siga viva en otros!" <br> <br>
                            <span>Añade una Reacción.</span>
                        </h3>

                        <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                            <fieldset>

                                <div class="form-field">
                                    <label for="emocion">¿Cómo te hizo sentir este libro?</label>
                                    <select name="emocion" id="emocion" class="h-full-width">
                                        <option value="😄 Alegría">😄 Alegría</option>
                                        <option value="😢 Tristeza">😢 Tristeza</option>
                                        <option value="😠 Ira">😠 Ira</option>
                                        <option value="😨 Miedo">😨 Miedo</option>
                                        <option value="😲 Sorpresa">😲 Sorpresa</option>
                                        <option value="😐 Neutral">😐 Neutral</option>
                                        <option value="🤢 Asco">🤢 Asco</option>
                                    </select>
                                </div>

                                <br>
                                <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Añadir Reacción" type="submit">

                            </fieldset>
                        </form>

                        <?php
                    
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
                            $emocion = $_POST['emocion'];
                            // Ya fue obtenido desde la consulta arriba
                            $id_libro = $_GET['id']; // ID del libro desde la URL
                            $fecha_emocion = date('Y-m-d H:i:s');

                            if (!empty($emocion) && !empty($id_usuario) && !empty($id_libro)) {
                                $stmt = $conn->prepare("INSERT INTO interacciones (id_libro, id_usuario, emocion, fecha_emocion) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("iiss", $id_libro, $id_usuario, $emocion, $fecha_emocion);

                                if ($stmt->execute()) {
                                echo '
                                <div id="successModal" style="
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-color: rgba(0, 0, 0, 0.6);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    z-index: 1000;
                                ">
                                    <div style="
                                        background-color: #d4edda;
                                        color: #155724;
                                        padding: 30px;
                                        border-radius: 8px;
                                        text-align: center;
                                        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                                    ">
                                        <h2>¡Gracias por tu emoción! 😄</h2>
                                        <p>Serás redirigido en unos segundos...</p>
                                    </div>
                                </div>

                                <script>
                                    setTimeout(function() {
                                        window.location.href = "categorias.php";
                                    }, 2000);
                                </script>
                                ';
                                exit;
                            }   

                            } else {
                                echo "<p style='color: red;'>Completa todos los campos.</p>";
                            }
                        }
                        ?>


                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->


    </section> <!-- end s-content -->


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

                    <h5>Comparte tu experiencia y ¡Hasta la próxima aventura literaria!</h5>

                    <p>Aquí siempre habrá un libro esperándote para abrir sus páginas y 
                        llevarte a otro mundo.
                        ¡Vuelve pronto a tu rincón favorito de historias! 📖❤️.</p>

                    <div class="subscribe-form">
                
                        <form id="mc-form" class="group" onsubmit="window.location.href='index.php'; return false;" novalidate="true">
                        <input type="submit" name="salir" value="Salir">
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