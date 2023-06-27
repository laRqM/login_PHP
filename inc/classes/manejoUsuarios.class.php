<?php 
    // MEDIDA SE SEGURIDAD. SI ALGUIEN INTENTA ACCEDER A ESTE ARCHIVO DIRECTAMENTE, SE LO ENVÍA A LA PÁGINA DE INICIO DEL SITIO
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header( 'location: /' ));
    }
?>

<?php
    class manejoUsuarios extends Usuarios {
        public function crearUsuario($usuario, $email, $password) { // MÉTODO PARA CREAR UN USUARIO
            $user   =   htmlspecialchars($usuario, ENT_QUOTES); // SANITIZAMOS EL USUARIO RECIBIDO
            $correo =   htmlspecialchars($email, ENT_QUOTES);   // SANITIZAMOS EL CORREO ELECTRÓNICO RECIBIDO

            $sqlEmail = "SELECT * FROM usuarios WHERE email = :email"; // PREPARAMOS LA SENTENCIA SQL PARA VERIFICAR EL CORREO ELECTRÓNICO

            $stmtEmail = $this->conectar()->prepare($sqlEmail); // PREPARAMOS LA SENTENCIA
            $stmtEmail->execute(['email' => $correo]); // EJECUTAMOS LA SENTENCIA HACIENDO LA ASIGNACIÓN

            if($stmtEmail->rowCount() > 0) { // SI EL NÚMERO DE FILAS ES MAYOR QUE 0, SIGNIFICA QUE EL EMAIL YA ESTÁ EN USO
                $_SESSION['mensaje_error_email_repetido'] = 'El correo electrónico ingresado ya está en uso';
            } else { // EN CASO CONTRARIO, PROCEDEMOS AL REGISTRO
                $hashed = hash('sha256', $password); // UTILIZAMOS EL ALGORITMO DE HASH sha256 PARA ENCRIPTAR LA CONTRASEÑA

                $sql = "INSERT INTO usuarios (username, password, email, rol_id) VALUES (:usuario, :contra, :correo_E, 2)"; // SENTENCIA SQL PARA CREAR EL USUARIO. EL 2 REPRESENTA EL TIPO DE USUARIO usuario

                try {
                    $query = $this->conectar()->prepare($sql); // NOS CONECTAMOS A LA BASE DE DATOS Y PREPARAMOS LA SENTENCIA SQL
                    $query->execute(['usuario' => $user, 'contra' => $hashed, 'correo_E' => $correo]); // EJECUTAMOS LA SENTENCIA HACIENDO LAS ASIGNACIONES
                    $_SESSION['mensaje_usuario_creado'] = "Usuario creado correctamente";
                } catch(Exception $e) {
                    $_SESSION['mensaje_error_crear_usuario'] = "Error al crear el usuario";
                }
            }
        }
    } 
?>
