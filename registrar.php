<?php
    session_start();
    if(isset($_SESSION['rol'])) { // SI LA SESIÓN YA TIENE UN ROL, ES DECIR, QUE YA SE INICIÓ SESIÓN...
        switch($_SESSION['rol']) { // HACEMOS UN SWITCH
            case 1: // SI ES EL CASO 1, ES DECIR, QUE SEA admin...
                header('location: /admin.php');  // LO MANDAMOS A admin.php
                exit;
            case 2: //SI ES EL CASO 2, ES DECIR, QUE SEA usuario...
                header('location: /index.php'); //LO MANDAMOS A index.php
                exit;
            default;
        // ESTO SIRVE PARA QUE, SI UN USUARIO QUE YA INICIÓ SESIÓN QUIERE ACCEDER DIRECTAMENTE AL ARCHIVO login.php
        // COMO YA INICIÓ SESIÓN, NO DEBERÍA TENER ACCESO A LA PÁGINA DE INICIO DE SESIÓN(login.php)
        // Y POR LO TANTO, SI LA SESIÓN ESTÁ INICIADA, LO MANDAMOS A index.php SI QUIERE ACCEDER DIRECTAMENTE A login.php
        }
    }
    include_once('inc/autoload.class.php');
    include_once('inc/functions/registro.php');
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
    <body class="bg-primary bg-opacity-25">
        <section>
            <div class="d-flex flex-column min-vh-100 justify-content-center">
                <div class="container">
                    <div class="row">
                        <?php include_once('mensajes.php'); ?>
                        <div class="col-sm-12 col-md-10 mx-auto bg-white rounded shadow">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-5 text-center">
                                        <h1>Registro de usuario</h1>
                                    </div>
                                    <form class="m-5 needs-validation" action="#" method="POST" novalidate="">
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Usuario</label>
                                            <input class="form-control" type="text" name="username" id="username" required="">
                                            <div class="invalid-feedback">
                                                Por favor, escribe tu nombre de usuario
                                            </div>
                                        </div><!-- mb-3 -->
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Correo electr&oacute;nico</label>
                                            <input class="form-control" type="text" name="email" id="email" required="">
                                            <div class="invalid-feedback">
                                                Por favor, escribe tu correo electr&oacute;nico
                                            </div>
                                        </div><!-- mb-3 -->
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input class="form-control" type="password" name="password" id="password" required="">
                                            <div class="invalid-feedback">
                                                Por favor, escribe tu contraseña
                                            </div>
                                        </div><!-- mb-3 -->
                                        <div class="mb-3">
                                            <label class="form-label" for="confirm_password">Confirmar contraseña</label>
                                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" required="">
                                            <div class="invalid-feedback">
                                                Por favor, confirma tu contraseña
                                            </div>
                                        </div><!-- mb-3 -->
                                        <div class="row text-center">
                                            <div class="col-md-6 mb-2">
                                                <div class="d-grid">
                                                    <button class="btn btn-success btn-block" type="submit" name="registrar">Registrarse</button>
                                                </div><!-- d-grid -->
                                            </div><!-- col-md-6 -->
                                            <div class="col-md-6">
                                                <div class="d-grid">
                                                    <a class="btn btn-info btn-block" type="button" href="/login.php">Iniciar sesión</a>
                                                </div><!-- d-grid -->
                                            </div><!-- col-md-6 -->
                                        </div><!-- row text-center -->
                                    </form>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <div>
                                        <img src="https://www.svgrepo.com/show/96348/server.svg" alt="login_image" class="img-fluid p-5">
                                    </div>
                                </div><!-- col-md-6 -->
                            </div><!-- row -->
                        </div><!-- col-sm-12 -->
                    </div><!-- row -->
                </div><!-- container -->
            </div><!-- d-flex -->
        </section>

        <!-- SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
        <script src="assets/js/bs-validation.js"></script>
    </body>
</html>