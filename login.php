<?php
	include_once 'inc/functions/db.php'; // LLAMAMOS AL ARCHIVO QUE MANEJA LA CONEXIÓN A LA BASE DE DATOS
    session_start(); // INICIAMOS UNA SESSION
    if(isset($_GET['cerrar_sesion'])) { // SI LA OPCIÓN cerrar_sesion SE UTILIZA...
        session_unset(); // LIBERAMOS LAS VARIABLES DE LA SESSION
        session_destroy(); // DESTRUIMOS LA SESSION
		header("Location: /login.php"); // AL CERRAR SESIÓN MANDAMOS AL USUARIO AL INICIO DE SESIÓN
    }

    if(isset($_SESSION['rol'])) { // SI LA SESIÓN YA TIENE UN ROL, ES DECIR, QUE YA SE INICIÓ SESIÓN...
        switch($_SESSION['rol']) { // HACEMOS UN SWITCH
            case 1: // SI ES EL CASO 1, ES DECIR, QUE SEA admin...
                header('location: /admin.php');  // LO MANDAMOS A admin.php
                break;
            case 2: //SI ES EL CASO 2, ES DECIR, QUE SEA usuario...
                header('location: /index.php'); //LO MANDAMOS A index.php
                break;
            default;
        // ESTO SIRVE PARA QUE, SI UN USUARIO QUE YA INICIÓ SESIÓN QUIERE ACCEDER DIRECTAMENTE AL ARCHIVO login.php
        // COMO YA INICIÓ SESIÓN, NO DEBERÍA TENER ACCESO A LA PÁGINA DE INICIO DE SESIÓN(login.php)
        // Y POR LO TANTO, SI LA SESIÓN ESTÁ INICIADA, LO MANDAMOS A index.php SI QUIERE ACCEDER DIRECTAMENTE A login.php
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])) { // SI username Y password HAN RECIBIDO UN DATO...
        $username = $_POST['username']; // LA VARIABLE $username SERÁ IGUAL AL DATO ENVIADO A $_POST['username']
        $username = htmlspecialchars($username); // SANITIZAMOS A LA VARIABLE $username
        $username = stripslashes($username); // ELIMINAMOS LAS DIAGONALES INVERTIDAS
        $username = trim($username); // ELIMINAMOS ESPACIOS EN BLANCO AL PRINCIPIO Y FINAL
        $password = hash('sha256', $_POST['password']); // ENCRIPTAMOS EL CONTENIDO DE LA VARIABLE USANDO EL ALGORITMO DE HASH sha256

        $Obj = new Database(); // CREAMOS UN OBJETO DE LA CLASE Database
        $query = $Obj->conectar()->prepare('SELECT * FROM usuarios WHERE username = :username AND password = :password'); // PREPARAMOS NUESTRA SQL QUERY
        $query->execute(['username' => $username, 'password' => $password]); // EJECUTAMOS LA QUERY

        $row = $query->fetch(PDO::FETCH_NUM); // LA VARIABLE $row SERÁ IGUAL A LO OBTENIDO EN LA QUERY
        if($row) { // SI $row TIENE DATOS
            $rol = $row[4]; // LA VARIABLE rol SERÁ IGUAL AL DATO EN LA POSICIÓN 3 DE LA TABLA usuarios
            $_SESSION['rol'] = $rol; // GUARDAMOS LO ANTERIOR EN SESSION
            switch($_SESSION['rol']) {
                case 1:
                    header('location: /admin.php'); // AL INICIAR SESIÓN CORRECTAMENTE, SI ES EL ID 1, EL USUARIO ES admin Y SE MANDA AL index.php
                    break;
                case 2:
                    header('location: /index.php'); // AL INICIAR SESIÓN CORRECTAMENTE, SI ES EL ID 2, EL USUARIO ES trabajador Y SE MANDA AL index.php
                    break;
                default;
            }
        } else {
			$_SESSION['mensaje_error_login'] = "Usuario o contrase&ntilde;a incorrectos"; // SI ALGO NO ES CORRECTO EN LOS DATOS INGRESADOS, TIRAMOS UN ERROR. LOS MENSAJES SE MANEJAN EN mensajes.php
        }
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
                                        <h1>Bienvenido</h1>
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
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input class="form-control" type="password" name="password" id="password" required="">
                                            <div class="invalid-feedback">
                                                Por favor, escribe tu contraseña
                                            </div>
                                        </div><!-- mb-3 -->
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                                <label class="form-check-label" for="form2Example3">
                                                    Recordarme
                                                </label>
                                            </div>
                                            <a href="#!" class="text-body">&iquest;Olvidaste tu contrase&ntilde;a?</a>
                                        </div><!-- mb-3 -->
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="submit" name="submit">Iniciar sesión</button>
                                        </div><!-- d-grid gap-2 -->
                                    </form>
                                    <div class="text-center">
                                        &iquest;No tienes cuenta? <a href="/registrar.php">Registrate</a>
                                    </div>
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