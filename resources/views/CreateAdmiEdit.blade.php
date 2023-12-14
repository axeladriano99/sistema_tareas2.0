@extends('plantilla')
@section('content')
        <div > 
            <div class="col-md-12" style="padding: 45px;font-family: 'Oswald', sans-serif;
            color:black; ">
                @includeif('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Tarea</span>
                    </div>
                    <div class="card-body">
                        
                        <form method="POST" action="{{ route('tareas.update', $tarea->id) }}"  role="form" enctype="multipart/form-data">
                            
                            {{ method_field('PATCH') }}
                            @csrf
                            @if(isset($error))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endif
                            <div class="box box-info padding-1">
                                <div class="box-body" style="padding: 15px;">
                                    <div class="form-group">
                                        {{ Form::label('nombre') }}
                                        {{ Form::text('nombre', $tarea->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="fecha">
                                        {{ Form::label('Fecha_inicio') }}
                                        {{ Form::date('Fecha_inicio', \Carbon\Carbon::parse($tarea->Fecha_inicio)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('Fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio']) }}
                                        {!! $errors->first('Fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                        {{ Form::time('hora_inicio', $tarea->hora_inicio, ['class' => 'form-control' . ($errors->has('hora_inicio') ? ' is-invalid' : ''), 'placeholder' => 'hora_inicio']) }}

                                        {{ Form::label('fecha_termino') }}
                                        {{ Form::date('fecha_termino', \Carbon\Carbon::parse($tarea->fecha_termino)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fecha_termino') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Termino']) }}
                                        {!! $errors->first('fecha_termino', '<div class="invalid-feedback">:message</div>') !!}

                                        {{ Form::time('hora_termino', $tarea->hora_termino, ['class' => 'form-control' . ($errors->has('hora_termino') ? ' is-invalid' : ''), 'placeholder' => 'hora_termino']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('descripcion') }}
                                    {{ Form::textArea('descripcion', $tarea->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('Estado') }}
                                    {{ Form::select('idEstado', $estado, $tarea->idEstado, ['class' => 'form-control' . ($errors->has('idEstado') ? ' is-invalid' : '')]) }}
                                    {!! $errors->first('idEstado', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <br>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                            </div>
                        </form>
                   
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection