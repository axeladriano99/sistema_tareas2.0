<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'apellidoPaterno' => ['required', 'string', 'max:255'],
        'apellido_Materno' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', ],
        'DNI' => ['required', 'integer'],
        'cargo' => ['required', 'string', 'max:255'],
        'idArea' => ['required', 'integer'],
        'password' => ['required', 'string', 'confirmed'],
    ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellidoPaterno' => $data['apellidoPaterno'],
            'apellido_Materno' => $data['apellido_Materno'],
            'email' => $data['email'],
            'DNI' => $data['DNI'],
            'cargo' => $data['cargo'],
            'idArea' => $data['idArea'],
            'password' => Crypt::encryptString($data['password']),
        ]);
    }
    //Avatar::create($data->name);
}
