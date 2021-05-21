<?php

use Illuminate\Support\Facades\Route;
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
use App\Notifications\SuscripcionUsuario;
use App\Notifications\SuscripcionComisionUsuario;
use App\Notifications\SuscripcionIniciativaUsuario;
use App\Notifications\ComentarioUsuario;
use App\Notifications\ComentarioComision;
use App\Notifications\Buzon;
use App\Models\ImagenesRandom;
use App\Models\DatosAbiertos;
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
			$iniciativas[$key]->autores = PonentesIniciativa::where([["id_principal",$value->id_principal],["infolej",$value->infolej]])->get();
			$iniciativas[$key]->comentarios = IniciativaComentario::where([["id_principal",$value->id_principal],["infolej",$value->infolej],["aprobado",1]])->get();
		}
	}
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}

	
	
    return view('home', compact('videoyoutube', 'iniciativas','imagenes_random'));
});

/*ROUTE PARA LANZAR EL HOME*/
Route::get('/home', function () {
    return redirect('/');
});

/*ROUTE PARA LANZAR EL VIEW DE CONGRESO*/
Route::get('/congreso', function () {

	$terminos = [];
	$letra = "A";
	/*ARMA EL ABECEDARIO*/
	for ($i=65;$i<=90;$i++) {
		/*Busca los términos por letra*/
		$terminos[chr($i)] = Terminologia::where("nombre", "like", chr($i)."%")->get();
	}
    return view('congreso', compact('terminos','letra'));
})->name("congreso");

/*ROUTE PARA COMISIONES*/
Route::get('/comisiones', function () {

	/*Obtiene el listado de las comisiones*/
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

    return view('comisiones', compact('comisiones','imagenes_random'));
})->name("comisiones");

/*ROUTE PARA BUSCAR INICIATIVAS POR COMISIÓN*/
Route::get('/iniciativas/{nombre_comision}', function ($nombre_comision ) {

	/*Busca las iniciativas de esa comisión*/
	$iniciativas = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
	->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->where("nom_comision",$nombre_comision)
	->orderBy("fecha_inicial","desc")->paginate(9); //y las página de 9 en 9
	if($iniciativas){
		/*Recorre las iniciativas para obtener los autores*/
		foreach ($iniciativas as $key => $value) {
			$iniciativas[$key]->autores = PonentesIniciativa::where([["id_principal",$value->id_principal],["infolej",$value->infolej]])->get();
			$iniciativas[$key]->comentarios = IniciativaComentario::where([["id_principal",$value->id_principal],["infolej",$value->infolej],["aprobado",1]])->get();
		}
	}
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}

    return view('iniciativas', compact('iniciativas','nombre_comision','imagenes_random'));
});


/*ROUTE PARA OBTENER EL DETALLE DE UNA INICIATIVA*/
Route::get('/detalle_iniciativa/{id_i}/{id_p}', function ($id_i,$id_p) { //ID_PRINCIPAL, INFOLEJ

	/*Busca la iniciativa junto con los comentarios y los datos añadidos desde configuraciones*/
	$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
	->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
	->where("detalle_iniciativas_comision.infolej",$id_i)
	->where("detalle_iniciativas_comision.id_principal",$id_p)
	->first();

	if($iniciativa){
		//Busca las iniciativas y los estados procesales
		$iniciativa->autores = PonentesIniciativa::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej]])->get();
		$iniciativa->estados_procesales = EstadosProcesalesIniciativa::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej]])
		->orderBy("no_e", "desc")
		->get();
		$iniciativa->comentarios = IniciativaComentario::where([["id_principal",$iniciativa->id_principal],["infolej",$iniciativa->infolej],["aprobado",1]])
		->orderBy("fecha_creacion","desc")->paginate(10);
		
	}
    return view('detalle_iniciativa', compact('iniciativa'));
});


/*Route para comentar una iniciativa*/
Route::post('/comentar', function (Request $request) {
	DB::beginTransaction();
	try {
	
		$data = array(
			"id_principal" => $request["idp"],
			"infolej" => $request["idi"],
			"usuario_nombre" => $request["usuario_nombre"],
			"usuario_email" => $request["usuario_email"],
			"usuario_comentario" => $request["usuario_comentario"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		$niceNames = array(
			"id_principal" => 'Iniciativa',
			"infolej" => 'Iniciativa',
			'usuario_nombre' => 'Nombre',
			'usuario_email' => 'Email',
			'usuario_comentario' => 'Comentario',
			'aviso_privacidad' => 'Aviso de privacidad',
			'no_soy_robot' => 'No soy un robot',
		);
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
		if($validator->fails()){
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			$url = "";
			$file =$request->file('file');
				
			if($file){
				
				
				/*Procedimiento para guardar la nueva imagen*/
				$folder = "archivos_comentarios";

				$name =  $request->file('file')->getClientOriginalName();
				$name = "Iniciativa _".$request["idp"]."_".$request["idi"];
				$extension = $request->file('file')->getClientOriginalExtension();
				$filename = $name." ".date('Y-m-d His').".".$extension;

				if($_FILES['file']['tmp_name'] != NULL){
					$mimetype = mime_content_type($_FILES['file']['tmp_name']);


					if(!in_array($mimetype, array("application/vnd.microsoft.portable-executable", "application/octet-stream"))) {
					
						$file = $_FILES['file'];
						$size = $file["size"];

						if($size > "3145728"){ //3MB
							$response["status"] = "422";
							$response["msg"]= array("El tamaño del archivo no debe superar los 3MB");
							

						}else{

							$url = "public/".$request->file('file')->storeAs($folder, $filename, 'public');
							
						}
						

					} else {
						$response["status"] = "422";
						$response["msg"]= array("El formato del archivo es incorrecto");
						
					}
				}
				else{
					$response["status"] = "422";
					$response["msg"]= array("Error al subir el archivo");
					
				}
			}


			$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
			->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->where("detalle_iniciativas_comision.infolej",$request["idi"])
			->where("detalle_iniciativas_comision.id_principal",$request["idp"])
			->first();

			$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;

			$response = IniciativaComentario::create([
				'id_principal' => $data['id_principal'],
				'infolej' => $data['infolej'],
				'id_iniciativa_interno'=>$id_iniciativa_interno,
				'usuario_nombre' => $data['usuario_nombre'],
				'usuario_email' => $data['usuario_email'],
				'usuario_comentario' => $data['usuario_comentario'],
				'usuario_url_file' => $url,
				'fecha_creacion' => date("Y-m-d H:i:s"),
				
			]);
			$folio = $response->id;
			$user =(Object) ["nombre"=>$data["usuario_nombre"], "email"=>$data["usuario_email"]];
				Notification::route('mail',$request["usuario_email"])->notify(new ComentarioUsuario($data,$iniciativa,$folio));
			$usuarios_comision = User::where("id_comision", $iniciativa->id_comision)->get();
			Notification::send($usuarios_comision, new ComentarioComision($data,$iniciativa,$folio));
			
			
		 	if(array_key_exists('status', $response) != true){
		   		$response["status"] = "200";
		   	}
			
		}
		DB::commit();
	}catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200);
});


/*ROUTE DE DIPUTADOS*/
Route::get('/diputados', function () {

	/*Busca los partidos*/
	$partidos = Diputado::select("partido")->orderBy("partido")->groupBy("partido")->get();
	
	if($partidos){
		//Recorre los partidos para buscar los diputados
		foreach ($partidos as $key => $value) {
			$partidos[$key]->diputados =  Diputado::where("partido",$value->partido)->orderBy("nombre")->get();;
		}
		
	}
	
    return view('diputados', compact('partidos'));
})->name("diputados");


/*Route del perfil del diputado*/
Route::get('/perfil_diputado/{id}', function ($id) {
	//Busca un diputado en específico
	$diputado = Diputado::where("id_diputado", $id)->first();
    return view('perfil_diputado', compact('diputado'));
});


/*Route de configuraciones*/
Route::get('/configuraciones', function () {

	/*Busca las comisiones*/
	$comisiones = ConteoIniciativasComision::select("conteo_iniciativas_comision.id_comision","conteo_iniciativas_comision.nombre_comision","imagenes_comisiones.url_imagen")
	->leftJoin('imagenes_comisiones', 'imagenes_comisiones.id_comision', '=', 'conteo_iniciativas_comision.id_comision')
	->orderBy("nombre_comision")->get();
	
	$categorias_datos = (object) array(array('nombre' =>  "Legislativo"),array('nombre' =>  "Otro"));
	
    return view('configuraciones', compact('comisiones',"categorias_datos"));
})->name("configuraciones");

/*Routes para las acciones de usuarios en configuraciones*/
Route::get('/configuraciones/get_usuario/{id}', 'ConfiguracionesController@show_usuario');
Route::post('configuraciones/create_usuario', 'ConfiguracionesController@store_usuario');
Route::get('/configuraciones/get_usuarios', 'ConfiguracionesController@get_usuarios');
Route::get('/configuraciones/delete_usuario/{id}', 'ConfiguracionesController@destroy_usuario');
Route::post('configuraciones/update_usuario/{id}', 'ConfiguracionesController@update_usuario');
Route::post('configuraciones/update_usuario_pass/{id}', 'ConfiguracionesController@update_usuario_pass');


/*Route para las terminologías en las configuraciones*/
Route::get('/configuraciones/get_terminologia/{id}', 'ConfiguracionesController@show_terminologia');
Route::post('configuraciones/create_terminologia', 'ConfiguracionesController@store_terminologia');
Route::get('/configuraciones/get_terminologias', 'ConfiguracionesController@get_terminologias');
Route::get('/configuraciones/delete_terminologia/{id}', 'ConfiguracionesController@destroy_terminologia');
Route::post('configuraciones/update_terminologia/{id}', 'ConfiguracionesController@update_terminologia');

/*Route para los vídeos del home en las configuraciones*/
Route::get('/configuraciones/get_video/{id}', 'ConfiguracionesController@show_video');
Route::post('configuraciones/create_video', 'ConfiguracionesController@store_video');
Route::get('/configuraciones/get_videos', 'ConfiguracionesController@get_videos');
Route::get('/configuraciones/delete_video/{id}', 'ConfiguracionesController@destroy_video');
Route::post('configuraciones/update_video/{id}', 'ConfiguracionesController@update_video');

/*Route para las iniciativas en las configuraciones*/
Route::get('/configuraciones/get_iniciativa/{idp}/{idi}', 'ConfiguracionesController@show_iniciativa');
Route::post('configuraciones/create_iniciativa', 'ConfiguracionesController@store_iniciativa');
Route::get('/configuraciones/get_iniciativas', 'ConfiguracionesController@get_iniciativas');
Route::get('/configuraciones/delete_iniciativa/{idp}/{idi}', 'ConfiguracionesController@destroy_iniciativa');
Route::post('configuraciones/update_iniciativa/{idp}/{idi}', 'ConfiguracionesController@update_iniciativa');


/*Route para los comentarios*/
Route::get('/configuraciones/get_comentarios', 'ConfiguracionesController@get_comentarios');
Route::post('configuraciones/aprobar_comentario', 'ConfiguracionesController@aprobar_comentario');

Route::get('get_file_comentario/{ide}', function ($ide) {

	$document = IniciativaComentario::where("id", $ide)->first();

	if($document){
		$id_user = Auth::id();
		$user = User::find($id_user); 
		//si es el propietario
			
		$filePath = $document->usuario_url_file;
		// file not found
		if( ! Storage::exists($filePath) ) {
			abort(404);
		}

		$pdfContent = Storage::get($filePath);

		$type       = Storage::mimeType($filePath);
		if($type == "application/x-empty" || strpos($type, "x-empty") !== false){
			abort(403, 'Este archivo se encuentra vacío');
		}
		else if(strpos($type, "image") !== false){
			
			$file = storage_path()."/app/".$filePath;
			
			$image = $file;
			// Read image path, convert to base64 encoding
			$imageData = base64_encode(file_get_contents($image));

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

			// Echo out a sample image
			echo '<img src="' . $src . '">';
		}else{
			$fileName   = $filePath;

			return Response::make($pdfContent, 200, [
				'Content-Type'        => $type,
				'Content-Disposition' => 'inline; filename="'.$fileName.'"'
			]);
		}
		
	
		
	}else{
		abort(404);
	}
	
    
});

/*Route para suscribirse a una iniciativa*/
Route::post('/suscripcion', function (Request $request) {
	DB::beginTransaction();
	try {
	
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"infolej" => $request["idi"],
			"id_principal" => $request["idp"]);
		$niceNames = array(
			"id_principal" => 'Iniciativa',
			"infolej" => 'Iniciativa',
			'nombre' => 'Nombre',
			'email' => 'Email',
			
		);
		$validator =  Validator::make(array_map('trim',$data), [
			'id_principal' => ['required', 'string', 'min:1'],
			'infolej' => ['required', 'string', 'min:1'],
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			

			$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
			->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
			->where("detalle_iniciativas_comision.infolej",$request["idi"])
			->where("detalle_iniciativas_comision.id_principal",$request["idp"])
			->first();
			$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;

			$buscar_usuario = IniciativaSuscripcion::where("email",$data["email"])
			->where("iniciativa_suscripciones.infolej",$request["idi"])
			->where("iniciativa_suscripciones.id_principal",$request["idp"])
			->first();
			if($buscar_usuario){
				$response = array("status"=>"422", "msg" => ["Este usuario ya se encuentra registrado en esta iniciativa"]);
			}else{
				$response = IniciativaSuscripcion::create([
					'id_principal' => $data['id_principal'],
					'infolej' => $data['infolej'],
					'id_iniciativa_interno'=>$id_iniciativa_interno,
					'nombre' => $data['nombre'],
					'email' => $data['email'],
					'id_usuario' => Auth::id(),
					'fecha_suscripcion'=>date("Y-m-d H:i:s")
					
					
				]);

				//envío de correos			
				/* notificación por correo para el usuario*/
				
				$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
				Notification::route('mail',$request["email"])->notify(new SuscripcionUsuario($data,$iniciativa));
				

				$response["status"] = "200";
			}
		}
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200);
});

/*Route para suscribirse a las comisiones*/
Route::post('/suscripcion_comisiones', function (Request $request) {
	DB::beginTransaction();
	try {
	
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		$niceNames = array(
			'nombre' => 'Nombre',
			'email' => 'Email',
			'comisiones' => 'Comisiones',
			"aviso_privacidad" => "Aviso de privacidad",
			"no_soy_robot" => "No soy un robot"
			
		);
		$validator =  Validator::make(array_map('trim',$data), [
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'aviso_privacidad' => ['required', 'string', 'min:2'],
			'no_soy_robot' => ['required', 'string', 'min:1'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			

			$comisiones = $request["comisiones"];
			$nombre_comisiones = [];
			$comisiones_suscritas = 0;
			if($comisiones){
			
				foreach ($comisiones as $key => $value) {
					$comision = ConteoIniciativasComision::where("id_comision", $value)->first();
					
					$buscar_usuario = ComisionSuscripcion::where("email",$data["email"])
					->where("comision_suscripciones.id_comision",$value)
					->first();
					if($buscar_usuario){
						
					}else{
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
				if($comisiones_suscritas > 0){
					//envío de correos
					/* notificación por correo para el usuario*/
					$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
					Notification::route('mail',$request["email"])->notify(new SuscripcionComisionUsuario($data,$nombre_comisiones));
				}
				
			}

		}

		if(!isset($response)){
			$response = array("status"=>"422", "msg" => ["Ya te encuentras registrado en la(s) comision(es) que seleccionaste"]);
		}
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200);
});

/*Route para suscribirse a las iniciativas*/
Route::post('/suscripcion_iniciativas', function (Request $request) {
	DB::beginTransaction();
	try {
	
		$data = array(
			"nombre" => $request["nombre"],
			"email" => $request["email"],
			"aviso_privacidad" => $request["aviso_privacidad"],
			"no_soy_robot" => $request["no_soy_robot"]);
		$niceNames = array(
			'nombre' => 'Nombre',
			'email' => 'Email',
			'iniciativas' => 'Iniciativas',
			"aviso_privacidad" => "Aviso de privacidad",
			"no_soy_robot" => "No soy un robot"
			
		);
		$validator =  Validator::make(array_map('trim',$data), [
			'nombre' => ['required', 'string', 'min:2'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'aviso_privacidad' => ['required', 'string', 'min:2'],
			'no_soy_robot' => ['required', 'string', 'min:1'],
			
		]);
		$validator->setAttributeNames($niceNames); 
		 //Si hay errores, retorna
		if($validator->fails()){
			$response = array("status"=>"422", "msg" => $validator->messages());
		}else{
			

			$iniciativas = $request["iniciativas"];
			$nombre_iniciativas = [];
			$iniciativas_suscritas = 0;
			if($iniciativas){
			
				foreach ($iniciativas as $key => $value) {
					$iniciativa = DetalleIniciativasComision::select("detalle_iniciativas_comision.*","comentarios_iniciativa.comentarios_iniciativas","iniciativas.nombre as nombre_iniciativa","iniciativas.url_imagen","iniciativas.url_video","iniciativas.descripcion_video")
						->leftJoin('comentarios_iniciativa', 'comentarios_iniciativa.infolej', '=', 'detalle_iniciativas_comision.infolej')
						->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
						->where("detalle_iniciativas_comision.infolej",$value)
						->first();
					$id_iniciativa_interno = ($iniciativa) ? $iniciativa->id : 0 ;
					
					$buscar_usuario = IniciativaSuscripcion::where("email",$data["email"])
					->where("iniciativa_suscripciones.infolej",$value)
					->first();
					if($buscar_usuario){
						
					}else{
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
				if($iniciativas_suscritas > 0){
					//envío de correos
												
					/* notificación por correo para el usuario*/
					$user =(Object) ["nombre"=>$data["nombre"], "email"=>$data["email"]];
					Notification::route('mail',$request["email"])->notify(new SuscripcionIniciativaUsuario($data,$nombre_iniciativas));
				}
				
			}

		}

		if(!isset($response)){
			$response = array("status"=>"422", "msg" => ["Ya te encuentras registrado en la(s) iniciativa(s) que seleccionaste"]);
		}
		DB::commit();
	
	}catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200);
});

/*Route para suscribirse a una iniciativa*/
Route::get('/cancelar_suscripcion/{email}/{token}', function ($email,$token) {
	DB::beginTransaction();
	try {
		
		if($token == env("KEY_CANCELAR_SUSCRIPCION")){
			$response["resp"] = ComisionSuscripcion::where("email", $email)->delete();
			$response["resp"] = IniciativaSuscripcion::where("email", $email)->delete();
			$response["status"] = 200;
			
			DB::commit();
			return redirect('/')->with('notification', '¡Se han cancelado todas las suscripciones!');
		}else{
			return redirect('/')->with('notification', '¡El token para cancelar la suscripción es incorrecto!');
		}
		
	}
	catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		return redirect('/')->with('notification', '¡Hubo un error al cancelar todas las suscripciones!');
	}
})->name("cancelar_suscripcion");


/*Routes para login, register*/
Auth::routes();






/*ROUTE DE DATOS ABIERTOS*/

Route::get('/datos', function () {

	
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}
	$categorias_datos = array(array('nombre' =>  "Legislativo"),array('nombre' =>  "Otro"));
	foreach ($categorias_datos as $key => $value) {
		$categorias_datos[$key]["datos"] = DatosAbiertos::where("categoria",$value["nombre"])->get();
	}
    return view('datos_abiertos', compact('imagenes_random','categorias_datos'));
})->name("datos");


Route::get('/datos_categoria/{categoria?}', function ($categoria) {

	/*Busca los datos abiertos*/
	$datos = DatosAbiertos::where("categoria",$categoria)->get();
	/*Obtengo las imágenes que usaré en caso de que una iniciativa no tenga foto*/
	$imagenes_random = ImagenesRandom::select("url_imagen")->get()->toArray();
	$orden_exito = shuffle($imagenes_random); //Se mezclan
	while($orden_exito == false){
		$orden_exito = shuffle($imagenes_random);
	}

	
    return view('datos_categoria', compact('datos','imagenes_random','categoria'));
})->name("datos_categoria");

/*Route para los datos en las configuraciones*/
Route::get('/configuraciones/get_dato/{id}', 'ConfiguracionesController@show_dato');
Route::post('configuraciones/create_dato', 'ConfiguracionesController@store_dato');
Route::get('/configuraciones/get_datos', 'ConfiguracionesController@get_datos');
Route::get('/configuraciones/delete_dato/{id}', 'ConfiguracionesController@destroy_dato');
Route::post('configuraciones/update_dato/{id}', 'ConfiguracionesController@update_dato');


Route::post('send_comentario', function (Request $request) {
	DB::beginTransaction();
	try {
		session_start();
		$message = '';
		if ( isset($_POST['securityCode']) && ($_POST['securityCode']!="")){
		    if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0){
		    	
		        $message = array("¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.");
		        $response = array("status"=>"422", "msg" => $message);
		        
		    }else{
				$data = array(
					"body" => $request["body"],
				);
				$niceNames = array(
					"body" => 'Comentario, queja o sugerencia',
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'body' => ['required', 'string', 'min:8'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{
					$body = $request["body"];
					$cc = env('MAIL_MAILTO_CC');
					Notification::route('mail',env('MAIL_MAILTO'))->notify(new Buzon($body, $cc));
					
					$response["status"] = "200";
				   	
					
				}
			}
		}else {
		    $message = array("Introduzca el código de seguridad.");
		    $response = array("status"=>"422", "msg" => $message);
		   
		}
		DB::commit();
	}catch (\Illuminate\Database\QueryException $e) {
		DB::rollback();
		$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
	}
	
	return response()->json($response,200);
})->name("send_comentario");
