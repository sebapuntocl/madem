<?php 

#EXTENCION DE CLASE: Los objetos puden ser extendidos y pueden hereadar propiedades y metodo. Para definier una clase como extencion, debo definir una clase padre, y se utiliza dentro de una clase hija.
#

require_once "conexion.php";

class Eventos extends Conexion{
	
	#REGISTRO DE Eventos
	#-------------------------------------
	public function registroEventosModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_us, cliente, nombre , fecha, hora, lugar, ruta , descripcion) VALUES (:id_us,:cliente,:nombre,:fecha, :hora, :lugar, :ruta, :descripcion)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":id_us", $datosModel["id_us"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datosModel["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datosModel["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

// 	#VISUALIZAR Eventos  
// 	#------------------------------------------------------
	public function vistaEventosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
		//$stmt = Conexion::conectar()->prepare("SELECT * FROM $table LEFT JOIN Eventos ON usuarios.id_us = Eventos.id_cli");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}	


// 	#EDITAR USUARIO
// 	#-------------------------------------

// 	public function editarEventosModel($datosModel, $tabla){

// 		$stmt = Conexion::conectar()->prepare("SELECT id_cli, nombre, email, fono, fono2, direccion, descripcion FROM $tabla WHERE id_cli = :id_cli");
// 		$stmt->bindParam(":id_cli", $datosModel, PDO::PARAM_INT);	
// 		$stmt->execute();

// 		return $stmt->fetch();

// 		$stmt->close();

// 	}

// #ACTUALIZAR USUARIO
// 	#-------------------------------------

// 	public function actualizarEventosModel($datosModel, $tabla){

// 		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, fono = :fono, fono2 = :fono2, direccion = :direccion, descripcion = :descripcion WHERE id_cli = :id_cli");

// 		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
// 		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
// 		$stmt->bindParam(":fono", $datosModel["fono"], PDO::PARAM_STR);
// 		$stmt->bindParam(":fono2", $datosModel["fono2"], PDO::PARAM_STR);
// 		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
// 		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
// 		$stmt->bindParam(":id_cli", $datosModel["id_cli"], PDO::PARAM_INT);

// 		if($stmt->execute()){

// 			return "success";

// 		}

// 		else{

// 			return "error";

// 		}

// 		$stmt->close();

// 	}


// 	#BORRAR USUARIO
// 	#------------------------------------
// 	public function borrarEventosModel($datosModel, $tabla){

// 		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cli = :id_cli");
// 		$stmt->bindParam(":id_cli", $datosModel, PDO::PARAM_INT);

// 		if($stmt->execute()){

// 			return "success";

// 		}

// 		else{

// 			return "error";

// 		}

// 		$stmt->close();

// 	}




}



