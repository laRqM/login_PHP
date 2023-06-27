<?php 
    //MEDIDA SE SEGURIDAD. SI ALGUIEN INTENTA ACCEDER A ESTE ARCHIVO DIRECTAMENTE, SE LO ENVÍA A LA PÁGINA DE INICIO DEL SITIO
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header( 'location: /'));
    }
?>
<?php
    class Database {        // DECLARAMOS LA CLASE Database
        private $host;      // VARIABLE PRIVADA PARA ALMACENAR EL HOST DE LA BASE DE DATOS
        private $db;        // VARIABLE PRIVADA PARA ALMACENAR EL NOMBRE DE LA BASE DE DATOS
        private $user;      // VARIABLE PRIVADA PARA ALMACENAR EL USUARIO DE LA BASE DE DATOS  
        private $password;  // VARIABLE PRIVADA PARA ALMACENAR LA CONTRASEÑA DEL USUARIO DE LA BASE DE DATOS
        private $charset;   // VARIABLE PRIVADA PARA ALMACENAR EL CONJUNTO DE CARACTERES

        public function __construct() { // DECLARAMOS EL CONSTRUCTOR DE LA CLASE
            $this->host = 'db';
            $this->db = 'usuarios';
            $this->user = 'root';
            $this->password = '';
            $this->charset = 'utf8mb4';
        }

        function conectar() { // MÉTODO PARA CONECTARSE A LA BASE DE DATOS
            try {
                $conexion = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset; // CADENA DE CONEXIÓN A LA BASE DE DATOS
                $opciones = [ // ARRAY CON LAS CONFIGURACIONES DE LA CONEXIÓN PDO
                    PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION, // HABILITAMOS EL MODO DE EXCEPCIONES
                    PDO::ATTR_EMULATE_PREPARES  => false, // DESACTIVAMOS LA EMULACIÓN DE PREPARACIÓN DE CONSULTAS
                ];
                
                $pdo = new PDO($conexion, $this->user, $this->password, $opciones); // CREAMOS UNA INSTANCIA DE LA CLASE PDO USANDO LA CADENA DE CONEXIÓN PREVIAMENTE DECLARADA, EL USUARIO Y CONTRASEÑA DE LA BASE DE DATOS. ASÍ COMO LAS OPCIONES DE CONFIGURACIÓN
        
                return $pdo; // RETORNAMOS LA VARIABLE
            } catch(PDOException $e) { // SI ALGO SALE MAL, SE CAPTURA
                print_r('ERROR DE CONEXI&Oacute;N CON LA BASE DE DATOS: ' . $e->getMessage()); // DE IMPRIME UN MENSAJE DE ERROR Y EL PROBLEMA DE CONEXIÓN
            }
        }
    }
?>
