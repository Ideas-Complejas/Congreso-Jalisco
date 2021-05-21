<!--Vista para confirmar al usuario que su comentario ha sido enviado-->
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
						<?php 
							echo "<b>Hola</b>";
						?>

						
						<br><br>Hay un nuevo mensaje del buzón</a>.<br>

						

						<div style="text-align: left; margin-top: 1em">
							
							<span  style="font-weight: 500!important;"><b>Mensaje: </b>{{$body}}</span>
							
						</div>

					</div>


				</div>
				<div class="col-md-10" style="height: 10rem" >
					
					<div class="portada"  style="background-image: url('{{asset('imagenes_random/12.jpg')}}';background-size: cover; background-position: center 30%; height: 100%!important">
					</div>
				</div>
				<div class="col-md-10" style="background: white; padding: 3rem">
					 
					<div style="font-size: 1.0rem;"><img src="{{asset('img/icon/question.png')}}" style="width: 1.3rem" alt="icono ayuda" /><a href="{{ url('/FAQ') }}" style="color: #0A7DD9; text-decoration: none;">¿Necesitas ayuda?</a></div>
					
				</div>
				<div class="col-md-10" style="padding: 3rem; width: 100%">
					 
					<div style="font-size: 1.0rem; width: 48%; display: inline-block;"><img src="{{asset('img/logo.png')}}" width="35%" alt="logo Ayuntamiento" /></div>
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

