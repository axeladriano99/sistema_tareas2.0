<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdministrador extends Controller
{
    public function index(){
        $areas =  Area::pluck('nombre', 'id');
        return view('home',compact('areas'));
    }
    public function superAdm(Request $request) {
        $area = $request->input('id');
        $data = User::where('idArea', $area)->where('estado','=',1)->get();
    
        if ($data->isEmpty()) {
            return response()->json(['nombre' => 'No cuenta con usuario esa area']);
        }
    
        return response()->json($data);
    }
    public function datatabless($id)
    {
        $users = User::find($id);
        return response()->json($users);
    }
}
