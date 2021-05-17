@extends('app')

@section('content')
<div class="modal fade" id="action_usuario" tabindex="-1" usuarioe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " usuarioe="document">
		<form id="form_usuario" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_usuario">Agregar nuevo usuario</span><span id="ide_usuario"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label for="inputAddress">Email</label>
							<input type="email" class="form-control validation" id="email" name="email">
						</div>
						<div class="form-row" id="password_data">
							<div class="form-group col-md-6">
								<label>Password</label>
								<input type="password" class="form-control validation" id="password" name="password" placeholder="Contraseña">
							</div>
							<div class="form-group col-md-6">
								<label >Confirmar Password</label>
								<input type="password" class="form-control validation" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
							</div>
						</div>
						<div class="form-group">
							<label >Nombre</label>
							<input type="text" class="form-control validation" id="nombre_usuario" name="nombre" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress2">Apelido Paterno</label>
							<input type="text" class="form-control validation" id="apellido_p" name="apellido_p" placeholder="">
						</div>
						<div class="form-group">
							<label>Apelido Materno</label>
							<input type="text" class="form-control validation" id="apellido_m" name="apellido_m" placeholder="">
						</div>
						<div class="form-group">
							<label">Rol</label>
							<select class="form-control input-materialize" name="rol" id="rol_usuario">
								<option value="Usuario">Usuario</option>
								<option value="Administrador">Administrador</option>
								
							</select>
						</div>
						<div class="form-group">
							<label">Comisión a la que pertenece</label>
							<select class="form-control input-materialize" name="id_comision" id="id_comision">
								<option value="">Selecciona una comisión</option>
								<?php foreach ($comisiones as $key => $value) {
									echo '<option value="'.$value->id_comision.'">'.$value->nombre_comision.'</option>';
								}?>
							</select>
						</div>
						
						
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_usuario" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_usuario" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="action_usuario_pass" tabindex="-1" usuarioe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " usuarioe="document">
		<form id="form_usuario_pass" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_usuario_pass">Cambiar contraseña</span><span id="ide_usuario_pass"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword4">Password</label>
								<input type="password" class="form-control validation" id="password" name="password" placeholder="Contraseña">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Confirmar Password</label>
								<input type="password" class="form-control validation" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="save_usuario_pass" class="btn btn-principal-modal">ACTUALIZAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="action_terminologia" tabindex="-1" terminologiae="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " terminologiae="document">
		<form id="form_terminologia" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_terminologia">Agregar nueva terminología</span><span id="ide_terminologia"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label for="inputAddress">Nombre de la terminología</label>
							<input type="text" class="form-control validation" id="nombre_terminologia" name="nombre" placeholder="">
						</div>
						
						<div class="form-group">
							<label for="inputAddress">Definición</label>
							<textarea type="text" class="form-control validation" id="definicion_terminologia" name="definicion" placeholder=""></textarea>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_terminologia" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_terminologia" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="action_video" tabindex="-1" videoe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " videoe="document">
		<form id="form_video" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_video">Agregar nuevo vídeo</span><span id="ide_video"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label for="inputAddress">Nombre del vídeo</label>
							<input type="text" class="form-control validation" id="nombre_video" name="nombre" placeholder="">
						</div>
						
						<div class="form-group">
							<label for="inputAddress">Descripción</label>
							<textarea type="text" class="form-control validation" id="descripcion_video" name="descripcion" placeholder=""></textarea>
						</div>
						 <div class="form-group">
							<label for="inputAddress">Link <br><small>El link del vídeo debe de ser de Youtube, para obtenerlo, debes buscar en tu vídeo en Youtube la opción de compartir, posteriormente seleccionar insertar, y buscar el link que está dentro de la etiqueta SRC</small></label>
							<input type="text" class="form-control validation" id="link_video" name="link" placeholder="">
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_video" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_video" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="action_iniciativa" tabindex="-1" iniciativae="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " iniciativae="document">
		<form id="form_iniciativa" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_iniciativa">Agregar nueva iniciativa</span><span id="ide_iniciativa"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label for="inputAddress">Nombre de la iniciativa</label>
							<input type="text" class="form-control validation" id="nombre_iniciativa" name="nombre" placeholder="">
						</div>
						
						<div class="form-group">
							<label for="inputAddress">Url Imagen</label> 
							<a class="text-decoration-none" data-toggle="collapse" href="#ver_imagen_actual" role="button" aria-expanded="false"><span class="p-1 pt-2 pb-2" id="texto_ver_imagen_actual"></span>

							</a>
							<div class="collapse" id="ver_imagen_actual">
							</div>
							
							<input type="file" class="form-control validation" id="url_imagen_iniciativa" name="file" accept="image/*" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Link vídeo 
								<br><small>El link del vídeo debe de ser de Youtube, para obtenerlo, debes buscar en tu vídeo en Youtube la opción de compartir, posteriormente seleccionar insertar, y buscar el link que está dentro de la etiqueta SRC</small>
							</label>
							<input type="text" class="form-control validation" id="url_video_iniciativa" name="url_video" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Descripción vídeo </label>
							<input type="text" class="form-control validation" id="descripcion_video_iniciativa" name="descripcion_video" placeholder="">
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_iniciativa" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_iniciativa" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="action_comentario" tabindex="-1" comentarioe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " comentarioe="document">
		<form id="form_comentario" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_comentario">Detalle comentario</span><span id="ide_comentario"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label>Nombre del usuario</label>
							<input type="text" class="form-control validation" id="usuario_nombre">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control validation" id="usuario_email" name="nombre" placeholder="">
						</div>
						
						<div class="form-group">
							<label>Comentario</label>
							<input type="text" class="form-control validation" id="usuario_comentario">
						</div>
						<div class="form-group">
							<label>Archivo</label>
							<button class="btn btn-purple"><i class="far fa-file"></i></button>
						</div>
						<div class="form-group">
							<label>Fecha comentario</label>
							<input type="text" class="form-control validation" id="usuario_comentario_fecha">
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Check me out</label>
						  </div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_comentario" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_comentario" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="action_dato" tabindex="-1" datoe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog " datoe="document">
		<form id="form_dato" autocomplete="off" autocomplete="nope">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header ">
					<h5 class="modal-title" id="exampleModalLabel"><span id="title_modal_dato">Agregar nueva terminología</span><span id="ide_dato"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">

						<div class="form-group">
							<label for="inputAddress">Título</label>
							<input type="text" class="form-control validation" id="titulo_dato" name="titulo" placeholder="">
						</div>
						<div class="form-group">
							<label">Categoría</label>
							<select class="form-control input-materialize" name="categoria" id="categoria_dato">
								<?php foreach ($categorias_datos as $key => $value) {
									echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
								}?>
								
							</select>
						</div>

						<div class="form-group">
							<label for="inputAddress">Descripción</label>
							<textarea type="text" class="form-control validation" id="descripcion_dato" name="descripcion" placeholder=""></textarea>
						</div>
						<div class="form-group">
							<label for="inputAddress">Imagen</label>
							<a class="text-decoration-none" data-toggle="collapse" href="#ver_imagen_actual_dato" role="button" aria-expanded="false"><span class="p-1 pt-2 pb-2" id="texto_ver_imagen_actual_dato"></span>

							</a>
							<div class="collapse" id="ver_imagen_actual_dato">
							</div>
							<input type="file" class="form-control validation" id="url_imagen_dato" name="file" accept="image/*" placeholder="">
						</div>
						
						<div class="form-group">
							<label for="inputAddress">Link</label>
							<input type="text" class="form-control validation" id="link_dato" name="link" placeholder="">
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark-modal " data-dismiss="modal">CANCELAR</button>
					<button type="button" ide="" nme="" id="create_dato" class="btn btn-principal-modal">CREAR</button>
					<button type="button" ide="" nme="" id="save_dato" class="btn btn-principal-modal">GUARDAR</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="" style="height: 100px; background:var(--purple-primary);">
	
</div>
<section>
	<div class="row p-5">
		<?php
		
		if(Auth::user()->hasRole("Administrador") == true){?>
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Usuarios</h5>
						</div>
						<div class="button-card-header">
						   <button id="new_usuario" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo usuario</button>   
						</div>
						 <small>Aquí podrás añadir, modificar o eliminar los usuarios que tienen acceso solo a la sesión de las configuraciones</small>
					</div>
					<div class="card-body">

						<table id="table_usuarios" class="table dataTable table-striped" style="width:100%; height: 20rem">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col" class="">Nombre</th>
								<th scope="col">Email</th>
								<th scope="col">Rol</th>
								<th scope="col">Comisión a la que pertenece</th>
								
								<th scope="col" class="centrar">Acciones</th>
								

							</tr>
						</thead>
						<tbody class="list-modulo-usuarios">  
						</tbody>
					</table>

					</div>
				</div>
			</div>
		<?php }?>
	</div>
	<div class="row p-5">
		<div class="col-md-12">
			<div class="card card-sombra">
				<div class="card-header content-card-header">
					<div class="title-card-header">
					   <h5>Vídeos</h5>

					</div>
					<div class="button-card-header">
					   <button id="new_video" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo vídeo</button>   
					</div>
					 <small>Aquí podrás añadir, modificar o eliminar los vídeos que aparecen en el HOME en la parte inferior (Máximo 3 vídeos)</small>
					
				</div>
				<div class="card-body">

					<table id="table_videos" class="table dataTable table-striped" style="width:100%; height: 20rem">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col" class="">Nombre</th>
							<th scope="col">Descripcion</th>
							<th scope="col" class="">Link</th>
							<th scope="col" class="centrar">Acciones</th>
							

						</tr>
					</thead>
					<tbody class="list-modulo-videos">  
					</tbody>
				</table>

				</div>
			</div>
		</div>
		
	</div>
	<div class="row p-5">
		
		
		<div class="col-md-12">
			<div class="card card-sombra">
				<div class="card-header content-card-header">
					<div class="title-card-header">
					   <h5>Iniciativas</h5>
					</div>
					
					 <small>Aquí podrás modificar o eliminar los elementos extras de las iniciativas (Una iniciativa nunca se podrá eliminar, solo los elementos extras que aparecen ahí)</small>
					
				</div>
				<div class="card-body">

					<table id="table_iniciativas" class="table dataTable table-striped" style="width:100%; height: 20rem">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col" class="">Nombre</th>
							<th scope="col">Id principal</th>
							<th scope="col" class="">Infolej</th>
							<th scope="col" class="">Url Imagen</th>
							<th scope="col" class="">Link vídeo</th>
							<th scope="col" class="">Descripción vídeo</th>
							<th scope="col" class="centrar">Acciones</th>
							

						</tr>
					</thead>
					<tbody class="list-modulo-iniciativas">  
					</tbody>
				</table>

				</div>
			</div>
		</div>
	  
		
	</div>
	<div class="row p-5">
		<div class="col-md-12">
			<div class="card card-sombra">
				<div class="card-header content-card-header">
					<div class="title-card-header">
					   <h5>Comentarios</h5>
					</div>
					
					 <small>Aquí sólo podrás aprobar los comentarios. <br>Recuerda que solo los comentarios aprobados son los que mostrarán en las iniciativas</small>
					
				</div>
				<div class="card-body">

					<table id="table_comentarios" class="table dataTable table-striped" style="width:100%; height: 20rem">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Folio</th>
							<th scope="col">Aprobar</th>
							<th scope="col" class="">Comisión</th>
							<th scope="col" class="">Iniciativa</th>
							<th scope="col" class="">Usuario</th>
							<th scope="col">Comentario</th>
							<th scope="col">Fecha comentario</th>
							
							

						</tr>
					</thead>
					<tbody class="list-modulo-terminologias">  
					</tbody>
				</table>

				</div>
			</div>
		</div>
	</div>
	<?php
		
	if(Auth::user()->hasRole("Administrador") == true){?>
		<div class="row p-5">
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Terminologías</h5>
						</div>
						<div class="button-card-header">
						   <button id="new_terminologia" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nueva terminología</button>   
						</div>
						 <small>Aquí podrás añadir, editar o eliminar una terminología. Dichas terminologías son las que aparecen en la sección de congreso</small>
						
					</div>
					<div class="card-body">

						<table id="table_terminologias" class="table dataTable table-striped" style="width:100%; height: 20rem">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col" class="">Nombre</th>
								<th scope="col">Definición</th>
								<th scope="col" class="centrar">Acciones</th>
								

							</tr>
						</thead>
						<tbody class="list-modulo-terminologias">  
						</tbody>
					</table>

					</div>
				</div>
			</div>
			

		</div>
		<div class="row p-5">
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Datos abiertos</h5>
						</div>
						<div class="button-card-header">
						   <button id="new_dato" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo dato</button>   
						</div>
						 <small>Aquí podrás añadir, editar o eliminar un dato. Dichos datos son los que aparecen en la sección de Datos Abiertos</small>
						
					</div>
					<div class="card-body">

						<table id="table_datos" class="table dataTable table-striped" style="width:100%; height: 20rem">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col" class="">Título</th>
								<th scope="col" class="">Categoría</th>
								<th scope="col">Descripción</th>
								<th scope="col">Imagen</th>
								<th scope="col">Link</th>
								<th scope="col" class="centrar">Acciones</th>
								

							</tr>
						</thead>
						<tbody class="list-modulo-datos">  
						</tbody>
					</table>

					</div>
				</div>
			</div>
			

		</div>
	<?php }?>
</section>

@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		
		var SITEURL = '{{URL::to('')}}'; 
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		var oTable = $('#table_usuarios').DataTable(); 
		oTable.destroy();

		var table_usuarios = $('#table_usuarios').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_usuarios",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			{
				"className": 'details-control',
				"orderable": true,
				"data": null,
				render:function(data, type, row)
				{
					var z = data["RowNumY"] % 5;
					
					color = "nombreusuario-color"+z;
					
						return "<span class='"+color+"'>"+data["nombre"].substr(0, 1).toUpperCase()+data["apellido_p"].substr(0, 1).toUpperCase()+"</span>";
					
				},
			},
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					
					
					return data["nombre"]+" "+data["apellido_p"]+" "+data["apellido_m"];
				},
			},

			{ data: "email" },
			{ data: "rol" },
			{ data: "nombre_comision" },
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					var col = "";
						col = col+ "<button type='button' class='btn btn-light-blue edit_usuario' nme='"+data["email"]+"' ide='"+data["id"]+"' ><i class='fa fa-edit'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-red delete_usuario' nme='"+data["email"]+"' ide='"+data["id"]+"' ><i class='far fa-trash-alt'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-blue change_pass' nme='"+data["email"]+"' ide='"+data["id"]+"' ><i class='fas fa-key'></i></button>";
					return col;
				},
			},

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
			
		});

		$('#action_usuario').off('hidden.bs.modal');
		$("#action_usuario").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
		});
		/*  función para eliminar un usuario*/
		$('body').off('click',".delete_usuario");
		$('body').on('click', '.delete_usuario', function () {
			var id_usuario = $(this).attr("ide");
			var nme = $(this).attr("nme");
			bootbox.confirm({
				message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea eliminar este usuario: <b>"+nme+"</b>?</p>",
				buttons: {
					confirm: {
						label: 'CONTINUAR',
						className: 'btn-principal-modal'
					},
					cancel: {
						label: 'CANCELAR',
						className: 'btn-outline-dark-modal'
					}
				},
				callback: function (result) {
					if(result == true){
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_usuario/"+id_usuario,
							success: function (data) {
								if(data.status == "200"){
									var oTable = $('#table_usuarios').DataTable(); 
									oTable.ajax.reload();
									bootbox.alert("¡Usuario eliminado con éxito!");
								}
								else if (data.status == "422"){
									var error = data.msg;
									var mensaje = "";
									for (var i in error) {
										var error_msg = error[i];
										mensaje = mensaje + error_msg+"<br>";
									}
									bootbox.alert(mensaje);
								}else{
									bootbox.alert("¡Error al eliminar el usuario!");
								}
							},
							error: function (data) {
								console.log('Error:', data);
								bootbox.alert("¡Error al eliminar el usuario!");
							},
							complete: function(){
								setTimeout(function() {
									$("#preloader").fadeOut(500);
								},200);
							}
						});
					}
				}
			}); 
		});
		/*función para lanzar modal para editar un usuario*/
		$('body').off('click', ".edit_usuario");
		$('body').on('click', '.edit_usuario', function () {
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme");
			var id_usuario = $(this).attr("ide");
			$("#save_usuario").attr("ide", id_usuario);
			$("#title_modal_usuario").html("Actualizar usuario: <b>"+nme+"</b>");
			$("#create_usuario").css("display", "none");
			$("#save_usuario").css("display", "block");
			$.ajax({
				type: "get",
				url: SITEURL + "/configuraciones/get_usuario/"+id_usuario,
				data:{},
				success: function (data) {
					console.log(data);
					$("#apellido_p").val(data["apellido_p"]);
					$("#email").val(data["email"]);
					$("#apellido_m").val(data["apellido_m"]);
					$("#rol_usuario").val(data["rol"]);
					$("#id_comision").val(data["id_comision"]);
					$("#action_usuario").modal();
					$("#nombre_usuario").val(data["nombre"]);
					$("#id_comision").val(data["id_comision"]).trigger("change");
					$("#password_data").css("display", "none");
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del usuario!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});
		/*función para editar un usuario*/ 
		$('body').off('click',"#save_usuario");
		$('body').on('click', '#save_usuario', function () {
			var id_usuario = $("#save_usuario").attr("ide");
			var nombre_usuario = $("#nombre_usuario").val();
			var formulario = $("#form_usuario").serialize();
			
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_usuario/"+id_usuario,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_usuario").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Usuario actualizado con éxito!");
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar el usuario!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar el usuario!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear usuario*/
		$('body').off('click',"#new_usuario");
		$('body').on('click', '#new_usuario', function () {
			$("#title_modal_usuario").html("<b>Crear usuario</b>");
			$("#create_usuario").css("display", "block");
			$("#save_usuario").css("display", "none");
			$("#password_data").css("display", "flex");
			$("#action_usuario").modal();
		});
		/*función que crea un usuario*/
		$('body').off('click',"#create_usuario");
		$('body').on('click', '#create_usuario', function () {
			var nombre_usuario = $("#nombre_usuario").val();
			var formulario = $("#form_usuario").serialize();
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/create_usuario",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_usuario").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Usuario añadido con éxito!");
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al añadir el usuario!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al añadir el usuario!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		//change_pass
		$('body').off('click',".change_pass");
		$('body').on('click', '.change_pass', function () {
			var id_usuario = $(this).attr("ide");
			$("#save_usuario_pass").attr("ide", id_usuario);
			$("#action_usuario_pass").modal();
		});
		/*función para editar contraseña de un usuario*/ 
		$('body').off('click',"#save_usuario_pass");
		$('body').on('click', '#save_usuario_pass', function () {
			var id_usuario = $("#save_usuario_pass").attr("ide");
			var formulario = $("#form_usuario_pass").serialize();
			
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_usuario_pass/"+id_usuario,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_usuario_pass").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Contraseña de usuario actualizado con éxito!");
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar la contraseña del usuario!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar la contraseña del usuario!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		//TERMINOLOGÍAS
		var oTable = $('#table_terminologias').DataTable(); 
		oTable.destroy();

		var table_terminologias = $('#table_terminologias').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_terminologias",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			
			

			{ data: "nombre" },
			{
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					
					
					return data["definicion"];
				},
			},
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					var col = "";
						col = col+ "<button type='button' class='btn btn-light-blue edit_terminologia' nme='"+data["nombre"]+"' ide='"+data["id"]+"' ><i class='fa fa-edit'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-red delete_terminologia' nme='"+data["nombre"]+"' ide='"+data["id"]+"' ><i class='far fa-trash-alt'></i></button>";
					
					return col;
				},
			},

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
			
		});

		$('#action_terminologia').off('hidden.bs.modal');
		$("#action_terminologia").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
		});
		/*  función para eliminar un terminologia*/
		$('body').off('click',".delete_terminologia");
		$('body').on('click', '.delete_terminologia', function () {
			var id_terminologia = $(this).attr("ide");
			var nme = $(this).attr("nme");
			bootbox.confirm({
				message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea eliminar esta terminología: <b>"+nme+"</b>?</p>",
				buttons: {
					confirm: {
						label: 'CONTINUAR',
						className: 'btn-principal-modal'
					},
					cancel: {
						label: 'CANCELAR',
						className: 'btn-outline-dark-modal'
					}
				},
				callback: function (result) {
					if(result == true){
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_terminologia/"+id_terminologia,
							success: function (data) {
								if(data.status == "200"){
									var oTable = $('#table_terminologias').DataTable(); 
									oTable.ajax.reload();
									bootbox.alert("¡Terminología eliminada con éxito!");
								}
								else if (data.status == "422"){
									var error = data.msg;
									var mensaje = "";
									for (var i in error) {
										var error_msg = error[i];
										mensaje = mensaje + error_msg+"<br>";
									}
									bootbox.alert(mensaje);
								}else{
									bootbox.alert("¡Error al eliminar la terminología!");
								}
							},
							error: function (data) {
								console.log('Error:', data);
								bootbox.alert("¡Error al eliminar la terminología!");
							},
							complete: function(){
								setTimeout(function() {
									$("#preloader").fadeOut(500);
								},200);
							}
						});
					}
				}
			}); 
		});
		/*función para lanzar modal para editar un terminologia*/
		$('body').off('click', ".edit_terminologia");
		$('body').on('click', '.edit_terminologia', function () {
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme");
			var id_terminologia = $(this).attr("ide");
			$("#save_terminologia").attr("ide", id_terminologia);
			$("#title_modal_terminologia").html("Actualizar terminología: <b>"+nme+"</b>");
			$("#create_terminologia").css("display", "none");
			$("#save_terminologia").css("display", "block");
			$.ajax({
				type: "get",
				url: SITEURL + "/configuraciones/get_terminologia/"+id_terminologia,
				data:{},
				success: function (data) {
					$("#nombre_terminologia").val(data["nombre"]);
					$("#definicion_terminologia").val(data["definicion"]);
					$("#action_terminologia").modal();
					
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información de la terminología!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});
		/*función para editar un terminologia*/ 
		$('body').off('click',"#save_terminologia");
		$('body').on('click', '#save_terminologia', function () {
			var id_terminologia = $("#save_terminologia").attr("ide");
			var nombre_terminologia = $("#nombre_terminologia").val();
			var formulario = $("#form_terminologia").serialize();
			
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_terminologia/"+id_terminologia,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_terminologia").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Terminología actualizada con éxito!");
						var oTable = $('#table_terminologias').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar la terminología!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar la terminología!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear terminologia*/
		$('body').off('click',"#new_terminologia");
		$('body').on('click', '#new_terminologia', function () {
			$("#title_modal_terminologia").html("<b>Crear terminología</b>");
			$("#create_terminologia").css("display", "block");
			$("#save_terminologia").css("display", "none");
			$("#action_terminologia").modal();
		});
		/*función que crea un terminologia*/
		$('body').off('click',"#create_terminologia");
		$('body').on('click', '#create_terminologia', function () {
			var nombre_terminologia = $("#nombre_terminologia").val();
			var formulario = $("#form_terminologia").serialize();
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/create_terminologia",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_terminologia").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Terminología añadida con éxito!");
						var oTable = $('#table_terminologias').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al añadir la terminología!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al añadir la terminología!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});


		/*VIDEOS HOME*/
		var oTable = $('#table_videos').DataTable(); 
		oTable.destroy();

		var table_videos = $('#table_videos').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_videos",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			{ data: "nombre" },  
			{ data: "descripcion" },          
			{ data: "link" },
			
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					var col = "";
						col = col+ "<button type='button' class='btn btn-light-blue edit_video' nme='"+data["nombre"]+"' ide='"+data["id"]+"' ><i class='fa fa-edit'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-red delete_video' nme='"+data["nombre"]+"' ide='"+data["id"]+"' ><i class='far fa-trash-alt'></i></button>";
					
					return col;
				},
			},

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
			
		});

		$('#action_video').off('hidden.bs.modal');
		$("#action_video").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
		});
		/*  función para eliminar un video*/
		$('body').off('click',".delete_video");
		$('body').on('click', '.delete_video', function () {
			var id_video = $(this).attr("ide");
			var nme = $(this).attr("nme");
			bootbox.confirm({
				message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea eliminar este vídeo: <b>"+nme+"</b>?</p>",
				buttons: {
					confirm: {
						label: 'CONTINUAR',
						className: 'btn-principal-modal'
					},
					cancel: {
						label: 'CANCELAR',
						className: 'btn-outline-dark-modal'
					}
				},
				callback: function (result) {
					if(result == true){
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_video/"+id_video,
							success: function (data) {
								if(data.status == "200"){
									var oTable = $('#table_videos').DataTable(); 
									oTable.ajax.reload();
									bootbox.alert("¡Vídeo eliminado con éxito!");
								}
								else if (data.status == "422"){
									var error = data.msg;
									var mensaje = "";
									for (var i in error) {
										var error_msg = error[i];
										mensaje = mensaje + error_msg+"<br>";
									}
									bootbox.alert(mensaje);
								}else{
									bootbox.alert("¡Error al eliminar el vídeo!");
								}
							},
							error: function (data) {
								console.log('Error:', data);
								bootbox.alert("¡Error al eliminar el vídeo!");
							},
							complete: function(){
								setTimeout(function() {
									$("#preloader").fadeOut(500);
								},200);
							}
						});
					}
				}
			}); 
		});
		/*función para lanzar modal para editar un video*/
		$('body').off('click', ".edit_video");
		$('body').on('click', '.edit_video', function () {
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme");
			var id_video = $(this).attr("ide");
			$("#save_video").attr("ide", id_video);
			$("#title_modal_video").html("Actualizar vídeo: <b>"+nme+"</b>");
			$("#create_video").css("display", "none");
			$("#save_video").css("display", "block");
			$.ajax({
				type: "get",
				url: SITEURL + "/configuraciones/get_video/"+id_video,
				data:{},
				success: function (data) {
					$("#nombre_video").val(data["nombre"]);
					$("#descripcion_video").val(data["descripcion"]);
					$("#link_video").val(data["link"]);
					$("#action_video").modal();
				   
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del vídeo!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});
		/*función para editar un video*/ 
		$('body').off('click',"#save_video");
		$('body').on('click', '#save_video', function () {
			var id_video = $("#save_video").attr("ide");
			var nombre_video = $("#nombre_video").val();
			var formulario = $("#form_video").serialize();
			
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_video/"+id_video,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_video").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Vídeo actualizado con éxito!");
						var oTable = $('#table_videos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar el vídeo!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar el vídeo!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear video*/
		$('body').off('click',"#new_video");
		$('body').on('click', '#new_video', function () {
			$("#title_modal_video").html("<b>Crear vídeo</b>");
			$("#create_video").css("display", "block");
			$("#save_video").css("display", "none");
			$("#action_video").modal();
		});
		/*función que crea un video*/
		$('body').off('click',"#create_video");
		$('body').on('click', '#create_video', function () {
			var nombre_video = $("#nombre_video").val();
			var formulario = $("#form_video").serialize();
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/create_video",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_video").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Vídeo añadido con éxito!");
						var oTable = $('#table_videos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al añadir el vídeo!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al añadir el vídeo!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});


		//INICIATIVAS
		var oTable = $('#table_iniciativas').DataTable(); 
		oTable.destroy();

		var table_iniciativas = $('#table_iniciativas').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_iniciativas",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{	
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			{ data: "nombre"},  
			{ data: "id_principal" },
			{ data: "infolej" },

			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					if(data["url_imagen"] != null && data["url_imagen"]!= ""){
						var url = "{{URL::to('')}}";
						return url+""+data["url_imagen"];
					}else{
						return "";
					}
					
					
					
				},
			}, 
			{ data: "url_video"},  
			{ data: "descripcion_video" },
			
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					var col = "";
						col = col+ "<button type='button' class='btn btn-light-blue edit_iniciativa' nme='"+data["nombre"]+"' idp='"+data["id_principal"]+"' idi='"+data["infolej"]+"' ><i class='fa fa-edit'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-red delete_iniciativa' nme='"+data["nombre"]+"' idp='"+data["id_principal"]+"' idi='"+data["infolej"]+"' ><i class='far fa-trash-alt'></i></button>";
					
					return col;
				},
			},

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
		});

		$('#action_iniciativa').off('hidden.bs.modal');
		$("#action_iniciativa").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
			$("#ver_imagen_actual").html("");
			$("#texto_ver_imagen_actual").html("");
		});
		/*  función para eliminar un iniciativa*/
		$('body').off('click',".delete_iniciativa");
		$('body').on('click', '.delete_iniciativa', function () {
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			var nme = $(this).attr("nme");
			bootbox.confirm({
				message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea eliminar esta iniciativa?</p>",
				buttons: {
					confirm: {
						label: 'CONTINUAR',
						className: 'btn-principal-modal'
					},
					cancel: {
						label: 'CANCELAR',
						className: 'btn-outline-dark-modal'
					}
				},
				callback: function (result) {
					if(result == true){
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_iniciativa/"+idp+"/"+idi,
							success: function (data) {
								if(data.status == "200"){
									var oTable = $('#table_iniciativas').DataTable(); 
									oTable.ajax.reload();
									bootbox.alert("¡Datos extras de iniciativa eliminados con éxito!");
								}
								else if (data.status == "422"){
									var error = data.msg;
									var mensaje = "";
									for (var i in error) {
										var error_msg = error[i];
										mensaje = mensaje + error_msg+"<br>";
									}
									bootbox.alert(mensaje);
								}else{
									bootbox.alert("¡Error al eliminar los datos extras de la iniciativa!");
								}
							},
							error: function (data) {
								console.log('Error:', data);
								bootbox.alert("¡Error al eliminar los datos extras de la iniciativa!");
							},
							complete: function(){
								setTimeout(function() {
									$("#preloader").fadeOut(500);
								},200);
							}
						});
					}
				}
			}); 
		});
		/*función para lanzar modal para editar un iniciativa*/
		$('body').off('click', ".edit_iniciativa");
		$('body').on('click', '.edit_iniciativa', function () {
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme");
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			$("#save_iniciativa").attr("idp", idp);
			$("#save_iniciativa").attr("idi", idi);
			$("#title_modal_iniciativa").html("Actualizar iniciativa: <b>Infolej "+idi+"</b>");
			$("#create_iniciativa").css("display", "none");
			$("#save_iniciativa").css("display", "block");
			$.ajax({
				type: "get",
				url: SITEURL + "/configuraciones/get_iniciativa/"+idp+"/"+idi,
				data:{},
				success: function (data) {
					$("#nombre_iniciativa").val(data["nombre"]);
					$("#idp_iniciativa").val(data["id_principal"]);
					$("#idi_iniciativa").val(data["infolej"]);
					$("#url_video_iniciativa").val(data["url_video"]);

					if(data["url_imagen"] != "" && data["url_imagen"] != null){
						var url = "{{asset('')}}"+data["url_imagen"];
						$("#ver_imagen_actual").append("<img width='95%' src='"+url+"'>");
						$("#texto_ver_imagen_actual").append("Ver imagen actual");
						
					}
					$("#descripcion_video_iniciativa").val(data["descripcion_video"]);
					$("#action_iniciativa").modal();
				   
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información de la iniciativa!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});
		/*función para editar un iniciativa*/ 
		$('body').off('click',"#save_iniciativa");
		$('body').on('click', '#save_iniciativa', function () {
			var idp = $(this).attr("idp");
			var idi = $(this).attr("idi");
			var nombre_iniciativa = $("#nombre_iniciativa").val();
			
			$("#preloader").css("display", "block");
			var form = $("#form_iniciativa")[0];
			var formulario = new FormData(form);


			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_iniciativa/"+idp+"/"+idi,
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){
						$("#action_iniciativa").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Iniciativa actualizada con éxito!");
						var oTable = $('#table_iniciativas').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar la iniciativa!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar la iniciativa!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear iniciativa*/
		$('body').off('click',"#new_iniciativa");
		$('body').on('click', '#new_iniciativa', function () {
			$("#title_modal_iniciativa").html("<b>Crear iniciativa</b>");
			$("#create_iniciativa").css("display", "block");
			$("#save_iniciativa").css("display", "none");
			$("#action_iniciativa").modal();
		});
		/*función que crea un iniciativa*/
		$('body').off('click',"#create_iniciativa");
		$('body').on('click', '#create_iniciativa', function () {
			var nombre_iniciativa = $("#nombre_iniciativa").val();
			var formulario = $("#form_iniciativa").serialize();
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/create_iniciativa",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){
						$("#action_iniciativa").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Iniciativa añadida con éxito!");
						var oTable = $('#table_iniciativas').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al añadir la iniciativa!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al añadir la iniciativa!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		//COMENTARIOS
		var oTable = $('#table_comentarios').DataTable(); 
		oTable.destroy();

		var table_comentarios = $('#table_comentarios').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_comentarios",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			{
				"className": 'text-center',
				"data": null,
				render:function(data, type, row)
				{
					var iniciativa = "";
					var file = "";
					if(data["usuario_url_file"] != null && data["usuario_url_file"]!= ""){
						var url = "{{URL::to('')}}";
						file =  '<a href="'+url+'/get_file_comentario/'+data["id"]+'" target="_blank"><button class="btn btn-purple ver_archivo" ide="'+data["id"]+'"><i class="far fa-file"></i></button></a>';
					}else{
						file =  "";
					}

					return "COM"+data["folio_comentario"]+"<br>"+file;
					
					
					
				},
			},  
			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					var disabled = "";
					var checked = "";
					if(data["aprobado"] == 1){
						disabled = "disabled";
						checked = "checked";
					}
					return '<div class="form-check">'+
						'<input '+disabled+' '+checked+' type="checkbox" class="form-check-input aprobar_comentario" ide="'+data["id"]+'" id="aprobar_comentario'+data["RowNumY"]+'">'+
						'<label class="form-check-label" for="aprobar_comentario'+data["RowNumY"]+'">Aprobar</label>'+
					'</div>';
					
					
					
				},
			}, 
			
			{ data: "comision" },  
			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					var iniciativa = "";
					if(data["iniciativa"] != null && data["iniciativa"] != "" && data["iniciativa"].length > 0 ){
						iniciativa = "<b>Iniciativa:</b> "+data["iniciativa"]+"<br>";
					}
					return iniciativa+"<b>Infolej:</b> "+data["infolej"]+"<br><b>Id principal:</b>"+data["id_principal"];
					
					
					
				},
			},   
			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					return "<b>Nombre:</b>"+data["usuario_nombre"]+"<br><b>Email:</b>"+data["usuario_email"];
				},
			}, 
			{
				"width:":50,
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					return '<div class="expandable text-justify">'+
					'<p>'+data["usuario_comentario"]+'</p>'+
					'</div>';
				},
			},   
			{ data: "fecha_creacion" },

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			"autoWidth": false,
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
			
		});

		$('body').off('change',".aprobar_comentario");
		$('body').on('change', '.aprobar_comentario', function () {
			var ide = $(this).attr("ide");
			var checkbox = $(this);
			if($(this).is(":checked")) {
				bootbox.confirm({
					message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea aprobar este comentario?</p>",
					buttons: {
						confirm: {
							label: 'CONTINUAR',
							className: 'btn-principal-modal'
						},
						cancel: {
							label: 'CANCELAR',
							className: 'btn-outline-dark-modal'
						}
					},
					callback: function (result) {
						if(result == true){
							$("#preloader").css("display", "block");
							$.ajax({
								type: "post",
								data:{_token: "{{ csrf_token() }}", ide:ide},
								url: SITEURL + "/configuraciones/aprobar_comentario",
								
								success: function (data) {
									if(data.status == "200"){
										var oTable = $('#table_comentarios').DataTable(); 
										oTable.ajax.reload();
										bootbox.alert("¡Comentario aprobado con éxito!");
									}
									else if (data.status == "422"){
										var error = data.msg;
										var mensaje = "";
										for (var i in error) {
											var error_msg = error[i];
											mensaje = mensaje + error_msg+"<br>";
										}
										bootbox.alert(mensaje);
									}else{
										bootbox.alert("¡Error al aprobar el comentario!");
										$(checkbox).prop("checked", false);
									}
								},
								error: function (data) {
									console.log('Error:', data);
									bootbox.alert("¡Error al aprobar el comentario!");
									$(checkbox).prop("checked", false);
								},
								complete: function(){
									setTimeout(function() {
										$("#preloader").fadeOut(500);
									},200);
								}
							});
						}else{
							$(checkbox).prop("checked", false);
						}
					}
				}); 

			}
		});
		$('#table_comentarios').DataTable().on("draw", function(){
		   $('.expandable p').expander({
			  slicePoint: 50, // si eliminamos por defecto es 100 caracteres
			  expandText: '[Leer más]', // por defecto es 'read more...'
			  collapseTimer: 0, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
			  userCollapseText: '[Cerrar]' // por defecto es 'read less...'
			});
		})
		

		//DATOS
		var oTable = $('#table_datos').DataTable(); 
		oTable.destroy();

		var table_datos = $('#table_datos').dataTable({

			"ajax": {
				"url": SITEURL +"/configuraciones/get_datos",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			{
				"className": '',
				"visible": false,
				"data": null,
				render:function(data, type, row)
				{
					return data["RowNumY"];
					
					
				},
			},
			
			

			{ data: "titulo" },
			{ data: "categoria" },
			{
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					
					
					return data["descripcion"];
				},
			},
			
			{
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					
					
					return data["url_imagen"];
				},
			},
			{
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					
					
					return data["link"];
				},
			},
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					var col = "";
						col = col+ "<button type='button' class='btn btn-light-blue edit_dato' nme='"+data["titulo"]+"' ide='"+data["id"]+"' ><i class='fa fa-edit'></i></button>";
						col = col+ "<button type='button' class='btn btn-light-red delete_dato' nme='"+data["titulo"]+"' ide='"+data["id"]+"' ><i class='far fa-trash-alt'></i></button>";
					
					return col;
				},
			},

			], 

				
			"language": {
				"url": SITEURL +'/DataTables/DataTableSpanish.json',
			},
			paging: true,
			searching: true,
			select: true,
			"scrollX": true,
			"processing" : true,

			
			
		});

		$('#action_dato').off('hidden.bs.modal');
		$("#action_dato").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
			$("#ver_imagen_actual_dato").html("");
			$("#texto_ver_imagen_actual_dato").html("");
		});
		/*  función para eliminar un dato*/
		$('body').off('click',".delete_dato");
		$('body').on('click', '.delete_dato', function () {
			var id_dato = $(this).attr("ide");
			var nme = $(this).attr("nme");
			bootbox.confirm({
				message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea eliminar este dato: <b>"+nme+"</b>?</p>",
				buttons: {
					confirm: {
						label: 'CONTINUAR',
						className: 'btn-principal-modal'
					},
					cancel: {
						label: 'CANCELAR',
						className: 'btn-outline-dark-modal'
					}
				},
				callback: function (result) {
					if(result == true){
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_dato/"+id_dato,
							success: function (data) {
								if(data.status == "200"){
									var oTable = $('#table_datos').DataTable(); 
									oTable.ajax.reload();
									bootbox.alert("¡Dato eliminado con éxito!");
								}
								else if (data.status == "422"){
									var error = data.msg;
									var mensaje = "";
									for (var i in error) {
										var error_msg = error[i];
										mensaje = mensaje + error_msg+"<br>";
									}
									bootbox.alert(mensaje);
								}else{
									bootbox.alert("¡Error al eliminar el dato!");
								}
							},
							error: function (data) {
								console.log('Error:', data);
								bootbox.alert("¡Error al eliminar el dato!");
							},
							complete: function(){
								setTimeout(function() {
									$("#preloader").fadeOut(500);
								},200);
							}
						});
					}
				}
			}); 
		});
		/*función para lanzar modal para editar un dato*/
		$('body').off('click', ".edit_dato");
		$('body').on('click', '.edit_dato', function () {
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme");
			var id_dato = $(this).attr("ide");
			$("#save_dato").attr("ide", id_dato);
			$("#title_modal_dato").html("Actualizar dato: <b>"+nme+"</b>");
			$("#create_dato").css("display", "none");
			$("#save_dato").css("display", "block");
			$.ajax({
				type: "get",
				url: SITEURL + "/configuraciones/get_dato/"+id_dato,
				data:{},
				success: function (data) {
					$("#titulo_dato").val(data["titulo"]);
					$("#descripcion_dato").val(data["descripcion"]);
					if(data["url_imagen"] != "" && data["url_imagen"] != null){
						var url = "{{asset('')}}"+data["url_imagen"];
						$("#ver_imagen_actual_dato").append("<img width='95%' src='"+url+"'>");
						$("#texto_ver_imagen_actual_dato").append("Ver imagen actual");
						
					}
					$("#categoria_dato").val(data["categoria"]).trigger("change");
					$("#link_dato").val(data["link"]);

					$("#action_dato").modal();
					
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del dato!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});
		/*función para editar un dato*/ 
		$('body').off('click',"#save_dato");
		$('body').on('click', '#save_dato', function () {
			$("#preloader").css("display", "block");
			var id_dato = $("#save_dato").attr("ide");
			var nombre_dato = $("#nombre_dato").val();

			var form = $("#form_dato")[0];
			var formulario = new FormData(form);
			
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/update_dato/"+id_dato,
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){
						$("#action_dato").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Dato actualizado con éxito!");
						var oTable = $('#table_datos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al actualizar el dato!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al actualizar el dato!");
				},
				complete: function(){
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear dato*/
		$('body').off('click',"#new_dato");
		$('body').on('click', '#new_dato', function () {
			$("#title_modal_dato").html("<b>Crear dato</b>");
			$("#create_dato").css("display", "block");
			$("#save_dato").css("display", "none");
			$("#action_dato").modal();
		});
		/*función que crea un dato*/
		$('body').off('click',"#create_dato");
		$('body').on('click', '#create_dato', function () {
			var nombre_dato = $("#nombre_dato").val();
			
			$("#preloader").css("display", "block");
			var form = $("#form_dato")[0];
			var formulario = new FormData(form);
			
			
			$.ajax({
				type: "post",
				url: SITEURL + "/configuraciones/create_dato",
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){
						$("#action_dato").modal("hide");
						$('.modal-backdrop').remove();
						bootbox.alert("¡Dato añadido con éxito!");
						var oTable = $('#table_datos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){
						var error = data.msg;
						var mensaje = "";
						for (var i in error) {
							var error_msg = error[i];
							mensaje = mensaje + error_msg+"<br>";
						}
						bootbox.alert(mensaje);
					}else{
						bootbox.alert("¡Error al añadir el dato!");
					}
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al añadir el dato!");
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
@endsection
