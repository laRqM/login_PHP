<?php 
    //MEDIDA SE SEGURIDAD. SI ALGUIEN INTENTA ACCEDER A ESTE ARCHIVO DIRECTAMENTE, SE LO ENVÍA A LA PÁGINA DE INICIO DEL SITIO
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header( 'location: /' ));
    }
?>
<?php
	if(isset($_SESSION['mensaje_error_login'])) :
?>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<i class="fa-solid fa-circle-xmark" style="margin-right:.5rem!important;"></i>
		<div>
			<?= $_SESSION['mensaje_error_login']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div>
	</div>
<?php
	unset($_SESSION['mensaje_error_login']);
	endif;
?>

<?php
	if(isset($_SESSION['mensaje_error_email_repetido'])) :
?>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<i class="fa-solid fa-circle-xmark" style="margin-right:.5rem!important;"></i>
		<div>
			<?= $_SESSION['mensaje_error_email_repetido']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div>
	</div>
<?php
	unset($_SESSION['mensaje_error_email_repetido']);
	endif;
?>

<?php
	if(isset($_SESSION['mensaje_usuario_creado'])) :
?>
	<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
		<i class="fa-solid fa-circle-xmark" style="margin-right:.5rem!important;"></i>
		<div>
			<?= $_SESSION['mensaje_usuario_creado']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div>
	</div>
<?php
	unset($_SESSION['mensaje_usuario_creado']);
	endif;
?>

<?php
	if(isset($_SESSION['mensaje_usuario_password_no_match'])) :
?>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<i class="fa-solid fa-circle-xmark" style="margin-right:.5rem!important;"></i>
		<div>
			<?= $_SESSION['mensaje_usuario_password_no_match']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div>
	</div>
<?php
	unset($_SESSION['mensaje_usuario_password_no_match']);
	endif;
?>

<?php
	if(isset($_SESSION['mensaje_usuario_error'])) :
?>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<i class="fa-solid fa-circle-xmark" style="margin-right:.5rem!important;"></i>
		<div>
			<?= $_SESSION['mensaje_usuario_error']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div>
	</div>
<?php
	unset($_SESSION['mensaje_usuario_error']);
	endif;
?>