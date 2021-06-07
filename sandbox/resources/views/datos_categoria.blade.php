@extends('app')

@section('content')
<!--contenido de la portada de datos_categoria-->
<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/portada.png')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Datos abiertos</h1>
					<div class="text-header-content">
						<p>{{$categoria}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--sección de los datos por categorías-->
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

			<?php if($datos && count($datos)>0){ //Si la categoría tiene datos, que se manda desde el backend
				$contador = 0;
				$contador_imagenes = 0;
				foreach ($datos as $key => $value) { //Recorre cada dato
					if($contador == 0){ //Esto se hace para definir una fila
						echo '<div class="row mb-3">';
					}?>
					<!-- aquí es donde se dibuja el card de los datos -->
					<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
						<div class="card iniciativas-card--container">
							<?php
							//Si el dato no tiene imagen
							if($value->url_imagen != null && $value->url_imagen != ""){
								if(\File::exists(public_path()."/".$value->url_imagen)){ //Si la imagen definida no existe

									$url = str_replace(" ", "%20", asset($value->url_imagen));
									$array_imagenes_utilizadas[] = $url;
								}else{ //se busca una random
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
							}else{//se busca una random
							
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
								
								<h5 class="title-card--comision">{{$value->titulo}}</h5>
								<div class="mb-4 mt-4">
									<p class="subtitle-card--iniciativa">Descripción</p>
									{{$value->descripcion}}
									
								</div>


							</div>
							<div class="card-footer bg-transparent footer-card--iniciativa">
								<div class="call-card--iniciativa">
									<a target="_blank" href="{{$value->link}}" class="button-detalle">Ver detalle<i
										class="fas fa-chevron-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php 
					$contador ++;
					if($contador%3 == 0){//Esto se hace para cerrar una fila
						echo '</div>';
						$contador = 0;
					}
				}
				 if(count($datos)%3 != 0){//Si al terminar de recorrer las categorías hay una fila sin cerrar, se cierra
					echo '</div>';
				}
			}else{ //Si la categoría no tiene datos, se indica
				echo "<div class='col-md-12 p-0'><h3>Esta categoría está vacía</h3></div>";
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