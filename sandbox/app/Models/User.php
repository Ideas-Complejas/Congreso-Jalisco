<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'email',
        'password',
        'id_comision',
        'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_name(){
        $username = auth()->user()->nombre;
        
        return $username;

    }
    //Función que verifica si el usuario tiene un rol
    public function hasRole($name_rol){
        $usuario = DB::table('users')
            ->select('users.*')
             ->where('users.id' , auth()->user()->id)
            ->get();
        $usuario = $usuario->toArray();
        $rsp = "false"; // visitante
        if($usuario!= null){
           
            if(is_array($name_rol)){
                $name_rol = $name_rol[0];
                if(is_array($name_rol))
                    $name_rol = $name_rol[0];
            }
            if(strcmp($usuario[0]->rol, $name_rol) === 0){
                return  true;
            }
            else
                return false;
        }   
        
        return false;
    }
}
