<?php 
    //MEDIDA SE SEGURIDAD. SI ALGUIEN INTENTA ACCEDER A ESTE ARCHIVO DIRECTAMENTE, SE LO ENVÍA A LA PÁGINA DE INICIO DEL SITIO
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header('location: /'));
    }
?>
<?php
    if(isset($_POST['registrar'])) {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) { // SI EL BOTÓN registrar HA SIDO PRESIONADO Y HA ENVIADO TODOS LOS DATOS...
            $usuario            =   $_POST['username'];
            $email              =   $_POST['email'];
            $password           =   $_POST['password'];
            $confirm_password   =   $_POST['confirm_password'];

            if($password != $confirm_password) { // SI LAS CONTRASEÑAS NO SON IGUALES...
                $_SESSION['mensaje_usuario_password_no_match'] = "Las contrase&ntilde;as no coinciden";
            } else { // SI SON IGUALES...
                $Obj = new manejoUsuarios();
                $Obj->crearUsuario($usuario, $email, $password);
            }
        } else { // ENTONCES, ALGÚN CAMPO NO FUE LLENADO
            $_SESSION['mensaje_usuario_error'] = "Favor de rellenar todos los campos";
        }
    }
?>