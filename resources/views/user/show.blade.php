@extends('plantilla')
@section('content')
    @role('administrador')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('') }} Usuario:</span>
                            <div class="card-body">
                        
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $user->name }}
                                </div>
                                <div class="form-group">
                                    <strong>Apellidopaterno:</strong>
                                    {{ $user->apellidoPaterno }}
                                </div>
                                <div class="form-group">
                                    <strong>Apellido Materno:</strong>
                                    {{ $user->apellido_Materno }}
                                </div>
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>
                                <div class="form-group">
                                    <strong>Dni:</strong>
                                    {{ $user->DNI }}
                                </div>
                                <div class="form-group">
                                    <strong>Cargo:</strong>
                                    {{ $user->cargo }}
                                </div>
                                <div class="form-group">
                                    <strong>Idarea:</strong>
                                    {{ $user->idArea }}
                                </div>
        
                            </div>
                        </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                   
            </div>
        </div>
@endsection
@endrole