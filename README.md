# Sistema de login usando PHP orientado a objetos, PDO y sentencias preparadas

Este pequeño ejemplo demuestra el uso de PHP Data Objects, o PDO, que es una extensión de PHP que proporciona una interfaz orientada a objetos para acceder a bases de datos.
Además, la conexión a la base de datos se hace con sentencias preparadas(prepared statements).

Esto es un pequeño ejemplo de prueba de grado escolar. Obviamente puede haber mejoras y optimizaciones.

<details>
  
<summary>LOGIN</summary>

El sistema de login se conecta a la base de datos para crear una consulta SQL y verificar si el usuario ingresado existe y la contraseña coincide con dicho usuario.

El sistema funciona de la siguiente manera:
- Al entrar al sitio, el sistema detecta que no se ha iniciado sesión, por lo que redirige al visitante a `login.php`.
- Si no hay una sesión iniciada, no se puede acceder a ninguna parte del sitio.
- La contraseña es encriptada con el algoritmo de hash `sha256` y esta junto con el nombre de usuario son consultados en la base de datos. Si existen, se inicia sesión. Si no existen, se muestra un mensaje de error.
- Al iniciar sesión, si es usuario admin se lo envía a `admin.php`. Si es usuario regular, se lo envía a `index.php`.
</details>
<details>

<summary>SEGURIDAD</summary>

# Acceso directo a los archivos sensibles
Si se intenta acceder directamente a los achivos restringidos, el sistema detecta esto y manda al usuario a la raíz del sitio. Por lo tanto, no se le permite cargar archivos restringidos como `mensajes.php`:
```php
if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  header('HTTP/1.0 403 Forbidden', TRUE, 403);
  die(header( 'location: /' ));
}
```
# Sentencias preparadas
```php
$query = $db->connect()->prepare('SELECT * FROM usuarios WHERE username = :username AND password = :password');
$query->execute(['username' => $username, 'password' => $password]);
```
Esta parte del código hace uso de sentencias preparadas para conectarse a la base de datos. La sentencia preparada utiliza marcadores de posición (:username y :password) en lugar de
incluir directamente los valores en la consulta. Luego, se utiliza el método execute() para pasar los valores correspondientes a través de un array asociativo.

# Encriptación

Al crear un usuario, la contraseña que este elije se encripta usando el algoritmo de hash `sha256`:
```php
$hashed = hash('sha256', $password);
```

Al enviar los datos de inicio de sesión, la contraseña del usuario se encripta y después se compara con lo almacenado en la base de datos. 
```php
$password = hash('sha256', $_POST['password']);

$Obj = new Database(); // CREAMOS UN OBJETO DE LA CLASE Database
$query = $Obj->conectar()->prepare('SELECT * FROM usuarios WHERE username = :username AND password = :password'); // PREPARAMOS NUESTRA SQL QUERY
$query->execute(['username' => $username, 'password' => $password]); // EJECUTAMOS LA QUERY
```
De esta forma, la contraseña queda segura pues siquiera el adminsitrador de la base de datos podrá conocer la contraseña del usuario.
</details>

<details>

<summary>BASE DE DATOS</summary>

```sql
CREATE DATABASE `usuarios`;

USE `usuarios`;

CREATE TABLE `usuarios` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `rol_id` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_id_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles`(`id`)
);

CREATE TABLE `roles` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `rol` VARCHAR(50) NOT NULL,
    PRIMARY KEY(`id`)
);

INSERT INTO `roles` (`rol`) VALUES ('admin');
INSERT INTO `roles` (`rol`) VALUES ('usuario');
```

La base de datos almacenará un nombre de usuario, email y contraseña. Si el email ya existe, no se permitirá el registro de un nuevo usuario usando ese email. La contraseña se encuentra encriptada con el algoritmo de hash `sha256`.

La tabla roles es un catálogo, el cual contiene los tipos de usuario del sistema. En este ejemplo solo tenemos `admin` y `usuario`.

</details>

<details>

<summary>AUTOLOAD</summary>

El archivo `autoload.class.php` cargará de forma automática nuestras clases. La ruta será `classes\NOMBRE.class.php`. Nosotros solo indicamos `NOMBRE` y el archivo `autoload.class.php` hará el trabajo de buscar y cargar la clase referenciada.

</details>

<details>

<summary>SOFTWARE USADO</summary>

Entorno de desarrollo:
- Docker 4.17.0
- MySQL 8.0.32 - MySQL Community Server - GPL
- Apache/2.4.54
- PHP 8.1.15

Frontend:
- Bootstrap 5.3.0

</details>
