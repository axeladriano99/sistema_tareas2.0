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

/**
 * Class TareaController
 * @package App\Http\Controllers
 */
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tareas = Tarea::join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idUsuario','=','users.id')
            ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
            ->select("tareas.*",'editables.campos_editado', 'estados.name as idEstado')
            ->where('users.estado','=',1)
            ->where('tareas.estado', '=', 1)
            ->get();
        $fechas =  DB::Table('tareas')->select('fecha_creacion','id')->get();
        $estados = Estado::all();
        $id = Auth::id();
        $userr= User::find($id);
        $usuarios= User::all()->where('estado','=',1);
        if($userr->rol==1)
        {
            return view('tarea.index', compact('tareas','usuarios','estados','fechas'));
        }
        elseif($userr->rol==2)
        {
            return redirect()->route('home.index');
        }
        else{
            return view('tarea.index', compact('tareas','usuarios','estados','fechas'));
        }
       
        /*
        $tareas = Tarea::all()->where('estado','=',1)->join('estados.*');
        return view('tarea.index', compact('tareas'));*/
    }
    public function listarTareas()
    {
        $tareas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users as creador', 'tareas.idCreador', '=', 'creador.id')
            ->join('users as asignado', 'tareas.idUsuario', '=', 'asignado.id')
            ->select('tareas.*', 'estados.name as estados_id', 'creador.name as idCreador', 'asignado.name as nombre')
            ->where('tareas.estado', 1)
            ->get();

        return datatables()->collection($tareas)->toJson();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarea = new Tarea();
        $estado = Estado::pluck('name', 'id');
        $usuarios = User::pluck('name', 'id');
        return view('tarea.create', compact('tarea', 'estado', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    // FUNCION PARA CREAR UNA TAREA 
    public function store(Request $request)
    {
        // OBTIENE EL ID DEL USUARIO LOGEADO
        $id = Auth::id();
        $user = DB::table('users')->select('users.*')->where('id', '=', $id)->first();
        // SE EVALUA EL ROL DEL USUARIO LOGEADO
        if ($user->rol == 1 || $user->rol ==3) {
            //LAS VALIDACIONES DEL USUARIO PARA SALTAR EL MENSAJE DE ERROR SI ES POSIBLE
            $request->validate(Tarea::validationRules(), Tarea::validationMessages());
            request()->validate(Tarea::$rules);
            
            $request['fecha_creacion'] = date('Y-m-d H:i:s');
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
            // EVALUA SI LA FECHA ES MENOR A LA FECHA DE TERMINO Y SI ES ASI SE ACTUALIZA
            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino'] = $fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $tarea = Tarea::create($request->all());
                return redirect()->route('tareas.index')
                    ->with('success', 'Tarea creada correctamente.');
            } 
            // SINO ES ASI SE MANDA UN ERROR CON LA VARIABLE ERROR QUE CONTIENE EL MENSAJE
            // EN LA VISTA SE VALIDA SI LA VARIABLE CONTIENE ALGO Y SI ES ASI SE MUESTARD DEMTRO DE UN ALERT

            else {
                $estado = Estado::pluck('name', 'id');
                $usuarios = User::pluck('name', 'id');
                $error = "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('tarea.create', compact('error', 'estado', 'usuarios'));
            }
        } 
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::find($id);
        $estado = Estado::pluck('name', 'id');
        return view('tarea.show', compact('tarea' . 'estado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tarea::find($id);
        $usuarios = User::pluck('name', 'id');
        $estado = Estado::pluck('name', 'id');
        $fecha_hora = explode(' ', $tarea->Fecha_inicio);
        $tarea->Fecha_inicio = $fecha_hora[0]; // Establecer la fecha
        $tarea->hora_inicio = $fecha_hora[1];
        $hora_termino = explode(' ', $tarea->fecha_termino);
        $tarea->fecha_termino = $hora_termino[0];
        $tarea->hora_termino = $hora_termino[1];
        $editable = DB::Table('editables')->leftJoin('historial','editables.idTarea','=','historial.idTarea')->join('tareas','editables.idTarea','=','tareas.id')->select('editables.idTarea','editables.fecha_modificada','editables.fecha_finalanterior','editables.campos_editado','historial.descripcion','historial.created_at','tareas.Fecha_inicio','tareas.fecha_termino')->where('editables.idTarea',$id)->get();
        return view('tarea.edit',compact('editable','hora_termino','estado','usuarios','tarea','editable'));
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
        $users = Auth::id();

        $user = DB::Table('users')->select('users.*')->where('id', '=', $users)->first();
        if ($user->rol == 1 || $user->rol==3) {
            request()->validate(Tarea::$rules);
            $request['fecha_creacion'] = date('Y-m-d H:i:s');
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');

            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino'] = $fecha_termino_hora;
                $tarea->update($request->all());
                $admi = $request->input('admi');
                if($admi=== 'admi')
                {
                    
                return redirect()->route('admiIndex.index')
                ->with('success', 'Tarea actualizada correctamente.');
                }   
            else{
                return redirect()->route('tareas.index')
                ->with('success', 'Tarea actualizada correctamente.');
            }
                
               
            } 
            else {

                $tarea = Tarea::find($tarea->id);
                $estado = Estado::pluck('name', 'id');
                $usuarios = User::pluck('name', 'id');
                $fecha_hora = explode(' ', $tarea->Fecha_inicio);
                $tarea->Fecha_inicio = $fecha_hora[0]; // Establecer la fecha
                $tarea->hora_inicio = $fecha_hora[1];
                $hora_termino = explode(' ', $tarea->fecha_termino);
                $tarea->fecha_termino = $hora_termino[0];
                $tarea->hora_termino = $hora_termino[1];
                $error = "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('tarea.edit', compact('error', 'estado', 'tarea', 'usuarios'));
            }
            $tarea->update($request->all());

            return redirect('tareas')->with('success', 'Tarea actualizada correctamente');
        } elseif ($user->rol == 2) {

            $request['fecha_creacion'] = date('Y-m-d H:i:s');
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');

            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino'] = $fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $request['idUsuario'] = Auth::id();
                
                $tarea->update($request->all());

                return redirect('home')->with('success', 'Tarea actualizada correctamente');
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

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //optener usuario ingresado
        $userId = Auth::id();
        $tareas = Tarea::find($id);
        $tareas->estado = 2;
        $tareas->save();
        $actualizacion = DB::table('historial')
            ->insert([
                'idUsuario' => $userId,
                'idTarea' => $tareas->id,
                'descripcion' => 'se trato de eliminar la tarea'
            ]);
        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente');
    }



    /*
        
        $actualizacion= DB::table('historial')
        ->update(['idUsuario'=>$userId])
        ->update(['idTarea'=>$tareas->id])
        ->update(['descripcion'=>'trato de eliminar la tarea ']);


        ->update(['name' => 'John Doe']);
        $tarea = Tarea::find($id)->delete();
        
        return redirect()->route('tareas.index')
            ->with('success', 'Tarea deleted successfully');

            */
}
