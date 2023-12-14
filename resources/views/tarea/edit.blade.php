@extends('plantilla')
@section('content')
    <div>
        <div class="col-md-12" style="padding: 45px;font-family: 'Oswald', sans-serif;
        color:black; ">
            @includeif('partials.errors')
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Actualizar') }} Tarea</span>
                </div>
                <div class="card-body">

                    <form id="frmdatos" name="frmdatos">
                        @csrf
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <label id="respuesta" style="color:red"></label>
                        <div class="box box-info padding-1">
                            <div class="box-body" style="padding: 15px;">
                                <div class="form-group">
                                    {{ Form::label('nombre') }}
                                    {{ Form::text('nombre', $tarea->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                    <label id="error_nombre" style="color:red"></label>
                                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="fecha">
                                    {{ Form::label('Fecha_inicio') }}
                                    {{ Form::date('Fecha_inicio', \Carbon\Carbon::parse($tarea->Fecha_inicio)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('Fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio', 'id' => 'fecha_inicio']) }}
                                    {!! $errors->first('Fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                    <br>
                                    <label id="hora" style="color:red"></label>

                                    {{ Form::time('hora_inicio', $tarea->hora_inicio, ['class' => 'form-control' . ($errors->has('hora_inicio') ? ' is-invalid' : ''), 'placeholder' => 'hora_inicio', 'id' => 'hora_inicio']) }}

                                    {{ Form::label('fecha_termino') }}
                                    {{ Form::date('fecha_termino', \Carbon\Carbon::parse($tarea->fecha_termino)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fecha_termino') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Termino', 'id' => 'fecha_termino']) }}
                                    {!! $errors->first('fecha_termino', '<div class="invalid-feedback">:message</div>') !!}

                                    {{ Form::time('hora_termino', $tarea->hora_termino, ['class' => 'form-control' . ($errors->has('hora_termino') ? ' is-invalid' : ''), 'placeholder' => 'hora_termino', 'id' => 'hora_termino']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('descripcion') }}
                                {{ Form::textArea('descripcion', $tarea->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                                <label id="error_descripcion" style="color:red"></label>
                                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Estado') }}
                                {{ Form::select('idEstado', $estado, $tarea->idEstado, ['class' => 'form-control' . ($errors->has('idEstado') ? ' is-invalid' : '')]) }}
                                {!! $errors->first('idEstado', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Usuario') }}
                                {{ Form::select('idUsuario', $usuarios, $tarea->idUsuario, ['class' => 'form-control' . ($errors->has('idUsuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario', 'id' => 'idUsuario']) }}
                                {!! $errors->first('idUsuario', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <br>
                            <input type="date" name="fecha1" id="fecha1" value="{{ $tarea->Fecha_inicio }}" hidden>
                            <input type="date" name="fecha2" id="fecha2" value="{{ $tarea->fecha_termino }}" hidden>
                            <input type="time" name="hora1" id="hora1" value="{{ $tarea->hora_inicio }}" hidden>
                            <input type="time" name="hora2" id="hora2" value="{{ $tarea->hora_termino }}" hidden>
                        </div>
                        <div class="box-footer mt20">
                            <button type="button" onclick="compararFechas({{ $tarea->id }})" id="historial"
                                class="btn btn-success">{{ __('Guardar') }}</button>
                        </div>
                        <br>
                        
                        @if (isset($editable))
                        <div class="card-body" >
                            <table class="table table-striped table-hover" id="tareas">
                                <thead class="thead">
                                    <tr>
                                        <th>Fecha creacion del motivo </th>
                                        <th>Motivo</th>
                                        <th>Fecha de inicio </th>
                                        <th>Fecha de inicio Modificada</th>
                                        <th>Fecha final origina </th>
                                        <th>Fecha final modificada</th>
                                       
                                    </tr>
                                </thead>
                                <body>
                                    <tr>
                                        @foreach($editable as $editaron)
                                        <td>{{$editaron->created_at}}</td>
                                        <td>{{$editaron->descripcion}}</td>
                                        <td>{{$editaron->fecha_modificada}}</td>
                                        <td>{{$editaron->Fecha_inicio}}</td>
                                        <td>{{$editaron->fecha_finalanterior}}</td>
                                        <td>{{$editaron->fecha_termino}}</td>
                                       
                                        @endforeach
                                <tbody>
                                </table>
                        </div>
                        @endif
                        


                        <div class="modal" id="motivoModal">
                            <!-- Contenido del modal -->
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <label class="h5" id="titulo_modal">¿Cambiar fecha de inicio y termino?</label>
                                        <button onclick="cerrarModal()" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-primary" role="alert">
                                            Ingresa el motivo de tu cambio de fecha
                                        </div>
                                        <div class="input-group mb-3">
                                        </div>
                                        <div class="d-grid col-6 mx-auto">
                                            <div class="mb-3">

                                                <input type=text id ="motivo_texto" name="motivo_texto" class="form-control"
                                                    required>
                                                <label id=texto style="color: red;"></label>
                                                <br>
                                                <button onclick="guardarMotivo({{ $tarea->id }})"
                                                    class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>
                                                    Cambiar la fecha</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="cerrarModal()" id="btnCerrar" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        function cerrarModal() {
                            var modal = document.getElementById('motivoModal');
                            modal.style.display = "none";
                        }

                        function compararFechas(id) {

                            // Las fechas con hora originales
                            var fechaStr = document.getElementById("fecha1").value;
                            var horaStr = document.getElementById("hora1").value;
                            var fechaArray = fechaStr.split('-');
                            var horaArray = horaStr.split(':');

                            var fechaInicioOriginal = new Date(
                                parseInt(fechaArray[0], 10), // Año
                                parseInt(fechaArray[1], 10) - 1, // Mes (0-based)
                                parseInt(fechaArray[2], 10), // Día
                                parseInt(horaArray[0], 10), // Hora
                                parseInt(horaArray[1], 10) // Minutos
                            );

                            var fechaStrTermino = document.getElementById("fecha2").value;
                            var horaStrTermino = document.getElementById("hora2").value;
                            var fechaArrayTermino = fechaStrTermino.split('-');
                            var horaArrayTermino = horaStrTermino.split(':');

                            var fechaTerminoOriginal = new Date(
                                parseInt(fechaArrayTermino[0], 10), // Año
                                parseInt(fechaArrayTermino[1], 10) - 1, // Mes (0-based)
                                parseInt(fechaArrayTermino[2], 10), // Día
                                parseInt(horaArrayTermino[0], 10), // Hora
                                parseInt(horaArrayTermino[1], 10) // Minutos
                            );

                            // Las fechas Originales ahora
                            var fechaStrIngresada = document.getElementById("fecha_inicio").value;
                            var horaStrIngresada = document.getElementById("hora_inicio").value;
                            var fechaArrayIngresada = fechaStrIngresada.split('-');
                            var horaArrayIngresada = horaStrIngresada.split(':');

                            var fechaIngresada = new Date(
                                parseInt(fechaArrayIngresada[0], 10), // Año
                                parseInt(fechaArrayIngresada[1], 10) - 1, // Mes (0-based)
                                parseInt(fechaArrayIngresada[2], 10), // Día
                                parseInt(horaArrayIngresada[0], 10), // Hora
                                parseInt(horaArrayIngresada[1], 10) // Minutos
                            );


                            var fechaTerminoStr = document.getElementById("fecha_termino").value;
                            var horaTerminoStr = document.getElementById("hora_termino").value;

                            var fechaTerminoArray = fechaTerminoStr.split('-');
                            var horaTerminoArray = horaTerminoStr.split(':');

                            var fechaTermino = new Date(
                                parseInt(fechaTerminoArray[0], 10), // Año
                                parseInt(fechaTerminoArray[1], 10) - 1, // Mes (0-based)
                                parseInt(fechaTerminoArray[2], 10), // Día
                                parseInt(horaTerminoArray[0], 10), // Hora
                                parseInt(horaTerminoArray[1], 10) // Minutos
                            );


                            if (fechaIngresada > fechaTermino) {
                                document.getElementById('hora').innerHTML = 'fecha incorrecta';
                                return;
                            } else if (fechaInicioOriginal.getTime() === fechaIngresada.getTime() && fechaTerminoOriginal.getTime() ===
                                fechaTermino.getTime()) {

                                guardar(id);
                                return;

                            } else {
                                document.getElementById("motivoModal").style.display = "block";
                                return;
                            }






                            var fecha_inicio = new Date(document.getElementById('fecha_inicio').value);

                            var hora_inicio_ingresada;


                            if (fecha_inicioIngresada > fecha_inicioOriginal) {
                                document.getElementById("motivoModal").style.display = "block";
                            } else {
                                document.getElementById("motivoModal").style.display = "block";
                            }
                        }

                        function guardarMotivo(id) {

                            var boton = document.getElementById('boton');

                            var formulario = document.getElementById('frmdatos');
                            // Obtén los datos del formulario
                            const formData = new FormData(formulario);

                            let token = document.querySelector('input[name="_token"]');

                            var motivo = document.getElementById('motivo_texto').value;

                            if (motivo === '') {
                                document.getElementById('texto').innerHTML = 'El motivo no puede estar vacío';
                                return;
                            }

                            fetch("{{ url('/ActualizarFecha') }}?id=" + id, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': token.value
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    //console.log(data); // Contiene la respuesta del controlador o los errores
                                    if (data.errors) {
                                        // Manejar las validaciones como un error
                                        // console.log(data.errors);
                                        var errors = data.errors;
                                        $.each(errors, function(field, messages) {
                                            $.each(messages, function(key, message) {
                                                document.getElementById('error_' + field).innerHTML = message;
                                            });
                                        });
                                    } else {
                                        document.getElementById('respuesta').innerHTML = 'Actualizado correctamente';

                                        setTimeout(function() {
                                            window.location.href =
                                                "/tareas";
                                        }); // 1000 milisegundos (1 segundo)

                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });


                            /*var motivo = document.getElementById("motivoInput").value;
                            var frm = $("#frmdatos").serialize();*/
                        };

                        function guardar(id) {
                            var boton = document.getElementById('boton');

                            var formulario = document.getElementById('frmdatos');
                            // Obtén los datos del formulario
                            const formData = new FormData(formulario);

                            let token = document.querySelector('input[name="_token"]');

                            var motivo = document.getElementById('motivo_texto').value;
                            var boton = document.getElementById('boton');


                            fetch("{{ url('/ActualizarFecha') }}?id=" + id, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': token.value
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    //console.log(data); // Contiene la respuesta del controlador o los errores
                                    if (data.errors) {
                                        // Manejar las validaciones como un error
                                        // console.log(data.errors);
                                        var errors = data.errors;
                                        $.each(errors, function(field, messages) {
                                            $.each(messages, function(key, message) {
                                                document.getElementById('error_' + field).innerHTML = message;
                                            });
                                        });
                                    } else {
                                        document.getElementById('respuesta').innerHTML = 'Actualizado correctamente';
                                        setTimeout(function() {
                                            window.location.href =
                                                "/tareas";
                                        }); // 1000 milisegundos (1 segundo)

                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });


                            /*var motivo = document.getElementById("motivoInput").value;
                            var frm = $("#frmdatos").serialize();*/
                        };
                    </script>


                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
