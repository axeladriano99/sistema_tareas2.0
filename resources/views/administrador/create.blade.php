@extends('plantilla')
@section('content')
    <div class="row" style="padding: 45px;font-family: 'Oswald', sans-serif;
        fint-size: 48px; color:black; ">
        <div class="col-md-12">


            @includeif('partials.errors')
            <br><br>
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear') }} Tarea</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admiIndex.store') }}" role="form" enctype="multipart/form-data">
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
                                    {{ Form::text('nombre', null, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="fecha">
                                    {{ Form::label('Fecha_inicio') }}
                                    {{ Form::date('Fecha_inicio', \Carbon\Carbon::parse()->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('Fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio']) }}
                                    {!! $errors->first('Fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}

                                    {{ Form::time('hora_inicio', \Carbon\Carbon::parse()->format('H:i'), ['class' => 'form-control' . ($errors->has('hora_inicio') ? ' is-invalid' : ''), 'placeholder' => 'hora_inicio']) }}

                                    {{ Form::label('fecha_termino') }}
                                    {{ Form::date('fecha_termino', \Carbon\Carbon::parse()->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fecha_termino') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Termino']) }}
                                    {!! $errors->first('fecha_termino', '<div class="invalid-feedback">:message</div>') !!}

                                    {{ Form::time('hora_termino', \Carbon\Carbon::parse()->format('H:i'), ['class' => 'form-control' . ($errors->has('hora_termino') ? ' is-invalid' : ''), 'placeholder' => 'hora_termino']) }}

                                </div>


                            </div>
                            <div class="form-group">
                                {{ Form::label('descripcion') }}
                                {{ Form::textArea('descripcion', null, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Estado') }}
                                {{ Form::select('idEstado', $estado, null, ['class' => 'form-control' . ($errors->has('idEstado') ? ' is-invalid' : '')]) }}
                                {!! $errors->first('idEstado', '<div class="invalid-feedback">:message</div>') !!}
                            </div>


                            <br>
                        </div>
                        <div class="box-footer mt20">
                            <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
