@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/jalisco-hemiciclo.jpg')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Congreso Jalisco Abierto</h1>
					<button type="button" class="button-video-tutorial" data-toggle="modal" data-target="#modal-video-tutorial">
						<span class="icon-play"></span>Ver video tutorial
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
				<h3 class="title--congreso line-border-bottom">¿Qué es Congreso Jalisco abierto?</h3>
				<div class="text--congreso text-justify">
					<p>Es una plataforma digital creada para fomentar la participación ciudadana en el proceso de
						creación de leyes y donde podrás conocer todo el actuar del Poder Legislativo.</p>
					<p>Con ésta herramienta puedes conocer, consultar y opinar respecto de las iniciativas de Ley y de
						Decreto que son turnadas a las Comisiones legislativas; y en donde también podrás consultar la
						legislación vigente en el Estado de Jalisco, conocer el proceso legislativo y saber quiénes son
						nuestros diputados.</p>
					<p>Puedes suscribirte a la Comisión Legislativa que sea de tu interés para que te lleguen avisos
						respecto de alguna iniciativa de ley o de decreto, además podrás visualizar las Sesiones
						completas sin cortes del Pleno y sus Comisiones.</p>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="container-img--congreso">
					<div class="img img-bg" style="background-image: url('img/jalisco-hemiciclo.jpg');"></div>
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
		<?php if($iniciativas){
			$contador = 0;
			$contador_imagenes = 0;
			$cantidad_imagenes_aleatorias = count($imagenes_random);
			foreach ($iniciativas as $key => $value) {
				if($contador == 0){
					echo '<div class="row mb-3">';
				}?>
				<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
					<div class="card iniciativas-card--container">
						<?php
						
						if($value->url_imagen != null && $value->url_imagen != ""){
							if(\File::exists(public_path()."/".$value->url_imagen)){

								$url = str_replace(" ", "%20", asset($value->url_imagen));
								$array_imagenes_utilizadas[] = $url;
							}else{
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
						}else{
						
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
								<?php if($value->nombre_iniciativa != null && $value->nombre_iniciativa != ""){
									echo $value->nombre_iniciativa;
								}else{
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
								<?php if($value->autores){
									echo '<ul class="lista-autores">';
									foreach ($value->autores as $key_a => $value_a) {
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
							if($value->comentarios){
								$num_comentarios = count($value->comentarios);
								
								if($num_comentarios > 0){

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
								<button type="button" class="button-comentar" idp="{{$value->id_principal}}" idi="{{$value->infolej}}">
									<span class="icon-card comentar"></span>
									Comentar
								</button>

								<button type="button" class="button-video" id="button_ver_video" idv='{{$value->url_video}}'>
									<span class="icon-card video"></span>Ver video
								</button>

								<a target="_blank" href="{{ url('detalle_iniciativa') }}/{{$value->infolej}}/{{$value->id_principal}}" class="button-detalle">ver detalle<i
										class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			<?php 
				$contador ++;
				if($contador%3 == 0){
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
				<h3 class="title--canal-parlamento line-border-bottom">Canal parlamento de Jalisco</h3>
				<p class="subtext--canal-parlamento">Consulta las transmisiones del pleno del congreso y sus comisiones.
				</p>
			</div>
			<div class="col-md-4 d-flex justify-content-end align-items-center">
				<a target="_blank" href="https://youtube.com/c/CanalParlamentoDeJalisco" target="_blank" class="btn-ver-todas" tabindex="-1" role="button" aria-disabled="true">Ir al canal
					<i class="fas fa-chevron-right"></i></a>
			</div>
		</div>

		<?php if(isset($videoyoutube)){
			echo "<div class='row'>";
			foreach ($videoyoutube as $key => $value) {
				if($key == 0){?>

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

		$('body').off('click',"#button_ver_video");
		$('body').on('click', '#button_ver_video', function () {
			
			if($(this).attr("idv") != null && $(this).attr("idv") != ""){
				$("#link_video").attr("src",$(this).attr("idv"));
				$("#modal-video").modal();
			}else{
				bootbox.alert("Esta iniciativa no contiene vídeo");
			}
			
		});


		$('body').off('click',".button-comentar");
		$('body').on('click', '.button-comentar', function () {
		
			
			$("#idi").val($(this).attr("idi"));
			$("#idp").val($(this).attr("idp"));
			$("#modal-comentar").modal();
			
			
		});

		$('#modal-comentar').off('hidden.bs.modal');
		$("#modal-comentar").on('hidden.bs.modal', function () {
			$(this).find(".comentarios").val("");
		});

		/*función que crea un iniciativa*/
		$('body').off('click',"#enviar_comentario");
		$('body').on('click', '#enviar_comentario', function () {
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			
			$("#preloader").css("display", "block");
			var form = $("#form-comentar")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				url: SITEURL + "/comentar",
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){
						$("#modal-comentar").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert({
							message: "<b>FOLIO: COM"+data["id"]+"</b><br><br><b>¡Comentario enviado con éxito, en espera de que lo aprueben!</b><br>Se ha el enviado a tu correo el acuse de tu comentario, en caso de que no lo encuentres en tu bandeja, búsca dentro de la carpeta de spam.",
							callback: function () {
								setTimeout(function() {
									location.reload();
								},200);
							}
						});
						
					}else if (data.status == "422"){
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
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});
	});
</script>
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