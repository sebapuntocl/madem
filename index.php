<?php

require_once "models/enlaces.php";
 require_once "models/ingreso.php";

require_once "controllers/ingreso.php";
require_once "controllers/template.php";
require_once "controllers/enlaces.php";


require_once "models/usuarioCrud.php";
require_once "models/clientesCrud.php";
require_once "models/eventosCrud.php";

require_once "controllers/usuarioController.php";
require_once "controllers/clientesController.php";
require_once "controllers/eventosController.php";


$template = new TemplateController();
$template -> template();