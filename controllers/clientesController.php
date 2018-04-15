<?php

class ClientesControllers{

	

#REGISTRAR CLIENTES
	#------------------------------------
	public function registroClientesController(){

		if(isset($_POST["nombre"])){

			$datosController = array( "id_us"=>$_POST["id_us"],
									  "nombre"=>$_POST["nombre"], 
								      "email"=>$_POST["email"],
								      "fono"=>$_POST["fono"],
								      "fono2"=>$_POST["fono2"],
								      "direccion"=>$_POST["direccion"],
								      "descripcion"=>$_POST["descripcion"]);

			$respuesta = Clientes::registroClientesModel($datosController, "clientes");

			if($respuesta == "success"){

				echo '  
				<script>
					swal("Buen Trabajo!", "Un nuevo cliente esta registrado!", "success");
				</script>

				';
				header("location:clientes");

			}

			else{

				header("location:clientes.php");
			}

		}

	}


	#VISTA DE CLIENTES
	#------------------------------------
	public function vistaClientesController(){
		$respuesta = Clientes::vistaClientesModel("clientes"); //la tabla usuarios

	#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["fono"].'</td>
				<td>
<a href="index.php?action=clienteEditar&id='.$item["id_cli"].'"><button class="btn btn-info" ><i class="fas fa-eye"></i> / <i class="fas fa-edit"></i></button></a>
<a href="index.php?action=clientes&idBorrar='.$item["id_cli"].'"><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
				
			</tr>';

		}

	}

           

#EDITAR CLIENTES
#muesta lso datos en el form
	#------------------------------------

	public function editarClientesController(){

		$datosController = $_GET["id"];
		$respuesta = Clientes::editarClientesModel($datosController, "clientes");

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
	public function actualizarClientesController(){

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
	public function borrarClientesController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Clientes::borrarClientesModel($datosController, "clientes");

			if($respuesta == "success"){

				echo '
				<script language = javascript>

				swal({
						  title: "Estas seguro de Eliminar?",
						  text: "Si eliminas al cliente aun se mostrara la inforacion de los eventos relacionad",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    swal("Poof! Your imaginary file has been deleted!", {
						      icon: "success",
						    });
						  } else {
						    swal("Your imaginary file is safe!");
						  }
						});



	
	self.location = "index.php?action=clientes"
	</script>';
			
			}

		}

	}


}
