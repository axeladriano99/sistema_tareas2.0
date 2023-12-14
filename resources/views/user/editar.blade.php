@extends('plantilla')
@section('content')
    @role('administrador')
        <div class="row">
            <div class="col-md-12" style="padding: 45px;font-family: 'Oswald', sans-serif;
            fint-size: 48px; color:black; ">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @extends('plantilla')
@section('content')
    @role('administrador')
        <div class="row">
            <div class="col-md-12" style="padding: 45px;font-family: 'Oswald', sans-serif;
            fint-size: 48px; color:black; ">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                        
                                    <div class="form-group">
                                        {{ Form::label('DNI') }}
                                        <div class="input-group">
                                            {{ Form::text('DNI', $user->DNI, ['class' => 'form-control' . ($errors->has('DNI') ? ' is-invalid' : ''), 'placeholder' => 'Dni', 'id' => 'dni']) }}
                                            {!! $errors->first('DNI', '<div class="invalid-feedback">:message</div>') !!}
                                            <button type="button" class="btn btn-outline-success" id="buscar">Buscar</button>
                                        </div>
                                    </div>
                                    <div id="buscandoMensaje" style="display: none;">Buscando...</div>
                        
                                    <div class="form-group">
                                        {{ Form::label('Nombre') }}
                                        {{ Form::text('name', $user->name, ['id' => 'nombre', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('apellidoPaterno') }}
                                        {{ Form::text('apellidoPaterno', $user->apellidoPaterno, ['class' => 'form-control' . ($errors->has('apellidoPaterno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Paterno']) }}
                                        {!! $errors->first('apellidoPaterno', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('apellido_Materno') }}
                                        {{ Form::text('apellido_Materno', $user->apellido_Materno, ['class' => 'form-control' . ($errors->has('apellido_Materno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Materno']) }}
                                        {!! $errors->first('apellido_Materno', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('email') }}
                                        {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('cargo') }}
                                        {{ Form::text('cargo', $user->cargo, ['class' => 'form-control' . ($errors->has('cargo') ? ' is-invalid' : ''), 'placeholder' => 'Cargo']) }}
                                        {!! $errors->first('cargo', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    
                                    <div class="form-group">
                                        {{ Form::label('Area') }}
                                        {{ Form::select('idArea', $area,  ['class' => 'form-control' . ($errors->has('idArea') ? ' is-invalid' : '')]) }}
                                        {!! $errors->first('idArea', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('rol') }}
                                        {{ Form::select('rol', $roles ,$user->rol,['class' => 'form-control' . ($errors->has('rol') ? ' is-invalid' : '')]) }}
                                        {!! $errors->first('rol', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Contraseña') }}
                                        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Nueva contraseña']) }}
                                        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                                </div>
                                <script>
                                    document.querySelector('#buscar').addEventListener('click', function() {
                                        buscarDNI();
                                    });
                        
                                    function buscarDNI() {
                            const dniInput = document.querySelector('#dni');
                            const nombreInput = document.querySelector('#nombre');
                            const apellidoPaternoInput = document.querySelector('#apellidoPaterno');
                            const apellidoMaternoInput = document.querySelector('#apellido_Materno');
                            const buscandoMensaje = document.querySelector('#buscandoMensaje'); // Elemento para mostrar el mensaje
                        
                            const dni = dniInput.value;
                        
                            if (!dni) {
                                alert('Por favor, ingrese un número de DNI.');
                                return;
                            }
                        
                            // Mostrar el mensaje "Buscando"
                            buscandoMensaje.style.display = 'block';
                        
                            const url = `http://mundoapu.com:7415/?documento=${dni}`;
                            const api = new XMLHttpRequest();
                            api.open('GET', url, true);
                            api.send();
                        
                            api.onreadystatechange = function() {
                                if (this.status === 200 && this.readyState === 4) {
                                    // Ocultar el mensaje "Buscando" una vez que se reciba la respuesta
                                    buscandoMensaje.style.display = 'none';
                        
                                    const response = JSON.parse(this.responseText);
                        
                                    if (response.success) {
                                        const data = response.data;
                                        console.log(response.data);
                                        let nombres = data.nombres.split(' ');
                                        let nombresm = "";
                                        for (let index = 0; index < nombres.length; index++) {
                                            nombresm += capitalizar(nombres[index].toLowerCase()) + " ";
                                        }
                                        console.log(nombresm);
                                        const nombreCapitalizado = nombresm;
                                        const apellidoCapitalizado = capitalizar(data.apellidoPaterno.toLowerCase());
                                        const apellidoMaterno = capitalizar(data.apellidoMaterno.toLowerCase());
                                        nombreInput.value = nombreCapitalizado;
                                        apellidoPaternoInput.value = apellidoCapitalizado;
                                        apellidoMaternoInput.value = apellidoMaterno;
                                    } else {
                                        alert(response.message);
                                    }
                                }
                            };
                        }
                        
                        
                                    // Función para capitalizar el texto
                                    function capitalizar(string) {
                                        return string.charAt(0).toUpperCase() + string.slice(1);
                                    }
                                </script>
                            </div>
                        

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@endrole

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@endrole