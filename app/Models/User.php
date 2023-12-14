<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $apellidoPaterno
 * @property string $apellido_Materno
 * @property string $email
 * @property int $DNI
 * @property string $cargo
 * @property int $idArea
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string rol
 * @property Area $area
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class User extends Authenticatable
{

    use HasRoles;
    static $rules = [
        'name' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
        'apellidoPaterno' => 'required|alpha|max:100',
        'apellido_Materno' => 'required|alpha',
        'email' => 'email',
        'DNI' => ['required', 'numeric', 'digits:8', 'unique:users,DNI'], // Agregado 'unique' aquí
        'cargo' => 'required|alpha',
        'idArea' => 'required',
        'password' => 'required',
    ];
    
    public static function validationRules()
    {
        return [
            'name' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
            'apellidoPaterno' => ['required', 'alpha', 'max:100'],
            'apellido_Materno' => ['required', 'alpha'],
            'email' => ['required', 'email', 'unique:users,email'],
            'DNI' => ['required', 'numeric', 'digits:8', 'unique:users,DNI'],
            'cargo' => ['required'],
            'idArea' => ['required', 'integer'],
            'password' => ['required'],
        ];
    }
    
    public static function validationEditar()
    {
        return [
            'name' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
            'apellidoPaterno' => ['required', 'alpha', 'max:100'],
            'apellido_Materno' => ['required', 'alpha'],
            'email' => ['required', 'email'],
            'DNI' => ['required', 'numeric', 'digits:8'],
            'cargo' => ['required'],
            'idArea' => ['required', 'integer'],
            'password' => ['required'],
        ];
    }
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','apellidoPaterno','apellido_Materno','email','DNI','cargo','idArea','password','rol'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function area()
    {
        return $this->hasOne('App\Models\Area', 'id', 'idArea');
    }
    public static function validationMessages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'apellidoPaterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellidoPaterno.alpha' => 'El campo apellido paterno debe contener solo letras.',
            'apellidoPaterno.max' => 'El campo apellido paterno no debe tener más de :max caracteres.',
            'apellido_Materno.required' => 'El campo apellido materno es obligatorio.',
            'apellido_Materno.alpha' => 'El campo apellido materno debe contener solo letras.',
            'email.email' => 'Por favor, ingrese una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya esta registrado pruebe con otro ',
            'DNI.required' => 'El campo DNI es obligatorio.',
            'DNI.numeric' => 'El campo DNI debe contener solo números.',
            'DNI.digits' => 'El campo DNI debe tener :digits dígitos.',
            'DNI.unique' => 'El DNI ya está en uso por otro usuario.', // Mensaje personalizado para 'unique'
            'cargo.required' => 'El campo cargo es obligatorio.',
            'idArea.required' => 'El campo área es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio.'
        ];
    }

    public static function validationMessagesEditar()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'apellidoPaterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellidoPaterno.alpha' => 'El campo apellido paterno debe contener solo letras.',
            'apellidoPaterno.max' => 'El campo apellido paterno no debe tener más de :max caracteres.',
            'apellido_Materno.required' => 'El campo apellido materno es obligatorio.',
            'apellido_Materno.alpha' => 'El campo apellido materno debe contener solo letras.',
            'email.email' => 'Por favor, ingrese una dirección de correo electrónico válida.',
            'DNI.required' => 'El campo DNI es obligatorio.',
            'DNI.numeric' => 'El campo DNI debe contener solo números.',
            'DNI.digits' => 'El campo DNI debe tener :digits dígitos.',
            'cargo.required' => 'El campo cargo es obligatorio.',
            'cargo.alpha' => 'El campo cargo debe contener solo letras.',
            'idArea.required' => 'El campo área es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio.'
        ];
    }
}