@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/portada.png')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Datos abiertos</h1>
					<div class="text-header-content">
						<p>Conoce nuestro portal de datos y la información que tenemos para ti.</p>
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
		
	</div>

	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="tab-card" role="tabpanel" aria-labelledby="pills-home-tab">

			<?php if($categorias_datos){
				$contador = 0;
				$contador_imagenes = 0;
				foreach ($categorias_datos as $key => $value) {
					if($contador == 0){
						echo '<div class="row mb-3">';
					}?>
					<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
						<div class="card iniciativas-card--container">
							<?php							
							
								$url = str_replace(" ", "%20", asset($imagenes_random[$contador_imagenes]["url_imagen"]));
								if($contador_imagenes == (count($imagenes_random)-1)){
									$contador_imagenes = 0;
									$orden_exito = shuffle($imagenes_random);
									while($orden_exito == false){
										$orden_exito = shuffle($imagenes_random);
									}
								}
								$contador_imagenes++;
							?>

							
							<div class="img-card--inicitaivas img-bg" style="background-image: url('{{$url}}');">
							</div>
							<div class="card-body pb-1">
								
								<h5 class="title-card--comision">{{$value["nombre"]}}</h5>
								<div class="mb-4 mt-4">
									<p class="subtitle-card--iniciativa">Datos</p>
									<?php echo count($value["datos"]);?>
								</div>


							</div>
							<div class="card-footer bg-transparent footer-card--iniciativa">
								<div class="call-card--iniciativa">
									<a target="_blank" href="{{ url('datos_categoria') }}/{{$value['nombre']}}" class="button-detalle">Ver detalle<i
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
				 if(count($categorias_datos)%3 != 0){
					echo '</div>';
				}
			}?>
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