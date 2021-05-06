@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/jalisco-hemiciclo.jpg')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Comisiones</h1>
					<div class="text-header-content">
						<p>Opina y aporta tu punto de vista para enriquecer la ley.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="search-bar-area mt-5">
	<div class="container--search-bar">
		
	</div>
</div>
<section class="container-seccion container-table--iniciativas">
	<div class="row mb-4">
		<div class="col-md-6">
			<div class="nav-tabs-iniciativas">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#tab-card" role="tab"
						aria-controls="pills-home" aria-selected="true"><i class="fas fa-th"></i></a>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="col-md-6 d-flex justify-content-end align-items-center">
			
			<button type="button" class="button-suscribe"  data-toggle="tooltip" data-placement="top" title="Suscríbete" id="button-suscribe">
				<span class="icon-suscribe"></span>
			</button>
		</div>
	</div>

	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="tab-card" role="tabpanel" aria-labelledby="pills-home-tab">

			<?php if($comisiones){
				$contador = 0;
				$contador_imagenes = 0;
				foreach ($comisiones as $key => $value) {
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
								
								<h5 class="title-card--comision">{{$value->nombre_comision}}</h5>
								<div class="mb-4 mt-4">
									<p class="subtitle-card--iniciativa">Iniciativas</p>
									<?php if($value->iniciativas){
										
										echo count($value->iniciativas)." Iniciativa(s)";
									}?>
								</div>


							</div>
							<div class="card-footer bg-transparent footer-card--iniciativa">
								<div class="call-card--iniciativa">
									<a target="_blank" href="{{ url('iniciativas') }}/{{$value->nombre_comision}}" class="button-detalle">Ver detalle<i
										class="fas fa-chevron-right"></i>
									</a>
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
				 if(count($comisiones)%3 != 0){
					echo '</div>';
				}
			}?>
		</div>
		<div class="tab-pane fade" id="tab-list" role="tabpanel" aria-labelledby="pills-profile-tab">

			<!-- vista lista -->
			<?php if($comisiones){
				$contador = 0;
				foreach ($comisiones as $key => $value) {?>

					<div class="border-top"></div>
					<div class="row mb-4">
						<div class="col-md-2">
							<div class="fecha-list-iniciativa--container">
								<p class="fecha-number mb-1"><?php echo count($value->iniciativas);?></p>
								<p>Iniciativas</p>
							</div>
						</div>
						<div class="col-md-10">
							<h5 class="title-card--comision-lista">{{$value->nombre_comision}}</h5>
							
							<a target="_blank" href="{{ url('iniciativas') }}/{{$value->nombre_comision}}" class="button-detalle">ver detalle<i
								class="fas fa-chevron-right"></i>
							</a>
						</div>
					</div>
						
					

				<?php }
			}?>
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
						<p class="title-select--input">Elije las comisiones de las que deseas quieres recibir
						notificaciones</p>
						<?php if($comisiones){
							echo '<div class="mt-3">';
							foreach ($comisiones as $key => $value) {
								echo '<div class="custom-control custom-checkbox checkbox-iniciativa">
									<input type="checkbox" class="custom-control-input validation" id="customCheck'.$value->id_comision.'" name="comisiones[]" value="'.$value->id_comision.'">
									<label class="custom-control-label" for="customCheck'.$value->id_comision.'"> '.$value->nombre_comision.'</label>
								</div>';
							}
							echo '</div>';
						}?>
						
						<div class="mt-4">
							<div class="form-group form-check mb-2">
								<input type="checkbox" class="form-check-input validation" id="suscribirme_todas">
								<label class="form-check-label font-weight-bold" for="suscribirme_todas">
									Deseo suscribirme a todas las comisiones
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
					<button class="btn-enviar" id="suscripcion_comisiones">ENVIAR</button>
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
					<form class="form-comentar">
						<div class="p-2">
							<div class="form-group">
								<label for="formGroupExampleInput">Nombre</label>
								<input type="text" class="form-control" id="formGroupExampleInput">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Correo electrónico</label>
								<input type="email" class="form-control" id="exampleInputEmail1"
								aria-describedby="emailHelp">
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Comentario</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleFormControlFile1">Adjuntar</label>
								<input type="file" class="form-control-file" id="exampleFormControlFile1">
							</div>
							<div class="mt-4">
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="gridCheck">
										<label class="form-check-label" for="gridCheck">
											He leído y acepto el Aviso de privacidad
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="gridCheck">
										<label class="form-check-label" for="gridCheck">
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
					<button type="submit" class="btn-comentar">ENVIAR COMENTARIO</button>
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
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/SZzNImTo6RQ"
						allowfullscreen></iframe>
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
		//Función que crea una suscripcion en una iniciativa
		$('body').off('click',"#suscripcion_comisiones");
		$('body').on('click', '#suscripcion_comisiones', function () {
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			
			$("#preloader").css("display", "block");
			var form = $("#form-suscripcion")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				url: SITEURL + "/suscripcion_comisiones",
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
							message: "¡Suscripción realizada con éxito!",
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
						bootbox.alert("¡Error al solicitar la suscripción!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al solicitar la suscripción!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});


		$("#suscribirme_todas").on("click", function(){
			if($(this).is(":checked") == true){
				$("input[name='comisiones[]']").prop("checked", true);
			}else{
				$("input[name='comisiones[]']").prop("checked", false);
			}
			
		});		
		$('#button-suscribe').off('hidden.bs.modal');
		$("#button-suscribe").on('hidden.bs.modal', function () {
			$(this).find(".validation").val("");
			$("input[name='comisiones[]']").prop("checked", false);
		});


		$("#button-suscribe").on("click", function(){
			$("#modal-suscribe").modal();
		});
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
@endsection