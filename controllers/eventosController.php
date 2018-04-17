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

	public function editarEventosController(){

		$datosController = $_GET["id"];
		$respuesta = Eventos::editarEventosModel($datosController, "eventos");

		echo'
<div id="lagregarClientes">
	<div class="panel panel-default">
		<div class="panel-heading">
			
			<form name="ActualizaEventos"  action="" method="post" enctype="multipart/form-data">
				<input type="hidden" value="'.$respuesta["id_even"].'" name="id_even">
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Cliente *</label>
							<input type="text" class="form-control" name="cliente" id="cliente" value="'.$respuesta["cliente"].'" required >
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Nombre del Evento*</label>
							<input type="text" class="form-control" name="nombre" id="nombre" value="'.$respuesta["nombre"].'" required >
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Fecha *</label>
							<input type="date" class="form-control" name="fecha" id="fecha" value="'.$respuesta["fecha"].'" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Hora*</label>
							<input type="time" class="form-control" name="hora" id="hora" value="'.$respuesta["hora"].'" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Lugar</label>
							<input type="text" class="form-control" name="lugar" id="lugar" value="'.$respuesta["lugar"].'">
						</div>
					</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Banner del Evento</label>
								<input type="file" class="btn btn-default" name="editarImagen" style=" margin:10px 0">
							</div>
						</div>
						
						
						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Descripcion </label>
								<textarea  rows="5" class="form-control" name="descripcion" id="descripcion">'.$respuesta["descripcion"].'</textarea>
								<input type="hidden" value="'.$respuesta["ruta"].'" name="editarPhoto">
							</div>
						</div>
					</div>
					<input type="submit" class="btn btn-info btn-fill pull-right" id="guarEvent"  value="Actualizar">
					<div class="clearfix"></div>
				</form>
			</div>

			</<div>
				
			</div>
			<!--<img src="'.$respuesta["ruta"].'" width="100%" style="margin-bottom:20px">-->
';

	}
#ACTUALIZAR CLIENTES
#cambiar los datos del editar en la bd
	#------------------------------------
public function actualizarEventosController(){

		if(isset($_POST["nombre"])){

			if(isset($_FILES["editarImagen"]["tmp_name"])){

                $imagen = $_FILES["editarImagen"]["tmp_name"];

                $aleatorio = mt_rand(100, 999);

                $ruta = "views/images/perfiles/perfil".$aleatorio.".jpg";

                $origen = imagecreatefromjpeg($imagen);

                $destino = $origen; //imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

                imagejpeg($destino, $ruta);

            }

            if($ruta == ""){

                $ruta = $_POST["editarPhoto"];
            }

            if($ruta != "" && $_POST["editarPhoto"] != "views/images/photo.jpg"){

                 unlink($_POST["editarPhoto"]);
            
            }


			$datosController = array( "id_even"=>$_POST["id_even"],
									  "cliente"=>$_POST["cliente"],
									  "nombre"=>$_POST["nombre"],
				                      "fecha"=>$_POST["fecha"],
							          "hora"=>$_POST["hora"],
				                      "lugar"=>$_POST["lugar"],
				                      "ruta"=>$ruta,
				                      "descripcion"=>$_POST["descripcion"]);
			
			$respuesta = Eventos::actualizarEventosModel($datosController, "eventos");

			if($respuesta == "success"){

				echo '<script>

                        swal({
                              title: "¡OK!",
                              text: "¡El usuario ha sido editado correctamente!",
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

				echo "error";

			}

		}
	
	}


	#BORRAR EVENTOS
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
