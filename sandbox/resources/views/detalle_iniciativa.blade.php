@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/jalisco-hemiciclo.jpg')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Detalle de la iniciativa</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="container-seccion">
	<div class="row mt-5">
		<div class="col-lg-8 col-md-6">
			<div>
				<h5 class="title-card--iniciativa"><?php $nombre_iniciativa = ($iniciativa->nombre_iniciativa != null && $iniciativa->nombre_iniciativa != "") ? $iniciativa->nombre_iniciativa : "Iniciativa"; echo $nombre_iniciativa;?> </h5>
				<p class="text-card--iniciativa text-justify">{{$iniciativa->resumen}}
				</p>
				<p class="fecha--iniciativa"><i class="far fa-calendar-alt"></i> <?php setlocale(LC_TIME, "spanish");
					echo strftime("%B %d, %Y",strtotime($value->fecha_final));?></p></p>
			</div>
			<div class="container-comision-autor">
				<div>
					<p class="subtitle-card--iniciativa">Comisión(es) de estudio:</p>
					<p class="text-card--iniciativa">{{$iniciativa->nom_comision}}</p>
				</div>
				<div class="mr-2">
					<p class="subtitle-card--iniciativa">Autor:</p>
					 <?php if($iniciativa->autores){
						echo '<ul class="lista-autores-detalle">';
						foreach ($iniciativa->autores as $key_a => $value_a) {

							
							echo '<li><span>'.$value_a->nombre_remitente.'</span></li>';
							
						}
						echo '</ul>';
					}?>
				</div>
			</div>
			
			<!-- Tabla de iniciativas  -->
			<div class="container-table-iniciativas col-md-12">
				<table class="table dataTable table-striped">
					<thead>
						<tr>
							<th scope="col">Tipo de documento</th>
							<th scope="col">Estado</th>
							<th scope="col">Condición de Estado</th>
							<th scope="col">Fecha de registro</th>
							<th scope="col">No. Sesión</th>
							<th scope="col">Fecha de Sesión</th>
							<th scope="col">Gaceta</th>
							<th scope="col"><i class="fas fa-download"></i></th>
						</tr>
					</thead>
					<?php if($iniciativa->estados_procesales){
						echo '<tbody>';
						foreach ($iniciativa->estados_procesales as $key => $value) {?>
						   <tr>
								<th scope="row">{{$value->nombre_tipo}}</th>
								<td>{{$value->nombre_estado}}</td>
								<td>{{$value->nombre_fecha}}</td>
								<td>22/06/2020</td>
								<td>{{$value->no_sesion}}</td>
								<td><?php echo date_format(new DateTime($value->f_sesion),"d/m/Y")?></td>
								<td>1283</td>
								<td><a href=""><i class="fas fa-file-pdf icon-pdf"></i></a></td>
							</tr>
						<?php }
						echo '</tbody>';
					}?>
					
				</table>
			</div>

			<!-- Form enviar comentario  -->
			<?php 
			
			
			$num_comentarios = 0;
			$fecha_inicial = "";
			$fecha_final = "";
			if($iniciativa->comentarios){
				$num_comentarios = count($iniciativa->comentarios);
				
				if($num_comentarios > 0){
					$fecha_inicial = date_format(new DateTime($iniciativa->comentarios[$num_comentarios-1]->fecha_creacion),"d/m/Y");
					$fecha_final = date_format(new DateTime($iniciativa->comentarios[0]->fecha_creacion),"d/m/Y");
				}
			}?>
								
			<div class="col-md-12">
				<div class="border-comentar">
					<p class="text-comentarios--iniciativa">
						<span class="icon-card comentario"></span>{{$num_comentarios}} Comentario(s)
					</p>
					<p class="mb-0"><small class="text-muted"><?php echo $fecha_inicial." - ".$fecha_final; ?></p></small></p>
				</div>
				<?php if($iniciativa->comentarios){?>
					<table id="table_comentarios" class="table dataTable table-striped">
						<thead>
							<tr>
								<th scope="col">Folio</th>
								<th scope="col">Usuario</th>
								<th scope="col">Comentario</th>
								<th scope="col">Fecha</th>

							</tr>
						</thead>
						<tbody>
						<?php foreach ($iniciativa->comentarios as $key => $value) {
							echo "<tr>";
								if($value->usuario_url_file != "" && $value->usuario_url_file != null){
									$url = URL::to('');
									echo'<td class="text-center">COM'.$value->id.'<br><a href="'.$url.'/get_file_comentario/'.$value["id"].'" target="_blank"><button class="btn btn-purple ver_archivo" ide="'.$value["id"].'"><i class="far fa-file"></i></button></a></td>';
								}else{
									echo "<td>COM".$value->id."</td>";
								}
							echo "<td>".$value->usuario_nombre."</td>";
							echo "<td><div class='expandable text-justify'>
							<p>".$value->usuario_comentario."</p>
							</div></td>";
							
							echo "<td>".$value->fecha_creacion."</td>";
							echo "</tr>";
						}?>
						</tbody>
					</table>
					<div class="col-md-12 pt-2 pb-5 pr-0 pl-0">
						<div class="float-right">
							{{ $iniciativa->comentarios->links( "pagination::bootstrap-4") }}
						</div>
					</div>
				<?php }?>
			</div>
			<div class="container--comentar-detalle-iniciativa">
				<form class="form-comentar" id="form-comentar">
					{{ csrf_field() }}
					<div class="p-2">
						<input type="hidden" class="form-control comentarios" id="idi" name="idi" value="{{$iniciativa->infolej}}">
						<input type="hidden" class="form-control comentarios" id="idp" name="idp" value="{{$iniciativa->id_principal}}">
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
				<button id="enviar_comentario" idi="{{$iniciativa->infolej}}" idp="{{$iniciativa->id_principal}}" class="btn-comentar">ENVIAR COMENTARIO</button>
			</div>
		</div>
		<!-- Cards  -->
		<div class="col-lg-4 col-md-6">
			<div class="card container-card-detalle-iniciativa">
				<div class="card-body">
					<div class="text-card-estado-inicitiva">
						<p class="title-estado-iniciativa">Núm. INFOLEJ</p>
						<p class="subtitle-estado-iniciativa">INFOLEJ: {{$iniciativa->infolej}}/{{$iniciativa->legislatura}}</p>
					</div>
					<div class="text-card-estado-inicitiva">
						<p class="title-estado-iniciativa">Estado de la iniciativa</p>
						<p class="subtitle-estado-iniciativa">
							<?php if($iniciativa->estados_procesales && count($iniciativa->estados_procesales) >0){
								echo $iniciativa->estados_procesales[0]->nombre_estado;
							}?>
						</p>
					</div>
					<div class="text-card-estado-inicitiva">
						<p class="title-estado-iniciativa">Condición de estado :</p>
						<p class="subtitle-estado-iniciativa">
							<?php if($iniciativa->estados_procesales && count($iniciativa->estados_procesales) >0){
								echo $iniciativa->estados_procesales[0]->nombre_fecha;
							}?>
						</p>
					</div>
					<a href="https://periodicooficial.jalisco.gob.mx/" class="link-consultar-diario">Consultarlo en el periódico oficial "El Estado de Jalisco" <i class="fas fa-chevron-right"></i>
					</a>
				</div>
			</div>
			<?php if($iniciativa->url_video != null && $iniciativa->url_video!= "" && $iniciativa->descripcion_video != null && $iniciativa->descripcion_video != ""){?>

			
				<div class="card container-card-detalle-iniciativa">
					<div class="card-body">
						<div class="text-card-estado-inicitiva">
							<p class="title--video-card-iniciativa">Conoce más de la iniciativa</p>
						</div>
						<div class="mb-2">
							<iframe width="100%" height="170px" src="{{$iniciativa->url_video}}"
								frameborder="0"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen></iframe>
						</div>
						<p class="text--canal">{{$iniciativa->descripcion_video}}
						</p>
					</div>
				</div>
			<?php }?>
			<div class="card container-card-detalle-iniciativa">
				<div class="card-body">
					<div class="text-card-estado-inicitiva">
						<p class="title-registrate--card-iniciativa">Suscríbete para recibir información de esta
							iniciativa</p>
					</div>
					<form class="form-suscripcion" id="form-suscripcion">
					{{ csrf_field() }}
						<input type="hidden" class="form-control comentarios" id="idi" name="idi" value="{{$iniciativa->infolej}}">
						<input type="hidden" class="form-control comentarios" id="idp" name="idp" value="{{$iniciativa->id_principal}}">
						<div class="form-group text-form-registrate">
							<label for="formGroupExampleInput">Nombre</label>
							<input type="text" class="form-control" id="formGroupExampleInput" name="nombre">
						</div>
						<div class="form-group text-form-registrate">
							<label for="exampleInputEmail1">Correo electrónico</label>
							<input type="email" class="form-control" id="exampleInputEmail1"
								aria-describedby="emailHelp" name="email">
						</div>
						
					</form>
					<button id="suscripcion" idi="{{$iniciativa->infolej}}" idp="{{$iniciativa->id_principal}}" class="btn-registrate ">REGISTRATE</button>
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


		/*función que crea un comentario en una  iniciativa*/
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

		//Función que crea una suscripcion en una iniciativa
		$('body').off('click',"#suscripcion");
		$('body').on('click', '#suscripcion', function () {
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			
			$("#preloader").css("display", "block");
			var form = $("#form-suscripcion")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				url: SITEURL + "/suscripcion",
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

		//$('#table_comentarios').DataTable().on("draw", function(){
		   $('.expandable p').expander({
			  slicePoint: 50, // si eliminamos por defecto es 100 caracteres
			  expandText: '[Leer más]', // por defecto es 'read more...'
			  collapseTimer: 0, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
			  userCollapseText: '[Cerrar]' // por defecto es 'read less...'
			});
		//})

	});
</script>
@endsection