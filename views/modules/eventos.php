<?php 
	session_start();
	if (!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		exit();
	}
 
include "views/modules/botonera.php";
include "views/modules/cabezote.php";
?>

<div id="seccionClientes" class="col-md-12">
    
    <button id="btnAgregarClientes" class="btn btn-info btn-lg">Agregar Evento</button>

    <!--==== AGREGAR ARTÍCULO  ====-->

    <div id="agregarClientes" style="displfay:none">
      <div class="panel panel-default">
                        <div class="panel-heading">  
        
        			<form name="registroClientes"  method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id_us" id="id_us" value="<?php echo $_SESSION["id_us"];?>"  >
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre Clente *</label>
                                    <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre del Cliente"  >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre del Evento *</label>
                                    <input type="text" class="form-control" name="nomEvento" id="nomEvento" placeholder="Cual es el nombre del Evento" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Cual es el dia del evento" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>hora </label>
                                    <input type="number" class="form-control" name="hora" id="hora" placeholder="A que hora es?" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Lugar</label>
                                    <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Donde va a ser?">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Imagen Banner </label>
                                    <input type="file" class="btn btn-default" name="banner" id="banner">
                                </div>
                            </div>
                            
                                                        
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripcion </label>
                                    <textarea  rows="5" class="form-control" name="descripcion" id="descripcion"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info btn-fill pull-right" id="guarEvent"  value="Guardar">
                        <div class="clearfix"></div>
                    </form>

    </div>

    <?php

$registroEventos = new EventosControllers();
$registroEventos -> registroEventosController();


?>
</div>
</div>
    
    <hr>

<!-- Advanced Tables -->
<div class="panel panel-default">
    <div class="panel-heading">Tabla de Eventos</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $vistaClientes = new EventosControllers();
                        $vistaClientes -> vistaEventosController();
// $vistaClientes -> borrarEventosController();
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<!--End Advanced Tables -->