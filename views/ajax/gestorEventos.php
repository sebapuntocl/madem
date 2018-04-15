<?php

require_once "../../controllers/gestorEventos.php";
require_once "../../models/eventosCrud.php";


#CLASE Y MÉTODOS
#-------------------------------------------------------------
class Ajax{

	#SUBIR LA IMAGEN DEL ARTICULO
	#----------------------------------------------------------
	
	public $imagenTemporal;

	public function EventosControllers(){

		$datos = $this->imagenTemporal;

		$respuesta = GestorArticulos::mostrarImagenController($datos);

		echo $respuesta;

	}



#OBJETOS
#-----------------------------------------------------------

if(isset($_FILES["imagen"]["tmp_name"])){

	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> EventosControllers();

}
