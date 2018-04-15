<?php 
	session_start();
	if (!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
 
include "views/modules/botonera.php";
include "views/modules/cabezote.php";
?>
<!--==========================================
=            CONTIENIDO DEL SITIO            =
===========================================-->

<?php 
    $editarUsuario = new MvcController();
    $editarUsuario -> actualizarUsuarioController();//si hay algun error al editar muesta el error
    $editarUsuario -> editarUsuarioController();
 ?>
