<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;

class DatatableController extends Controller
{
    public function TareasFiltradas(){
        $tareas= DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->join('users','tareas.idCreador','=','users.id')
        ->join('users as asignado', 'tareas.idUsuario', '=', 'asignado.id')
        ->select('tareas.*','estados.name as estados_id','users.name as idCreador', 'asignado.name as idUsuario')
        ->get();
        return datatables()->collection($tareas)->toJson();
    }
    public function ListarTareaUsuario(Request $request)
    {
         $userId = $request->input('id');
        // Puedes hacerlo de la siguiente manera:
        $tareas_sin_iniciar = DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->join('users','tareas.idCreador','=','users.id')
        ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 1)
        ->get();
        //dd($tareas_sin_iniciar);
        return datatables()->collection($tareas_sin_iniciar)->toJson();
    }
    public function tabla2(Request $request)
    {
        $userId = $request->input('id');
        // Puedes hacerlo de la siguiente manera:
        $tareas_sin_iniciar = DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->join('users','tareas.idCreador','=','users.id')
        ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 2)
        ->get();
        return datatables()->collection($tareas_sin_iniciar)->toJson();
    }
    public function tabla3(Request $request)
    {
        $userId = $request->input('id');
        // Puedes hacerlo de la siguiente manera:
        $tareas_sin_iniciar = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->get();
        return datatables()->collection($tareas_sin_iniciar)->toJson();
    }

    /*
    public function users($id)
    {
        $usuarios = User::find($id);
        return $id;
        
        $users = User::select('id','name','email')->get();
        return datatables()->collection($usuarios)->toJson();
    }
    */
}
