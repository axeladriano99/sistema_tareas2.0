<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property Tarea[] $tareas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estado extends Model
{
    
    static $rules = [
      'name' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
    ];
    public static function validationRules()
    {
        return [
            'name' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
        ];
    }
    public static function validationMessages()
    {
        return [
          'name.required' => 'El campo nombre es obligatorio.'
        ];
    
        }


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tareas()
    {
        return $this->hasMany('App\Models\Tarea', 'idEstado', 'id');
    }
    

}
