<?php

namespace App\Http\Controllers;


use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use App\Models\Historial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Area;
/**
 * Class TareaController
 * @package App\Http\Controllers
 */
class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $areas = Area::all();
            $userId = Auth::id();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
               
                ->orderBy('tareas.created_at', 'asc')
                ->get();
            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
            ->latest('tareas.created_at')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->orderBy('tareas.fecha_creacion','desc')
            ->get();
            $id= Auth::id();
            $user= User::find($id);
            if($user->rol==1)
            {
                return view('administrador.index',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','areas'));
            }
            else{
                return view('home',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','areas'));
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $tarea = new Tarea();
        $estado = Estado::pluck('name', 'id');
        $usuarios = User::pluck('name', 'id');
        return view('administrador.create', compact('tarea', 'estado', 'usuarios'));
    }
    
    public function delete(){

    }
    public function show($id){
        $tarea = Tarea::find($id);
        $estado = Estado::pluck('name', 'id');
        return view('administrador.show', compact('tarea' , 'estado'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
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
              
                return redirect()->route('admiIndex.index')
                    ->with('success', 'Tarea creada correctamente.');
            }
            else{
                $error= "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('homeCreate',compact('error','estado'));
            }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
        $editable = DB::Table('editables')->leftJoin('historial','editables.idTarea','=','historial.idTarea')->join('tareas','editables.idTarea','=','tareas.id')->select('editables.idTarea','editables.fecha_modificada','editables.fecha_finalanterior','editables.campos_editado','historial.descripcion','historial.created_at','tareas.Fecha_inicio','tareas.fecha_termino')->where('editables.idTarea',$id)->get();
        return view('administrador.edit', compact('tarea','estado','usuarios','editable'));
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tarea $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        //echo 'dasda';
        //dd($request->input());
        $users = Auth::id();

        $user = DB::Table('users')->select('users.*')->where('id', '=', $users)->first();
        $request['fecha_creacion'] = date('Y-m-d H:i:s');
        $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
        $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');

        if ($fecha_inicio_hora <= $fecha_termino_hora) {
            request()->validate(Tarea::$rules);
            $request['Fecha_inicio'] = $fecha_inicio_hora;
            $request['fecha_termino'] = $fecha_termino_hora;
            $request['idCreador'] = Auth::id();
            $request['idUsuario'] = Auth::id();
            $tarea->update($request->all());
            
            return redirect()->route('admiIndex.index')->with('success', 'Tarea actualizada correctamente');
        } else {
            $tarea = Tarea::find($tarea->id);
            $estado = Estado::pluck('name', 'id');
            $usuarios = User::pluck('name', 'id');
            $fecha_hora = explode(' ', $tarea->Fecha_inicio);
            $tarea->Fecha_inicio = $fecha_hora[0]; // Establecer la fecha
            $tarea->hora_inicio = $fecha_hora[1];
            $hora_termino = explode(' ', $tarea->fecha_termino);
            $tarea->fecha_termino = $hora_termino[0];
            $tarea->hora_termino = $hora_termino[1];
            request()->validate(Tarea::$ruless);


            $usuarios = User::pluck('name', 'id');
            $estado = Estado::pluck('name', 'id');
            $error = "La fecha de inicio tiene que se menor a la fecha de termino";
            return view('edit', compact('tarea', 'estado', 'usuarios', 'error'));
        }
    }
}
