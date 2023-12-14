<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class ValidarController extends Controller
{
    public function validar(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }
    /*
    public function login(Request $request)
{
    // Obtén el usuario por su correo electrónico
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Usuario no encontrado');
    }

    // Desencripta la contraseña almacenada en la base de datos
    $decryptedPassword = decryptString($user->password);

    if ($request->password === $decryptedPassword) {
        // Las contraseñas coinciden, autenticar al usuario
        Auth::login($user);
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login')->with('error', 'Contraseña incorrecta');
    }
}*/

    
    public function store(Request $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $credentials =["email"=>$request->email, "password"=>$request->password];
        $user = DB::table('users')->where('email', $request->email)->first();   
        if (!$user) {
            $error= "Correo electronico incorreto";
            return view('auth.login',compact('error'));
        }
        
        $decryptedPassword = Crypt::decryptString($user->password);
        if($request->email == $user->email  && $user->estado=== '2')
        {
            $error= "Usuario inactivo";
            return view('auth.login',compact('error'));
        }
        
        elseif($request->password == $decryptedPassword)
        {   
            Auth::loginUsingId($user->id);
            return  redirect()->route('home.index');
            
        }
        else{
            return redirect()->route('login')->with('error', 'Contraseña incorrecta');
        }
    }
        /*
        $email = $request->input('email');
        $password = $request->input('password');
        $user = DB::Table('users')->select('email', 'password')->where('email','=', $email)->first();
        //desncriptar contraseña para luego compararla
       
            $credentials = $request->only('email','password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
        
        return redirect()->route('home.index')
        ->with('success', 'Tarea creada correctamente.');*/
    
    /*$this->guard()->logout();
        $email = $request->input('email');
        $password = $request->input('password');
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('home');
        }*/
}
