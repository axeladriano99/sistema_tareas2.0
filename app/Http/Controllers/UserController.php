<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\ValidationException;
use Laravel\Ui\Presets\React;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $userr= User::find($id);
        $users = User::all();
        if($userr->rol==1)
        {
            return view('user.index',compact('users'));
        }
        elseif($userr->rol==2)
        {
            return redirect()->route('home.index');
        }
        else{
            return view('user.index',compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        $users = DB::Table('users')
        ->join('areas','users.idArea','=','areas.id')
        ->select('users.*','areas.nombre as idArea')
        ->where('users.estado',1)
        ->get();
        return datatables()->collection($users)->toJson();
    }

    public function create(Request $request)
    {
        
        $user = new User();

        
        $roles = DB::table('roles')->pluck('name', 'id');
        $area =  Area::pluck('nombre', 'id');
        return view('user.create', compact('user', 'area','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{ 
    $request->validate(User::validationRules(), User::validationMessages());
    request()->validate(User::$rules);
    $rol_ingresado = $request->input('rol');
    //echo encrypt($request->input('password'));
    /*dd([
        'DNI' => $request->input('DNI'),
        'name' => $request->input('name'),
        'apellidoPaterno' => $request->input('apellidoPaterno'),
        'apellido_Materno' => $request->input('apellido_Materno'),
        'email' => $request->input('email'),
        'cargo' => $request->input('cargo'),
        'idArea' => $request->input('idArea'),
        'rol' => $request->input('rol'),
        'password' => encrypt($request->input('password')),
    ]);die;*/
    $user = User::create([
        'DNI' => $request->input('DNI'),
        'name' => $request->input('name'),
        'apellidoPaterno' => $request->input('apellidoPaterno'),
        'apellido_Materno' => $request->input('apellido_Materno'),
        'email' => $request->input('email'),
        'cargo' => $request->input('cargo'),
        'idArea' => $request->input('idArea'),
        'rol' => $request->input('rol'),
        'password' =>  Crypt::encryptString($request->input('password')),
    ]);
    //$user = User::create($request->all());

    // Fetch the latest user created
    $users = DB::table('users')->orderBy('created_at', 'desc')->first();
    
    // Fetch the specific user by ID
    $userToUpdate = User::find($users->id);

    // Update the user's role
    $userToUpdate->rol = $rol_ingresado;
    $userToUpdate->save();

    $userRol = User::find($users->rol);
    $model_has_roles =  DB::table('model_has_roles')->insert([
        'role_id' => $rol_ingresado,
        'model_type' => 'App\Models\User',
        'model_id' => $users->id,

    ]);
    return redirect('users')->with('success', 'Usuario creado correctamente');

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   /*
        $payload = '$2y$10$5CPGe74ZFDmDlhOvXhUAxOnC44GmUnbZDPDb5unq5VFG9eSR2l1dK';
        echo $payload .'<br>';
        $dato_descifrado = decrypt($payload);
        echo $dato_descifrado;*/

        $user = User::find($id);
        $roles =  DB::table('roles')->pluck('name','id');
        $area = Area::pluck('nombre', 'id');
        $userr = DB::Table('users')->select('password')->where('id','=',$id)->first();
        $encryptedPassword = $user->password;
        $decryptedPassword = Crypt::decryptString($userr->password);
        return view('user.edit', compact('user', 'area','roles','decryptedPassword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $user)
    {   
        $request->validate(User::validationEditar(), User::validationMessagesEditar());
        $rol_ingresado = $request->input('rol');
        $user->update(['DNI' => $request->input('DNI'),
        'name' => $request->input('name'),
        'apellidoPaterno' => $request->input('apellidoPaterno'),
        'apellido_Materno' => $request->input('apellido_Materno'),
        'email' => $request->input('email'),
        'cargo' => $request->input('cargo'),
        'idArea' => $request->input('idArea'),
        'rol' => $request->input('rol'),
        'password' =>  Crypt::encryptString($request->input('password')),]);
        $model_has_roles =  DB::Table('model_has_roles')->where('model_id','=', $user->id)->update([
            'role_id' => $rol_ingresado,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id,
    
        ]);
        return redirect('users')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroy($id)
    {
        //optener usuario ingresado
        $userId = Auth::id();
        $usuario = User::find($id);
        if($usuario->estado == 1){
            $usuario->estado =2;
            $usuario->save();
        return redirect('users')
            ->with('success', 'Usuario cambiado a INACTIVO  correctamente');
        }
        else{
            $usuario->estado=1;
            $usuario->save();
        return redirect('users')
            ->with('success', 'Usuario cambiado a ACTIVO correctamente');
        }
        
    }

    public function dni(Request $request)
    {
        $userId = $request->input('buscar');
        $client = new Client();
        $url = 'http://mundoapu.com:7415/?documento='.$userId; // Reemplaza esto con la URL de la API que deseas consumir
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);
        return view('user.index',compact('data'));
    }
}
