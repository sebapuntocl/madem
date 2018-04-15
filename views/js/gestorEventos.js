/*=============================================
Subir Imagen a través del Input         
=============================================*/
$("#subirFoto").change(function(){

	imagen = this.files[0];

	//Validar tamaño de la imagen

	imagenSize = imagen.size;

	if(Number(imagenSize) > 2000000){

		$("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 200kb</div>')

	}

	else{

		$(".alerta").remove();

	}

	// Validar tipo de la imagen

	imagenType = imagen.type;

	if(imagenType == "image/jpeg" || imagenType == "image/png"){

		$(".alerta").remove();
	}

	else{

		$("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>')

	}