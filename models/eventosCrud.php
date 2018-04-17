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


	#EDITAR USUARIO
	#-------------------------------------

	public function editarEventosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_even = :id_even");
		$stmt->bindParam(":id_even", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

#ACTUALIZAREVENTO
	#-------------------------------------

	public function actualizarEventosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cliente = :cliente, nombre = :nombre, fecha = :fecha, hora = :hora, lugar = :lugar, descripcion = :descripcion, ruta = :ruta  WHERE id_even = :id_even");

		$stmt->bindParam(":cliente", $datosModel["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datosModel["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_even", $datosModel["id_even"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}



// 	#BORRAR USUARIO
// 	#------------------------------------
	public function borrarEventosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_even = :id_even");
		$stmt->bindParam(":id_even", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}




}



