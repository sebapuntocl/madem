<?php 

	class Conexion{

		public function conectar(){
			$link = new PDO("mysql:host=localhost;dbname=madem","root","");
			return $link;
		}
	}

 ?>