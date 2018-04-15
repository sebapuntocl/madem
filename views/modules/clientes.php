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
    
    <button id="btnAgregarClientes" class="btn btn-info btn-lg">Agregar Cliente</button>

    <!--==== AGREGAR ARTÍCULO  ====-->

    <div id="agregarClientes" style="display:none">
      <div class="panel panel-default">
                        <div class="panel-heading">  
        
        <form name="registroClientes"  action="" method="post">
                        <input type="hidden" class="form-control" name="id_us" id="id_us" value="<?php echo $_SESSION["id_us"];?>"  >
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre *</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Cliente" required >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Cual es su correo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fono Principa *</label>
                                    <input type="number" class="form-control" name="fono" id="fono" placeholder="Fijo o Celular" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fono Segundario</label>
                                    <input type="number" class="form-control" name="fono2" id="fono2" placeholder="Fijo o Celular">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Fijo o Celular">
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

$registro = new ClientesControllers();
$registro -> registroClientesController();


?>
</div>
</div>
    
    <hr>

<!-- Advanced Tables -->
<div class="panel panel-default">
    <div class="panel-heading">Tabla de Clientes</div>
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
                        $vistaClientes = new ClientesControllers();
                        $vistaClientes -> vistaClientesController();
                        $vistaClientes -> borrarClientesController();
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<!--End Advanced Tables -->

