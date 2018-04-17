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

<form method="post" action="">
	
<?php 
	 $editarEventos = new EventosControllers();
	 $editarEventos -> editarClientesController();
	 $editarEventos -> actualizarClientesController();//si hay algun error al editar muesta el error
 ?>
	

</form>
