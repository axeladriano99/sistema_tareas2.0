<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 *
 * @property $id
 * @property $nombre
 * @property $Fecha_inicio
 * @property $fecha_creacion
 * @property $fecha_termino
 * @property $descripcion
 * @property $idEstado
 * @property $idCreador
 * @property $idUsuario
 * @property $created_at
 * @property $updated_at
 *
 * @property Estado $estado
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarea extends Model
{

    static $rules = [
        'nombre' => ['required', 'max:100'],
        'Fecha_inicio' => 'required',
        //'fecha_creacion' => 'required',
        'fecha_termino' => 'required',
        'descripcion' => ['required', 'max:100'],
        'idEstado' => 'required',
    ];

    

    public static function validationRules()
    {
        return [
            'nombre' => ['required', 'max:100'],
            'descripcion' => ['required', 'max:100'],
            'Fecha_inicio' => 'required',
            //'fecha_creacion' => 'required',
            'fecha_termino' => 'required',
            'idEstado' => 'required',
            'idUsuario' => 'required',

        ];
    }

    public static function validationMessages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'descripcion.required' => 'el campo descripcion debe contener algun dato',
            'idUsuario.required' => 'el campo es oblitorio',
        ];
    }


    // validacion del tecnico cuando crea una tarea
    static $ruless = [
        'nombre' => ['required', 'max:100', ],
        'Fecha_inicio' => 'required',
        //'fecha_creacion' => 'required',
        'fecha_termino' => 'required',
        'descripcion' => ['required', 'max:100'],
        'idEstado' => 'required',
    ];

    public static function validacionTecnico()
    {
        return [
            'nombre' => ['required', 'max:100'],
            'descripcion' => ['required', 'max:100'],
            'Fecha_inicio' => 'required',
            //'fecha_creacion' => 'required',
            'fecha_termino' => 'required',
            'idEstado' => 'required',
            


        ];
    }
    public static function validationMessagesTenico()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'descripcion.required' => 'el campo descripcion debe contener algun dato',
        ];
    }
    









    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'Fecha_inicio', 'fecha_creacion', 'fecha_termino', 'descripcion', 'idEstado', 'idCreador', 'idUsuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadoss()
    {
        return $this->hasOne('App\Models\Estado', 'id', 'idEstado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'idUsuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'idCreador');
    }
}
