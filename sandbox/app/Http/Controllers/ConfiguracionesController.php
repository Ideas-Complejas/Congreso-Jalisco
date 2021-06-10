<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Los modelos nos permiten acceder a la información de la base de datos
use App\Models\User;
use App\Models\Terminologia;
use App\Models\Video;
use App\Models\Iniciativa;
use App\Models\DatosAbiertos;
use App\Models\IniciativaComentario;
use App\Models\ConteoIniciativasComision;
use App\Models\DetalleIniciativasComision;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Notification;
//Estas notificaciones se usan para envío de correos
use App\Notifications\ComentarioAprobado;

class ConfiguracionesController extends Controller
{
	//permite verificar si está logueado*/
	public function __construct(){
		$this->middleware(['auth']);
	
	}

	public function configuraciones(){
		/*Busca las comisiones*/
		$comisiones = ConteoIniciativasComision::select("conteo_iniciativas_comision.id_comision","conteo_iniciativas_comision.nombre_comision","imagenes_comisiones.url_imagen")
		->leftJoin('imagenes_comisiones', 'imagenes_comisiones.id_comision', '=', 'conteo_iniciativas_comision.id_comision')
		->orderBy("nombre_comision")->get();
		
		$categorias_datos = (object) array(array('nombre' =>  "Legislativo"),array('nombre' =>  "Administrativo"),array('nombre' =>  "Otro"));
		
	    return view('configuraciones', compact('comisiones',"categorias_datos"));
	}
	//***************************USUARIOS*********************************************
	//Función que crea un usuario
	public function store_usuario(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("nombre" => $request["nombre"],
					"apellido_p" => $request["apellido_p"],
					"apellido_m" => $request["apellido_m"],
					"password" => $request["password"],
					"password_confirmation" => $request["password_confirmation"],
					"email" => $request["email"],
					"rol" => $request["rol"],
					"id_comision" => $request["id_comision"]
				);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'email' => 'Correo electrónico',
					'nombre' => 'Nombre',
					'apellido_p' => 'Apellido Paterno',
					'apellido_m' => 'Apellido Materno',
					'rol' => 'Rol',
					'password' => 'Contraseña',
					'password_confirmation' => 'Confirmar contraseña',
					'id_comision' => 'Comisión',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2'],
					'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
					'password' => ['required', 'string', 'min:8', 'confirmed'],
					'rol' => ['required', 'string', 'min:2'],
					'apellido_p' => ['required', 'string', 'min:2'],
					'apellido_m' => ['required', 'string', 'min:2'],
				]);

				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se crea el usuario
					$response = User::create([
						'nombre' => $data['nombre'],
						'apellido_p' => $data['apellido_p'],
						'apellido_m' => $data['apellido_m'],
						'email' => $data['email'],
						'id_comision' => $data['id_comision'],
						'rol'=>$data["rol"],
						'password' => Hash::make($data['password']), //Se hashea la contraseña
						
					]);
					
					$response["status"] = "200";
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{ 
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder 
			return redirect('/');
		}
	}

	//Función que actualiza los datos de un usuario
	public function update_usuario(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("nombre" => $request["nombre"],
					"apellido_p" => $request["apellido_p"],
					"apellido_m" => $request["apellido_m"],
					"rol" => $request["rol"],
					"email" => $request["email"],
					"id_comision" => $request["id_comision"]
				);
				//Se busca los datos del usuario que se quiere actualizar
				$usuario = User::find($id);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'email' => 'Correo electrónico',
					'nombre' => 'Nombre',
					'apellido_p' => 'Apellido Paterno',
					'apellido_m' => 'Apellido Materno',
					'rol' => 'Rol',
					'id_comision' => 'Comisión',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'email' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($usuario->id)], //Se valida que el email sea el único, ignorando la fila del usuario que se está actualizando
					'nombre' => ['required', 'string', 'min:2'],
					'apellido_p' => ['required', 'string', 'min:2'],
					'apellido_m' => ['required', 'string', 'min:2'],
					'rol' => ['required', 'string', 'min:2'],
				]);

				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se actualiza el usuario
					$response["resp"] = User::find($id)->update([
						'nombre' => $data['nombre'],
						'apellido_p' => $data['apellido_p'],
						'apellido_m' => $data['apellido_m'],
						'email' => $data['email'],
						'id_comision' => $data['id_comision'],
						'rol' => $data['rol'],
					]); 
					 
					$response["status"] = "200";
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Cambiar contraseña
	public function update_usuario_pass(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array(
					"password" => $request["password"],
					"password_confirmation" => $request["password_confirmation"],
					);
				//Se busca los datos del usuario que se quiere actualizar
				$usuario = User::find($id);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'password' => 'Contraseña',
					'password_confirmation' => 'Confirmar contraseña',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'password' => ['required', 'string', 'min:8', 'confirmed'],
				]);

				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se actualiza la contraseña
					$response["resp"] = User::find($id)->update([
						'password' => Hash::make($data['password']),
					]); 
					 
					$response["status"] = "200";
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Función que elimina un usuario
	public function destroy_usuario($id){   
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se busca el usuario que se quiere eliminar, y se elimina
				$response["resp"] = User::find($id)->delete();
				$response["status"] = 200;
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}
			catch (\Illuminate\Database\QueryException $e) {  //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				if($e->errorInfo[0] == "23000"){
					$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
				}else{
					$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
				}
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Obtiene los usuarios
	public function get_usuarios(){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::statement(DB::raw('set @rownum=0'));
			//Hace la consulta a la base de datos, los datos que se necesitan, son los siguientes (dentro del select):
			//DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision"
			$usuarios = User::select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision")
			->leftJoin('conteo_iniciativas_comision', 'conteo_iniciativas_comision.id_comision', '=', 'users.id_comision')
			->orderBy("users.nombre", "asc")
			->get();
			//Y retorna lo obtenido
			return response()->json($usuarios);  
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Muestra un usuario en específico
	public function show_usuario($id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			//Busca la información del usuario y se necesita esto "users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision"

			$usuario = User::select("users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision")
			->leftJoin('conteo_iniciativas_comision', 'conteo_iniciativas_comision.id_comision', '=', 'users.id_comision')
			->where("users.id",$id)
			->first();

			return response()->json($usuario); //Retorna al frontend la información obtenida
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//*********************************TERMINOLOGIAS*************************************
	//Función que crea un terminología
	public function store_terminologia(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("nombre" => $request["nombre"],
					"definicion" => $request["definicion"],
				);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'definicion' => 'Definición',
					'nombre' => 'Nombre',
					
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'definicion' => ['required', 'string', 'min:2'],
					'nombre' => ['required', 'string', 'min:2', 'unique:terminologias'],
				]);

				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se crea la terminología
					$response = Terminologia::create([
						'nombre' => $data['nombre'],
						'definicion' => $data['definicion'],
						
					]);

					$response["status"] = "200";
					
				}

				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Función que actualiza los datos de un terminología
	public function update_terminologia(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("nombre" => $request["nombre"],
					"definicion" => $request["definicion"],
				);
				//Se busca los datos de la terminología que se quiere actualizar
				$terminologia = Terminologia::find($id);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'definicion' => 'Definición',
					'nombre' => 'Nombre',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2',Rule::unique('terminologias')->ignore($terminologia->id)],
					'definicion' => ['required', 'string', 'min:2'],
					
				]);
				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se actualiza la terminología
					$response["resp"] = Terminologia::find($id)->update([
						'nombre' => $data['nombre'],
						'definicion' => $data['definicion'],
						
					]); 
					 
					$response["status"] = "200";
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
		
		
	}

	//Función que elimina un terminología
	public function destroy_terminologia($id){   
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se busca la terminología a eliminar y procede
				$response["resp"] = Terminologia::find($id)->delete();
				$response["status"] = 200;
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				if($e->errorInfo[0] == "23000"){
					$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
				}else{
					$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
				}
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Obtiene todas las terminologías
	public function get_terminologias(){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			//Obtiene todas las terminologías , lo que se manda es esto DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'terminologias.*'
			DB::statement(DB::raw('set @rownum=0'));
			$terminologias = DB::table('terminologias')
			->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'terminologias.*')
			->orderBy("terminologias.nombre", "asc")
			->get();
			return response()->json($terminologias);   //El resultado se manda al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Obtiene una terminología en específico
	public function show_terminologia($id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			//Busca el contenido de la terminología
			$terminologia = Terminologia::find($id);
			return response()->json($terminologia); //El resultado se manda al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//************************************VIDEOS EN HOME **********************************************++
	//Función que crea un vídeo
	public function store_video(Request $request){
		
		DB::beginTransaction();
		try {
			//Obtiene todos los vídeos que se han guardado
			$count_videos = Video::all();
			if($count_videos && count($count_videos)<3){ //Si hay menos de 3, permite crear otro
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("nombre" => $request["nombre"],
					"descripcion" => $request["descripcion"],
					"link" => $request["link"]
				);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'descripcion' => 'Descripción',
					'nombre' => 'Nombre',
					
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'descripcion' => ['required', 'string', 'min:2'],
					'link' => ['required', 'string', 'min:2'],
					'nombre' => ['required', 'string', 'min:2', 'unique:videos'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{
					//En caso de que todo esté bien, se crea el vídeo
					$response = Video::create([
						'nombre' => $data['nombre'],
						'descripcion' => $data['descripcion'],
						'link' => $data['link'],
						
					]);
					
					
					$response["status"] = "200";
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}else{
				//Mensaje de error que se manda si ya hay 3 vídeos
				$response = array("status"=>"422", "msg" => ["Solo se pueden añadir 3 vídeos"]);
			}
			
		}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		//Retorna este array al frontend
		return response()->json($response,200);
	}

	//Función que actualiza los datos de un vídeo
	public function update_video(Request $request, $id){
		
		DB::beginTransaction();
		try {
			//Se arma el arreglo de los datos que se pasan por post
			$data = array("nombre" => $request["nombre"],
				"descripcion" => $request["descripcion"],
				 "link" => $request["link"],
			);
			//Se busca los datos del vídeo que se quiere actualizar
			$video = Video::find($id);
			//Se definen los nombres que corresponden a las variables que se mandan por post
			$niceNames = array(
				'descripcion' => 'Descripción',
				'nombre' => 'Nombre',
			);
			//Validadores del formulario que se envía
			$validator =  Validator::make(array_map('trim',$data), [
				'nombre' => ['required', 'string', 'min:2',Rule::unique('videos')->ignore($video->id)],
				'descripcion' => ['required', 'string', 'min:2'],
				'link' => ['required', 'string', 'min:2'],
				
			]);
			$validator->setAttributeNames($niceNames);
			 //Si hay errores, retorna
			if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
				$response = array("status"=> "422", "msg" => $validator->messages());
			}else{
				//En caso de que todo esté bien, se actualiza el vídeo
				$response["resp"] = Video::find($id)->update([
					'nombre' => $data['nombre'],
					'descripcion' => $data['descripcion'],
					'link' => $data['link'],
					
				]); 
				 
				$response["status"] = "200";
				
			}
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}

	//Función que elimina un vídeo
	public function destroy_video($id){   
		
		DB::beginTransaction();
		try {
			//Se busca el vídeo que se quiere eliminar
			$response["resp"] = Video::find($id)->delete();
			$response["status"] = 200;
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			if($e->errorInfo[0] == "23000"){
				$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
			}else{
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}

	//Obtiene todos los vídeos del home
	public function get_videos(){

		//Obtiene los vídeos que deben ir en home
		DB::statement(DB::raw('set @rownum=0'));
		$videos = DB::table('videos')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'videos.*')
		->orderBy("videos.nombre", "asc")
		->get();
		return response()->json($videos);  //Y lo envía al frontend
	}

	//Obtiene solo un vídeo
	public function show_video($id){
		//Obtiene un vídeo en específico
		$video = Video::find($id);
		return response()->json($video); //Y lo envía al frontend
	}

	//*********************************************INICIATIVAS*********************************+
	

	//Función que actualiza los datos de un iniciativa
	public function update_iniciativa(Request $request, $idp,$idi){
		
		DB::beginTransaction();
		try {
			//Se arma el arreglo de los datos que se pasan por post
			$data = array("nombre" => $request["nombre"],
				"url_imagen" => $request["url_imagen"],
				"url_video" => $request["url_video"],
				"descripcion_video" => $request["descripcion_video"],
				
			);
			//Se definen los nombres que corresponden a las variables que se mandan por post
			$niceNames = array(
				'nombre' => 'Nombre',
				'url_imagen' => 'Url de imagen',
				'url_video' => 'Url de vídeo',
				'descripcion_video' => 'Descripción de vídeo'
				
			);
			//Se busca los datos de la iniciativa que se quiere actualizar
			 $iniciativa = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->first();
			if($iniciativa){ //Si la iniciativa existe
				//Validadores del formulario que se envía
				 $validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2',Rule::unique('iniciativas')->ignore($iniciativa->id)], //Se verifica que el nombre sea el único ignorando el que se esta actualizando
					'url_imagen' => ['string', 'min:2'],
					'url_video' => ['string', 'min:2'],
					'descripcion_video' => ['string', 'min:2'],
					
				]);
			}else{ //Si la iniciativa no existe
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2', 'unique:iniciativas'],
					'url_imagen' => ['string', 'min:2'],
					'url_video' => ['string', 'min:2'],
					'descripcion_video' => ['string', 'min:2'],
				]);
			}
			
		   
			$validator->setAttributeNames($niceNames);
			 //Si hay errores, retorna
			if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
				$response = array("status"=> "422", "msg" => $validator->messages());
			}else{
				//En caso de que todo esté bien
				$file =$request->file('file');
				
				$url_imagen = (isset($iniciativa)) ? $iniciativa->url_imagen : "" ;
				if($file){ //y se haya mandado una imagen
					
					$image_path = public_path()."/".$url_imagen;

					//En caso de que la iniciativa tenga una imagen anterior y se sube una nueva, la imagen anterior se elimina
					if($url_imagen != "" && $url_imagen != null){
						if(File::exists($image_path)){
							unlink($image_path);
						}
					}
				   
					/*Procedimiento para guardar la nueva imagen*/
					$folder = "imagenes_iniciativas";

					$name =  $request->file('file')->getClientOriginalName();
					$name = "Imagen iniciativa _".$idp."_".$idi;
					$extension = $request->file('file')->getClientOriginalExtension();
					$filename = $name." ".date('Y-m-d His').".".$extension;

					//Validación que se hace para verificar que si se está mandando un archivo
					if($_FILES['file']['tmp_name'] != NULL){
						$mimetype = mime_content_type($_FILES['file']['tmp_name']);

						//Validación para revisar si la extensión del archivo es la requerida
						if(in_array($mimetype, array("image/jpeg","image/png", "image/svg+xml"))) {
							$file = $_FILES['file'];
							$size = $file["size"];

							//Validación que se hace para verificar que tenga el tamaño requerido
							if($size > env('UPLOAD_MAX_FILESIZE_BYTES')){ //3MB
								//De lo contrario, manda mensajes de error al backend
								$response["status"] = "422";
								$response["msg"]= array("El tamaño del archivo no debe superar los ".env('UPLOAD_MAX_FILESIZE'));
								

							}else{
								//Si cumple con la extensión y tamaño requerido, se procede a almacenarla
								$request->file('file')->move(public_path($folder), $filename);
								$url_imagen = "/".$folder."/".$filename;
								

							}
							

						} else {
							//De lo contrario, manda mensajes de error al backend
							$response["status"] = "422";
							$response["msg"]= array("El formato del archivo es incorrecto, solo se permiten los siguientes formatos: .jpe .jpeg .jpg, .png, .svg");
							
						}
					}
					else{
						//De lo contrario, manda mensajes de error al backend
						$response["status"] = "422";
						$response["msg"]= array("Error al subir el archivo");
						
					}
				}

				if($iniciativa){ //Si la iniciativa existe se actualiza la info
					 $response["resp"] = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->update([
						'nombre' => $data['nombre'],
						'url_imagen' => $url_imagen,
						'url_video' => $data['url_video'],
						'descripcion_video' => $data['descripcion_video'],
						
					]); 
				 
				}else{ //Si no existe, se crea una nueva
					 $response = Iniciativa::create([
						'nombre' => $data['nombre'],
						'url_imagen' => $url_imagen,
						'url_video' => $data['url_video'],
						'descripcion_video' => $data['descripcion_video'],
						'id_principal' => $idp,
						'infolej' => $idi,
						
					]);
					
				
				}
			   	if(!isset($response["status"])){
			   		$response["status"] = "200";
			   	}
				
				
			}
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}

	//Función que elimina un iniciativa
	public function destroy_iniciativa($idp,$idi){   
		
		DB::beginTransaction();
		try {
			//Se busca los datos de la iniciativa a eliminar
			$iniciativa = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->first();
			$url_imagen = (isset($iniciativa)) ? $iniciativa->url_imagen : "" ;
			$image_path = public_path()."/".$url_imagen;
			//En caso de que tenga una imagen, se elimina
			if($url_imagen != null && $url_imagen != ""){
				if(File::exists($image_path)){
					unlink($image_path);
				}
			}
			//Se procede a eliminar
			$response["resp"] = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->delete();
			$response["status"] = 200;
			
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			if($e->errorInfo[0] == "23000"){
				$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
			}else{
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}
	
	//Obtiene todas las iniciativas
	public function get_iniciativas(){
		//Obtiene la información del usuario logueado
		$usuario = User::find(Auth::id());

		//Obtiene las iniciativas
		DB::statement(DB::raw('set @rownum=0'));
		$iniciativas = DB::table('detalle_iniciativas_comision')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'detalle_iniciativas_comision.id_principal','detalle_iniciativas_comision.infolej','iniciativas.nombre','iniciativas.url_imagen','iniciativas.url_video','iniciativas.descripcion_video','detalle_iniciativas_comision.nom_comision as comision')
		->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej');
		if($usuario->rol != "Administrador"){ //Si el usuario es diferente al administrador, hará el filtro para que solo traiga las que son de su comisión
			
			$iniciativas = $iniciativas->where("id_comision",$usuario->id_comision);
		}

		$iniciativas = $iniciativas->orderBy("detalle_iniciativas_comision.fecha_inicial", "desc")
		->get();
		return response()->json($iniciativas);  //Envía la información obtenida al frontend
	}

	//Obtiene solo una iniciativa
	public function show_iniciativa($idp,$idi){

		//Obtiene la información de una iniciativa de acuerdo al id principal y al infolej
		$iniciativa = DB::statement(DB::raw('set @rownum=0'));
		$iniciativa = DB::table('detalle_iniciativas_comision')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'detalle_iniciativas_comision.id_principal','detalle_iniciativas_comision.infolej','iniciativas.nombre','iniciativas.url_imagen','iniciativas.url_video','iniciativas.descripcion_video')
		->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
		->where("detalle_iniciativas_comision.infolej",$idi)
		->where("detalle_iniciativas_comision.id_principal", $idp)
		->first();
		return response()->json($iniciativa);  //Envía la información obtenida al frontend
	}

	//Obtiene los comentarios pendientes de aprobación
	public function get_comentarios(){
		//Obtiene la información del usuario logueado
		$usuario = User::find(Auth::id());
		//Obtiene los comentarios
		DB::statement(DB::raw('set @rownum=0'));
			$comentarios = IniciativaComentario::select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"iniciativa_comentarios.*",DB::raw("DATE_FORMAT(iniciativa_comentarios.fecha_creacion, '%Y-%m-%d') as fecha_creacion"),"detalle_iniciativas_comision.nom_comision as comision",'iniciativas.nombre as iniciativa',"detalle_iniciativas_comision.id_comision","iniciativa_comentarios.id as folio_comentario")
			->leftJoin('detalle_iniciativas_comision', 'detalle_iniciativas_comision.infolej', '=', 'iniciativa_comentarios.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'iniciativa_comentarios.infolej')
			->where("iniciativa_comentarios.aprobado", 0);
			
		if($usuario->rol != "Administrador"){ //Si el usuario es diferente al administrador, hará el filtro para que solo traiga las que son de su comisión
			$comentarios = $comentarios->where("id_comision",$usuario->id_comision);
		}
		$comentarios = $comentarios->orderBy("iniciativa_comentarios.fecha_creacion", "asc")
		->get();
		
		return response()->json($comentarios);   //Envía la información obtenida al frontend
	}

	//Obtiene los comentarios aprobados
	public function get_comentarios_aprobados(){
		//Obtiene la información del usuario logueado
		$usuario = User::find(Auth::id());
		//Obtiene los comentarios
		DB::statement(DB::raw('set @rownum=0'));
			$comentarios = IniciativaComentario::select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"iniciativa_comentarios.*",DB::raw("DATE_FORMAT(iniciativa_comentarios.fecha_creacion, '%Y-%m-%d') as fecha_creacion"),"detalle_iniciativas_comision.nom_comision as comision",'iniciativas.nombre as iniciativa',"detalle_iniciativas_comision.id_comision","iniciativa_comentarios.id as folio_comentario")
			->leftJoin('detalle_iniciativas_comision', 'detalle_iniciativas_comision.infolej', '=', 'iniciativa_comentarios.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'iniciativa_comentarios.infolej')
			->where("iniciativa_comentarios.aprobado", 1);
			
		if($usuario->rol != "Administrador"){ //Si el usuario es diferente al administrador, hará el filtro para que solo traiga las que son de su comisión
			$comentarios = $comentarios->where("id_comision",$usuario->id_comision);
		}
		$comentarios = $comentarios->orderBy("iniciativa_comentarios.fecha_creacion", "asc")
		->get();
		
		return response()->json($comentarios);   //Envía la información obtenida al frontend
	}

	//Aprobar comentario
	public function aprobar_comentario(Request $request){
		
		DB::beginTransaction();
		try {
			
			//Busca el comentario a aprobar, y actualiza la información de que se aprobó, quien lo aprobó y la fecha de aprobación
			$response["resp"] = IniciativaComentario::find($request["ide"])->update([
				'aprobado' => 1,
				'id_usuario_aprobacion' => Auth::id(),
				'fecha_aprobacion' => date("Y-m-d"),
				
			]); 
			 
			$response["status"] = "200";
				
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}

	//Aprobar uno o varios comentario
	public function aprobar_comentarios(Request $request){
		
		DB::beginTransaction();
		try {
			$comentarios = $request["comentarios"];
			if($comentarios){
				//Recorre los comentarios a aprobar
				foreach ($comentarios as $key => $value) {
					//Busca el comentario a aprobar, y actualiza la información de que se aprobó, quien lo aprobó y la fecha de aprobación
					$iniciativa = IniciativaComentario::select("iniciativa_comentarios.*","iniciativas.nombre as nombre_iniciativa")
					->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'iniciativa_comentarios.infolej')
					->where("iniciativa_comentarios.infolej",$value)
					->first();
					$comentario = IniciativaComentario::find($value);
					$response["resp"] = IniciativaComentario::find($value)->update([
						'aprobado' => 1,
						'id_usuario_aprobacion' => Auth::id(),
						'fecha_aprobacion' => date("Y-m-d"),
						
					]);
					//Se le notifica al usuario que su comentario fue aprobado
					$data =(Object) ["nombre"=>$comentario->usuario_nombre, "email"=>$comentario->usuario_email];
					Notification::route('mail',$comentario->usuario_email)->notify(new ComentarioAprobado($data,$comentario));

				}
				$response["status"] = "200";
			}else{
				$response = array("status"=>"422", "msg" => "Debes seleccionar al menos un comentario");
			}
			
			 
			
				
			//Hasta que llegue aquí se ejecuta el commit en la base de datos
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
			//Si hay error se hace el rollback
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200); //Retorna este array al frontend
	}


	/*************************************DATOS ABIERTOS**********************************/
	//Función que crea un dato
	public function store_dato(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("titulo" => $request["titulo"],
					"descripcion" => $request["descripcion"],
					"link" => $request["link"],
					"categoria" => $request["categoria"],
					"link_licencia" => $request["link_licencia"],
					"link_diccionario" => $request["link_diccionario"],

				);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'descripcion' => 'Descripción',
					'titulo' => 'Título',
					'link_licencia' => 'Licencia',
					'link_diccionario' => 'Diccionario',
					
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'descripcion' => ['required', 'string', 'min:2'],
					'titulo' => ['required', 'string', 'min:2', 'unique:datos_abiertos'],
					'categoria' => ['required', 'string', 'min:2'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{

					$file =$request->file('file');
				
					$url_imagen = "" ;
					//Si el dato tiene un archivo
					if($file){
						
					   
						/*Procedimiento para guardar la nueva imagen*/
						$folder = "datos_abiertos";

						$name =  $request->file('file')->getClientOriginalName();
						$name = "Imagen datos_abiertos";
						$extension = $request->file('file')->getClientOriginalExtension();
						$filename = $name." ".date('Y-m-d His').".".$extension;

						//y el archivo existe
						if($_FILES['file']['tmp_name'] != NULL){
							$mimetype = mime_content_type($_FILES['file']['tmp_name']);

							//y cumple con el tipo de archivo requerido
							if(in_array($mimetype, array("image/jpeg","image/png", "image/svg+xml"))) {
								$file = $_FILES['file'];
								$size = $file["size"];

								//Validación que se hace para verificar que tenga el tamaño requerido
								if($size > env('UPLOAD_MAX_FILESIZE_BYTES')){ //3MB
									//De lo contrario, manda mensajes de error al backend
									$response["status"] = "422";
									$response["msg"]= array("El tamaño del archivo no debe superar los ".env('UPLOAD_MAX_FILESIZE'));
									

								}else{
									//Si cumple con la extensión y tamaño requerido, se procede a almacenarla
									$request->file('file')->move(public_path($folder), $filename);
									$url_imagen = "/".$folder."/".$filename;
									

								}
								

							} else {
								//De lo contrario, manda mensajes de error al backend
								$response["status"] = "422";
								$response["msg"]= array("El formato del archivo es incorrecto, solo se permiten los siguientes formatos: .jpe .jpeg .jpg, .png, .svg");
								
							}
						}
						else{
							//De lo contrario, manda mensajes de error al backend
							$response["status"] = "422";
							$response["msg"]= array("El tamaño del archivo no debe superar los 3MB");
							
						}
					}

					//Se crea el dato
					$response["resp"] = DatosAbiertos::create([
						'titulo' => $data['titulo'],
						'descripcion' => $data['descripcion'],
						'url_imagen'=> $url_imagen,
						'link'=>$data["link"],
						'link_licencia'=>$data["link_licencia"],
						'link_diccionario'=>$data["link_diccionario"],
						"categoria" => $request["categoria"],
						
					]);
					
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
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Función que actualiza los datos de un dato
	public function update_dato(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se arma el arreglo de los datos que se pasan por post
				$data = array("titulo" => $request["titulo"],
					"descripcion" => $request["descripcion"],
					"link" => $request["link"],
					"categoria" => $request["categoria"],
					"link_licencia" => $request["link_licencia"],
					"link_diccionario" => $request["link_diccionario"],
				);
				//Se busca los datos del dato que se quiere actualizar
				$dato = DatosAbiertos::find($id);
				//Se definen los nombres que corresponden a las variables que se mandan por post
				$niceNames = array(
					'descripcion' => 'Descripción',
					'titulo' => 'Título',
					'link_licencia' => 'Licencia',
					'link_diccionario' => 'Diccionario',
				);
				//Validadores del formulario que se envía
				$validator =  Validator::make(array_map('trim',$data), [
					'titulo' => ['required', 'string', 'min:2',Rule::unique('datos_abiertos')->ignore($dato->id)],
					'descripcion' => ['required', 'string', 'min:2'],
					'categoria' => ['required', 'string', 'min:2'],
					
				]);
				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){ //Si encuentra que no se cumple el validador, se define el array con los mensajes de error y con los nicenames al frontend
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{
					$file =$request->file('file');
				
					$url_imagen = (isset($dato)) ? $dato->url_imagen : "" ;
					//Si el dato tiene una imagen
					if($file){
						
						$image_path = public_path()."/".$url_imagen;

						//En caso de que la iniciativa tenga una imagen anterior y se sube una nueva, la imagen anterior se elimina
						if($url_imagen != "" && $url_imagen != null){
							if(File::exists($image_path)){
								unlink($image_path);
							}
						}
					   
						/*Procedimiento para guardar la nueva imagen*/
						$folder = "datos_abiertos";

						$name =  $request->file('file')->getClientOriginalName();
						$name = "Imagen datos_abiertos";
						$extension = $request->file('file')->getClientOriginalExtension();
						$filename = $name." ".date('Y-m-d His').".".$extension;

						if($_FILES['file']['tmp_name'] != NULL){ //y en realidad si se manda un archivo
							$mimetype = mime_content_type($_FILES['file']['tmp_name']);

							//y cumple con el tipo de archivo requerido
							if(in_array($mimetype, array("image/jpeg","image/png", "image/svg+xml"))) {
								$file = $_FILES['file'];
								$size = $file["size"];

								//Validación que se hace para verificar que tenga el tamaño requerido
								if($size > env('UPLOAD_MAX_FILESIZE_BYTES')){ //3MB
									//De lo contrario, manda mensajes de error al backend
									$response["status"] = "422";
									$response["msg"]= array("El tamaño del archivo no debe superar los ".env('UPLOAD_MAX_FILESIZE'));
									

								}else{
									//Si cumple con la extensión y tamaño requerido, se procede a almacenarla
									$request->file('file')->move(public_path($folder), $filename);
									$url_imagen = "/".$folder."/".$filename;
									

								}
								

							} else {
								//De lo contrario, manda mensajes de error al backend
								$response["status"] = "422";
								$response["msg"]= array("El formato del archivo es incorrecto, solo se permiten los siguientes formatos: .jpe .jpeg .jpg, .png, .svg");
								
							}
						}
						else{
							//De lo contrario, manda mensajes de error al backend
							$response["status"] = "422";
							$response["msg"]= array("Error al subir el archivo");
							
						}
					}
					//Actualiza los datos 
					$response["resp"] = DatosAbiertos::find($id)->update([
						'titulo' => $data['titulo'],
						'url_imagen'=>$url_imagen,
						'link'=>$data['link'],
						'link_licencia'=>$data["link_licencia"],
						'link_diccionario'=>$data["link_diccionario"],
						'descripcion' => $data['descripcion'],
						"categoria" => $request["categoria"],
						
					]); 
					 
					if(array_key_exists('status', $response) != true){
			   			$response["status"] = "200";
			   		}
					
				}
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			return response()->json($response,200);  //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Función que elimina un dato
	public function destroy_dato($id){   
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				//Se busca los datos
				$dato = DatosAbiertos::where("id", $id)->first();
				$url_imagen = (isset($dato)) ? $dato->url_imagen : "" ;
				$image_path = public_path()."/".$url_imagen;
				//En caso de que tenga una imagen, se elimina
				if($url_imagen != null && $url_imagen != ""){
					if(File::exists($image_path)){
						unlink($image_path);
					}
				}
				//Se busca los datos del dato que se quiere eliminar
				$response["resp"] = DatosAbiertos::find($id)->delete();
				$response["status"] = 200;
				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}
			catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				if($e->errorInfo[0] == "23000"){
					$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
				}else{
					$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
				}
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Obtiene todas las datos
	public function get_datos(){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			//Obtiene los datos
			DB::statement(DB::raw('set @rownum=0'));
			$datos = DB::table('datos_abiertos')
			->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'datos_abiertos.*')
			->orderBy("datos_abiertos.titulo", "asc")
			->get();
			return response()->json($datos);   //Y envía el resultado al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Obtiene una dato en específico
	public function show_dato($id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			//Busca la información del dato
			$dato = DatosAbiertos::find($id);
			return response()->json($dato); //Y envía el resultado al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	
	//Función que crea un dato
	public function change_portada(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {

				$file =$request->file('file');
				//Si se recibe un archivo
				if($file){
					
					if($_FILES['file']['tmp_name'] != NULL){ //Y el archivo existe
						$mimetype = mime_content_type($_FILES['file']['tmp_name']);

						//y cumple con el tipo de archivo requerido
						if(in_array($mimetype, array("image/jpeg","image/png"))) {
							$file = $_FILES['file'];
							$size = $file["size"];

							//Validación que se hace para verificar que tenga el tamaño requerido
							if($size > env('UPLOAD_MAX_FILESIZE_BYTES')){ //3MB
								//De lo contrario, manda mensajes de error al backend
								$response["status"] = "422";
								$response["msg"]= array("El tamaño del archivo no debe superar los ".env('UPLOAD_MAX_FILESIZE'));
								

							}else{
								$image = $_FILES['file']['tmp_name'];
								switch (exif_imagetype($image)) {
								    case IMAGETYPE_GIF :
								        $img = imagecreatefromgif($image);
								        break;
								    case IMAGETYPE_JPEG :
								        $img = imagecreatefromjpeg($image);
								        break;
								    default :
								        $response["status"] = "422";
										$response["msg"]= array("Error en el formato de imagen");
										break;
								}
								
								//Si cumple con la extensión y tamaño requerido, se procede a almacenarla
								$filename = $_SERVER['DOCUMENT_ROOT'] ."".$_SERVER['PHP_SELF']."img/portada.png";
								$filename = str_replace("index.php", "", $filename);
								imagepng($img, $filename);
								$response["status"] = "200";
								$response["msg"]["url_portada"]= "img/portada.png";

							}
							

						} else {
							//De lo contrario, manda mensajes de error al backend
							$response["status"] = "422";
							$response["msg"]= array("El formato del archivo es incorrecto, solo se permiten los siguientes formatos: .jpe .jpeg .jpg, .png");
							
						}
					}
					else{
						//De lo contrario, manda mensajes de error al backend
						$response["status"] = "422";
						$response["msg"]= array("El tamaño del archivo no debe superar los 3MB");
						
					}
				}else{
					//De lo contrario, manda mensajes de error al backend
					$response = array("status"=>"422", "msg" => ["Debe subir una nueva imagen"]);
				}

				//Hasta que llegue aquí se ejecuta el commit en la base de datos
				DB::commit();
			}catch (\Illuminate\Database\QueryException $e) { //En caso de que ocurra un error, se define el array al frontend
				//Si hay error se hace el rollback
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200); //Retorna este array al frontend
		}else{
			abort(403, 'Acción no autorizada.'); //Lanza ventana 403 indicando que no se tiene permiso para acceder
			return redirect('/');
		}
	}

	//Función que manda al view de estadísticas
	public function estadisticas(){
		//Obtiene las comisiones*/
		$comisiones = ConteoIniciativasComision::select("conteo_iniciativas_comision.id_comision","conteo_iniciativas_comision.nombre_comision","imagenes_comisiones.url_imagen")
			->leftJoin('imagenes_comisiones', 'imagenes_comisiones.id_comision', '=', 'conteo_iniciativas_comision.id_comision')
			->orderBy("nombre_comision")->get();

		//Envía al view home.blade.php las variables videoyoutube, iniciativas, e imágenes_random
	    return view('estadisticas', compact("comisiones"));
	}
	//Función que realiza la búsqueda de los comentarios por comisión por iniciativa
	public function get_data_graficas($id_comision = "", $fecha_inicial = "", $fecha_final = ""){
		
		$infolej = [];
		//Obtiene las comisiones
		$comisiones = ConteoIniciativasComision::select("conteo_iniciativas_comision.id_comision")
		->groupBy("conteo_iniciativas_comision.id_comision")
		->get();
		
		if($comisiones){
			foreach ($comisiones as $key => $value) {

				//Busca las iniciativas asociadas a la comisión en turno
				$iniciativas = DetalleIniciativasComision::select("detalle_iniciativas_comision.nom_comision as comision","detalle_iniciativas_comision.id_comision", "detalle_iniciativas_comision.infolej", "detalle_iniciativas_comision.id_principal")
				->where("detalle_iniciativas_comision.id_comision", $value->id_comision);
				
				//Si se manda el filtro de alguna comisión, hace el filtro
				if($id_comision > 0){
					$iniciativas = $iniciativas->where("detalle_iniciativas_comision.id_comision", $id_comision);
				}
				$iniciativas = $iniciativas->get();

				//Recorre cada iniciativa de la comisión en turno
				foreach ($iniciativas as $key_i => $value_i) {
					//Agrega el nombre de la comisión 
					$comisiones[$key]["comision"] = $value_i->comision;
					//Busca el número de comentarios totales de la iniciativa
					$contador = IniciativaComentario::where([["id_principal",$value_i->id_principal],["infolej",$value_i->infolej]]);
					//Si hay fecha inicial, hace el respectivo filtro
					if($fecha_inicial != ""){
						$contador = $contador->where(DB::raw("DATE_FORMAT(iniciativa_comentarios.fecha_creacion, '%Y-%m-%d')"), ">=", $fecha_inicial);
					}
					//Si hay fecha final, hace el respectivo filtro
					if($fecha_final != ""){
						$contador = $contador->where(DB::raw("DATE_FORMAT(iniciativa_comentarios.fecha_creacion, '%Y-%m-%d')"), "<=", $fecha_final);
					}
					$contador = $contador->get()->count();
					if($contador > 0){
						//Si encontró más de un comentario lo añade en el data que se manda a graficar
						$comisiones[$key]["infolej ".$value_i->infolej.""] =  $contador ." com";
						$infolej[] = "infolej ".$value_i->infolej;
					}
					
				}
			}
		}
		
		//Lo que responde es la data de las comisiones con sus iniciativas y cuantos comentarios
		$response["comentarios"] = $comisiones;
		//Cuáles infolej (iniciativas) se encontraron con comentarios
		$response["infolej"] = $infolej;
		$response["status"] = "200";
		return response()->json($response);  //Envía la información obtenida al frontend
	}
}
