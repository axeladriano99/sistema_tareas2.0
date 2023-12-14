<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
class CreateAdmi extends Controller
{
    public function index(){
        $areas = Area::all();
        $userId = Auth::id();
        $tareas_iniciadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 2)
            ->where('tareas.estado',1)
            ->get();
        $tareas_sin_iniciar =  DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->join('users','tareas.idCreador','=','users.id')
        ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 1)
        ->where('tareas.estado',1)
        ->get();
        $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
        $tareas_terminadas = DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->join('users','tareas.idCreador','=','users.id')
        ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 3)
        ->where('tareas.estado',1)
        ->get();
        return view('homeAdmi',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','areas'));
    }
    public function store(Request $request){
         
        $id=Auth::id();
        $user = DB::table('users')->select('users.*')->where('id','=',$id)->first();
       
        if($user->rol == 1)
        {
            $estado = Estado::pluck('name', 'id');
            // Primero, valida el formulario
            $request->validate(Tarea::validacionTecnico(), Tarea::validationMessagesTenico());
        
            // A continuación, realiza el procesamiento
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        
            // Verifica si la fecha de inicio es menor o igual a la fecha de termino
            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino']=$fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $request['fecha_creacion'] = date('Y-m-d H:i:s');
                $request['idUsuario'] = Auth::id();
                $tarea = Tarea::create($request->all());
              
                return redirect()->route('homeAdmi')
                    ->with('success', 'Tarea creada correctamente.');
            }
            else{
                $error= "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('homeCreate',compact('error','estado'));
            }
        }
        elseif ($user->rol == 2) {

            $estado = Estado::pluck('name', 'id');
            // Primero, valida el formulario
            $request->validate(Tarea::validacionTecnico(), Tarea::validationMessagesTenico());
        
            // A continuación, realiza el procesamiento
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        
            // Verifica si la fecha de inicio es menor o igual a la fecha de termino
            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino']=$fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $request['fecha_creacion'] = date('Y-m-d H:i:s');
                $request['idUsuario'] = Auth::id();
                $tarea = Tarea::create($request->all());
              
                return redirect()->route('home.index')
                    ->with('success', 'Tarea creada correctamente.');
            }
            else{
                $error= "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('homeCreate',compact('error','estado'));
            }
        }
        
        else{
            $estado = Estado::pluck('name', 'id');
            // Primero, valida el formulario
            $request->validate(Tarea::validacionTecnico(), Tarea::validationMessagesTenico());
        
            // A continuación, realiza el procesamiento
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        
            // Verifica si la fecha de inicio es menor o igual a la fecha de termino
            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino']=$fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $request['fecha_creacion'] = date('Y-m-d H:i:s');
                $request['idUsuario'] = Auth::id();
                $tarea = Tarea::create($request->all());
              
                return redirect()->route('homeAdmi')
                    ->with('success', 'Tarea creada correctamente.');
            }
            else{
                $error= "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('homeCreate',compact('error','estado'));
            }

        }
        
    }
    public function edit($id){
        $tarea = Tarea::find($id);
        $usuarios = User::pluck('name','id');
        $estado = Estado::pluck('name','id');
        $fecha_hora = explode(' ', $tarea->Fecha_inicio);
        $tarea->Fecha_inicio = $fecha_hora[0]; // Establecer la fecha
        $tarea->hora_inicio = $fecha_hora[1];
        $hora_termino = explode(' ',$tarea->fecha_termino);
        $tarea->fecha_termino = $hora_termino[0];
        $tarea->hora_termino = $hora_termino[1];
        
        return view('CreateAdmiEdit', compact('tarea','estado','usuarios'));
    }
    }

