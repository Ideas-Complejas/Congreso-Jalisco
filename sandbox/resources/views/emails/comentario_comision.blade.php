<!--Vista para confirmar a la comisión de que hay un nuevo comentario-->
<!DOCTYPE html>
<html lang="es" style="width: 100%!important">
	<head>
		<meta charset="utf-8">
		<style type="text/css">
			*{
				font-family: 'Roboto', sans-serif;
				font-size: 1.0rem;
				color: #233052;
			}
		</style>
	</head>
	<body style="width: 100%!important; background: #F8F9FA">
		<div class="container" style="width: 60%;margin: auto auto">
			<div class="row justify-content-center mt-5" style="text-align: left!important;">
				<div class="col-md-10" style="display: flex;align-items: center!important; padding:3rem 0rem ">
					<div class="col-md-6" style="display: inline-block; font-weight: bold; width: 100%; font-size: 1.5rem!important">
						Congreso Jalisco
					</div>
					
				</div>
				<div class="col-md-10" style="background: white;padding: 2rem 3rem">
					<div style="font-weight: bold;font-size: 1.2rem">Comentario en Iniciativa</div>
					<div style="font-size: 1.0rem">
						
						<br><br>Has recibido un nuevo comentario en el portal Gobierno Abierto Jalisco</a>.<br>

						

						<div style="text-align: left; margin-top: 1em">
							<label style="text-align: left!important"><span style='color:#0277B9; font-weight:bold; font-size: 1.2em'>FOLIO: COM{{$folio}}</span></label>
							<br>
							El comentario fue realizado en la iniciativa  
							
								<?php if($iniciativa->nombre_iniciativa != null && $iniciativa->nombre_iniciativa != ""){
									echo '<label style="text-align: left!important"><span style="color:#0277B9; font-weight:bold; font-size: 1.2em">'.$iniciativa->nombre_iniciativa.'</span></label>';
								}else{
									echo '<label style="text-align: left!important"><span style="color:#0277B9; font-weight:bold; font-size: 1.2em">Infolej: '.$iniciativa->Infolej.'<br>Id principal: '.$iniciativa->id_principal.'</span></label>';
								}
								?>
							
							.
							<span class="mb-4 mt-4 msg_bienv_login" style="font-weight: 500!important;color: darkslategray;margin-bottom: 1.5rem !important; margin-top: 1.5rem!important; text-align: left!important; display: block;">
							
								
								<?php 
									$fecha =date('d/m/Y H:i:s');
									
									echo '<span  style="font-weight: 500!important;"><b>Fecha y hora de solicitud: </b> '.$fecha.' hrs.</span>';
									
								?>
								<br><br>Haz clic en el siguiente link para poder aprobar el comentario

							</span>
						</div>

					</div>

					<div style="font-size: 1.0rem;margin-top: 1rem; text-align: center; ">
						
						<button style="line-height: 1.5;border-radius: 0.25rem;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;padding: 0.375rem 0.75rem;color: #007bff;text-decoration: none;background-color: transparent;background-color: #609BBF !important;color: white !important;font-size: 1.0rem !important;border-radius: 2px !important;"><a href="{{ url('/configuraciones') }}"  class="" style="color: #ffffff;text-decoration: none; font-size: 1.0rem">Ver comentario</a></button>
					</div>
					<div style="margin-top: 1rem; ">
						<span class="mb-4 mt-4 msg_bienv_login" style="color: darkslategray;margin-bottom: 1.5rem !important; margin-top: 1.5rem!important; text-align: center!important; display: block; font-size: 1.0rem!important">O puedes copiar/pegar este enlace en el navegador:<br>
							<span style="color: #609BBF;text-decoration: none;font-size: 1.0rem">{{ url('/configuraciones') }}</span>
						</span>

					</div>

				</div>
				<div class="col-md-10" style="height: 10rem" >
					
					<div class="portada"  style="background-image: url('https://jalisco.ideascomplejas.com/public_html/imagenes_random/12.jpg');background-size: cover; background-position: center 30%; height: 100%!important">
					</div>
				</div>
				<div class="col-md-10" style="background: white; padding: 3rem">
					 
					<div style="font-size: 1.0rem;"><img src="https://jalisco.ideascomplejas.com/public_html/img/icon/question.png" style="width: 1.3rem" alt="icono ayuda" /><a href="{{ url('/FAQ') }}" style="color: #0A7DD9; text-decoration: none;">¿Necesitas ayuda?</a></div>
					
				</div>
				<div class="col-md-10" style="padding: 3rem; width: 100%">
					 
					<div style="font-size: 1.0rem; width: 48%; display: inline-block;"><img src="https://jalisco.ideascomplejas.com/public_html/img/logo.png" width="35%" alt="logo Ayuntamiento" /></div>
					<div style="font-size: 1.0rem; width: 25%; display: inline-block;"><a href="" target="_blank" style="color: #FDC625; font-size: 1.0rem">Términos y condiciones</a></div>
					<div style="font-size: 1.0rem; width: 25%; display: inline-block;"><a href="" target="_blank" style="color: #FDC625; font-size: 1.0rem">Aviso de privacidad</a></div>
				</div>
				<div class="col-md-10" style="padding-bottom: 2rem ">
					 
					<div style="font-size: 1.0rem;">Congreso Jalisco</div>
					
				</div>
			</div>
		</div>
	</body>
</html>

