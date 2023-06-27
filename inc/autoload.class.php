<?php 
    //MEDIDA SE SEGURIDAD. SI ALGUIEN INTENTA ACCEDER A ESTE ARCHIVO DIRECTAMENTE, SE LO ENVÍA A LA PÁGINA DE INICIO DEL SITIO
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header( 'location: /' ));
    }
?>

<?php
    spl_autoload_register('autoload'); //AUTOCARGAMOS LA FUNCIÓN autoload

    function autoload ($class) { //CUANDO UNA FUNCIÓN O MÉTODO SE INTENTE CARGAR Y/O EJECUTAR, ESTO LO DETECTA Y EL NOMBRE SE GUARDA EN LA VARIABLE class
        $ruta = "classes/"; //CARPETA CONTENEDORA
        $extension = ".class.php"; //EXTENSIÓN DEL ARCHIVO. LAS CLASES LAS NOMBRAREMOS CON UN .class.php AL FINAL
        $nombreClase = str_replace("\\", DIRECTORY_SEPARATOR, $class); //PARA PHP 7.4 NECESITAMOS ELIMINAR PARÉNTESIS.

        include_once $ruta . $nombreClase . $extension; //INCLUIMOS AL ARCHIVO CONCATENANDO LOS VALORES DE LAS VARIABLES ANTERIORES PARA GENERAR UNA SOLA STRING
    }
?>
