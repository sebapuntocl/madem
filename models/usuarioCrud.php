<?php 

#EXTENCION DE CLASE: Los objetos puden ser extendidos y pueden hereadar propiedades y metodo. Para definier una clase como extencion, debo definir una clase padre, y se utiliza dentro de una clase hija.
#

require_once "conexion.php";

class Datos extends Conexion{
	
	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroUsuarioModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email) VALUES (:usuario,:password,:email)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}
/*
	#INGRESO USUARIO
	#-------------------------------------
	public function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_us, usuario, password FROM $tabla WHERE usuario = :usuario");	
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

	}
*/
	#INGRESO USUARIO
	#-------------------------------------
	/*public function vistaUsuariosModel( $tabla){

			$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}
		*/

	#EDITAR USUARIO
	#-------------------------------------

	public function editarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_us = :id_us");
		$stmt->bindParam(":id_us", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

#ACTUALIZAR USUARIO
	#-------------------------------------

	public function  actualizarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario,/* password = :password,*/ nombre = :nombre, email = :email, fono = :fono, fono2 = :fono2 , direccion = :direccion , pais = :pais , ciudad = :ciudad,  comuna = :comuna , codPosta = :codPosta, facebook = :facebook , instagram = :instagram, twitter = :twitter, categoria = :categoria, tags = :tags, descripcion = :descripcion, photo = :photo  WHERE id_us = :id_us");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		//$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":fono", $datosModel["fono"], PDO::PARAM_STR);
		$stmt->bindParam(":fono2", $datosModel["fono2"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datosModel["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":comuna", $datosModel["comuna"], PDO::PARAM_STR);
		$stmt->bindParam(":codPosta", $datosModel["codPosta"], PDO::PARAM_STR);
		$stmt->bindParam(":facebook", $datosModel["facebook"], PDO::PARAM_STR);
		$stmt->bindParam(":instagram", $datosModel["instagram"], PDO::PARAM_STR);
		$stmt->bindParam(":twitter", $datosModel["twitter"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tags", $datosModel["tags"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR); 
		$stmt->bindParam(":id_us", $datosModel["id_us"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

// #GUARDAR PERFIL
// 	#------------------------------------------------------------
// 	public function guardarPerfilController(){

// 		$ruta = "";

// 		if(isset($_POST["nuevoUsuario"])){	

// 			if(isset($_FILES["nuevaImagen"]["tmp_name"])){

// 				$imagen = $_FILES["nuevaImagen"]["tmp_name"];

// 				$aleatorio = mt_rand(100, 999);

// 				$ruta = "views/images/perfiles/perfil".$aleatorio.".jpg";

// 				$origen = imagecreatefromjpeg($imagen);

// 				$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>100, "height"=>100]);

// 				imagejpeg($destino, $ruta);

// 			}

// 			if($ruta == ""){

// 				$ruta = "views/images/photo.jpg";	

// 			}

// 			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])&&
// 			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
// 			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])){

// 				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

// 				$datosController = array("usuario"=>$_POST["nuevoUsuario"],
// 										 "password"=>$encriptar,
// 										 "email"=>$_POST["nuevoEmail"],
// 										 "rol"=>$_POST["nuevoRol"],
// 										 "photo"=> $ruta);

// 				$respuesta = GestorPerfilesModel::guardarPerfilModel($datosController, "usuarios");

// 				if($respuesta == "ok"){

// 					echo'<script>

// 						swal({
// 							  title: "¡OK!",
// 							  text: "¡El usuario ha sido creado correctamente!",
// 							  type: "success",
// 							  confirmButtonText: "Cerrar",
// 							  closeOnConfirm: false
// 						},

// 						function(isConfirm){
// 								 if (isConfirm) {	   
// 								    window.location = "perfil";
// 								  } 
// 						});


// 					</script>';

// 				}

// 			}

// 			else{

// 				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
// 			}

// 		}

// 	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}




}


?>
