<?php 
	session_start();
	if (!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
 
include "views/modules/botonera.php";
include "views/modules/cabezote.php";
?>

<h1> Editar Eventos</h1>
<hr>


	
<?php 
	 $editarEventos = new EventosControllers();
	 $editarEventos -> editarEventosController();
	 $editarEventos -> actualizarEventosController();//si hay algun error al editar muesta el error
 ?>
	

