@extends('app')

@section('content')

<!--modal para editar o añadir un usuario-->
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
							<!--Actualmente solo están estos dos roles-->
							<select class="form-control input-materialize" name="rol" id="rol_usuario">
								<option value="Usuario">Usuario</option>
								<option value="Administrador">Administrador</option>
								
							</select>
						</div>
						<div class="form-group">
							<label">Comisión a la que pertenece</label>
							<select class="form-control input-materialize" name="id_comision" id="id_comision">
								<option value="">Selecciona una comisión</option>
								<!-- muestra todas las comisiones que se mandan desde el backend-->
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

<!--modal para actualizar la contraseña del usuario-->
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

<!--modal para añadir o editar una terminología-->
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

<!--modal para añadir o editar un vídeo del home-->
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

<!--modal para editar una iniciativa-->
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
							<!--Aquí se mira la imagen actual del dato por medio de un mostrar/ocultar-->
							<a class="text-decoration-none" data-toggle="collapse" href="#ver_imagen_actual" role="button" aria-expanded="false"><span class="p-1 pt-2 pb-2" id="texto_ver_imagen_actual"></span>

							</a>
							<div class="collapse" id="ver_imagen_actual">
							</div>
							<!--fin imagen actual-->
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

<!--modal para añadir o editar un dato abierto-->
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
									//muestra todas las categorías de datos abiertos, se mandan desde el backend
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
							<!--Aquí se mira la imagen actual del dato por medio de un mostrar/ocultar-->
							<a class="text-decoration-none" data-toggle="collapse" href="#ver_imagen_actual_dato" role="button" aria-expanded="false"><span class="p-1 pt-2 pb-2" id="texto_ver_imagen_actual_dato"></span>

							</a>
							<div class="collapse" id="ver_imagen_actual_dato">
							</div>
							<!--fin imagen actual-->
							<input type="file" class="form-control validation" id="url_imagen_dato" name="file" accept="image/*" placeholder="">
						</div>
						
						<div class="form-group">
							<label for="inputAddress">Link</label>
							<input type="text" class="form-control validation" id="link_dato" name="link" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Link licencia</label>
							<input type="text" class="form-control validation" id="link_licencia" name="link_licencia" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputAddress">Link diccionario de datos</label>
							<input type="text" class="form-control validation" id="link_diccionario" name="link_diccionario" placeholder="">
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
		//Si el usuario es administrador, mostrar sección para cambiar la portada
		if(Auth::user()->hasRole("Administrador") == true){?>
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Portada</h5>
						</div>
						
						 <small>Aquí podrás cambiar la imagen de la portada</small>
					</div>
					<div class="card-body">
							
						<div class="row">
							<!--imagen actual de la portada-->
							<div class="col-md-2">
								<img id="url_portada" src="{{asset('img/portada.png')}}" style="height: 100px;">
							</div>
							<div class="col-md-4 m-auto">
								<form id="form_change_portada" autocomplete="off" autocomplete="nope">
								{{ csrf_field() }}
									<label>Subir nueva imagen</label>
									<!--input para subir el nuevo archivo-->
									<input type="file" name="file">
								</form>
							</div>
							<div class="col-md-2 m-auto">
								<button class="btn btn-purple" id="guardar_portada">Guardar</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php }?>
	</div>
	<div class="row p-5">
		<?php
		//Si el usuario es administrador, se muestra la sección para añadir, editar o eliminar usuarios
		if(Auth::user()->hasRole("Administrador") == true){?>
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Usuarios</h5>
						</div>
						<!--botón para añadir usuario-->
						<div class="button-card-header">
						   <button id="new_usuario" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo usuario</button>   
						</div>
						 <small>Aquí podrás añadir, modificar o eliminar los usuarios que tienen acceso solo a la sesión de las configuraciones</small>
					</div>
					<div class="card-body">
						<!--tabla que es llenada con una función ajax-->
						<table id="table_usuarios" class="table dataTable table-striped" style="width:100%;">
						<thead>
							<tr>
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
					<!--botón para añadir un nuevo vídeo-->
					<div class="button-card-header">
					   <button id="new_video" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo vídeo</button>   
					</div>
					 <small>Aquí podrás añadir, modificar o eliminar los vídeos que aparecen en el HOME en la parte inferior (Máximo 3 vídeos)</small>
					
				</div>
				<div class="card-body">
					<!--tabla que es llenada con una función ajax-->
					<table id="table_videos" class="table dataTable table-striped" style="width:100%; ">
					<thead>
						<tr>
						
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
					<!--tabla que es llenada con una función ajax-->
					<table id="table_iniciativas" class="table dataTable table-striped" style="width:100%;">
					<thead>
						<tr>
							
							<th scope="col" class="">Nombre</th>
							<th scope="col" class="">Comisiones</th>
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
	<div class="row" style="padding: 3rem 3.9rem!important;">
		<nav>
		  <div class="nav nav-tabs nav-tabs-comentarios" id="nav-tab" role="tablist">
		    <a class="nav-item nav-link active" id="com-por-aprob-tab" data-toggle="tab" href="#com-por-aprob" role="tab" aria-controls="com-por-aprob" aria-selected="true">Comentarios por aprobar</a>
		    <a class="nav-item nav-link" id="com-aprobados-tab" data-toggle="tab" href="#com-aprobados" role="tab" aria-controls="com-aprobados" aria-selected="false">Comentarios aprobados</a>
		     <a  href="{{url('configuraciones/estadisticas')}}" target="_blank" class="ml-5"><button class="btn btn-purple">Ver gráfica</button></a>
		   
		  </div>

		</nav>
		<div class="tab-content w-100" id="nav-tabContent">
		  <div class="tab-pane fade show active" id="com-por-aprob" role="tabpanel" aria-labelledby="com-por-aprob-tab">
		  	<div class="col-md-12 p-0">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Comentarios por aprobar</h5>
						</div>
						
						 <small>Aquí sólo podrás aprobar los comentarios. <br>Recuerda que solo los comentarios aprobados son los que mostrarán en las iniciativas</small>
						<button id="aprobar_comentarios" class="btn btn-purple float-right">Aprobar</button>
					</div>
					<div class="card-body">
						<!--tabla que es llenada con una función ajax-->
						<table id="table_comentarios" class="table dataTable table-striped" style="width:100%;">
							<thead>
								<tr>
									<th scope="col">Folio</th>
									<th scope="col">Aprobar</th>
									<th scope="col" class="">Comisión</th>
									<th scope="col" class="">Iniciativa</th>
									<th scope="col" class="">Usuario</th>
									<th scope="col">Comentario</th>
									<th scope="col">Fecha comentario</th>							

								</tr>
							</thead>
							<tbody class="">  
							</tbody>
						</table>

					</div>
				</div>
			</div>
		  </div>
		  <div class="tab-pane fade" id="com-aprobados" role="tabpanel" aria-labelledby="com-aprobados-tab">
		  	<div class="col-md-12 p-0">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Comentarios aprobados</h5>
						</div>
						
						 <small>Aquí sólo podrás ver los comentarios aprobados. <br>Recuerda que solo los comentarios aprobados son los que mostrarán en las iniciativas</small>
						
					</div>
					<div class="card-body">
						<!--tabla que es llenada con una función ajax-->
						<table id="table_comentarios_aprobados" class="table dataTable table-striped" style="width:100%;">
							<thead>
								<tr>
									<th scope="col">Folio</th>
									<th scope="col">Aprobar</th>
									<th scope="col" class="">Comisión</th>
									<th scope="col" class="">Iniciativa</th>
									<th scope="col" class="">Usuario</th>
									<th scope="col">Comentario</th>
									<th scope="col">Fecha comentario</th>							

								</tr>
							</thead>
							<tbody class="">  
							</tbody>
						</table>

					</div>
				</div>
			</div>
		  </div>
		 
		</div>
		
	</div>
	<?php
	//Si el usuario es administrador podrá añadir, editar o eliminar terminologías
	if(Auth::user()->hasRole("Administrador") == true){?>
		<div class="row p-5">
			<div class="col-md-12">
				<div class="card card-sombra">
					<div class="card-header content-card-header">
						<div class="title-card-header">
						   <h5>Terminologías</h5>
						</div>
						<!--botón para añadir una nueva terminología-->
						<div class="button-card-header">
						   <button id="new_terminologia" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nueva terminología</button>   
						</div>
						 <small>Aquí podrás añadir, editar o eliminar una terminología. Dichas terminologías son las que aparecen en la sección de congreso</small>
						
					</div>
					<div class="card-body">
						<!--tabla que es llenada con una función ajax-->
						<table id="table_terminologias" class="table dataTable table-striped" style="width:100%;">
						<thead>
							<tr>
								<th scope="col" class="">Nombre</th>
								<th scope="col">Definición</th>
								<th scope="col" class="centrar">Acciones</th>
								

							</tr>
						</thead>
						<tbody class="">  
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
						<!--botón para añadir un nuevo dato abierto-->
						<div class="button-card-header">
						   <button id="new_dato" type="button" class="btn btn-purple float-right"><i class="fa fa-plus mr-1"></i> Nuevo dato</button>   
						</div>
						 <small>Aquí podrás añadir, editar o eliminar un dato. Dichos datos son los que aparecen en la sección de Datos Abiertos</small>
						
					</div>
					<div class="card-body">
						<!--tabla que es llenada con una función ajax-->
						<table id="table_datos" class="table dataTable table-striped" style="width:100%;">
						<thead>
							<tr>
								<th scope="col" class="">Título</th>
								<th scope="col" class="">Categoría</th>
								<th scope="col">Descripción</th>
								<th scope="col">Imagen</th>
								<th scope="col">Link</th>
								<th scope="col">Licencia</th>
								<th scope="col">Diccionario de datos</th>
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
<!--sección de los scripts-->
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		
		var SITEURL = '{{URL::to('')}}'; 
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////PORTADA///////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////

		/*función para editar un dato*/ 
		$('body').off('click',"#guardar_portada");
		$('body').on('click', '#guardar_portada', function () {
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			
			//Obtiene la imagen
			var form = $("#form_change_portada")[0];
			var formulario = new FormData(form);
			
			$.ajax({
				type: "post",
				//Desde esta ruta el backend cambia la portada
				url: SITEURL + "/configuraciones/change_portada",
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta fue exitosa
						//Se actualiza la url de la imagen de la portada
						$("#url_portada").attr("src","");
						$("#url_portada").attr("src","{{asset('')}}"+data.msg.url_portada);
						//Se hace un reset del formulario 
						$("#form_change_portada")[0].reset();
						//Notifica el cambio de portada
						bootbox.alert("¡Portada actualizada con éxito!");
						
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////USUARIOS//////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		//Función que obtiene los usuarios
		var oTable = $('#table_usuarios').DataTable(); 
		oTable.destroy();

		var table_usuarios = $('#table_usuarios').dataTable({

			"ajax": {
				//Desde esa url busca los usuarios y los añade en la tabla
				"url": SITEURL +"/configuraciones/get_usuarios",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
			{
				"className": 'details-control',
				"orderable": true,
				"data": null,
				render:function(data, type, row)
				{
					//Esto se hace para asignar color a los circulitos con las iniciales del usuario
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
					
					//El nombre del usuario se compone con nombre y sus apellidos
					return data["nombre"]+" "+data["apellido_p"]+" "+data["apellido_m"];
				},
			},

			{ data: "email" },
			{ data: "rol" },
			{ data: "nombre_comision" },
			
			{
				//Esto es para los botones para editar, eliminar y cambiar contraseña de cada usuario
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

		//Acción que se ejecuta al cerrar el modal del usuario
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
			var nme = $(this).attr("nme"); //Obtiene el nombre del usuario a eliminar
			//Manda un mensaje de confirmación
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
					if(result == true){ //En caso de que el usuario haya confirmado la eliminación se ejecuta esto
						$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
						$.ajax({
							type: "get",
							//Esta es la función que se manda a llamar para eliminar el usuario
							url: SITEURL + "/configuraciones/delete_usuario/"+id_usuario,
							success: function (data) {
								if(data.status == "200"){ //Si la respuesta del backend fue exitosa
									//Actualiza la tabla
									var oTable = $('#table_usuarios').DataTable(); 
									oTable.ajax.reload();
									//Notifica que el usuario seleccionado fue eliminado con éxito
									bootbox.alert("¡Usuario eliminado con éxito!");
								}
								//Si hubieron mensajes de error del lado del backend
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
								//Independientemente de la respuesta obtenida se cierra el preloader
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
			$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
			
			var nme = $(this).attr("nme"); //Se obtiene el nombre
			var id_usuario = $(this).attr("ide"); //Se obtiene el ide

			$("#save_usuario").attr("ide", id_usuario); //Guarda temporalmente el ide del usuario para después poder obtenerlo al editar
			$("#title_modal_usuario").html("Actualizar usuario: <b>"+nme+"</b>"); //Se personaliza el título del modal
			
			$("#create_usuario").css("display", "none");	//Se oculta el botón de crear
			$("#save_usuario").css("display", "block");		//Para mostrar el de editar
			//Función que obtiene la información de un usuario
			$.ajax({
				type: "get",
				//Desde esta ruta se obtiene del backend la información del usuario
				url: SITEURL + "/configuraciones/get_usuario/"+id_usuario,
				data:{},
				success: function (data) {
					//Si el resultado es existoso, se despliega la información en el modal
					
					$("#apellido_p").val(data["apellido_p"]);
					$("#email").val(data["email"]);
					$("#apellido_m").val(data["apellido_m"]);
					$("#rol_usuario").val(data["rol"]);
					$("#id_comision").val(data["id_comision"]);
					
					$("#nombre_usuario").val(data["nombre"]);
					$("#id_comision").val(data["id_comision"]).trigger("change");
					$("#password_data").css("display", "none"); //La sección del password se oculta, ya que solo está disponible cuando se crea el usuario
					$("#action_usuario").modal();
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del usuario!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});

		/*función para editar un usuario*/ 
		$('body').off('click',"#save_usuario");
		$('body').on('click', '#save_usuario', function () {

			//Obtiene el ide del usuario que se va a editar
			var id_usuario = $("#save_usuario").attr("ide");
			//Obtiene el formulario del modal del usuario
			var formulario = $("#form_usuario").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend actualiza el usuario
				url: SITEURL + "/configuraciones/update_usuario/"+id_usuario,
				data:formulario,
				success: function (data) {
					
					if(data.status == "200"){//Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_usuario").modal("hide");
						$('.modal-backdrop').remove();
						//Manda el mensaje de confirmación
						bootbox.alert("¡Usuario actualizado con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
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
			$("#create_usuario").css("display", "block"); //Muestra el botón de crear
			$("#save_usuario").css("display", "none"); //Oculta el botón de editar
			$("#password_data").css("display", "flex"); //Muestra los campos para pedir la contraseña
			$("#action_usuario").modal(); //Lanza el modal
		});

		/*función que crea un usuario*/
		$('body').off('click',"#create_usuario");
		$('body').on('click', '#create_usuario', function () {
			//Obtiene el formulario del modal del usuario
			var formulario = $("#form_usuario").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend crea el usuario
				url: SITEURL + "/configuraciones/create_usuario",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_usuario").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Usuario añadido con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		//change_pass
		$('body').off('click',".change_pass");
		$('body').on('click', '.change_pass', function () {
			var id_usuario = $(this).attr("ide"); //Obtiene el usuario a cambiar contraseña
			$("#save_usuario_pass").attr("ide", id_usuario); //Para almacenarlo temporalmente en el botón del modal
			//Lanza el modal
			$("#action_usuario_pass").modal();
		});

		/*función para editar contraseña de un usuario*/ 
		$('body').off('click',"#save_usuario_pass");
		$('body').on('click', '#save_usuario_pass', function () {
			//Obtiene el ide del usuario
			var id_usuario = $("#save_usuario_pass").attr("ide");
			//Obtiene el formulario
			var formulario = $("#form_usuario_pass").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend cambia la contraseña del usuario
				url: SITEURL + "/configuraciones/update_usuario_pass/"+id_usuario,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Oculta el modal
						$("#action_usuario_pass").modal("hide");
						$('.modal-backdrop').remove();
						//Muestra el mensaje de que se realizó con éxito
						bootbox.alert("¡Contraseña de usuario actualizado con éxito!");
						//Actualiza la tabla de usuarios
						var oTable = $('#table_usuarios').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////VÍDEOS////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		/*VIDEOS HOME*/
		//Función que obtiene los vídeos
		var oTable = $('#table_videos').DataTable(); 
		oTable.destroy();

		var table_videos = $('#table_videos').dataTable({

			"ajax": {
				//Desde esta url se obtienen los vídeos
				"url": SITEURL +"/configuraciones/get_videos",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
			{ data: "nombre" },  
			{ data: "descripcion" },          
			{ data: "link" },
			
			
			{
				//Aquí se arman los botones para editar o eliminar cada vídeo
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

		//Acción que se ejecuta cuando se cierra el modal del vídeo
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
			var nme = $(this).attr("nme"); //Obtiene el nombre del vídeo
			bootbox.confirm({ //Manda un mensaje de confirmación
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
					if(result == true){ //Si el usuario confirma la eliminación, se procede
						$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
						$.ajax({
							type: "get",
							//Desde esta ruta el backend elimina un vídeo
							url: SITEURL + "/configuraciones/delete_video/"+id_video,
							success: function (data) {
								if(data.status == "200"){ //Si la respuesta del backend fue exitosa
									//Actualiza la tabla
									var oTable = $('#table_videos').DataTable(); 
									oTable.ajax.reload();
									//Notifica que la acción se ejecutó con éxito
									bootbox.alert("¡Vídeo eliminado con éxito!");
								}
								else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
								//Independientemente de la respuesta obtenida se cierra el preloader
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
			$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
			var nme = $(this).attr("nme"); //Obtiene el nombre del vídeo
			var id_video = $(this).attr("ide"); //Obtiene el ide del vídeo

			$("#save_video").attr("ide", id_video); //Almacena temporalmente el ide
			$("#title_modal_video").html("Actualizar vídeo: <b>"+nme+"</b>"); //Personaliza el título del modal
			$("#create_video").css("display", "none"); //Oculta el botón de crear 
			$("#save_video").css("display", "block"); //Para mostrar el botón de editar
			$.ajax({
				type: "get",
				//Función del backend que obtiene la información del vídeo
				url: SITEURL + "/configuraciones/get_video/"+id_video,
				data:{},
				success: function (data) { //Llena los campos del modal
					$("#nombre_video").val(data["nombre"]);
					$("#descripcion_video").val(data["descripcion"]);
					$("#link_video").val(data["link"]);
					$("#action_video").modal(); //Muestra el modal
				   
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del vídeo!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});

		/*función para editar un video*/ 
		$('body').off('click',"#save_video");
		$('body').on('click', '#save_video', function () {
			//Obtiene el ide del vídeo a actualizar
			var id_video = $("#save_video").attr("ide");
			//Obtiene el formulario
			var formulario = $("#form_video").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");

			$.ajax({
				type: "post",
				//Desde esta ruta el backend actualiza el vídeo
				url: SITEURL + "/configuraciones/update_video/"+id_video,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Oculta el modal
						$("#action_video").modal("hide"); 
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Vídeo actualizado con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_videos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear video*/
		$('body').off('click',"#new_video");
		$('body').on('click', '#new_video', function () {
			//Actualiza el título del modal
			$("#title_modal_video").html("<b>Crear vídeo</b>");
			$("#create_video").css("display", "block"); //Muestra el botón de crear
			$("#save_video").css("display", "none"); //Para ocultar el de editar
			$("#action_video").modal(); //Muestra el modal
		});

		/*función que crea un video*/
		$('body').off('click',"#create_video");
		$('body').on('click', '#create_video', function () {
			//Obtiene el formulario
			var formulario = $("#form_video").serialize();
			$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
			$.ajax({
				type: "post",
				//Desde esta ruta el backend crea un vídeo
				url: SITEURL + "/configuraciones/create_video",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Oculta el modal
						$("#action_video").modal("hide"); 
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Vídeo añadido con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_videos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////INICIATIVAS///////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		//INICIATIVAS
		//Función que obtiene las iniciativas
		var oTable = $('#table_iniciativas').DataTable(); 
		oTable.destroy();

		var table_iniciativas = $('#table_iniciativas').dataTable({

			"ajax": {
				//Desde esta ruta se obtiene del backend la información de las iniciativas
				"url": SITEURL +"/configuraciones/get_iniciativas",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
			{ data: "nombre"}, 
			{ data: "comision"},  
			{ data: "id_principal" },
			{ data: "infolej" },

			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					//Si la iniciativa tiene url de imagen
					if(data["url_imagen"] != null && data["url_imagen"]!= ""){
						var url = "{{URL::to('')}}";
						return url+""+data["url_imagen"];
					}else{ //Si no tiene, se muestra en blanco la celda
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
					//Aquí se arman los botones para editar o eliminar los datos extras de la iniciativa
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

		//Acción que se ejecuta al cerrar el modal de la iniciativa
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
			var idp = $(this).attr("idp"); //Se obtiene el ide principal
			var idi = $(this).attr("idi"); //Se obtiene el infolej
			bootbox.confirm({ //Manda un mensaje de confirmación de eliminación
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
					if(result == true){ //Si la confirmación fue exitosa
						//Muestra el preloader como indicativo de que algo está pasando
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							//Desde esta ruta el backend elimina la información extra de una iniciativa
							url: SITEURL + "/configuraciones/delete_iniciativa/"+idp+"/"+idi,
							success: function (data) {
								if(data.status == "200"){ //Si la respuesta del backend fue exitosa
									//Actualiza la tabla
									var oTable = $('#table_iniciativas').DataTable(); 
									oTable.ajax.reload();
									//Notifica que la acción fue ejecutada con éxito
									bootbox.alert("¡Datos extras de iniciativa eliminados con éxito!");
								}
								else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
								//Independientemente de la respuesta obtenida se cierra el preloader
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
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");

			var idp = $(this).attr("idp"); //Obtiene el ide principal
			var idi = $(this).attr("idi"); //Obtiene el infolej
			$("#save_iniciativa").attr("idp", idp); //Y los almacena temporalmente
			$("#save_iniciativa").attr("idi", idi);
			//Actualiza el título del modal
			$("#title_modal_iniciativa").html("Actualizar iniciativa: <b>Infolej "+idi+"</b>");
			$("#create_iniciativa").css("display", "none"); //Oculta el botón de crear
			$("#save_iniciativa").css("display", "block"); //Muestra el botón de guardar
			$.ajax({
				type: "get",
				//Desde esta ruta se obtiene del backend la información de la iniciativa
				url: SITEURL + "/configuraciones/get_iniciativa/"+idp+"/"+idi,
				data:{},
				success: function (data) {

					//Llena los campos del modal
					$("#nombre_iniciativa").val(data["nombre"]);
					$("#idp_iniciativa").val(data["id_principal"]);
					$("#idi_iniciativa").val(data["infolej"]);
					$("#url_video_iniciativa").val(data["url_video"]);
					//Si la iniciativa tiene imagen, la muestra
					if(data["url_imagen"] != "" && data["url_imagen"] != null){
						var url = "{{asset('')}}"+data["url_imagen"];
						$("#ver_imagen_actual").append("<img width='95%' src='"+url+"'>");
						$("#texto_ver_imagen_actual").append("Ver imagen actual");
						
					}
					$("#descripcion_video_iniciativa").val(data["descripcion_video"]);
					//Muestra el modal
					$("#action_iniciativa").modal();
				   
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información de la iniciativa!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});

		/*función para editar un iniciativa*/ 
		$('body').off('click',"#save_iniciativa");
		$('body').on('click', '#save_iniciativa', function () {
			var idp = $(this).attr("idp"); //Obtiene el ide principal
			var idi = $(this).attr("idi"); //Obtiene el infolej
			var nombre_iniciativa = $("#nombre_iniciativa").val();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			//Obtiene el formulario
			var form = $("#form_iniciativa")[0];
			var formulario = new FormData(form);

			$.ajax({
				type: "post",
				//Desde esta ruta el backend actualiza una iniciativa
				url: SITEURL + "/configuraciones/update_iniciativa/"+idp+"/"+idi,
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_iniciativa").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Iniciativa actualizada con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_iniciativas').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear iniciativa*/
		$('body').off('click',"#new_iniciativa");
		$('body').on('click', '#new_iniciativa', function () {
			$("#title_modal_iniciativa").html("<b>Crear iniciativa</b>"); //Se actualiza el título de la iniciativa
			$("#create_iniciativa").css("display", "block");  //Se muestra el botón de crear
			$("#save_iniciativa").css("display", "none"); //Se oculta el botón de guardar
			$("#action_iniciativa").modal(); //Se muestra modal
		});

		/*función que crea un iniciativa*/
		$('body').off('click',"#create_iniciativa");
		$('body').on('click', '#create_iniciativa', function () {
			//Obtiene el formulario
			var formulario = $("#form_iniciativa").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend crea la información extra de la iniciativa
				url: SITEURL + "/configuraciones/create_iniciativa",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_iniciativa").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Iniciativa añadida con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_iniciativas').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});
		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////COMENTARIOS///////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////

		//COMENTARIOS
		//Función que obtiene los comentarios
		var oTable = $('#table_comentarios').DataTable(); 
		oTable.destroy();

		var table_comentarios = $('#table_comentarios').dataTable({

			"ajax": {
				//Desde esta ruta se obtiene del backend la información de los comentarios
				"url": SITEURL +"/configuraciones/get_comentarios",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
			{
				"className": 'text-center',
				"data": null,
				render:function(data, type, row)
				{
					var iniciativa = "";
					var file = "";
					//Si el usuario subió un archivo, se muestra el archivo
					if(data["usuario_url_file"] != null && data["usuario_url_file"]!= ""){
						var url = "{{URL::to('')}}";
						file =  '<a href="'+url+'/get_file_comentario/'+data["id"]+'" target="_blank"><button class="btn btn-purple ver_archivo" ide="'+data["id"]+'"><i class="far fa-file"></i></button></a>';
					}else{ //de lo contrario no se muestra nada
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
					//Si el comentario está aprobado, mostrar el checked y deshabilitarlo
					if(data["aprobado"] == 1){
						disabled = "disabled";
						checked = "checked";
					}
					return '<div class="form-check">'+
						'<input '+disabled+' '+checked+' type="checkbox" class="form-check-input aprobar_comentario" ide="'+data["id"]+'" id="aprobar_comentario'+data["RowNumY"]+'" value="'+data["id"]+'">'+
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
					//Si la iniciativa tiene nombre, se mostrará
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
					//Aquí se muestra el nombre del usuario y el email de quien hizo el comentario
					return "<b>Nombre:</b>"+data["usuario_nombre"]+"<br><b>Email:</b>"+data["usuario_email"];
				},
			}, 
			{
				"width:":50,
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					//Aquí se muestra el comentario
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
		var oTable = $('#table_comentarios_aprobados').DataTable(); 
		oTable.destroy();

		var table_comentarios_aprobados = $('#table_comentarios_aprobados').dataTable({

			"ajax": {
				//Desde esta ruta se obtiene del backend la información de los comentarios
				"url": SITEURL +"/configuraciones/get_comentarios_aprobados",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
			{
				"className": 'text-center',
				"data": null,
				render:function(data, type, row)
				{
					var iniciativa = "";
					var file = "";
					//Si el usuario subió un archivo, se muestra el archivo
					if(data["usuario_url_file"] != null && data["usuario_url_file"]!= ""){
						var url = "{{URL::to('')}}";
						file =  '<a href="'+url+'/get_file_comentario/'+data["id"]+'" target="_blank"><button class="btn btn-purple ver_archivo" ide="'+data["id"]+'"><i class="far fa-file"></i></button></a>';
					}else{ //de lo contrario no se muestra nada
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
					//Si el comentario está aprobado, mostrar el checked y deshabilitarlo
					if(data["aprobado"] == 1){
						disabled = "disabled";
						checked = "checked";
					}
					return '<div class="form-check">'+
						'<input '+disabled+' '+checked+' type="checkbox" class="form-check-input comentario_aprobado" ide="'+data["id"]+'" id="comentario_aprobado'+data["RowNumY"]+'">'+
						'<label class="form-check-label" for="comentario_aprobado'+data["RowNumY"]+'">Aprobar</label>'+
					'</div>';
					
				},
			}, 
			
			{ data: "comision" },  
			{
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					//Si la iniciativa tiene nombre, se mostrará
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
					//Aquí se muestra el nombre del usuario y el email de quien hizo el comentario
					return "<b>Nombre:</b>"+data["usuario_nombre"]+"<br><b>Email:</b>"+data["usuario_email"];
				},
			}, 
			{
				"width:":50,
				"className": '',
				"data": null,
				render:function(data, type, row)
				{
					//Aquí se muestra el comentario
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

		//Función que se ejecuta al aprobar el comentario
		/*$('body').off('change',".aprobar_comentario");
		$('body').on('change', '.aprobar_comentario', function () {
			var ide = $(this).attr("ide");
			var checkbox = $(this);
			if($(this).is(":checked")) { //Si el comentario está checked
				bootbox.confirm({ //Manda un mensaje de confirmación de aprobación
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
						if(result == true){ //Si la confirmación fue exitosa
							//Muestra el preloader como indicativo de que algo está pasando
							$("#preloader").css("display", "block");
							$.ajax({
								type: "post",
								data:{_token: "{{ csrf_token() }}", ide:ide},
								//Desde esta ruta el backend aprueba el comentario
								url: SITEURL + "/configuraciones/aprobar_comentario",
								
								success: function (data) {
									if(data.status == "200"){ //Si la respuesta del backend fue exitosa
										//Actualiza la tabla
										var oTable = $('#table_comentarios').DataTable(); 
										oTable.ajax.reload();
										//Notifica que la acción fue ejecutada con éxito
										bootbox.alert("¡Comentario aprobado con éxito!");
									}
									else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
									//Independientemente de la respuesta obtenida se cierra el preloader
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
		});*/

		$('body').off('click',"#aprobar_comentarios");
		$('body').on('click', '#aprobar_comentarios', function () {
			var comentarios_por_aprobar = [];

			$(".aprobar_comentario:checked").each(function(){
			    comentarios_por_aprobar.push(this.value);
			});

			if(comentarios_por_aprobar.length > 0) { //Si hay al menos un comentario elegido
				bootbox.confirm({ //Manda un mensaje de confirmación de aprobación
					message : "<p class='text-center'><i class='fa fa-exclamation-triangle icon-warning'></i>&nbsp¿Está seguro que desea aprobar los comentarios seleccionados?</p>",
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
						if(result == true){ //Si la confirmación fue exitosa
							
							//Muestra el preloader como indicativo de que algo está pasando
							$("#preloader").css("display", "block");
							$.ajax({
								type: "post",
								data:{_token: "{{ csrf_token() }}", comentarios: comentarios_por_aprobar},
								//Desde esta ruta el backend aprueba los comentarios
								url: SITEURL + "/configuraciones/aprobar_comentarios",
								
								success: function (data) {
									if(data.status == "200"){ //Si la respuesta del backend fue exitosa
										//Actualiza la tabla
										var oTable = $('#table_comentarios').DataTable(); 
										oTable.ajax.reload();
										var oTable = $('#table_comentarios_aprobados').DataTable(); 
										oTable.ajax.reload();
										//Notifica que la acción fue ejecutada con éxito
										bootbox.alert("¡Comentario(s) aprobado(s) con éxito!");
									}
									else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
									//Independientemente de la respuesta obtenida se cierra el preloader
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

			}else{
				bootbox.alert("¡Debe seleccionar al menos un comentario!");
			}
		});


		//Función que se ejecuta después de dibujar la tabla de los comentarios para poder ocultar parte de los comentarios que están extensos
		$('#table_comentarios').DataTable().on("draw", function(){
		   $('.expandable p').expander({
			  slicePoint: 50, // si eliminamos por defecto es 100 caracteres
			  expandText: '[Leer más]', // por defecto es 'read more...'
			  collapseTimer: 0, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
			  userCollapseText: '[Cerrar]' // por defecto es 'read less...'
			});
		});
		$('#table_comentarios_aprobados').DataTable().on("draw", function(){
		   $('.expandable p').expander({
			  slicePoint: 50, // si eliminamos por defecto es 100 caracteres
			  expandText: '[Leer más]', // por defecto es 'read more...'
			  collapseTimer: 0, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
			  userCollapseText: '[Cerrar]' // por defecto es 'read less...'
			});
		})

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////TERMINOLOGÍAS/////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////

		//TERMINOLOGÍAS
		//Función que obtiene las terminologías
		var oTable = $('#table_terminologias').DataTable(); 
		oTable.destroy();
		var table_terminologias = $('#table_terminologias').dataTable({

			"ajax": {
				//De esta ruta obtiene las terminologías del backend
				"url": SITEURL +"/configuraciones/get_terminologias",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[

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
					//Aquí se arman los botones para editar o eliminar cada terminología
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

		//Acción que se ejecuta al cerrar el modal de la terminología
		$('#action_terminologia').off('hidden.bs.modal');
		$("#action_terminologia").on('hidden.bs.modal', function () {
			$(this).find(".text-error").text("");
			$(this).find(".check-ok").removeClass("check-ok");
			$(this).find(".validation").val("");
		});

		/*  función para eliminar un terminologia*/
		$('body').off('click',".delete_terminologia");
		$('body').on('click', '.delete_terminologia', function () {
			var id_terminologia = $(this).attr("ide"); //Obtiene el ide del elemento a eliminar
			var nme = $(this).attr("nme"); //y el nombre
			bootbox.confirm({ //Manda un mensaje de confirmación de eliminación
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
					if(result == true){ //Si la confirmación fue exitosa
						//Muestra el preloader como indicativo de que algo está pasando
						$("#preloader").css("display", "block");

						$.ajax({
							type: "get",
							//Desde esta ruta el backend elimina una terminología
							url: SITEURL + "/configuraciones/delete_terminologia/"+id_terminologia,
							success: function (data) {
								if(data.status == "200"){ //Si la respuesta del backend fue exitosa
									//Actualiza la tabla
									var oTable = $('#table_terminologias').DataTable(); 
									oTable.ajax.reload(); 
									//Notifica que la acción fue ejecutada con éxito
									bootbox.alert("¡Terminología eliminada con éxito!");
								}
								else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
								//Independientemente de la respuesta obtenida se cierra el preloader
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
			$("#preloader").css("display", "block"); //Muestra el preloader como indicativo de que algo está pasando
			
			var nme = $(this).attr("nme"); //Obtiene el nombre de la terminología
			var id_terminologia = $(this).attr("ide"); //y el ide
			$("#save_terminologia").attr("ide", id_terminologia); //Almacena temporalmente el ide
			$("#title_modal_terminologia").html("Actualizar terminología: <b>"+nme+"</b>"); //Actualiza el título del modal
			$("#create_terminologia").css("display", "none"); //Oculta el botón de crear
			$("#save_terminologia").css("display", "block"); //Para mostrar el de editar
			$.ajax({
				type: "get",
				//Desde esta ruta se obtiene del backend la información de la terminología
				url: SITEURL + "/configuraciones/get_terminologia/"+id_terminologia,
				data:{},
				success: function (data) {
					//Llena los campos del modal
					$("#nombre_terminologia").val(data["nombre"]);
					$("#definicion_terminologia").val(data["definicion"]);
					//Lanza el modal
					$("#action_terminologia").modal();
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información de la terminología!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});

		/*función para editar un terminologia*/ 
		$('body').off('click',"#save_terminologia");
		$('body').on('click', '#save_terminologia', function () {

			var id_terminologia = $("#save_terminologia").attr("ide"); //Obtiene el ide de la terminología a actualizar
			//Obtiene el formulario
			var formulario = $("#form_terminologia").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend actualiza la terminología
				url: SITEURL + "/configuraciones/update_terminologia/"+id_terminologia,
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Oculta el modal
						$("#action_terminologia").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Terminología actualizada con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_terminologias').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear terminologia*/
		$('body').off('click',"#new_terminologia");
		$('body').on('click', '#new_terminologia', function () {
			$("#title_modal_terminologia").html("<b>Crear terminología</b>"); //Actualiza el título del modal
			$("#create_terminologia").css("display", "block"); //Muestra el botón de crear
			$("#save_terminologia").css("display", "none"); //Y oculta el botón de editar
			$("#action_terminologia").modal(); //Lanza el modal
		});

		/*función que crea un terminologia*/
		$('body').off('click',"#create_terminologia");
		$('body').on('click', '#create_terminologia', function () {
			//Obtiene el formulario
			var formulario = $("#form_terminologia").serialize();
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			$.ajax({
				type: "post",
				//Desde esta ruta el backend crea la terminología
				url: SITEURL + "/configuraciones/create_terminologia",
				data:formulario,
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Oculta el modal
						$("#action_terminologia").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Terminología añadida con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_terminologias').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend

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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////DATOS/////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////

		//DATOS
		//Función que obtiene los datos abiertos
		var oTable = $('#table_datos').DataTable(); 
		oTable.destroy();

		var table_datos = $('#table_datos').dataTable({

			"ajax": {
				//Desde esta ruta se obtiene del backend la información de los datos
				"url": SITEURL +"/configuraciones/get_datos",
				"dataSrc": "",
				data:{
					"_token": "{{ csrf_token() }}",
				}
			},
			"columns": 
			[
			
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
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{	
					return data["link_licencia"];
				},
			},
			{
				"className": 'details-control text-justify',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{	
					return data["link_diccionario"];
				},
			},
			
			{
				"className": 'details-control text-center',
				"orderable": false,
				"data": null,
				render:function(data, type, row)
				{
					//Aquí se arman los botones para editar o eliminar cada dato
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

		//Acción que se ejecuta cuando se cierra el modal del dato
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
			var id_dato = $(this).attr("ide"); //Se obtiene el ide
			var nme = $(this).attr("nme"); //Se obtiene el nombre

			bootbox.confirm({ //Manda un mensaje de confirmación de eliminación
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
					if(result == true){ //Si la confirmación fue exitosa
						//Muestra el preloader como indicativo de que algo está pasando
						$("#preloader").css("display", "block");
						$.ajax({
							type: "get",
							url: SITEURL + "/configuraciones/delete_dato/"+id_dato,
							success: function (data) {
								if(data.status == "200"){ //Si la respuesta del backend fue exitosa
									//Actualiza la tabla
									var oTable = $('#table_datos').DataTable(); 
									oTable.ajax.reload();
									//Notifica que la acción fue ejecutada con éxito
									bootbox.alert("¡Dato eliminado con éxito!");
								}
								else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
								//Independientemente de la respuesta obtenida se cierra el preloader
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
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			var nme = $(this).attr("nme"); //Se obtiene el nombre
			var id_dato = $(this).attr("ide"); //Se obtiene el ide
			$("#save_dato").attr("ide", id_dato); //Se almacena temporalmente
			$("#title_modal_dato").html("Actualizar dato: <b>"+nme+"</b>"); //Se actualiza el título del modal
			$("#create_dato").css("display", "none");  //Se oculta el botón de crear
			$("#save_dato").css("display", "block"); //Para mostrar el de guardar
			$.ajax({
				type: "get",
				//Desde esta ruta se obtiene del backend la información del dato
				url: SITEURL + "/configuraciones/get_dato/"+id_dato,
				data:{},
				success: function (data) {
					//Llena los campos del modal
					$("#titulo_dato").val(data["titulo"]);
					$("#descripcion_dato").val(data["descripcion"]);
					if(data["url_imagen"] != "" && data["url_imagen"] != null){ //Si tiene una imagen se muestra
						var url = "{{asset('')}}"+data["url_imagen"];
						$("#ver_imagen_actual_dato").append("<img width='95%' src='"+url+"'>");
						$("#texto_ver_imagen_actual_dato").append("Ver imagen actual");
						
					}
					$("#categoria_dato").val(data["categoria"]).trigger("change");
					$("#link_dato").val(data["link"]);
					$("#link_licencia").val(data["link_licencia"]);
					$("#link_diccionario").val(data["link_diccionario"]);
					//Se muestra el modal
					$("#action_dato").modal();
					
					
				},
				error: function (data) {
					console.log('Error:', data);
					bootbox.alert("¡Error al obtener la información del dato!");
				},
				complete: function(){
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
		});

		/*función para editar un dato*/ 
		$('body').off('click',"#save_dato");
		$('body').on('click', '#save_dato', function () {
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			var id_dato = $("#save_dato").attr("ide"); //Se obtiene el ide del dato a actualizar
			//Se obtiene el formulario
			var form = $("#form_dato")[0];
			var formulario = new FormData(form);
			
			$.ajax({
				type: "post",
				//Desde esta ruta el backend actualiza el dato
				url: SITEURL + "/configuraciones/update_dato/"+id_dato,
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_dato").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Dato actualizado con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_datos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});

		/*función que lanza modal para crear dato*/
		$('body').off('click',"#new_dato");
		$('body').on('click', '#new_dato', function () {
			$("#title_modal_dato").html("<b>Crear dato</b>"); //Se actualiza el título del modal
			$("#create_dato").css("display", "block"); //Se muestra el botón de crear
			$("#save_dato").css("display", "none"); //Se oculta el botón de guardar
			$("#action_dato").modal(); //Se muestra el modal
		});

		/*función que crea un dato*/
		$('body').off('click',"#create_dato");
		$('body').on('click', '#create_dato', function () {
			//Muestra el preloader como indicativo de que algo está pasando
			$("#preloader").css("display", "block");
			//Se obtiene el formulario
			var form = $("#form_dato")[0];
			var formulario = new FormData(form);
			
			
			$.ajax({
				type: "post",
				//Desde esta ruta el backend crea el dato
				url: SITEURL + "/configuraciones/create_dato",
				data:formulario,
				enctype: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (data) {
					if(data.status == "200"){ //Si la respuesta del backend fue exitosa
						//Cierra el modal
						$("#action_dato").modal("hide");
						$('.modal-backdrop').remove();
						//Notifica que la acción fue ejecutada con éxito
						bootbox.alert("¡Dato añadido con éxito!");
						//Actualiza la tabla
						var oTable = $('#table_datos').DataTable(); 
						oTable.ajax.reload();
					}else if (data.status == "422"){ //Si hubieron mensajes de error del lado del backend
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
					//Independientemente de la respuesta obtenida se cierra el preloader
					setTimeout(function() {
						$("#preloader").fadeOut(500);
					},200);
				}
			});
			
		});


	  
	});
</script>
@endsection
