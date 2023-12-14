<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 *
 * @property $id
 * @property $nombre
 *
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Area extends Model
{
    
    static $rules = [
      'nombre' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
    ];
    public static function validationRules()
    {
        return [
            'nombre' => ['required', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/'],
        ];
    }
    public static function validationMessages()
    {
        return [
          'nombre.required' => 'El campo nombre es obligatorio.'
        ];
    
        }


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'idArea', 'id');
    }
    

}
