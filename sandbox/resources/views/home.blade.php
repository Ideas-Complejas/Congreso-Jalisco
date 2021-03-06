@extends('app')

@section('content')
<!--contenido de la portada del home-->
<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/portada.png')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Congreso Jalisco Abierto</h1>
					<button type="button" class="button-video-tutorial" data-toggle="modal" data-target="#modal-video-tutorial">
						<span class="icon-play"></span>Ver vídeo tutorial
					</button>
					
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal comentar iniciativa  -->
<div class="modal fade modal-comentar" id="modal-comentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ml-3" id="exampleModalLabel">Envíanos tu comentario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--formulario que se usa para comentar una iniciativa-->
				<form class="form-comentar" id="form-comentar">
					{{ csrf_field() }}
					<div class="p-2">
						<input type="hidden" class="form-control comentarios" id="idi" name="idi">
						<input type="hidden" class="form-control comentarios" id="idp" name="idp">
						<div class="form-group">
							<label for="formGroupExampleInput">Nombre</label>
							<input type="text" class="form-control comentarios" id="usuario_nombre" name="usuario_nombre">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Correo electrónico</label>
							<input type="email" class="form-control comentarios" id="usuario_email" name="usuario_email"
								aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Comentario</label>
							<textarea class="form-control comentarios" id="usuario_comentario" name="usuario_comentario" rows="3"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Adjuntar</label>
							<input type="file" class="form-control-file comentarios" id="usuario_url_file" name="file">
						</div>
						<div class="mt-4">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input comentarios" type="checkbox" id="no_soy_robot" name="no_soy_robot" value="campos_obligatorios">
									<label class="form-check-label" for="no_soy_robot">
										He leído y acepto el Aviso de privacidad
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input comentarios" type="checkbox" id="aviso_privacidad" name="aviso_privacidad" value="campos_obligatorios">
									<label class="form-check-label" for="aviso_privacidad">
										No soy un robot
									</label>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-cancelar" data-dismiss="modal">CANCELAR</button>
				<button id="enviar_comentario" idi="" idp="" class="btn-comentar">ENVIAR COMENTARIO</button>
			</div>
		</div>
	</div>
</div>
 <!-- Modal video iniciativa -->
 <div class="modal fade" id="modal-video-tutorial" data-backdrop="static" data-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-video-tutorial">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/S5uX1IpFXGg" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Menu  -->

<section class="bg-color-light">
	<div class="container">
		<div class="menu--content">
			<div class="row">
				<div class="offset-md-1 col-lg-2 col-md-6 col-sm-6 mb-3" style="padding: 0.5em;">
					<div class="card content-card-menu">
						<div class="card-body" style="padding: 0.5em">
							<a target="_blank" href="{{route('comisiones')}}" style="text-decoration: none">
								<div>
									<div class="icon-menu--card">
										<img src="icons/group.svg" alt="">
									</div>
									<div class="title-menu--card">
										<h6>Lo que estamos discutiendo</h6>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 mb-3" style="padding: 0.5em;">
					<div class="card content-card-menu">
						<div class="card-body" style="padding: 0.5em">
							<a target="_blank" href="{{route('congreso')}}" style="text-decoration: none">
								<div class="icon-menu--card">
									<img src="icons/question.svg" alt="">
								</div>
								<div class="title-menu--card">
									<h6>¿Cómo funciona tu congreso?</h6>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 mb-3" style="padding: 0.5em;">
					<div class="card content-card-menu">
						<div class="card-body" style="padding: 0.5em">
							<a target="_blank" href="{{route('diputados')}}" style="text-decoration: none">
								<div class="icon-menu--card">
									<img src="icons/team.svg" alt="">
								</div>
								<div class="title-menu--card">
									<h6>Conoce a tus diputados</h6>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 mb-3" style="padding: 0.5em;">
					<div class="card content-card-menu">
						<div class="card-body" style="padding: 0.5em">
							<a target="_blank" href="https://congresoweb.congresojal.gob.mx/bibliotecavirtual/LeyesEstatales.cfm" style="text-decoration: none">
								<div class="icon-menu--card">
									<img src="icons/reading.svg" alt="">
								</div>
								<div class="title-menu--card">
									<h6>Legislación vigente</h6>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 mb-3" style="padding: 0.5em;">
					<div class="card content-card-menu">
						<div class="card-body" style="padding: 0.5em">
							<a target="_blank" href="{{url('/datos')}}" style="text-decoration: none">
								<div class="icon-menu--card">
									<img src="icons/research.svg" alt="">
								</div>
								<div class="title-menu--card">
									<h6>Datos abiertos</h6>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Que es congreso jalisco  -->
<Section class="bg-color-light">
	<div class="container congreso--container">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h3 class="title--congreso line-border-bottom">¿Qué es Congreso Jalisco Abierto?</h3>
				<div class="text--congreso text-justify">
					<p>Es una Plataforma digital creada para fomentar la participación ciudadana en el proceso de
						creación de leyes y donde podrás conocer todo el actuar del Poder Legislativo.</p>
					<p>Con ésta herramienta puedes conocer, consultar y opinar respecto de las iniciativas de Ley y de
						Decreto que son turnadas a las Comisiones Legislativas; y en donde también podrás consultar la
						legislación vigente en el Estado de Jalisco, conocer el proceso legislativo y saber quiénes son
						nuestros diputados.</p>
					<p>Puedes suscribirte a la Comisión Legislativa que sea de tu interés para que te lleguen avisos
						respecto de alguna iniciativa de ley o de decreto, además podrás visualizar las sesiones
						completas sin cortes del Pleno y sus Comisiones.</p>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="container-img--congreso">
					<div class="img img-bg" style="background-image: url('{{asset('img/portada.png')}}');"></div>
				</div>
			</div>
		</div>
	</div>
</Section>
<!-- Viñetas congreso  -->
<section>
	<div class="container seccion-viñetas--container">
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<a href="{{route('congreso')}}" target="_blank" style="text-decoration: none; cursor: pointer;">
						<div class="content--viñetas">
						<div class="icon-vinetas--container">
							<img src="icons/chat.svg" alt="">
						</div>
						<div>
							<h6 class="title--viñetas">Conoce</h6>
							<p class="text--viñetas">Cómo funciona el Congreso del Estado de Jalisco, y cuál es la
								terminología y los conceptos que se utilizan en la creación y modificación de las leyes.</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-12">
				<a href="{{route('comisiones')}}" target="_blank" style="text-decoration: none; cursor: pointer;">
					<div class="content--viñetas">
						<div class="icon-vinetas--container">
							<img src="icons/discussion.svg" alt="">
						</div>
						<div>
							<h6 class="title--viñetas">Participa</h6>
							<p class="text--viñetas">Aportando tus opiniones y propuestas a las iniciativas de ley que están
								en discusión, para que los diputados integrantes de las Comisiones y Órganos Técnicos
								enriquezcan las iniciativas.</p>
						</div>
					</div>
				</a>
				
			</div>
			<div class="col-md-4 col-sm-12">
				<a href="{{route('comisiones')}}" target="_blank" style="text-decoration: none; cursor: pointer;">
					<div class="content--viñetas">
						<div class="icon-vinetas--container">
							<img src="icons/expression.svg" alt="">
						</div>
						<div>
							<h6 class="title--viñetas">Opina</h6>
							<p class="text--viñetas">Construye tus ideas y aporta tu punto de vista para enriquecer nuestras
								leyes.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- Iniciativas -->
<section>
	<div class="container-seccion container--iniciativas">
		<div class="row">
			<div class="col-md-8">
				<h3 class="title--iniciativas line-border-bottom">Iniciativas</h3>
			</div>
			<div class="col-md-4 d-flex justify-content-end align-items-center">
				<a target="_blank" href="{{ route('comisiones') }}" class="btn-conocer-todas" tabindex="-1" role="button"
					aria-disabled="true">Conocer todas
					<i class="fas fa-chevron-right"></i></a>
			</div>
		</div>
		<?php if($iniciativas){ //Si existen las iniciativas
			$contador = 0;
			$contador_imagenes = 0;
			$cantidad_imagenes_aleatorias = count($imagenes_random);
			foreach ($iniciativas as $key => $value) { //Recorre cada iniciativa
				if($contador == 0){ //Esto se hace para definir una fila
					echo '<div class="row mb-3">';
				}?>
				<!--card de iniciativa-->
				<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
					<div class="card iniciativas-card--container">
						<?php
						
						if($value->url_imagen != null && $value->url_imagen != ""){ //Si la iniciativa no tiene imagen
							if(\File::exists(public_path()."/".$value->url_imagen)){ //Si existe la imagen, toma la imagen

								$url = str_replace(" ", "%20", asset($value->url_imagen));
								$array_imagenes_utilizadas[] = $url;
							}else{ //si no, busca una random
								$url = str_replace(" ", "%20", asset($imagenes_random[$contador_imagenes]["url_imagen"]));
								if($contador_imagenes == (count($imagenes_random)-1)){
									$contador_imagenes = 0;
									$orden_exito = shuffle($imagenes_random);
									while($orden_exito == false){
										$orden_exito = shuffle($imagenes_random);
									}
								}
								$contador_imagenes++;
							}
						}else{ //si no, busca una random
						
							$url = str_replace(" ", "%20", asset($imagenes_random[$contador_imagenes]["url_imagen"]));
							if($contador_imagenes == (count($imagenes_random)-1)){
								$contador_imagenes = 0;
								$orden_exito = shuffle($imagenes_random);
								while($orden_exito == false){
									$orden_exito = shuffle($imagenes_random);
								}
							}
							$contador_imagenes++;
						}?>

						<div class="img-card--inicitaivas img-bg" style="background-image: url('{{$url}}');">
						</div>
						<div class="card-body pb-1">
							<p class="fecha--iniciativa"><i class="far fa-calendar-alt"></i> 
							<?php 
							setlocale(LC_TIME, "spanish");
							echo strftime("%B %d, %Y",strtotime($value->fecha_inicial));
						?></p>
							<h5 class="title-card--iniciativa">
								<?php if($value->nombre_iniciativa != null && $value->nombre_iniciativa != ""){ //Si la iniciativa tiene nombre
									echo $value->nombre_iniciativa;
								}else{ //Si no, pone default Iniciativa
									echo "Iniciativa";
								}?>
							</h5>
							<p class="text-card--iniciativa text-justify">{{$value->resumen}}</p>
							<div class="mb-4 mt-4">
								<p class="subtitle-card--iniciativa">Comisión(es) de estudio:</p>
								<p class="text-card--iniciativa text-card--iniciativa-comision">{{$value->nom_comision}}</p>
							</div>
							<div class="mb-5">
								<p class="subtitle-card--iniciativa">Autor(es):</p>
								<?php if($value->autores){ //Si hay autores
									echo '<ul class="lista-autores">';
									foreach ($value->autores as $key_a => $value_a) { //Los va mostrando
										if($key_a < 3){
											
											echo '<li><span>'.$value_a->nombre_remitente.'</span></li>';
										}else if($key_a == 3){
											echo '<li><span>'.(count($value->autores)-4).' más</span></li>';
										}
									}
									echo '</ul>';
								}?>
							</div>
							<?php 
							$num_comentarios = 0;
							$fecha_inicial = "";
							$fecha_final = "";
							if($value->comentarios){ //Si hay comentarios
								$num_comentarios = count($value->comentarios);
								
								if($num_comentarios > 0){
									//Define la fecha inicial y final de los comentarios
									$fecha_inicial = date_format(new DateTime($value->comentarios[0]->fecha_creacion),"d/m/Y");
									$fecha_final = date_format(new DateTime($value->comentarios[$num_comentarios-1]->fecha_creacion),"d/m/Y");
								}
							}?>
							<div class="info-coment-card--iniciativa">
								<p class="text-card--iniciativa mb-0">
									<span class="icon-card comentario"></span>{{$num_comentarios}} Comentario(s)</p>
								<p class="mb-0"><small class="text-muted"><?php echo $fecha_inicial." - ".$fecha_final; ?></p></small></p>
							</div>
						</div>
						<div class="card-footer bg-transparent footer-card--iniciativa">
							<div class="call-card--iniciativa">
								<!--botón para lanzar el modal de comentar iniciativa-->
								<button type="button" class="button-comentar" idp="{{$value->id_principal}}" idi="{{$value->infolej}}">
									<span class="icon-card comentar"></span>
									Comentar
								</button>
								<!--botón para ver el vídeo de la iniciativa-->
								<button type="button" class="button-video" id="button_ver_video" idv='{{$value->url_video}}'>
									<span class="icon-card video"></span>Ver vídeo
								</button>
								<!--botón para mandar a ver detalle de la iniciativa-->
								<a target="_blank" href="{{ url('detalle_iniciativa') }}/{{$value->infolej}}/{{$value->id_principal}}" class="button-detalle">ver detalle<i
										class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			<?php 
				$contador ++;
				if($contador%3 == 0){ //Esto se hace para cerrar una fila
					echo '</div>';
					$contador = 0;
				}
			}
		}?>
	   
		
	</div>

	 <!-- Modal video iniciativa -->
	<div class="modal fade" id="modal-video" data-backdrop="static" data-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-video">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" id="link_video" src="" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

<!-- Canal parlamento  -->
<section>
	<div class="container-seccion container--canal-parlamento bg-color-light">
		<div class="row mb-3">
			<div class="col-md-8">
				<h3 class="title--canal-parlamento line-border-bottom">Canal Parlamento de Jalisco</h3>
				<p class="subtext--canal-parlamento">Consulta las transmisiones del pleno del congreso y sus comisiones.
				</p>
			</div>
			<div class="col-md-4 d-flex justify-content-end align-items-center">
				<a target="_blank" href="https://youtube.com/c/CanalParlamentoDeJalisco" target="_blank" class="btn-ver-todas" tabindex="-1" role="button" aria-disabled="true">Ir al canal
					<i class="fas fa-chevron-right"></i></a>
			</div>
		</div>

		<?php if(isset($videoyoutube)){ //Si hay vídeos para el home
			echo "<div class='row'>";
			foreach ($videoyoutube as $key => $value) { //Recorre cada uno
				if($key == 0){ //El primer vídeo lo muestra en grande de lado izquierdo?>

					<div class="col-md-6">
						<div>
							<iframe width="100%" height="480px" src="{{$value->link}}" frameborder="0"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen></iframe>
						</div>
						<div class="mt-3">
							<p class="text--canal text--canal-nombre">{{$value->nombre}}</p>
							<p class="text--canal text--canal-descripcion">{{$value->descripcion}}</p>
						</div>
					</div> 
					<div class="col-md-6">
						<div class="row">
				<?php }?>
							<div class="col-md-12">
								<div class="row mb-3">
									<div class="col-md-6">
										<div>
											<iframe width="100%" height="170px" src="{{$value->link}}"
												frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>
										</div>
									</div>
									<div class="col-md-6 d-flex align-items-center">
										<div class="row">
											<p class="text--canal text--canal-nombre">{{$value->nombre}}</p>
											<p class="text--canal text--canal-descripcion">{{$value->descripcion}}</p>
										</div>
									</div>
								</div>
							</div>
				<?php if($key == 2){?>
					</div>
				</div>
				<?php }
			}
			echo "</div>";
		}?>
		
		
	</div>
</section>

@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		var SITEURL = '{{URL::to('')}}'; 
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		//Al hacer clic sobre el botón de ver vídeo, lanza el modal
		$('body').off('click',".button-video");
		$('body').on('click', '.button-video', function () {
			
			if($(this).attr("idv") != null && $(this).attr("idv") != ""){ //Busca si la iniciativa tiene vídeo
				$("#link_video").attr("src",$(this).attr("idv"));
				$("#modal-video").modal();
			}else{ //Si no tiene, lanza un mensaje
				bootbox.alert("Esta iniciativa no contiene vídeo");
			}
			
		});

		//Al hacer clic sobre el botón comentar, lanza el modal
		$('body').off('click',".button-comentar");
		$('body').on('click', '.button-comentar', function () {
		
			
			$("#idi").val($(this).attr("idi")); //Obtiene los identificadores de la iniciativa
			$("#idp").val($(this).attr("idp")); //Obtiene los identificadores de la iniciativa
			$("#modal-comentar").modal(); //Lanza el modal
			
			
		});

		//Cuando el modal de comentar se cierra
		$('#modal-comentar').off('hidden.bs.modal');
		$("#modal-comentar").on('hidden.bs.modal', function () { 
			//Se formatean los campos
			$(this).find(".comentarios").val("");
		});

		//Acción que se ejecuta al hacer clic en el botón del modal del comentario
		$('body').off('click',"#enviar_comentario");
		$('body').on('click', '#enviar_comentario', function () {
			var idp = $(this).attr("idp"); //Obtiene el ide principal
			var idi = $(this).attr("idi"); //Obtiene el infolej
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			//Obtiene el formulario
			var form = $("#form-comentar")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				//Desde esta ruta se realiza en el backend la acción de comentar iniciativa
				url: SITEURL + "/comentar",
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Se oculta el modal
						$("#modal-comentar").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert({ //Notifica que la acción fue ejecutada con éxito
							message: "<b>FOLIO: COM"+data.rsp["id"]+"</b><br><br><b>¡Comentario enviado con éxito, en espera de que lo aprueben!</b><br>Se ha el enviado a tu correo el acuse de tu comentario, en caso de que no lo encuentres en tu bandeja, búsca dentro de la carpeta de spam.",
							callback: function () {
								setTimeout(function() { //Al confirmar el mensaje, se recarga la página
									location.reload();
								},200);
							}
						});
						
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al enviar el comentario!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al enviar el comentario!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});
	});
</script>
<!--si existe la variable notificación, se ejecuta lo siguiente-->
@if (session('notification'))
<script>
	$(document).ready(function () {
		var mensaje = "{{ session('notification') }}";
		bootbox.alert({
			message: mensaje,
			callback: function () {
			}
		});
		
		
	});
</script>

@endif
@endsection