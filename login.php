<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Tinta Paginas y Encuentros</title>
  <link rel="stylesheet" href="css/estilo_log.css">
</head>

<body>
  <div class="fondo"></div>

  <div class="contenedor-libro" onclick="abrirLibro()">
    <img src="images/cubierta.png" alt="Libro" class="cubierta">
    <img src="images/logo.png" alt="Logo" class="logo">
  </div>

  <div class="pagina-login" id="paginaLogin">
    <img src="images/inicio_log.png" alt="Fondo Login" class="fondo-login">
    <form class="formulario" action="validaciones.php" method="post">
      <h2>Iniciar Sesión</h2>
      <input type="email" name="correo" placeholder="Correo" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit" class="submit btn btn--primary h-full-width">Iniciar</button>
      <p><a href="registro.php">Aún no tengo una cuenta</a></p>
    </form>
  </div>

  <script src="js/libro.js"></script>

</body>
</html>
