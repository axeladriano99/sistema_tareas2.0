<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Historial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HistorialFecha extends Controller
{
    public function ActualizarTarea(Request $request)
    {

        //$validar =  $request->validate(Tarea::validationMessagesTenico(), Tarea::validationMessagesTenico());

        $validar = Validator::make($request->all(), Tarea::validacionTecnico());

        if ($validar->fails()) {
            return response()->json(['errors' => $validar->errors()], 422);
        }


        $fecha_inicio = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
        $fecha_final = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        $fecha_inicioOriginal = $request->input('fecha1') . ' ' . $request->input('hora1');
        $fecha_finalOriginal = $request->input('fecha2') . ' ' . $request->input('hora2');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $estado = $request->input('idEstado');
        $idUsuario = $request->input('idUsuario');
        if ($fecha_inicioOriginal == $fecha_inicio && $fecha_finalOriginal == $fecha_final) {
            $fecha = 'las fechas coinciden';
            $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'idEstado' => $estado,
                'idUsuario' => $idUsuario,
            ]);
            return response()->json(['request' => $request->all(), 'Msj' => 'Solicitud exitosa']);
        } else {
            $valor = Carbon::now();
            $motivo = $request->input('motivo_texto');
            $idHistorial = DB::table('historial')->where('idTarea','=',$request->input('id'))->get();
            if(isset($idHistorial))
            {
                $historial = DB::table('historial')
                ->where('idTarea', $request->input('id'))
                ->update([
                    'descripcion' => $motivo,
                    'updated_at' => now(),
                ]);
                $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'Fecha_inicio' => $fecha_inicio,
                    'fecha_termino' => $fecha_final,
                    'idEstado' => $estado,
                    'idUsuario' => $idUsuario,
                ]);
    
                return response()->json(['request' => $motivo, 'Msj' => 'Solicitud exitosa']);
            }
            else{
                $historial = DB::table('historial')->insert([
                    'idUsuario' => Auth::id(),
                    'idTarea' => $request->input('id'),
                    'descripcion' => $motivo,
                    'updated_at' => now(),
                ]);
                $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'Fecha_inicio' => $fecha_inicio,
                    'fecha_termino' => $fecha_final,
                    'idEstado' => $estado,
                    'idUsuario' => $idUsuario,
                ]);
    
                return response()->json(['request' => $motivo, 'Msj' => 'Solicitud exitosa']);
            }
            
            
        }
    }
    public function update(Request $request, Tarea $tarea)

    {
        
        //$validar =  $request->validate(Tarea::validationMessagesTenico(), Tarea::validationMessagesTenico());

        $validar = Validator::make($request->all(), Tarea::validacionTecnico());

        if ($validar->fails()) {
            return response()->json(['errors' => $validar->errors()], 422);
        }

        $id = $request->input('id');
        $tarea = Tarea::find($id);

        $id = $request->input('id');
        $tarea = Tarea::find($id);
        $fecha_inicio = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
        $fecha_final = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        $fecha_inicioOriginal = $request->input('fecha1') . ' ' . $request->input('hora1');
        $fecha_finalOriginal = $request->input('fecha2') . ' ' . $request->input('hora2');
        $request['Fecha_inicio'] = $fecha_inicio;
        $request['fecha_termino'] = $fecha_final;
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $estado = $request->input('idEstado');

        if ($fecha_inicioOriginal == $fecha_inicio && $fecha_finalOriginal == $fecha_final) 
        {
           
            $fecha = 'las fechas coinciden';
            $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'idEstado' => $estado,
            ]);
            $camposDistintos = [];
            $datosEntrada = $request->all();
            foreach ($tarea->getAttributes() as $campo => $valor) {
                if (array_key_exists($campo, $datosEntrada) && $valor != $datosEntrada[$campo]) {
                    $camposDistintos[] = $campo;
                }
            }
            $camposEditadosString = implode(',', $camposDistintos);
            $valorExistente = DB::table('Editables')
                ->where('idTarea', $id)
                ->value('campos_editado');

            if ($valorExistente) {
                $camposExistenteArray = explode(',', $valorExistente);


                // Agrega los nuevos cambios a los cambios existentes
                foreach ($camposDistintos as $campoNuevo) {
                    if (!in_array($campoNuevo, $camposExistenteArray)) {
                        $camposExistenteArray[] = $campoNuevo;
                    }
                }

                $camposEditadosString = implode(',', $camposExistenteArray);

                // Actualiza el campo en la base de datos
                DB::table('Editables')
                    ->where('idTarea', $id)
                    ->update(['campos_editado' => $camposEditadosString]);
            } else {
                $camposEditadosString = implode(',', $camposDistintos);
                $editables = DB::table('editables')->select('editables.*')->where('idTarea', '=', $id)->get();


                // Inserta un nuevo registro
                DB::table('Editables')->insert([
                    'idTarea' => $id,
                    'campos_editado' => $camposEditadosString,
                ]);
            }
            
            return response()->json(['request' => 'hola', 'Msj' => 'mensaje']);
        } elseif ($fecha_inicio > $fecha_inicioOriginal) 
        {
            $motivo = $request->input('motivo_texto');
            $verificar_Motivo =  DB::Table('historial')->where('idTarea','=',$request->input('id'))->get();
            if (!empty($verificar_Motivo)) {
                $historial = DB::table('historial')
                ->where('idUsuario', Auth::id())
                ->where('idTarea', $request->input('id'))
                ->update([
                    'descripcion' => $motivo,
                    'updated_at' => now(),
                ]);
            } else {
                $historial = DB::table('historial')->insert([
                    'idUsuario' => Auth::id(),
                    'idTarea' => $request->input('id'),
                    'descripcion' => $motivo,
                    'updated_at' => now(),
                ]);

                
            }
            
            $camposDistintos = [];
            $datosEntrada = $request->all();
            foreach ($tarea->getAttributes() as $campo => $valor) {
                if (array_key_exists($campo, $datosEntrada) && $valor != $datosEntrada[$campo]) {
                    $camposDistintos[] = $campo;
                }
            }
            $camposEditadosString = implode(',', $camposDistintos);


            $valorExistente = DB::table('Editables')
                ->where('idTarea', $id)
                ->value('campos_editado');

            if ($valorExistente) {
                $camposExistenteArray = explode(',', $valorExistente);


                // Agrega los nuevos cambios a los cambios existentes
                foreach ($camposDistintos as $campoNuevo) {
                    if (!in_array($campoNuevo, $camposExistenteArray)) {
                        $camposExistenteArray[] = $campoNuevo;
                    }
                }

                $camposEditadosString = implode(',', $camposExistenteArray);

                // Actualiza el campo en la base de datos
                DB::table('Editables')
                    ->where('idTarea', $id)
                    ->update(['campos_editado' => $camposEditadosString]);
            } else {
                $camposEditadosString = implode(',', $camposDistintos);
                $editables = DB::table('editables')->select('editables.*')->where('idTarea', '=', $id)->get();


                // Inserta un nuevo registro
                DB::table('Editables')->insert([
                    'idTarea' => $id,
                    'campos_editado' => $camposEditadosString,
                ]);
            }
            $tarea = Tarea::find($id);
            $editables = DB::table('Editables')->where('idTarea', '=', $request->input('id'))->update([
                'fecha_modificada' => $tarea->Fecha_inicio,
                'fecha_finalanterior' => $tarea->fecha_termino,
            ]);
            $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'Fecha_inicio' => $fecha_inicio,
                'fecha_termino' => $fecha_final,
                'idEstado' => $estado,
            ]);

            return response()->json(['request' => 'soy mensaje', 'Msj' => 'Solicitud exitosa']);
        } else
         {
            $valor = Carbon::now();
            $motivo = $request->input('motivo_texto');
            $historial = DB::table('historial')->insert([
                'idUsuario' => Auth::id(),
                'idTarea' => $request->input('id'),
                'descripcion' => $motivo,
                'created_at' => now(),  // Utiliza la función 'now()' de Laravel para obtener la fecha y hora actual
                'updated_at' => now(),
            ]);
            $camposDistintos = [];
            $datosEntrada = $request->all();
            foreach ($tarea->getAttributes() as $campo => $valor) {
                if (array_key_exists($campo, $datosEntrada) && $valor != $datosEntrada[$campo]) {
                    $camposDistintos[] = $campo;
                }
            }
            $camposEditadosString = implode(',', $camposDistintos);


            $valorExistente = DB::table('Editables')
                ->where('idTarea', $id)
                ->value('campos_editado');

            if ($valorExistente) {
                $camposExistenteArray = explode(',', $valorExistente);


                // Agrega los nuevos cambios a los cambios existentes
                foreach ($camposDistintos as $campoNuevo) {
                    if (!in_array($campoNuevo, $camposExistenteArray)) {
                        $camposExistenteArray[] = $campoNuevo;
                    }
                }

                $camposEditadosString = implode(',', $camposExistenteArray);

                // Actualiza el campo en la base de datos
                DB::table('Editables')
                    ->where('idTarea', $id)
                    ->update(['campos_editado' => $camposEditadosString]);
            } else {
                $camposEditadosString = implode(',', $camposDistintos);
                $editables = DB::table('editables')->select('editables.*')->where('idTarea', '=', $id)->get();


                // Inserta un nuevo registro
                DB::table('Editables')->insert([
                    'idTarea' => $id,
                    'campos_editado' => $camposEditadosString,
                ]);
            }
            $tarea = Tarea::find($id);
            $editables = DB::table('Editables')->where('idTarea', '=', $request->input('id'))->update([
                'fecha_modificada' => $tarea->Fecha_inicio,
                'fecha_finalanterior' => $tarea->fecha_termino,

            ]);

            $actualizar = DB::Table('Tareas')->where('id', '=', $request->input('id'))->update([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'Fecha_inicio' => $fecha_inicio,
                'fecha_termino' => $fecha_final,
                'idEstado' => $estado,
            ]);

            return response()->json(['request' => 'soy mensaje', 'Msj' => 'Solicitud exitosa']);
        }
    }
    public function show($id)
    {
        $editable = DB::Table('editables')->join('tareas', 'editables.idTarea', '=', 'tareas.id')->select('editables.idTarea', 'editables.campos_editado', 'tareas.nombre as idTarea')->where('editables.idTarea', $id)->get();
        if (empty($editable)) {

            dd('h');
        } else {
            $editable = DB::Table('editables')->leftJoin('historial', 'editables.idTarea', '=', 'historial.idTarea')->join('tareas', 'editables.idTarea', '=', 'tareas.id')->select('editables.idTarea', 'editables.fecha_modificada', 'editables.fecha_finalanterior', 'editables.campos_editado', 'historial.descripcion', 'historial.created_at', 'tareas.Fecha_inicio', 'tareas.fecha_termino')->where('editables.idTarea', $id)->get();
            return view('showEditable', compact('editable'));
        }
    }
}
