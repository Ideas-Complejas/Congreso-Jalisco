@extends('app')

@section('content')
<!--contenido de la portada de datos abiertos-->
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
<!-- sección de los datos abiertos-->
<section class="container-seccion container-table--iniciativas mt-5">
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
		<!--solo hay una opción a mostrar, que es en forma de card-->
		<div class="tab-pane fade show active" id="tab-card" role="tabpanel" aria-labelledby="pills-home-tab">

			<?php if($categorias_datos){ //Si hay categoría de datos, que se manda desde el backend
				$contador = 0;
				$contador_imagenes = 0;
				foreach ($categorias_datos as $key => $value) {
					if($contador == 0){ //Esto se hace para definir una fila
						echo '<div class="row mb-3">';
					}?>
					<!-- aquí es donde se dibuja el card de las categorías de los datos -->
					<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
						<div class="card iniciativas-card--container">
							<?php							
								//Se busca una imagen random
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
					if($contador%3 == 0){ //Esto se hace para cerrar una fila
						echo '</div>';
						$contador = 0;
					}
				}
				 if(count($categorias_datos)%3 != 0){ //Si al terminar de recorrer las categorías hay una fila sin cerrar, se cierra
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

	});
</script>
@endsection