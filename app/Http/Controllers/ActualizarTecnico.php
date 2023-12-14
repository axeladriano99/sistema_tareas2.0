<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estado;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;

class ActualizarTecnico extends Controller
{
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
        return view('edit', compact('tarea','estado','usuarios','editable'));
    }
    public function update(Request $request, Tarea $tarea)
    {
        request()->validate(Tarea::$ruless);
        $request['fecha_creacion'] = date('Y-m-d H:i:s');
            $hora_inicio = date('H:i:s', strtotime($request->input('hora_inicio')));
            $hora_termino = date('H:i:s', strtotime($request->input('hora_termino')));
            $fecha_inicio_hora= $request->input('Fecha_inicio'). " ". $hora_inicio;
            $fecha= $request->input('fecha_termino'). " ". $hora_termino;
            $request['Fecha_inicio'] = $fecha_inicio_hora;
            $request['fecha_termino']=$fecha;
            $request['idCreador'] = Auth::id();
            $request['idUsuario'] = Auth::id();
        $tarea->update($request->all());
       
        return redirect()->route('home.index')->with('success', 'Tarea actualizada correctamente');
    }
}
