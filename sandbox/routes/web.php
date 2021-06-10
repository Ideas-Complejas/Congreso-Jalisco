<?php

use Illuminate\Support\Facades\Route;
//Los modelos nos permiten acceder a la información de la base de datos
use App\Models\Terminologia;
use App\Models\Video;
use App\Models\User;
use App\Models\Iniciativa;
use App\Models\Diputado;
use App\Models\DetalleIniciativasComision;
use App\Models\PonentesIniciativa;
use App\Models\EstadosProcesalesIniciativa;
use App\Models\ComisionesEstudianIniciativa;
use App\Models\IniciativaComentario;
use App\Models\ConteoIniciativasComision;
use App\Models\IniciativaSuscripcion;
use App\Models\ComisionSuscripcion;
use App\Models\ImagenesRandom;
use App\Models\ImagenesRandomDato;
use App\Models\DatosAbiertos;

//Estas notificaciones se usan para envío de correos
use App\Notifications\SuscripcionUsuario;
use App\Notifications\SuscripcionComisionUsuario;
use App\Notifications\SuscripcionIniciativaUsuario;
use App\Notifications\ComentarioUsuario;
use App\Notifications\ComentarioComision;
use App\Notifications\Buzon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Routes para login, register*/
Auth::routes();

/*ROUTE PARA LANZAR EL HOME*/
Route::get('/', function () {
	//Obtiene los vídeos cargados en configuraciones*/
	$videoyoutube = Video::all();
	/*obtiene sólo 9 iniciativas ordenadas por fecha inicial desc*/
	$iniciativas = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
	->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->orderBy("detalle_iniciativas_comision.fecha_inicial","desc")
	->limit(9)
	->get();
	if($iniciativas){
		/*recorre las iniciativas para buscar los autores*/
		foreach ($iniciativas as $key => $value) {
			/*Obtiene los autores de la iniciativa en curso*/
			$iniciativas[$key]->autores = PonentesIniciativa::where([["id_principal",$value->id_principal],["infolej",$value->infolej]])->get();
			/*Obtiene los comentarios aprobados de la iniciativa en curso*/
			$iniciativas[$key]->comentarios = IniciativaComentario::where([["id_principal",$value->id_principal],["infolej",$value->infolej],["aprobado",1]])->get();
		}
	}
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}

	//Envía al view home.blade.php las variables videoyoutube, iniciativas, e imágenes_random
    return view('home', compact('videoyoutube', 'iniciativas','imagenes_random'));
});

/*ROUTE PARA LANZAR EL HOME*/
Route::get('/home', function () {
    return redirect('/');
});

/*ROUTE PARA LANZAR EL VIEW DE CONGRESO*/
Route::get('/congreso', function () {

	$terminos = [];
	//Por default manda la letra A para que sea la que se esté mostrando cuando se entre al view
	$letra = "A";
	/*ARMA EL ABECEDARIO*/
	for ($i=65;$i<=90;$i++) {
		/*Busca los términos por letra*/
		$terminos[chr($i)] = Terminologia::where("nombre", "like", chr($i)."%")->get();
	}
	//Retorna al view congreso.blade.php las variables terminos, y letra
    return view('congreso', compact('terminos','letra'));
})->name("congreso"); //Este name se usa por si en un view se requiere usar route("congreso") en vez de url("/congreso")

/*ROUTE PARA COMISIONES*/
Route::get('/comisiones', function () {

	/*Obtiene el listado de las comisiones  así como la imágen relacionada a esa comisión*/
	$comisiones = ConteoIniciativasComision::select("conteo_iniciativas_comision.nombre_comision","conteo_iniciativas_comision.id_comision","imagenes_comisiones.url_imagen")
	->leftJoin('imagenes_comisiones', 'imagenes_comisiones.id_comision', '=', 'conteo_iniciativas_comision.id_comision')
	->orderBy("nombre_comision")->get();

	if($comisiones){
		/*Recorre las comisiones para buscar las iniciativas*/
		foreach ($comisiones as $key => $value) {
			$comisiones[$key]->iniciativas = DetalleIniciativasComision::where("nom_comision",$value->nombre_comision)->get();
		}
	}
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}
	//Retorna al view comisiones.blade.php las variables comisiones e imagenes_random
    return view('comisiones', compact('comisiones','imagenes_random'));
})->name("comisiones"); //Este name se usa por si en un view se requiere usar route("comisiones") en vez de url("/comisiones")

/*ROUTE PARA BUSCAR INICIATIVAS POR COMISIÓN*/
//Forzosamente debe recibir el nombre de la comisión
Route::get('/iniciativas/{nombre_comision}', function ($nombre_comision ) {

	/*Busca las iniciativas de esa comisión que se recibe*/
	$iniciativas = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
	->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->where("nom_comision",$nombre_comision)
	->orderBy("fecha_inicial","desc")->paginate(9); //y las página de 9 en 9

	if($iniciativas){
		/*Recorre las iniciativas*/
		foreach ($iniciativas as $key => $value) {
			/*Obtiene los autores de la iniciativa en curso*/
			$iniciativas[$key]->autores = PonentesIniciativa::where([["id_principal",$value->id_principal],["infolej",$value->infolej]])->get();
			/*Obtiene los comentarios aprobados de la iniciativa en curso*/
			$iniciativas[$key]->comentarios = IniciativaComentario::where([["id_principal",$value->id_principal],["infolej",$value->infolej],["aprobado",1]])->get();
		}
	}
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}
	//Retorna al view iniciativas.blade.php las variables iniciativas, nombre_comision e imagenes_random
    return view('iniciativas', compact('iniciativas','nombre_comision','imagenes_random'));
});


/*ROUTE PARA OBTENER EL DETALLE DE UNA INICIATIVA*/
Route::get('/detalle_iniciativa/{id_i}/{id_p}', function ($id_i,$id_p) { //Recibe el ID_PRINCIPAL, INFOLEJ

	/*Busca la iniciativa junto con los comentarios y los datos añadidos desde configuraciones*/
	$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
	->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->where("detalle_iniciativas_comision.infolej",$id_i)
	->where("detalle_iniciativas_comision.id_principal",$id_p)
	->first();

	if($iniciativa){
		/*Obtiene los autores de la iniciativa en curso*/
		$iniciativa->autores = PonentesIniciativa::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej]])->get();

		/*Obtiene los estados procesales de la iniciativa en curso*/
		$iniciativa->estados_procesales = EstadosProcesalesIniciativa::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej]])
		//ordena los estados procesales de forma descendente
		->orderBy("no_e", "desc")
		->get();

		/*Obtiene los comentarios aprobados de la iniciativa en curso*/
		$iniciativa->comentarios = IniciativaComentario::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej],["aprobado",1]])
		//ordena los comentarios por fecha de creación descendente y los pagina de 10 en 10
		->orderBy("fecha_creacion","desc")->paginate(10);
		
	}
	//Retorna al view detalle_iniciativa.blade.php la variable iniciativa
    return view('detalle_iniciativa', compact('iniciativa'));
});


/*Route para comentar una iniciativa*/
Route::post('/comentar', function (Request $request) {
	DB::beginTransaction();
	try {
		
		//Se arma el arreglo de los datos que se pasan por post
		$data = array(
			"id_principal" => $request["idp"],
			"infolej" => $request["idi"],
			"usuario_nombre" => $request["usuario_nombre"],
			"usuario_email" => $request["usuario_email"],
			"usuario_comentario" => $request["usuario_comentario"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		//Se definen los nombres que corresponden a las variables que se mandan por post
		$niceNames = array(
			"id_principal" => 'Iniciativa',
			"infolej" => 'Iniciativa',
			'usuario_nombre' => 'Nombre',
			'usuario_email' => 'Email',
			'usuario_comentario' => 'Comentario',
			'aviso_privacidad' => 'Aviso de privacidad',
			'no_soy_robot' => 'No soy un robot',
		);
		//Validadores del formulario que se envía
		$validator =  Validator::make(array_map('trim',$data), [
			'id_principal' => ['required', 'string', 'min:1'],
			'infolej' => ['required', 'string', 'min:1'],
			'usuario_nombre' => ['required', 'string', 'min:2'],
			'usuario_email' => ['required', 'string', 'email', 'max:255'],
			'usuario_comentario' => ['required', 'string', 'min:8'],
			'aviso_privacidad' => ['required', 'string', 'min:2'],
			'no_soy_robot' => ['required', 'string', 'min:1'],
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			//En caso de que todo esté bien
			$url = "";
			$file =$request->file('file');
			//Y si el usuario envía un archivo adjunto a su comentario	
			if($file){
				
				
				/*Procedimiento para guardar la nueva imagen*/
				$folder = "archivos_comentarios";

				$name =  $request->file('file')->getClientOriginalName();
				$name = "Iniciativa _".$request["idp"]."_".$request["idi"];
				$extension = $request->file('file')->getClientOriginalExtension();
				$filename = $name." ".date('Y-m-d His').".".$extension;

				//Validación que se hace para verificar que si se está mandando un archivo
				if($_FILES['file']['tmp_name'] != NULL){
					$mimetype = mime_content_type($_FILES['file']['tmp_name']);


					//Validación para revisar si la extensión del archivo es la requerida
					if(!in_array($mimetype, array("application/vnd.microsoft.portable-executable", "application/octet-stream"))) {
					
						$file = $_FILES['file'];
						$size = $file["size"];

						//Validación que se hace para verificar que tenga el tamaño requerido
						if($size > env('UPLOAD_MAX_FILESIZE_BYTES')){ //3MB
							$response["status"] = "422";
							$response["msg"]= array("El tamaño del archivo no debe superar los ".env('UPLOAD_MAX_FILESIZE'));
							

						}else{
							//Si cumple con la extensión y tamaño requerido, se procede a almacenarla
							$url = "public/".$request->file('file')->storeAs($folder, $filename, 'public');
							
						}
						

					} else {
						//De lo contrario, manda mensajes de error al backend
						$response["status"] = "422";
						$response["msg"]= array("El formato del archivo es incorrecto");
						
					}
				}
				else{
					//De lo contrario, manda mensajes de error al backend
					$response["status"] = "422";
					$response["msg"]= array("Error al subir el archivo");
					
				}
			}

			//Obtiene el detalle de la iniciativa de acuerdo al idi principal e infolej que se manda,
			//esto incluye los comentarios e imagen asociada
			$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
			->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->where("detalle_iniciativas_comision.infolej",$request["idi"])
			->where("detalle_iniciativas_comision.id_principal",$request["idp"])
			->first();

			$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;

			//Crea el registro de un nuevo comentario
			$response["rsp"] = IniciativaComentario::create([
				'id_principal' => $data['id_principal'],
				'infolej' => $data['infolej'],
				'id_iniciativa_interno'=>$id_iniciativa_interno,
				'usuario_nombre' => $data['usuario_nombre'],
				'usuario_email' => $data['usuario_email'],
				'usuario_comentario' => $data['usuario_comentario'],
				'usuario_url_file' => $url, //Así como la url donde se almacena el archivo que el usuario subió (si es que lo hace)
				'fecha_creacion' => date("Y-m-d H:i:s"),
				//Por default el campo aprobado es 0
			]);

			$folio = $response["rsp"]->id;
			//Obtiene el usuario para enviar notificación de correo
			$user =(Object) ["nombre"=>$data["usuario_nombre"], "email"=>$data["usuario_email"]];
				Notification::route('mail',$request["usuario_email"])->notify(new ComentarioUsuario($data,$iniciativa,$folio));
			
			//Obtiene la lista de usuarios que pertenecen a esa comisión para enviarle un correo de notificación de que hay un nuevo comentario que requiere ser aprobado
			$usuarios_comision = User::where("id_comision", $iniciativa->id_comision)->get();
			Notification::send($usuarios_comision, new ComentarioComision($data,$iniciativa,$folio));
			
			//Si todo surge bien, se cambia el status a 200
		 	if(array_key_exists('status', $response) != true){
		   		$response["status"] = "200";
		   	}
			
		}
		//Hasta que llegue aquí se ejecuta el commit en la base de datos
		DB::commit();
	}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
		//Si hay error se hace el rollback
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200); //Retorna este array al frontend
});


/*ROUTE DE DIPUTADOS*/
Route::get('/diputados', function () {

	/*Obtiene la lista de partidos que hay, de acuerdo a la tabla de diputados*/
	$partidos = Diputado::select("partido")->orderBy("partido")->groupBy("partido")->get();
	
	if($partidos){
		//Recorre los partidos para buscar los diputados pertenecientes a cada partido
		foreach ($partidos as $key => $value) {
			$partidos[$key]->diputados =  Diputado::where("partido",$value->partido)->orderBy("nombre")->get();;
		}
		
	}
	
	//Retorna al view diputados.blade.php la variable partidos
    return view('diputados', compact('partidos'));
})->name("diputados"); //Este name se usa por si en un view se requiere usar route("diputados") en vez de url("/diputados")


/*Route del perfil del diputado*/
Route::get('/perfil_diputado/{id}', function ($id) {

	//Busca un diputado en específico
	$diputado = Diputado::where("id_diputado", $id)->first();
	//Retorna al view perfil_diputado.blade.php la variable diputado
    return view('perfil_diputado', compact('diputado'));
});


/*Route de configuraciones*/
Route::get('/configuraciones', 'ConfiguracionesController@configuraciones')->name('configuraciones');

/*Routes para las acciones de usuarios en configuraciones*/
//DISPONIBLE PARA EL ADMINISTRADOR -> obtiene la información en específico de un usuario (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_usuario/{id}', 'ConfiguracionesController@show_usuario');
//DISPONIBLE PARA EL ADMINISTRADOR -> Crea un usuario (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/create_usuario', 'ConfiguracionesController@store_usuario');
//DISPONIBLE PARA EL ADMINISTRADOR -> Obtiene todos los usuarios (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_usuarios', 'ConfiguracionesController@get_usuarios');
//DISPONIBLE PARA EL ADMINISTRADOR -> Elimina un usuario (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/delete_usuario/{id}', 'ConfiguracionesController@destroy_usuario');
//DISPONIBLE PARA EL ADMINISTRADOR -> Actualiza la información de un usuario (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_usuario/{id}', 'ConfiguracionesController@update_usuario');
//DISPONIBLE PARA EL ADMINISTRADOR -> Actualiza la contraseña de un usuario (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_usuario_pass/{id}', 'ConfiguracionesController@update_usuario_pass');


/*Route para las terminologías en las configuraciones*/
//DISPONIBLE PARA EL ADMINISTRADOR -> obtiene la información en específico de una terminología (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_terminologia/{id}', 'ConfiguracionesController@show_terminologia');
//DISPONIBLE PARA EL ADMINISTRADOR -> Crea una terminología (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/create_terminologia', 'ConfiguracionesController@store_terminologia');
//DISPONIBLE PARA EL ADMINISTRADOR -> Obtiene todas las terminologías (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_terminologias', 'ConfiguracionesController@get_terminologias');
//DISPONIBLE PARA EL ADMINISTRADOR -> Elimina una terminología (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/delete_terminologia/{id}', 'ConfiguracionesController@destroy_terminologia');
//DISPONIBLE PARA EL ADMINISTRADOR -> Actualiza una terminología (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_terminologia/{id}', 'ConfiguracionesController@update_terminologia');

/*Route para los vídeos del home en las configuraciones*/
//obtiene la información en específico de un vídeo (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_video/{id}', 'ConfiguracionesController@show_video');
//Crea un vídeo (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/create_video', 'ConfiguracionesController@store_video');
//obtiene todos los vídeos (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_videos', 'ConfiguracionesController@get_videos');
//Elimina un vídeo (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/delete_video/{id}', 'ConfiguracionesController@destroy_video');
//Actualiza un vídeo (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_video/{id}', 'ConfiguracionesController@update_video');

/*Route para las iniciativas en las configuraciones*/
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> obtiene la información en específico de una iniciativa de acuerdo a un id principal e infolej (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_iniciativa/{idp}/{idi}', 'ConfiguracionesController@show_iniciativa');
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> obtiene todas las iniciativas (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_iniciativas', 'ConfiguracionesController@get_iniciativas');
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> Elimina una iniciativa (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/delete_iniciativa/{idp}/{idi}', 'ConfiguracionesController@destroy_iniciativa');
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> Actualiza una iniciativa (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_iniciativa/{idp}/{idi}', 'ConfiguracionesController@update_iniciativa');


/*Route para los comentarios*/
//Obtiene los comentarios pendientes de aprobar, si es ADMINISTRADOR, obtiene todos, si es un usuario de comisión solo los de su comisión, de lo contrario no ve nada(Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_comentarios', 'ConfiguracionesController@get_comentarios');
//Obtiene los comentarios aprobados, si es ADMINISTRADOR, obtiene todos, si es un usuario de comisión solo los de su comisión, de lo contrario no ve nada(Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_comentarios_aprobados', 'ConfiguracionesController@get_comentarios_aprobados');
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> Función que aprueba un comentario (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/aprobar_comentario', 'ConfiguracionesController@aprobar_comentario');
//DISPONIBLE PARA EL ADMINISTRADOR/USUARIO DE COMISIÓN -> Función que aprueba uno o varios comentario (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/aprobar_comentarios', 'ConfiguracionesController@aprobar_comentarios');

//Función que obtiene el archivo que un usuario sube al comentar una iniciativa
Route::get('get_file_comentario/{ide}', function ($ide) {

	//Busca la iniciativa
	$document = IniciativaComentario::where("id", $ide)->first();

	if($document){
		$id_user = Auth::id();
		$user = User::find($id_user); 
		//si es el propietario
			
		$filePath = $document->usuario_url_file;
		// file not found
		if( ! Storage::exists($filePath) ) { //Si no existe el documento, manda un error 404
			abort(404);
		}

		//Si existe
		$pdfContent = Storage::get($filePath);

		$type       = Storage::mimeType($filePath);
		if($type == "application/x-empty" || strpos($type, "x-empty") !== false){
			abort(403, 'Este archivo se encuentra vacío');
		}
		else if(strpos($type, "image") !== false){ //Y es una imagen
			
			$file = storage_path()."/app/".$filePath;
			
			$image = $file;
			// Read image path, convert to base64 encoding
			$imageData = base64_encode(file_get_contents($image));

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

			// Echo out a sample image
			echo '<img src="' . $src . '">';
		}else{ //Y no es una imagen
			$fileName   = $filePath;

			return Response::make($pdfContent, 200, [
				'Content-Type'        => $type,
				'Content-Disposition' => 'inline; filename="'.$fileName.'"'
			]);
		}
		
	}else{ //Si no existe el id, manda un error 404
		abort(404);
	}
	
    
});

/*Route para suscribirse a una iniciativa*/
Route::post('/suscripcion', function (Request $request) {
	DB::beginTransaction();
	try {
		
		//Se arma el arreglo de los datos que se pasan por post
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"infolej" => $request["idi"],
			"id_principal" => $request["idp"]);
		//Se definen los nombres que corresponden a las variables que se mandan por post
		$niceNames = array(
			"id_principal" => 'Iniciativa',
			"infolej" => 'Iniciativa',
			'nombre' => 'Nombre',
			'email' => 'Email',
			
		);
		//Validadores del formulario que se envía
		$validator =  Validator::make(array_map('trim',$data), [
			'id_principal' => ['required', 'string', 'min:1'],
			'infolej' => ['required', 'string', 'min:1'],
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			//En caso de que todo esté bien, se actualiza el usuario

			//Busca la información de la iniciativa
			$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
			->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->where("detalle_iniciativas_comision.infolej",$request["idi"])
			->where("detalle_iniciativas_comision.id_principal",$request["idp"])
			->first();

			$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;

			//Busca si el usuario ya está suscrito en la iniciativa
			$buscar_usuario = IniciativaSuscripcion::where("email",$data["email"])
			->where("iniciativa_suscripciones.infolej",$request["idi"])
			->where("iniciativa_suscripciones.id_principal",$request["idp"])
			->first();
			if($buscar_usuario){ //Si está suscrito, arma el mensaje para notificarlo
				$response = array("status"=>"422", "msg" => ["Este usuario ya se encuentra registrado en esta iniciativa"]);
			}else{
				//Si no está suscrito, lo registra
				$response = IniciativaSuscripcion::create([
					'id_principal' => $data['id_principal'],
					'infolej' => $data['infolej'],
					'id_iniciativa_interno'=>$id_iniciativa_interno,
					'nombre' => $data['nombre'],
					'email' => $data['email'],
					'id_usuario' => Auth::id(),
					'fecha_suscripcion'=>date("Y-m-d H:i:s")
					
					
				]);

				//Y envía notificación de suscripción del usuario
				
				$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
				Notification::route('mail',$request["email"])->notify(new SuscripcionUsuario($data,$iniciativa));
				

				$response["status"] = "200";
			}
		}
		//Hasta que llegue aquí se ejecuta el commit en la base de datos
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
		//Si hay error se hace el rollback
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200); //Retorna este array al frontend
});

/*Route para suscribirse a las comisiones*/
Route::post('/suscripcion_comisiones', function (Request $request) {
	DB::beginTransaction();
	try {
		
		//Se arma el arreglo de los datos que se pasan por post
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		//Se definen los nombres que corresponden a las variables que se mandan por post
		$niceNames = array(
			'nombre' => 'Nombre',
			'email' => 'Email',
			'comisiones' => 'Comisiones',
			"aviso_privacidad" => "Aviso de privacidad",
			"no_soy_robot" => "No soy un robot"
			
		);
		//Validadores del formulario que se envía
		$validator =  Validator::make(array_map('trim',$data), [
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'aviso_privacidad' => ['required', 'string', 'min:2'],
			'no_soy_robot' => ['required', 'string', 'min:1'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			
			//En caso de que todo esté bien
			$comisiones = $request["comisiones"]; //Obtiene las comisiones
			$nombre_comisiones = [];
			$comisiones_suscritas = 0;
			if($comisiones){
			
				foreach ($comisiones as $key => $value) {
					$comision = ConteoIniciativasComision::where("id_comision", $value)->first();
					
					//Busca si el usuario ya está registrado a la(s) comisión(es) marcada(s)
					$buscar_usuario = ComisionSuscripcion::where("email",$data["email"])
					->where("comision_suscripciones.id_comision",$value)
					->first();

					if($buscar_usuario){
						
					}else{//Si no está suscrito, lo suscribe, y registra el nombre de la comisión en un array
						$comisiones_suscritas ++;
						$nombre_comisiones[]=$comision->nombre_comision;
						$response = ComisionSuscripcion::create([
							'id_comision' => $value,
							'nombre' => $data['nombre'],
							'email' => $data['email'],
							'id_usuario' => Auth::id(),
							'fecha_suscripcion'=>date("Y-m-d H:i:s")
							
							
						]);
					
						$response["status"] = "200";
					}
				}
				//Si de todas las comisiones que marcó, hay alguna en la que falte de suscribir, envía correo
				if($comisiones_suscritas > 0){
					//envío de correos
					/* notificación por correo para el usuario*/
					$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
					Notification::route('mail',$request["email"])->notify(new SuscripcionComisionUsuario($data,$nombre_comisiones));
				}
				
			}

		}

		if(!isset($response)){
			//Si no se obtiene un array de respuesta, es porque ya está suscrito a todas las comisiones que se mandan
			$response = array("status"=>"422", "msg" => ["Ya te encuentras registrado en la(s) comision(es) que seleccionaste"]);
		}
		//Hasta que llegue aquí se ejecuta el commit en la base de datos
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) {  //En caso de que ocurra un error, se define el array al frontend
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200); //Retorna este array al frontend
});

/*Route para suscribirse a las iniciativas*/
Route::post('/suscripcion_iniciativas', function (Request $request) {
	DB::beginTransaction();
	try {
		//Se arma el arreglo de los datos que se pasan por post
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		//Se definen los nombres que corresponden a las variables que se mandan por post
		$niceNames = array(
			'nombre' => 'Nombre',
			'email' => 'Email',
			'iniciativas' => 'Iniciativas',
			"aviso_privacidad" => "Aviso de privacidad",
			"no_soy_robot" => "No soy un robot"
			
		);
		//Validadores del formulario que se envía
		$validator =  Validator::make(array_map('trim',$data), [
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'aviso_privacidad' => ['required', 'string', 'min:2'],
			'no_soy_robot' => ['required', 'string', 'min:1'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			//En caso de que todo esté bien

			//Obtiene todas las iniciativas marcadas
			$iniciativas = $request["iniciativas"];
			$nombre_iniciativas = [];
			$iniciativas_suscritas = 0;
			if($iniciativas){
				//Recorre cada iniciativa marcada
				foreach ($iniciativas as $key => $value) {
					//Obtiene la información de la iniciativa en curso
					$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
						->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
						->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
						->where("detalle_iniciativas_comision.infolej",$value)
						->first();

					$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;
					
					//Busca si el usuario ya está suscrito a la iniciativa en curso
					$buscar_usuario = IniciativaSuscripcion::where("email",$data["email"])
					->where("iniciativa_suscripciones.infolej",$value)
					->first();
					if($buscar_usuario){
						
					}else{
						//Si no existe, lo suscribe
						$iniciativas_suscritas ++;
						$nombre_iniciativas[]=$iniciativa->nombre_iniciativa;
						$response = IniciativaSuscripcion::create([
							'id_principal' => $iniciativa->id_principal,
							'infolej' => $value,
							'id_iniciativa_interno'=>$id_iniciativa_interno,
							'nombre' => $data['nombre'],
							'email' => $data['email'],
							'id_usuario' => Auth::id(),
							'fecha_suscripcion'=>date("Y-m-d H:i:s")
							
							
						]);

						$response["status"] = "200";
					}
				}
				if($iniciativas_suscritas > 0){ //Si encontró al menos una iniciativa a suscribirse
					//Envía el correo de notificación al usuario
					$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
					Notification::route('mail',$request["email"])->notify(new SuscripcionIniciativaUsuario($data,$nombre_iniciativas));
				}
				
			}

		}

		if(!isset($response)){
			//Si no se obtiene un array de respuesta, es porque ya está suscrito a todas las iniciativas que se mandan
			$response = array("status"=>"422", "msg" => ["Ya te encuentras registrado en la(s) iniciativa(s) que seleccionaste"]);
		}
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
		//Si hay error se hace el rollback
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200); //Retorna este array al frontend
});

/*Route para cancelar todas las suscripciones*/
Route::get('/cancelar_suscripcion/{email}/{token}', function ($email,$token) {
	DB::beginTransaction();
	try {
		
		//Si el token coincide con lo que mandamos, quiere confirmar que si es alguien que quiere cancelar suscripción
		if($token == env("KEY_CANCELAR_SUSCRIPCION")){
			//Elimina todo registro de las suscripciones de las comisiones
			$response["resp"] = ComisionSuscripcion::where("email", $email)->delete();
			//Elimina todo registro de las suscripciones de las iniciativas
			$response["resp"] = IniciativaSuscripcion::where("email", $email)->delete();
			$response["status"] = 200;
			
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
			return redirect('/')->with('notification', '¡Se han cancelado todas las suscripciones!');
		}else{
			//Si el token no coincide, se envía mensaje de notificación
			return redirect('/')->with('notification', '¡El token para cancelar la suscripción es incorrecto!');
		}
		
	}

	catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
		//Si hay error se hace el rollback
		DB::rollback();
		return redirect('/')->with('notification', '¡Hubo un error al cancelar todas las suscripciones!');
	}
})->name("cancelar_suscripcion");




/*ROUTE DE DATOS ABIERTOS*/

Route::get('/datos', function () {

	
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandomDato::select("url_imagen")->get()->toArray();

	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}
	//Se arma las categorías de los datos
	$categorias_datos = array(array('nombre' =>  "Legislativo"),array('nombre' =>  "Administrativo"),array('nombre' =>  "Otro"));

	//Recorre las categorías y busca si hay datos pertenecientes a la categoría en turno
	foreach ($categorias_datos as $key => $value) {
		$categorias_datos[$key]["datos"] = DatosAbiertos::where("categoria",$value["nombre"])->get();
	}
	//Retorna al view datos_abiertos.blade.php las variables imagenes_random y categorias_datos
    return view('datos_abiertos', compact('imagenes_random','categorias_datos'));
})->name("datos");


Route::get('/datos_categoria/{categoria?}', function ($categoria) {

	/*Busca los datos abiertos pertenecientes a la categoría que se envía*/
	$datos = DatosAbiertos::where("categoria",$categoria)->get();

	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}

	//Retorna al view datos_categoria.blade.php las variables datos, imagenes_random y categoria
    return view('datos_categoria', compact('datos','imagenes_random','categoria'));
})->name("datos_categoria");

/*Route para los datos en las configuraciones*/
//DISPONIBLE PARA EL ADMINISTRADOR -> obtiene la información en específico de un dato (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_dato/{id}', 'ConfiguracionesController@show_dato');
//DISPONIBLE PARA EL ADMINISTRADOR -> guarda un dato (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/create_dato', 'ConfiguracionesController@store_dato');
//DISPONIBLE PARA EL ADMINISTRADOR -> obtiene todos los datos (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/get_datos', 'ConfiguracionesController@get_datos');
//DISPONIBLE PARA EL ADMINISTRADOR -> elimina un dato (Esta función se encuentra en ConfiguracionesController)
Route::get('/configuraciones/delete_dato/{id}', 'ConfiguracionesController@destroy_dato');
//DISPONIBLE PARA EL ADMINISTRADOR -> actualiza un dato (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/update_dato/{id}', 'ConfiguracionesController@update_dato');


//Función para enviar comentario de buzón
Route::post('send_comentario', function (Request $request) {
	DB::beginTransaction();
	try {
		session_start();
		$message = '';
		//Si el código de seguridad existe
		if ( isset($_POST['securityCode']) && ($_POST['securityCode']!="")){
		    if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0){ //pero no coincide
		    	
		        $message = array("¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.");
		        $response = array("status"=>"422", "msg" => $message);
		        
		    }else{
		    	//Si todo está bien, es decir coincide el código de seguridad
		    	//Se arma el arreglo de los datos que se pasan por post
				$data = array(
					"body" => $request["body"],
				);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					"body" => 'Comentario, queja o sugerencia',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'body' => ['required', 'string', 'min:8'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{
					//Si las validaciones pertinentes se cumplen, se procede a enviar el correo
					$body = $request["body"];
					$cc = env('MAIL_MAILTO_CC');
					Notification::route('mail',env('MAIL_MAILTO'))->notify(new Buzon($body, $cc));
					
					$response["status"] = "200";
				   	
					
				}
			}
		}else { //Si el código de seguridad no existe, se notifica al frontend
		    $message = array("Introduzca el código de seguridad.");
		    $response = array("status"=>"422", "msg" => $message);
		   
		}
		//Hasta que llegue aquí se ejecuta el commit en la base de datos
		DB::commit();
	}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
		//Si hay error se hace el rollback
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200); //Retorna este array al frontend
})->name("send_comentario");

//Sirve para cambiar la portada de los view (Esta función se encuentra en ConfiguracionesController)
Route::post('configuraciones/change_portada', 'ConfiguracionesController@change_portada');


//ESTADÍSTICAS
Route::get('/configuraciones/estadisticas', 'ConfiguracionesController@estadisticas');
//obtiene la información de los comentarios para ser graficado
Route::get('/configuraciones/get_data_graficas/{id?}/{fi?}/{ff?}', 'ConfiguracionesController@get_data_graficas');
