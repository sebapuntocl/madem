<?php

require_once "../../controllers/eventosController.php";
require_once "../../models/eventosCrud.php";

class ImpresionEventos{

public function impresionEventos(){

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();

$html1 = <<<EOF
	
	<table>
		<tr>
			<td style="width:50px"><img src="images/logo.png"></td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td style="width:140px"><img src="images/logo.png"></td>
			<td width="200px"></td>
		</tr>
	</table>

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Cliente</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Nombre</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Fecha</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Hora</td>

		</tr>
	</table>

EOF;

$pdf->writeHTML($html1, false, false, false, false, ''); 

$respuesta = EventosControllers::impresionEventosController("eventos");

foreach ($respuesta as $row => $item) {

$html2 = <<<EOF

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666;">$item[cliente]</td>
			<td style="border: 1px solid #666;">$item[nombre]</td>
			<td style="border: 1px solid #666;">$item[fecha]</td>
			<td style="border: 1px solid #666;">$item[hora]</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($html2, false, false, false, false, ''); 	

}

$pdf->Output('eventos.pdf');

}

}

$a = new ImpresionEventos();
$a -> impresionEventos();

?>
