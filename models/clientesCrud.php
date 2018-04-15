<?php 

#EXTENCION DE CLASE: Los objetos puden ser extendidos y pueden hereadar propiedades y metodo. Para definier una clase como extencion, debo definir una clase padre, y se utiliza dentro de una clase hija.
#

require_once "conexion.php";

class Clientes extends Conexion{
	
	#REGISTRO DE CLIENTES
	#-------------------------------------
	public function registroClientesModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_cli, nombre, email, fono, fono2, direccion, descripcion) VALUES (:id_cli,:nombre,:email,:fono, :fono2, :direccion, :descripcion)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":id_cli", $datosModel["id_cli"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":fono", $datosModel["fono"], PDO::PARAM_STR);
		$stmt->bindParam(":fono2", $datosModel["fono2"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#VISUALIZAR CLIENTES  
	#------------------------------------------------------
	public function vistaClientesModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
		//$stmt = Conexion::conectar()->prepare("SELECT * FROM $table LEFT JOIN clientes ON usuarios.id_us = clientes.id_cli");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}	


	#EDITAR USUARIO
	#-------------------------------------

	public function editarClientesModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_cli, nombre, email, fono, fono2, direccion, descripcion FROM $tabla WHERE id_cli = :id_cli");
		$stmt->bindParam(":id_cli", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarClientesModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, fono = :fono, fono2 = :fono2, direccion = :direccion, descripcion = :descripcion WHERE id_cli = :id_cli");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":fono", $datosModel["fono"], PDO::PARAM_STR);
		$stmt->bindParam(":fono2", $datosModel["fono2"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cli", $datosModel["id_cli"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	#BORRAR USUARIO
	#------------------------------------
	public function borrarClientesModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cli = :id_cli");
		$stmt->bindParam(":id_cli", $datosModel, PDO::PARAM_INT);

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
