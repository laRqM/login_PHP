<?php
    session_start(); // INICIAMOS UNA SESSION
    if(!isset($_SESSION['rol'])) { // SI EN $_SESSION NO EXISTE EL DATO rol...
        header('location: /login.php'); // REDIRIGIMOS AL login.php. ES DECIR, SI NO SE HA INICIADO SESIÓN EN EL SITIO, MADAMOS A INICIAR SESIÓN.
        $_SESSION['mensaje_error_no_inicio_sesion'] = "Por favor, inicie sesión para acceder al sitio"; // DECLARAMOS UN VALOR EN SESSION QUE SERÁ USADO COMO MENSAJE DE ERROR
    }
?>
<!doctype html>
<html lang="es-MX">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Login Demo in PHP</title>
        <!-- STYLES -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="#">Login Demo in PHP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="/registrar.php">Registro</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuario</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="#">Perfil</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Notificaciones</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <a class="dropdown-item" href="/login.php?cerrar_sesion">Cerrar sesi&oacute;n</a>
                  </li>
                </ul><!-- dropdown-menu -->
              </li><!-- nav-item -->
            </ul><!-- navbar-nav -->
          </div><!-- navbar-collapse -->
        </div><!-- container -->
      </nav>
      
      <div class="container">
        <div class="text-center mt-5">
          <h1>Ejemplo de sistema de login</h1>
          <p class="lead">usando PHP orientado a objetos, PDO y sentencias preparadas</p>
          <p>Bootstrap v5.2.3</p>
        </div><!-- text-center mt-5 -->
      </div><!-- container -->

      <!-- SCRIPTS -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    </body>
</html>