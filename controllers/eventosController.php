<?php

class EventosControllers{

	#GUARDAR EVENTOS
	#-----------------------------------------------------------

	public function registroEventosController(){

		if(isset($_POST["cliente"])){

			$imagen = $_FILES["imagen"]["tmp_name"];

			$borrar = glob("views/images/eventos/temp/*");

			foreach($borrar as $file){

				unlink($file);

			}

			$aleatorio = mt_rand(100, 999);

			$ruta = "views/images/eventos/banner".$aleatorio.".jpg";

			$origen = imagecreatefromjpeg($imagen);

		    $destino = $origen; //imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

			imagejpeg($destino, $ruta);

			$datosController = array("id_us"=>$_POST["id_us"],
									  "cliente"=>$_POST["cliente"], 
								      "nombre"=>$_POST["nomEvento"],
								      "fecha"=>$_POST["fecha"],
								      "hora"=>$_POST["hora"],
								      "lugar"=>$_POST["lugar"],
								      "ruta"=>$ruta,
								      "descripcion"=>$_POST["descripcion"]);

			$respuesta = Eventos::registroEventosModel($datosController, "eventos");

			if($respuesta == "success"){

				echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo ha sido creado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "eventos";
							  } 
					});


				</script>';

			}

			else{

				echo $respuesta;

			}

		}

	}



	#VISTA DE CLIENTES
	#------------------------------------
	public function vistaEventosController(){
		$respuesta = Eventos::vistaEventosModel("eventos"); //la tabla usuarios

	#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["cliente"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>    
				<a href="#articulo'.$item["id_even"].'"  data-toggle="modal"><button class="btn btn-success"><i class="fas fa-eye"></i></button></a>
				<a href="index.php?action=eventosEditar&id='.$item["id_even"].'"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
				<a href="index.php?action=eventos&idBorrar='.$item["id_even"].'"><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
				
			</tr>


					<div id="articulo'.$item["id_even"].'" class="modal fade">
						<div class="modal-dialog modal-eventos modal-content">
							<div class="modal-header" style="border:1px solid #eee">
								
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title" style="text-align: center;"><b>'.$item["nombre"].'</b></h3>
								
							</div>
							<div class="modal-body" style="border:1px solid #eee">
								<img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
								
								<div class="row">
									<div class="col-xs-6 col-md-6 form-group">
										<label>Fecha</label>
										<input class="form-control" type="text" value="'.$item["fecha"].'" />
									</div>
									<div class="col-xs-6 col-md-6 form-group">
										<label>Hora</label>
										<input class="form-control" type="text" value="'.$item["hora"].'" />
									</div>
									<div class="col-xs-12 col-md-12 form-group">
										<label>Lugar</label>
										<input class="form-control" type="text" value="'.$item["lugar"].'" />
									</div>
								</div>
								<label>Descripcion</label>
								<textarea class="form-control" rows="5">'.$item["descripcion"].'</textarea>
							</p>
							
						</div>
						<div class="modal-footer" style="border:1px solid #eee">
							
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							
						</div>
					</div>
					</div>

				';

		}

	}

           

#EDITAR CLIENTES
#muesta lso datos en el form
	#------------------------------------

	public function editarClientesController(){

		$datosController = $_GET["id"];
		$respuesta = Clientes::editarEventosModel($datosController, "eventos");

		echo'
			<div id="agregarClientes">
				<div class="panel panel-default">
					<div class="panel-heading">
						
						<form name="ActualizaClientes"  action="" method="post">
						
						<input type="hidden" name="id_cli" value="'.$respuesta["id_cli"].'">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Nombre *</label>
										<input type="text" class="form-control" name="nombre" id="nombre" value="'.$respuesta["nombre"].'" required >
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label>Email *</label>
										<input type="email" class="form-control" name="email" id="email" value="'.$respuesta["email"].'" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Fono Principa *</label>
										<input type="number" class="form-control" name="fono" id="fono" value="'.$respuesta["fono"].'" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Fono Segundario</label>
										<input type="number" class="form-control" name="fono2" id="fono2" value="'.$respuesta["fono2"].'">
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label>Direccion</label>
										<input type="text" class="form-control" name="direccion" id="direccion" value="'.$respuesta["direccion"].'">
									</div>
								</div>
								
								
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Descripcion </label>
										<textarea  rows="5" class="form-control" name="descripcion" id="descripcion">'.$respuesta["descripcion"].'</textarea>
									</div>
								</div>
							</div>
							<input type="submit" class="btn btn-info btn-fill pull-right" id="guarEvent"  value="Actualizar">
							<div class="clearfix"></div>
						</form>
					</div>
					</<div>
						
					</div>
';

	}
#ACTUALIZAR CLIENTES
#cambiar los datos del editar en la bd
	#------------------------------------
	public function actualizarEventosController(){

		if(isset($_POST["nombre"])){

			$datosController = array( "id_cli"=>$_POST["id_cli"],
									  "nombre"=>$_POST["nombre"],
							          "email"=>$_POST["email"],
				                      "fono"=>$_POST["fono"],
				                      "fono2"=>$_POST["fono2"],
				                      "direccion"=>$_POST["direccion"],
				                      "descripcion"=>$_POST["descripcion"]);
			
			$respuesta = Clientes::actualizarClientesModel($datosController, "clientes");

			if($respuesta == "success"){

				echo '<script language = javascript>
	alert("Cambio Correcta.")
	self.location = "index.php?action=clientes"
	</script>';

			}

			else{

				echo "error";

			}

		}
	
	}


	#BORRAR CLIENTES
	// #------------------------------------
	public function borrarEventosController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Eventos::borrarEventosModel($datosController, "eventos");

			if($respuesta == "success"){

echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo se ha borrado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "eventos";
							  } 
					});


				</script>'; 
			
			}

		}

	}

		#IMPRESIÓN SUSCRIPTORES
	#------------------------------------------------------------

	public function impresionEventosController($datos){

		$datosController = $datos;

		$respuesta = Eventos::vistaEventosModel($datosController);
	
		return $respuesta;

	}


}
