@extends('app')

@section('content')
<!--contenido de la portada de iniciativas-->
<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/portada.png')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Iniciativas</h1>
					<h1 class="title--header-2">{{$nombre_comision}}</h1>
					<div class="text-header-content">
						<p>Opina y aporta tu punto de vista para enriquecer la ley.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="container-seccion container-table--iniciativas mt-5">
	<div class="row mb-4">
		<div class="col-md-6">
			<div class="nav-tabs-iniciativas">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<!--para ver las iniciativas en forma de cards-->
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#tab-card" role="tab"
							aria-controls="pills-home" aria-selected="true"><i class="fas fa-th"></i></a>
					</li>
					<!--para ver las iniciativas en forma de lista-->
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tab-list" role="tab"
							aria-controls="pills-profile" aria-selected="false"><i class="fas fa-list"></i></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-6 d-flex justify-content-end align-items-center">
			<!--botón para suscribirse a iniciativas-->
			<button type="button" class="button-suscribe"  data-toggle="tooltip" data-placement="top" title="Suscríbete" id="button-suscribe">
				<span class="icon-suscribe"></span>
			</button>
		</div>
	</div>

	<div class="tab-content" id="pills-tabContent">
		<!--para ver las iniciativas en forma de cards-->
		<div class="tab-pane fade show active" id="tab-card" role="tabpanel" aria-labelledby="pills-home-tab">

		   <?php if($iniciativas && count($iniciativas)>0){ //Si existen iniciativas en esa comisión
				$contador = 0;
				$contador_imagenes = 0;
				$cantidad_imagenes_aleatorias = count($imagenes_random);
				foreach ($iniciativas as $key => $value) { //Recorre cada una
					if($contador == 0){ //Esto se hace para definir una fila
						echo '<div class="row mb-3">';
					}


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
					}
					?>

					<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
						<div class="card iniciativas-card--container">
							<div class="img-card--inicitaivas img-bg" style="background-image: url('{{$url}}');">
							</div>
							<div class="card-body pb-1">
								<p class="fecha--iniciativa"><i class="far fa-calendar-alt"></i> 
								<?php  setlocale(LC_TIME, "spanish");
								echo strftime("%B %d, %Y",strtotime($value->fecha_inicial));?></p>
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
									<a href="{{ url('detalle_iniciativa') }}/{{$value->infolej}}/{{$value->id_principal}}" class="button-detalle">ver detalle<i
											class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				<?php 
					$contador ++;
					if($contador%3 == 0){  //Esto se hace para cerrar una fila
						echo '</div>';
						$contador = 0;
					}
				}
				if(count($iniciativas)%3 != 0){
					echo '</div>';
				}?>
				<!--muestra el paginador de las iniciativas-->
				<div class="col-md-12 pt-2 pb-5 pr-0 pl-0">
					<div class="float-right">
						{{ $iniciativas->links( "pagination::bootstrap-4") }}
					</div>
				</div>

			<?php }else{
				echo "<div class='col-md-12'><h3>Esta comisión no tiene ninguna iniciativa</h3></div>";
			}?>
		</div>
		<!--para ver las iniciativas en forma de lista-->
		<div class="tab-pane fade" id="tab-list" role="tabpanel" aria-labelledby="pills-profile-tab">

			<?php if($iniciativas && count($iniciativas)>0){ //Si existen las iniciativas
				$contador = 0;
				foreach ($iniciativas as $key => $value) { //Recorre cada iniciativa?>
					<div class="border-top"></div>
					<div class="row mb-4">
						<div class="col-md-2">
							<div class="fecha-list-iniciativa--container">
								<p class="fecha-number mb-1"><?php echo date_format(new DateTime($value->fecha_final),"d"); ?></p></p>
								<p><?php echo date_format(new DateTime($value->fecha_final),"M, Y"); ?></p></p>
							</div>
						</div>
						<div class="col-md-8">
							<h5 class="title-card--iniciativa">
								<?php if($value->nombre_iniciativa != null && $value->nombre_iniciativa != ""){ //Si la iniciativa tiene nombre
									echo $value->nombre_iniciativa;
								}else{ //Si no, pone default Iniciativa
									echo "Nombre de la iniciativa";
								}?>
								
							</h5>
							<p class="text-card--iniciativa text-justify">{{$value->resumen}}</p>
							<div class="container-comision-autor">
								<div>
									<p class="subtitle-card--iniciativa">Comisión(es) de estudio:</p>
									<p class="text-card--iniciativa">{{$value->nom_comision}}</p>
								</div>
								<div class="mr-2">
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
							</div>
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
								<a href="{{ url('detalle_iniciativa') }}/{{$value->infolej}}/{{$value->id_principal}}" class="button-detalle">ver detalle<i class="fas fa-chevron-right"></i>
								</a>

								
							</div>
						</div>
						<div class="col-md-2">
							<?php
								$num_comentarios = 0;
								$fecha_inicial = "";
								$fecha_final = "";
								if($value->comentarios){  //Si hay comentarios
									$num_comentarios = count($value->comentarios);
									
									if($num_comentarios > 0){
										//Define la fecha inicial y final de los comentarios
										$fecha_inicial = date_format(new DateTime($value->comentarios[0]->fecha_creacion),"d/m/Y");
										$fecha_final = date_format(new DateTime($value->comentarios[$num_comentarios-1]->fecha_creacion),"d/m/Y");
									}
								}?>

							<div class="border-left"></div>
							<div class="comentarios-list--container">
								<p class="text-card--iniciativa mb-0">
									<span class="icon-card comentario"></span>{{$num_comentarios}} Comentario(s)
								</p>
								<p><small class="text-muted"><?php echo $fecha_inicial." - ".$fecha_final; ?></p></small></p>
							</div>
						</div>
					</div>
					
					
				<?php 
					
				}?>
				<!--muestra la paginación de las iniciativas-->
				<div class="col-md-12 pt-2 pb-5 pr-0 pl-0">
					<div class="float-right">
						{{ $iniciativas->links( "pagination::bootstrap-4") }}
					</div>
				</div>

			<?php }else{ //Si la comisión no tiene iniciativas, muestra el siguiente texto
				echo "<div class='col-md-12'><h3>Esta comisión no tiene ninguna iniciativa</h3></div>";
			}?>

			<!-- vista lista -->
			
			
		</div>
	</div>

	<!-- Modal suscribete notificaciones -->
	<div class="modal right fade modal-suscribe" id="modal-suscribe" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Suscríbete para recibir notificaciones de las
						iniciativas de ley</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!--formulario para suscribir a las iniciativas de esa comisión-->
					<form class="form-suscribe" id="form-suscripcion">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name" class="col-form-label">Nombre de la Persona, Institución o
								AC<span>*</span>
							</label>
							<input type="text" class="form-control validation" id="nombre" name="nombre">
						</div>
						<div class="form-group">
							<label for="correo" class="col-form-label">Correo electrónico<span>*</span></label>
							<input type="email" class="form-control validation" id="email" name="email">
						</div>
						<p class="title-select--input">Elije las iniciativas a las que deseas recibir
						notificaciones</p>
						<?php if($iniciativas){ //Si hay iniciativas en esa comisión
							echo '<div class="mt-3">';
							foreach ($iniciativas as $key => $value) { //Las va mostrando
								if($value->nombre_iniciativa != null && $value->nombre_iniciativa != ""){
									echo '<div class="custom-control custom-checkbox checkbox-iniciativa">
										<input type="checkbox" class="custom-control-input validation" id="customCheck'.$value->infolej.'" name="iniciativas[]" value="'.$value->infolej.'">
										<label class="custom-control-label" for="customCheck'.$value->infolej.'"> '.$value->nombre_iniciativa.'</label>
									</div>';
								}
							}
							echo '</div>';
						}?>
						
						<div class="mt-4">
							<div class="form-group form-check mb-2">
								<input type="checkbox" class="form-check-input validation" id="suscribirme_todas">
								<label class="form-check-label font-weight-bold" for="suscribirme_todas">
									Deseo suscribirme a todas las iniciativas
								</label>
							</div>
							<div class="form-group form-check mb-2">
								<input type="checkbox" class="form-check-input validation" id="aviso_privacidad" name="aviso_privacidad" value="campos_obligatorios">
								<label class="form-check-label font-weight-bold" for="aviso_privacidad">
									He leído y acepto el Aviso de privacidad
								</label>
							</div>
							<div class="form-group form-check mb-2">
								<input type="checkbox" class="form-check-input validation" id="no_soy_robot" value="campos_obligatorios" name="no_soy_robot" >
								<label class="form-check-label font-weight-bold" for="no_soy_robot">
									No soy un robot
								</label>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-cancelar" data-dismiss="modal">CANCELAR</button>
					<button class="btn-enviar" id="suscripcion_iniciativas">ENVIAR</button>
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
					<!--formulario para comentar iniciativas-->
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

		//Función que crea una suscripcion en una iniciativa
		$('body').off('click',"#suscripcion_iniciativas");
		$('body').on('click', '#suscripcion_iniciativas', function () {
			var idp = $(this).attr("idp"); //Obtiene el ide principal
			var idi = $(this).attr("idi"); //Obtiene el infolej
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			//Obtiene el formulario
			var form = $("#form-suscripcion")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				//Desde esta ruta se realiza en el backend la suscripción de las iniciativas
				url: SITEURL + "/suscripcion_iniciativas",
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
							message: "¡Suscripción realizada con éxito!",
							callback: function () { //Al confirmar el mensaje, se recarga la página
								setTimeout(function() {
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
						bootbox.alert("¡Error al solicitar la suscripción!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al solicitar la suscripción!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		//Acción que se ejecuta cuando dan clic en suscribirse a todas las iniciativas, se marcan todas
		$("#suscribirme_todas").on("click", function(){
			if($(this).is(":checked") == true){
				$("input[name='iniciativas[]']").prop("checked", true);
			}else{
				$("input[name='iniciativas[]']").prop("checked", false);
			}
			
		});		

		//Acción que se ejecuta cuando se cierra el modal de suscribirse
		$('#button-suscribe').off('hidden.bs.modal');
		$("#button-suscribe").on('hidden.bs.modal', function () {
			//Se formatea el contenido del formulario
			$(this).find(".validation").val("");
			$("input[name='comisiones[]']").prop("checked", false);
		});

		//Cuando le da clic en suscribirse, se lanza el modal
		$("#button-suscribe").on("click", function(){
			$("#modal-suscribe").modal();
		});
		
		$('[data-toggle="tooltip"]').tooltip()

	});
</script>
@endsection