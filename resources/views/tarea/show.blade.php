@extends('plantilla')
@section('content') 
@role('administrador')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('') }} Tarea</span>
                            <div class="card-body">
                        
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    {{ $tarea->nombre }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha Inicio:</strong>
                                    {{ $tarea->Fecha_inicio }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha Creacion:</strong>
                                    {{ $tarea->fecha_creacion }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha Termino:</strong>
                                    {{ $tarea->fecha_termino }}
                                </div>
                                <div class="form-group">
                                    <strong>Descripcion:</strong>
                                    {{ $tarea->descripcion }}
                                </div>
                                <div class="form-group">
                                    <strong>Idestado:</strong>
                                    {{ $tarea->idEstado }}
                                </div>
                                <div class="form-group">
                                    <strong>Idcreador:</strong>
                                    {{ $tarea->idCreador }}
                                </div>
                                <div class="form-group">
                                    <strong>Idusuario:</strong>
                                    {{ $tarea->idUsuario }}
                                </div>
        
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tareas.index') }}"> {{ __('Salir') }}</a>
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
@endsection
@endrole