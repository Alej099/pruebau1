<?php
session_start();
// Verificar que existan las variables de sesión necesarias para emoción
if (isset($_SESSION['emocion'], $_SESSION['usuario_id'])) {
    $emocion = escapeshellarg($_SESSION['emocion']);
    $usuario_id = intval($_SESSION['usuario_id']);

    // Ejecutar el script Python
    $comando = "python recomendar_por_emocion.py $emocion $usuario_id";
    $output = shell_exec($comando);

    // Si ves símbolos raros, usa utf8_encode como prueba
    $output_utf8 = utf8_encode($output);

    $resultado_emocion = json_decode($output_utf8, true);

    if (!is_array($resultado_emocion) || !isset($resultado_emocion['recomendaciones'])) {
        $recomendaciones_emocion = [];
        $error_emocion = true;
        $debug_output = $output_utf8; // Para depuración
    } else {
        $recomendaciones_emocion = $resultado_emocion['recomendaciones'];
        $error_emocion = false;
    }
} else {
    $recomendaciones_emocion = [];
    $error_emocion = false;
}


include("conexion.php");

// Mostrar errores (solo durante pruebas)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit;
}

$correo = $_SESSION['correo'];

// Obtener el ID del usuario y su género favorito
$query = "SELECT id, genero_uno FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->bind_result($id_usuario, $genero_favorito);
$stmt->fetch();
$stmt->close();

$libros_recomendados = [];

// Si tiene género favorito, obtener 3 libros recomendados
if ($genero_favorito) {
    $query = "SELECT * FROM libros WHERE genero = ? LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $genero_favorito);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $libros_recomendados = $resultado->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}


if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    $sql = "SELECT * FROM libros WHERE titulo LIKE '%$busqueda%' LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $libro = mysqli_fetch_assoc($resultado);
        $genero = strtolower(str_replace(' ', '', $libro['genero']));
        echo "<script>location.href='categorias.php#$genero';</script>";
        exit;
    } else {
        echo "<script>alert('Libro no encontrado');</script>";
    }
}

// Obtener todos los libros para la sección por géneros
$sql = "
    SELECT * FROM (
        SELECT *, ROW_NUMBER() OVER (PARTITION BY genero ORDER BY titulo ASC) AS fila
        FROM libros
    ) AS subconsulta
    WHERE fila <= 10
";
$resultado = $conn->query($sql);

$libros_por_genero = [];
while ($libro = $resultado->fetch_assoc()) {
    $genero = $libro['genero'];
    if (!isset($libros_por_genero[$genero])) {
        $libros_por_genero[$genero] = [];
    }
    $libros_por_genero[$genero][] = $libro;
}
?>



<!DOCTYPE html>
<html class="no-js" lang="en">


    
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Nuestra Selección de Lecturas - Tinta Paginas y Encuentros</title>
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
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>


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
                <img src="images/logo.png" alt="Homepage">
            </a>
        </div>

        <div class="row s-header__navigation">

            <nav class="s-header__nav-wrap">

                <h3 class="s-header__nav-heading h6">Navigate to</h3>

                <ul class="s-header__nav">
                    
                    <li><a href="categorias.php#drama">Drama</a></li>
                    <li><a href="categorias.php#romance">Romance</a></li>
                    <li><a href="categorias.php#policial">Policial</a></li>
                    <li><a href="categorias.php#cienciaficcion">Ciencia Ficcion</a></li>
                    <li><a href="categorias.php#terror">Terror</a></li>
                    <li><a href="categorias.php#tragedia">Tragedia</a></li>
                    <li><a href="categorias.php#comedia">Comedia</a></li>
                    <li><a href="categorias.php#melodrama">Melodrama</a></li>
                    <li><a href="categorias.php#fantasia">Fantasia</a></li>
                    <li><a href="categorias.php#distopia">Distopia</a></li>
                    <li><a href="soporte.php">Ayuda/Soporte</a></li>
                    <li><a href="index.php">Salir</a></li>
                    

                </ul> <!-- end s-header__nav -->

                <a href="#0" title="Close Menu" class="s-header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end s-header__nav-wrap -->	

    </header> <!-- end s-header -->



    <!-- libros 
    ================================================== -->
    <section class="s-content">


        <?php if (!empty($libros_recomendados)): ?>
<!-- libros recomendados  -->
<div class="s-pageheader">
    <div class="row">
        <div class="column large-12">
            <h1 class="page-title">
                <span class="page-title__small-type">Explora el Mundo de Tinta, Páginas y Encuentros</span>
                Nuestra Colección para Ti
            </h1>
        </div>
    </div>
</div>

<!-- Libros personalizados -->
<section class="s-bricks s-bricks--half-top-padding">
    <div class="masonry">
        <div class="bricks-wrapper h-group">
            <div class="grid-sizer"></div>
            <div class="lines"><span></span><span></span><span></span></div>

            <?php foreach ($libros_recomendados as $libro): ?>
            <article class="brick entry" data-aos="fade-up">
                <div class="entry__thumb">
                    <a href="libro.php?id=<?php echo $libro['id_libro'] ?>" class="thumb-link">
                        <img src="<?= htmlspecialchars($libro['imagen']) ?>" 
                             srcset="<?= htmlspecialchars($libro['imagen']) ?> 1x, <?= htmlspecialchars($libro['imagen']) ?> 2x"
                             alt="<?= htmlspecialchars($libro['titulo']) ?>">
                    </a>
                </div>

                <div class="entry__text">
                    <div class="entry__header">
                        <h1 class="entry__title">
                            <a href="single-libro.php?id=<?= $libro['id_libro'] ?>">
                                <?= htmlspecialchars($libro['titulo']) ?>
                            </a>
                        </h1>

                        <div class="entry__meta">
                            <span class="byline">Autor:
                                <span class='author'>
                                    <a href="#"><?= htmlspecialchars($libro['autor']) ?></a>
                                </span>
                            </span>
                            <span class="cat-links">
                                <a href="#"><?= htmlspecialchars($libro['genero']) ?></a>
                            </span>
                        </div>
                    </div>

                    <div class="entry__excerpt">
                        <p><?= htmlspecialchars($libro['descripcion']) ?></p>
                    </div>
                    <a href="libro.php?id=<?php echo $libro['id_libro']; ?>">Leer más</a>

                </div>
            </article>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- libros recomendados por emocion   -->
<?php if (!empty($libros_recomendados)): ?>
    

    <?php if (isset($_SESSION['emocion'])): ?>
         <div class="s-pageheader">
            <div class="row">
                <div class="column large-12">
                    <h1 class="page-title">
                        <span class="page-title__small-type">
                            Siente, lee, conecta: Tinta, Páginas y Encuentros
                        </span>
                        Tu Biblioteca Emocional Comienza Aquí.
                        Tu emoción de hoy: <em><?= htmlspecialchars($_SESSION['emocion']) ?></em>
                    </h1>
                </div>
            </div>
        </div>

        <?php if ($error_emocion): ?>
            <p>Error al obtener recomendaciones por emoción.</p>
            <pre><?= htmlspecialchars($debug_output) ?></pre>

        <?php elseif (count($recomendaciones_emocion) > 0): ?>
            <section class="s-bricks s-bricks--half-top-padding">
                <div class="masonry">
                    <div class="bricks-wrapper h-group">
                        <div class="grid-sizer"></div>
                        <div class="lines"><span></span><span></span><span></span></div>

                        <?php foreach (array_slice($recomendaciones_emocion, 0, 5) as $libro): ?>
                            <article class="brick entry" data-aos="fade-up">
                                <div class="entry__thumb">
                                    <a href="libro.php?id=<?php echo $libro['id_libro'] ?>" class="thumb-link">
                                        <img src="<?= htmlspecialchars($libro['imagen']) ?>" 
                                            srcset="<?= htmlspecialchars($libro['imagen']) ?> 1x, <?= htmlspecialchars($libro['imagen']) ?> 2x"
                                            alt="<?= htmlspecialchars($libro['titulo']) ?>">

                                    </a>
                                </div>

                                <div class="entry__text">
                                    <div class="entry__header">
                                        <h1 class="entry__title">
                                            <a href="single-libro.php?id=<?= $libro['id_libro'] ?>">
                                                <?= htmlspecialchars($libro['titulo']) ?>
                                            </a>
                                        </h1>

                                        <div class="entry__meta">
                                            <span class="byline">Autor:
                                                <span class="author">
                                                    <a href="#"><?= htmlspecialchars($libro['autor']) ?></a>
                                                </span>
                                            </span>
                                            <span class="cat-links">
                                                <a href="#"><?= htmlspecialchars($libro['genero']) ?></a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="entry__excerpt">
                                        <p><?= htmlspecialchars($libro['descripcion']) ?></p>
                                    </div>
                                    <a href="libro.php?id=<?= $libro['id_libro'] ?>">Leer más</a>
                                </div>
                            </article>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

        <?php else: ?>
            <p>No se encontraron libros recomendados para esta emoción.</p>
        <?php endif; ?>

    <?php endif; ?>

<?php endif; ?>



        <!-- Libros por genero 
        ================================================== -->
        <?php

    $frases_genero = [
    'Drama' => 'Historias que duelen, conmueven y reflejan la complejidad humana. Cuando lo cotidiano se convierte en una batalla emocional.',
    'Romance' => 'Amores imposibles, pasiones que arden y miradas que cambian destinos. Porque todos merecemos una historia que haga latir el corazón.',
    'Terror' => 'Pesadillas vivas, miedos ocultos y oscuridad que acecha. Atrévete a leer… si puedes dormir después.',
    'Ciencia Ficcion' => 'Tecnología que despierta preguntas, viajes imposibles y futuros que quizás no estén tan lejos. ¿Estás listo para cruzar los límites de la realidad?',
    'Policial' => 'Crímenes sin resolver, pistas ocultas y mentes brillantes. Nada es lo que parece cuando la verdad se esconde tras la evidencia.',
    'Tragedia' => 'Amores que terminan en lágrimas, héroes que caen y finales que dejan huella. El dolor también tiene belleza.',
    'Comedia' => 'Situaciones absurdas, personajes únicos y risas que estallan. Porque a veces, el mejor remedio está en una buena historia divertida.',
    'Melodrama' => 'Sentimientos extremos, dilemas imposibles y lágrimas que brotan con cada página. Cuando el corazón se convierte en campo de batalla.',
    'Fantasia' => 'Magia ancestral, mundos ocultos y héroes destinados a cambiarlo todo. Escapa de lo normal y sumérgete en lo extraordinario.',
    'Distopia' => 'Gobiernos totalitarios, rebeldes que se alzan y un futuro que nadie quiere vivir. Las revoluciones empiezan en las páginas.'
];

?>

        <?php foreach ($libros_por_genero as $genero => $libros): ?>
            
<!-- título categoría lectura -->
<div class="s-pageheader" id="<?= strtolower(str_replace(' ', '', $genero)) ?>">
    <div class="row">
        <div class="column large-12">
            <h1 class="page-title">
                <span class="page-title__small-type">
                    <?= isset($frases_genero[$genero]) ? $frases_genero[$genero] : 'Sumérgete en este universo literario.' ?>
                </span>
                <?= strtoupper($genero) ?>
            </h1>
        </div>
    </div>
</div> <!-- end s-pageheader -->

<!-- Libros por género -->
<section class="s-bricks s-bricks--half-top-padding">
    <div class="masonry">
        <div class="bricks-wrapper h-group">
            <div class="grid-sizer"></div>
            <div class="lines"><span></span><span></span><span></span></div>

            <?php foreach ($libros as $libro): ?>
            <article class="brick entry" data-aos="fade-up">

                <div class="entry__thumb">
                    
                    <a href="libro.php?id=<?php echo $libro['id_libro'] ?>" class="thumb-link">
                        <img src="<?= htmlspecialchars($libro['imagen']) ?>" 
                             srcset="<?= htmlspecialchars($libro['imagen']) ?> 1x, <?= htmlspecialchars($libro['imagen']) ?> 2x" 
                             alt="<?= htmlspecialchars($libro['titulo']) ?>">
                    </a>
                </div> <!-- end entry__thumb -->

                <div class="entry__text">
                    <div class="entry__header">
                        <h1 class="entry__title">
                            <a href="single-libro.php?id=<?= $libro['id_libro'] ?>">
                                <?= htmlspecialchars($libro['titulo']) ?>
                            </a>
                        </h1>

                        <div class="entry__meta">
                            <span class="byline">Autor:
                                <span class='author'>
                                    <a href="#"><?= htmlspecialchars($libro['autor']) ?></a>
                                </span>
                            </span>
                            <span class="cat-links">
                                <a href="#"><?= htmlspecialchars($libro['genero']) ?></a>
                            </span>
                        </div>
                    </div>

                    <div class="entry__excerpt">
                        <p><?= htmlspecialchars($libro['descripcion']) ?></p>
                    </div>

                    <a href="libro.php?id=<?php echo $libro['id_libro']; ?>">Leer más</a>

                </div> <!-- end entry__text -->

            </article> <!-- end article -->
            <?php endforeach; ?>

        </div> <!-- end bricks-wrapper -->
    </div> <!-- end masonry -->
</div> <!-- end s-bricks -->

<?php endforeach; ?>

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path></svg>
                </a>
            </div> <!-- subir  -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var containerBricks = document.querySelector('.bricks-wrapper');
        if (containerBricks) {
            imagesLoaded(containerBricks, function () {
                new Masonry(containerBricks, {
                    itemSelector: '.brick',
                    columnWidth: '.grid-sizer',
                    percentPosition: true
                });
            });
        }
    });
    </script>


</body>

</html>