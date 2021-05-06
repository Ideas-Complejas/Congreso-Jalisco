<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Terminologia;
use App\Models\Video;
use App\Models\Iniciativa;
use App\Models\IniciativaComentario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ConfiguracionesController extends Controller
{
	//permite verificar si está logueado*/
	public function __construct(){
		$this->middleware(['auth']);
	
	}
	//***************************USUARIOS*********************************************
	//Función que crea un usuario
	public function store_usuario(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				
				$data = array("nombre" => $request["nombre"],
					"apellido_p" => $request["apellido_p"],
					"apellido_m" => $request["apellido_m"],
					"password" => $request["password"],
					"password_confirmation" => $request["password_confirmation"],
					"email" => $request["email"],
					"rol" => $request["rol"],
					"id_comision" => $request["id_comision"]
				);
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
				if($validator->fails()){
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{

					$response = User::create([
						'nombre' => $data['nombre'],
						'apellido_p' => $data['apellido_p'],
						'apellido_m' => $data['apellido_m'],
						'email' => $data['email'],
						'id_comision' => $data['id_comision'],
						'rol'=>$data["rol"],
						'password' => Hash::make($data['password']),
						
					]);
					$id_usuario = $response->id;
					
					$response["status"] = "200";
					
				}
				DB::commit();
			}catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Función que actualiza los datos de un usuario
	public function update_usuario(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				$data = array("nombre" => $request["nombre"],
					"apellido_p" => $request["apellido_p"],
					"apellido_m" => $request["apellido_m"],
					"rol" => $request["rol"],
					"email" => $request["email"],
					"id_comision" => $request["id_comision"]
				);
				$usuario = User::find($id);
				$niceNames = array(
					'email' => 'Correo electrónico',
					'nombre' => 'Nombre',
					'apellido_p' => 'Apellido Paterno',
					'apellido_m' => 'Apellido Materno',
					'rol' => 'Rol',
					'id_comision' => 'Comisión',
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'email' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($usuario->id)],
					'nombre' => ['required', 'string', 'min:2'],
					//'password' => ['required', 'string', 'min:8', 'confirmed'],
					'apellido_p' => ['required', 'string', 'min:2'],
					'apellido_m' => ['required', 'string', 'min:2'],
					'rol' => ['required', 'string', 'min:2'],
				]);
				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{

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
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Cambiar contraseña
	public function update_usuario_pass(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				$data = array(
					
					"password" => $request["password"],
					"password_confirmation" => $request["password_confirmation"],
					);
				$usuario = User::find($id);
				$niceNames = array(
					'password' => 'Contraseña',
					'password_confirmation' => 'Confirmar contraseña',
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'password' => ['required', 'string', 'min:8', 'confirmed'],
					
				]);
				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{

					$response["resp"] = User::find($id)->update([
						'password' => Hash::make($data['password']),
					]); 
					 
					$response["status"] = "200";
					
				}
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Función que elimina un usuario
	public function destroy_usuario($id){   
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				$usuario = User::find($id);
				$response["resp"] = User::find($id)->delete();
				$response["status"] = 200;
				
				DB::commit();
			}
			catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				if($e->errorInfo[0] == "23000"){
					$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
				}else{
					$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
				}
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Obtiene los usuarios
	public function get_usuarios(){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::statement(DB::raw('set @rownum=0'));
			$usuarios = User::select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision")
			->leftJoin('conteo_iniciativas_comision', 'conteo_iniciativas_comision.id_comision', '=', 'users.id_comision')
			->orderBy("users.nombre", "asc")
			->get();
			return response()->json($usuarios);  
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Muestra un usuario en específico
	public function show_usuario($id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			$usuario = User::select("users.rol","users.id","users.nombre","users.apellido_p","users.apellido_m","users.email","users.id_comision","conteo_iniciativas_comision.nombre_comision")
			->leftJoin('conteo_iniciativas_comision', 'conteo_iniciativas_comision.id_comision', '=', 'users.id_comision')
			->where("users.id",$id)
			->first();
			return response()->json($usuario);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//*********************************TERMINOLOGIAS*************************************
	//Función que crea un terminología
	public function store_terminologia(Request $request){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				
				$data = array("nombre" => $request["nombre"],
					"definicion" => $request["definicion"],
				);
				$niceNames = array(
					'definicion' => 'Definición',
					'nombre' => 'Nombre',
					
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'definicion' => ['required', 'string', 'min:2'],
					'nombre' => ['required', 'string', 'min:2', 'unique:terminologias'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{

					$response = Terminologia::create([
						'nombre' => $data['nombre'],
						'definicion' => $data['definicion'],
						
					]);
					$id_terminologia = $response->id;
					
					$response["status"] = "200";
					
				}
				DB::commit();
			}catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Función que actualiza los datos de un terminología
	public function update_terminologia(Request $request, $id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				$data = array("nombre" => $request["nombre"],
					"definicion" => $request["definicion"],
				);
				$terminologia = Terminologia::find($id);
				$niceNames = array(
					'definicion' => 'Definición',
					'nombre' => 'Nombre',
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2',Rule::unique('terminologias')->ignore($terminologia->id)],
					'definicion' => ['required', 'string', 'min:2'],
					
				]);
				$validator->setAttributeNames($niceNames);
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=> "422", "msg" => $validator->messages());
				}else{

					$response["resp"] = Terminologia::find($id)->update([
						'nombre' => $data['nombre'],
						'definicion' => $data['definicion'],
						
					]); 
					 
					$response["status"] = "200";
					
				}
				DB::commit();
				
			}
			catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
		
		
	}

	//Función que elimina un terminología
	public function destroy_terminologia($id){   
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::beginTransaction();
			try {
				$terminologia = Terminologia::find($id);
				$response["resp"] = Terminologia::find($id)->delete();
				$response["status"] = 200;
				
				DB::commit();
			}
			catch (\Illuminate\Database\QueryException $e) {
				DB::rollback();
				if($e->errorInfo[0] == "23000"){
					$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
				}else{
					$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
				}
			}
			
			return response()->json($response,200);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Obtiene todas las terminologías
	public function get_terminologias(){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			DB::statement(DB::raw('set @rownum=0'));
			$terminologias = DB::table('terminologias')
			->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'terminologias.*')
			->orderBy("terminologias.nombre", "asc")
			->get();
			return response()->json($terminologias);  
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//Obtiene una terminología en específico
	public function show_terminologia($id){
		if(Auth::user()->hasRole("Administrador") == true){ //si es administrador puede realizar lo siguiente
			$terminologia = Terminologia::find($id);
			return response()->json($terminologia);
		}else{
			abort(403, 'Acción no autorizada.');
			return redirect('/');
		}
	}

	//************************************VIDEOS EN HOME **********************************************++
	//Función que crea un vídeo
	public function store_video(Request $request){
		
		DB::beginTransaction();
		try {
			
			$count_videos = Video::all();
			if($count_videos && count($count_videos)<3){
				$data = array("nombre" => $request["nombre"],
					"descripcion" => $request["descripcion"],
					"link" => $request["link"]
				);
				$niceNames = array(
					'descripcion' => 'Descripción',
					'nombre' => 'Nombre',
					
				);
				$validator =  Validator::make(array_map('trim',$data), [
					'descripcion' => ['required', 'string', 'min:2'],
					'link' => ['required', 'string', 'min:2'],
					'nombre' => ['required', 'string', 'min:2', 'unique:videos'],
				]);
				$validator->setAttributeNames($niceNames); 
				 //Si hay errores, retorna
				if($validator->fails()){
					$response = array("status"=>"422", "msg" => $validator->messages());
				}else{

					$response = Video::create([
						'nombre' => $data['nombre'],
						'descripcion' => $data['descripcion'],
						'link' => $data['link'],
						
					]);
					$id_video = $response->id;
					
					$response["status"] = "200";
					
				}
				DB::commit();
			}else{
				$response = array("status"=>"422", "msg" => ["Solo se pueden añadir 3 vídeos"]);
			}
			
		}catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200);
	}

	//Función que actualiza los datos de un vídeo
	public function update_video(Request $request, $id){
		
		DB::beginTransaction();
		try {
			$data = array("nombre" => $request["nombre"],
				"descripcion" => $request["descripcion"],
				 "link" => $request["link"],
			);
			$video = Video::find($id);
			$niceNames = array(
				'descripcion' => 'Descripción',
				'nombre' => 'Nombre',
			);
			$validator =  Validator::make(array_map('trim',$data), [
				'nombre' => ['required', 'string', 'min:2',Rule::unique('videos')->ignore($video->id)],
				'descripcion' => ['required', 'string', 'min:2'],
				'link' => ['required', 'string', 'min:2'],
				
			]);
			$validator->setAttributeNames($niceNames);
			 //Si hay errores, retorna
			if($validator->fails()){
				$response = array("status"=> "422", "msg" => $validator->messages());
			}else{

				$response["resp"] = Video::find($id)->update([
					'nombre' => $data['nombre'],
					'descripcion' => $data['descripcion'],
					'link' => $data['link'],
					
				]); 
				 
				$response["status"] = "200";
				
			}
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200);
	}

	//Función que elimina un vídeo
	public function destroy_video($id){   
		
		DB::beginTransaction();
		try {
			$video = Video::find($id);
			$response["resp"] = Video::find($id)->delete();
			$response["status"] = 200;
			
			DB::commit();
		}
		catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			if($e->errorInfo[0] == "23000"){
				$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
			}else{
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
		}
		
		return response()->json($response,200);
	}

	//Obtiene todos los vídeos del home
	public function get_videos(){
		DB::statement(DB::raw('set @rownum=0'));
		$videos = DB::table('videos')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'videos.*')
		->orderBy("videos.nombre", "asc")
		->get();
		return response()->json($videos);  
	}

	//Obtiene solo un vídeo
	public function show_video($id){
		$video = Video::find($id);
		return response()->json($video);
	}

	//*********************************************INICIATIVAS*********************************+
	

	//Función que actualiza los datos de un iniciativa
	public function update_iniciativa(Request $request, $idp,$idi){
		
		DB::beginTransaction();
		try {
			$data = array("nombre" => $request["nombre"],
				"url_imagen" => $request["url_imagen"],
				"url_video" => $request["url_video"],
				"descripcion_video" => $request["descripcion_video"],
				
			);
			$niceNames = array(
				'nombre' => 'Nombre',
				'url_imagen' => 'Url de imagen',
				'url_video' => 'Url de vídeo',
				'descripcion_video' => 'Descripción de vídeo'
				
			);
			//Busca la iniciativa
			 $iniciativa = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->first();
			if($iniciativa){ //Si la iniciativa existe
				 $validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2',Rule::unique('iniciativas')->ignore($iniciativa->id)],
					'url_imagen' => ['string', 'min:2'],
					'url_video' => ['string', 'min:2'],
					'descripcion_video' => ['string', 'min:2'],
					
				]);
			}else{ //Si la iniciativa no existe
				$validator =  Validator::make(array_map('trim',$data), [
					'nombre' => ['required', 'string', 'min:2', 'unique:iniciativas'],
					'url_imagen' => ['string', 'min:2'],
					'url_video' => ['string', 'min:2'],
					'descripcion_video' => ['string', 'min:2'],
				]);
			}
			
		   
			$validator->setAttributeNames($niceNames);
			 //Si hay errores, retorna
			if($validator->fails()){
				$response = array("status"=> "422", "msg" => $validator->messages());
			}else{
				
				$file =$request->file('file');
				
				$url_imagen = (isset($iniciativa)) ? $iniciativa->url_imagen : "" ;
				if($file){
					
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

					if($_FILES['file']['tmp_name'] != NULL){
						$mimetype = mime_content_type($_FILES['file']['tmp_name']);


						if(in_array($mimetype, array("image/jpeg","image/png", "image/svg+xml"))) {
							$file = $_FILES['file'];
							$size = $file["size"];

							if($size > "3145728"){ //3MB
								$response["status"] = "422";
								$response["msg"]= array("El tamaño del archivo no debe superar los 3MB");
								

							}else{
								
								$request->file('file')->move(public_path($folder), $filename);
								$url_imagen = "/".$folder."/".$filename;
								

							}
							

						} else {
							$response["status"] = "422";
							$response["msg"]= array("El formato del archivo es incorrecto, solo se permiten los siguientes formatos: .jpe .jpeg .jpg, .png, .svg");
							
						}
					}
					else{
						$response["status"] = "422";
						$response["msg"]= array("El tamaño del archivo no debe superar los 3MB");
						
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
					$id_iniciativa = $response->id;
				
				}
			   
				$response["status"] = "200";
				
			}
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200);
	}

	//Función que elimina un iniciativa
	public function destroy_iniciativa($idp,$idi){   
		
		DB::beginTransaction();
		try {
			$iniciativa = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->first();
			$url_imagen = (isset($iniciativa)) ? $iniciativa->url_imagen : "" ;
			$image_path = public_path()."/".$url_imagen;
			//En caso de que tenga una imagen, se elimina
			if($url_imagen != null && $url_imagen != ""){
				if(File::exists($image_path)){
					unlink($image_path);
				}
			}
			$response["resp"] = Iniciativa::where([["id_principal",$idp],["infolej",$idi]])->delete();
			$response["status"] = 200;
			
			DB::commit();
		}
		catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			if($e->errorInfo[0] == "23000"){
				$response = array("status"=>"422", "msg" => ["Este elemento no puede ser eliminado porque está relacionado con otras tablas"], "error"=>$e);
			}else{
				$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
			}
		}
		
		return response()->json($response,200);
	}
	
	//Obtiene todas las iniciativas
	public function get_iniciativas(){
		$usuario = User::find(Auth::id());
		DB::statement(DB::raw('set @rownum=0'));
		$iniciativas = DB::table('detalle_iniciativas_comision')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'detalle_iniciativas_comision.id_principal','detalle_iniciativas_comision.infolej','iniciativas.nombre','iniciativas.url_imagen','iniciativas.url_video','iniciativas.descripcion_video')
		->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej');
		if($usuario->rol != "Administrador"){
			
			$iniciativas = $iniciativas->where("id_comision",$usuario->id_comision);
		}

		$iniciativas = $iniciativas->orderBy("detalle_iniciativas_comision.fecha_inicial", "desc")
		->get();
		return response()->json($iniciativas);  
	}

	//Obtiene solo una iniciativa
	public function show_iniciativa($idp,$idi){
		$iniciativa = DB::statement(DB::raw('set @rownum=0'));
		$iniciativa = DB::table('detalle_iniciativas_comision')
		->select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'), 'detalle_iniciativas_comision.id_principal','detalle_iniciativas_comision.infolej','iniciativas.nombre','iniciativas.url_imagen','iniciativas.url_video','iniciativas.descripcion_video')
		->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'detalle_iniciativas_comision.infolej')
		->where("detalle_iniciativas_comision.infolej",$idi)
		->where("detalle_iniciativas_comision.id_principal", $idp)
		->first();
		return response()->json($iniciativa);
	}

	//Obtiene los comentarios
	public function get_comentarios(){
		$usuario = User::find(Auth::id());
		DB::statement(DB::raw('set @rownum=0'));
			$comentarios = IniciativaComentario::select(DB::raw('(@rownum:=@rownum+1) AS RowNumY'),"iniciativa_comentarios.*",DB::raw("DATE_FORMAT(iniciativa_comentarios.fecha_creacion, '%Y-%m-%d') as fecha_creacion"),"detalle_iniciativas_comision.nom_comision as comision",'iniciativas.nombre as iniciativa',"detalle_iniciativas_comision.id_comision","iniciativa_comentarios.id as folio_comentario")
			->leftJoin('detalle_iniciativas_comision', 'detalle_iniciativas_comision.infolej', '=', 'iniciativa_comentarios.infolej')
			->leftJoin('iniciativas', 'iniciativas.infolej', '=', 'iniciativa_comentarios.infolej');
			
		if($usuario->rol != "Administrador"){
			
			$comentarios = $comentarios->where("id_comision",$usuario->id_comision);
		}
		$comentarios = $comentarios->orderBy("iniciativa_comentarios.fecha_creacion", "asc")
		->get();
		
		return response()->json($comentarios);  
	}

	//Aprobar comentario
	public function aprobar_comentario(Request $request){
		
		DB::beginTransaction();
		try {
			

			$response["resp"] = IniciativaComentario::find($request["ide"])->update([
				'aprobado' => 1,
				'id_usuario_aprobacion' => Auth::id(),
				'fecha_aprobacion' => date("Y-m-d"),
				
			]); 
			 
			$response["status"] = "200";
				
			
			DB::commit();
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			DB::rollback();
			$response = array("status"=>"422", "msg" => ["Ocurrió un error en la base de datos, intenta más tarde. "], "error"=>$e);
		}
		
		return response()->json($response,200);
	}


	
}
