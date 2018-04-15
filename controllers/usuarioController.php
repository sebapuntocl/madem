<?php

class MvcController{

#REGISTRO DE USUARIOS
	#------------------------------------
	// public function registroUsuarioController(){

	// 	if(isset($_POST["usuarioRegistro"])){

	// 		$datosController = array( "usuario"=>$_POST["usuarioRegistro"], 
	// 							      "password"=>$_POST["passwordRegistro"],
	// 							      "email"=>$_POST["emailRegistro"]);

	// 		$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

	// 		if($respuesta == "success"){

	// 			header("location:index.php?action=ok");

	// 		}

	// 		else{

	// 			header("location:index.php");
	// 		}

	// 	}

	// }

 

#EDITAR USUARIO
#muesta lso datos en el form
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_SESSION["id_us"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'  
            <div class="content">
                <div class="container-fluid">
                    <div class="row info-usuario">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Mis Datos Personales</h4>
                                </div>
                                <div class="content">
                                    <form name="actulizarUsuario" method="post" enctype="multipart/form-data">
                                     <input name="actualizarSesion" type="hidden" value="ok">
                                     <input name="id_us" type="hidden" value="'.$respuesta["id_us"].'">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Usuario Numero</label>
                                                    <input type="text" class="form-control" name="user_usuario"  placeholder="usuario" value="'.$respuesta["usuario"].'" >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Nombre *</label>
                                                    <input type="text" class="form-control" name="user_nombre" placeholder="Tu Nombre" value="'.$respuesta["nombre"].'">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email *</label>
                                                    <input type="email" class="form-control" name="user_email" placeholder="Email" value="'.$respuesta["email"].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fono *</label>
                                                    <input type="text" class="form-control" name="user_fono" placeholder="Fijo o Celular" value="'.$respuesta["fono"].'">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fono 2</label>
                                                    <input type="text" class="form-control" name="user_fono2" placeholder="Fijo o Celular" value="'.$respuesta["fono2"].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Direccion *</label>
                                                    <input type="text" class="form-control" name="user_direccion" placeholder="Donde esta ubicado" value="'.$respuesta["direccion"].'" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Pais </label>
                                                    <input type="text" class="form-control" name="user_pais" placeholder="pais" value="'.$respuesta["pais"].'" >
                                                    <!--         <div class="bfh-selectbox bfh-countries" name="user_pais" data-country="CL" data-flags="true"></div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Ciudad *</label>
                                                    <input type="text" class="form-control" name="user_ciudad" placeholder="ciudad" value="'.$respuesta["ciudad"].'" >
                                                    <!--                  <select class="form-control" id="regiones" name="user_ciudad" id="cli_ciudad" name="cli_ciudad" required></select> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comuna</label>
                                                    <input type="text" class="form-control" name="user_comuna" placeholder="comuna" value="'.$respuesta["comuna"].'" >
                                                    <!--             <select class="form-control" id="comunas" name="user_comuna" id="cli_comuna" name="cli_comuna"></select> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cod. Postal</label>
                                                    <input type="number" class="form-control" name="user_cPostal" value="'.$respuesta["codPosta"].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control" name="user_facebook" placeholder="Link del Perfil"  value="'.$respuesta["facebook"].'">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Instagram</label>
                                                    <input type="text" class="form-control" name="user_instagram" placeholder="Link del Perfil"  value="'.$respuesta["instagram"].'">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Twiter</label>
                                                    <input type="text" class="form-control" name="user_twitter" placeholder="Link del Perfil"  value="'.$respuesta["twitter"].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Categoria </label>
                                                    <select class="form-control" name="user_categoria">
                                                        <option>'.$respuesta["categoria"].'</option>
                                                        <option>Animador</option>
                                                        <option>Locutor</option>
                                                        <option>Productor</option>
                                                        <option>Maestro de Ceremonias</option>
                                                        <option>Iluminador</option>
                                                        <option>Fotografo</option>
                                                        <option>Editor de Videos</option>
                                                        <option>Arriedo Local</option>
                                                        <option>Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Sub Categorias</label>
                                                <div class="from-group">
                                                    <select class="form-control" name="user_tags">
                                                        <option>'.$respuesta["tags"].'</option>
                                                        <option>Animador</option>
                                                        <option>Locutor</option>
                                                        <option>Productor</option>
                                                        <option>Maestro de Ceremonias</option>
                                                        <option>Iluminador</option>
                                                        <option>Fotografo</option>
                                                        <option>Editor de Videos</option>
                                                        <option>Arriedo Local</option>
                                                        <option>Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Biografia *</label>
                                                    <textarea rows="5" class="form-control" name="user_descripcion" placeholder="Escribe tu descripcion, la podran ver todos los usuarios" >'.$respuesta["descripcion"].'</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-user">
                                    <div class="image">
                                        
                                    </div>
                                    <div class="content">
                                        <div class="author">
                                            <a href="#">
                                                <img class="avatar border-gray" src="'. $respuesta["photo"].'" >
                                                <input type="hidden" value="'.$respuesta["photo"].'" name="editarPhoto">


                                                <h4 class="title">'.$respuesta["nombre"].'<br />
                                                <small>'.$respuesta["usuario"].'</small>
                                                </h4>
                                            </a>
                                        </div>
                                        <p class="description text-center">

                                            <input type="file" class="btn btn-default" name="editarImagen" style=" margin:10px 0"></br>

                                            
                                            <a href="" data-toggle="modal">wdwdwd<a></br>
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#clave'.$respuesta["id_us"].'">Open Modal</button>

                                            <input type="text" value="'.$respuesta["password"].'" name="nuevoPassword">

                                            <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">


                                        </p>
                                    </div>
                                </form>
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- Modal -->

  <!-- Modal -->
  <div class="modal fade" id="clave'.$respuesta["id_us"].'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


                ';




	

	}

#ACTUALIZAR USUARIO
#cambiar los datos del editar en la bd
	#------------------------------------
	public function actualizarUsuarioController(){

		 $ruta = "";

        if(isset($_POST["user_nombre"])){  

            if(isset($_FILES["editarImagen"]["tmp_name"])){

                $imagen = $_FILES["editarImagen"]["tmp_name"];

                $aleatorio = mt_rand(100, 999);

                $ruta = "views/images/perfiles/perfil".$aleatorio.".jpg";

                $origen = imagecreatefromjpeg($imagen);

                $destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>100, "height"=>100]);

                imagejpeg($destino, $ruta);

            }

            if($ruta == ""){

                $ruta = $_POST["editarPhoto"];
            }

            if($ruta != "" && $_POST["editarPhoto"] != "views/images/photo.jpg"){

                 unlink($_POST["editarPhoto"]);
            
            }

             if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["user_usuario"])&&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["user_email"])){

                 $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

               $datosController = array("id_us"=>$_SESSION["id_us"],
                                         "usuario"=>$_POST["user_usuario"],
                                         "nombre"=>$_POST["user_nombre"],
                                         "password"=>$encriptar,
                                         "email"=>$_POST["user_email"],
                                         "fono"=>$_POST["user_fono"],
                                         "fono2"=>$_POST["user_fono2"],
                                         "direccion"=>$_POST["user_direccion"],
                                         "pais"=>$_POST["user_pais"],
                                         "ciudad"=>$_POST["user_ciudad"],
                                         "comuna"=>$_POST["user_comuna"],
                                         "codPosta"=>$_POST["user_cPostal"],
                                         "facebook"=>$_POST["user_facebook"],
                                         "instagram"=>$_POST["user_instagram"],
                                         "twitter"=>$_POST["user_twitter"],
                                         "categoria"=>$_POST["user_categoria"],
                                         "tags"=>$_POST["user_tags"],
                                         "descripcion"=>$_POST["user_descripcion"],
                                         "photo"=> $ruta
                                         );

                $respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");


                if(isset($_POST["actualizarSesion"])){

                        $_SESSION["id_us"] = $_SESSION["id_us"];
                        $_SESSION["usuario"] = $_POST["user_usuario"];
                        $_SESSION["nombre"] = $_POST["user_nombre"];
                        $_SESSION["password"] = $encriptar;
                        $_SESSION["photo"] = $ruta;
                        //$_SESSION["rol"] = $_POST["editarRol"];

                    }

                if($respuesta == "success"){

                    echo'<script>

                        swal({
                              title: "¡OK!",
                              text: "¡El usuario ha sido creado correctamente!",
                              type: "success",
                              confirmButtonText: "Cerrar",
                              closeOnConfirm: false
                        },

                        function(isConfirm){
                                 if (isConfirm) {      
                                    window.location = "perfil";
                                  } 
                        });


                    </script>';

                }

            }

            else{

                echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
            }

        }

    }

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				echo '<script language = javascript>
	alert("Eliminacion Correcta.")
	self.location = "index.php?action=usuarios"
	</script>';
			
			}

		}

	}


}

