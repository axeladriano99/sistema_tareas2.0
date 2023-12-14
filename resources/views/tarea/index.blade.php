@extends('plantilla')
@section('content')
    @if (auth()->check() &&
            (auth()->user()->hasRole('administrador') ||
                auth()->user()->hasRole('superadministrador')))
        <br>

        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title" style="margin-left: 30px">
                    <h3>Lista de Tareas</h3>
                </span>
                <div class="float-right" style=" margin-right: 20px;">
                    <br>
                    
                    <a href="{{ route('tareas.create') }}" class="btn btn-success btn-sm float-right" data-placement="left">
                        {{ __('Crear Nueva una Tarea') }}
                    </a>
                </div>
            </div>
            <div class="espaciado">
            <div style="padding-left: 2.5px;">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
                <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tarjeta-centrada">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">CRITERIOS DE BÚSQUEDA</h3>                         
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    

                                                    
                                                        <!-- Agregar un campo de entrada para la búsqueda -->
                                                        <form action="{{ route('generar') }}" method="post">
                                                            @csrf <!-- Agrega el campo csrf token para proteger tu formulario -->
                                                        
                                                                <div class="col">
                                                                    <span class="help-block text-muted small-font">
                                                                    
                                                                    </span>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <select class="form-select" id="estado" name="estado" data-index="">
                                                                            <option value="0">Seleccione el estado</option>
                                                                        
                                                                            @foreach ($estados as $estado)
                                                                                <option value="{{ $estado->name }}">{{ $estado->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <select class="form-select" id="area" name="area" data-index="9" aria-label="Default select example">
                                                                            <option value="0">Seleccione el usuario</option>
                                                                            @foreach ($usuarios as $usuario)
                                                                                <option value="{{ $usuario->name }}">{{ $usuario->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                   
                                                                    <div class="col-md-2">
                                                                        <button type="submit" class="btn btn-success" style="margin-left: 15px;">Generar Archivo Excel</button>

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a href="#" id="filtrar" class="btn btn-success" style="margin-left: ;">Buscar</a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                    <a href="{{ route('tareas.index') }}" class="btn btn-success" >Mirar todos los usuarios </a>
                                                                    </div>   
                                                                </div>
                                                        </form>
                                                </div>
                                        
                                              
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <style>
                            .tarjeta-centrada {
                                padding-left: 50px;
    padding-right: 30px;    
                                
                            }
                        </style>

                    </div><br>
                    <div class="margen-tabla">
                    <div class="card-body" >
                        <table class="table table-striped table-hover" id="tareas">
                            <thead class="thead">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha Creacion</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Termino</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Creador</th>
                                    <th>Usuario Asignado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas as $tarea)
                                    <tr>
                                        
                                        @php
                                            $camposEditadosArray = explode(',', $tarea->campos_editado);
                                        @endphp
                                        <td @if (in_array('nombre', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->nombre }}</td>
                                        <td @if (in_array('fecha_creacion', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->fecha_creacion }}</td>
                                        <td @if (in_array('Fecha_inicio', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->Fecha_inicio }}</td>
                                        <td @if (in_array('fecha_termino', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->fecha_termino }}</td>
                                        <td @if (in_array('descripcion', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->descripcion }}</td>
                                        <td >{{ $tarea->idEstado }}</td>
                                        <td @if (in_array('idUsuario', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->users->name}}</td>
                                        <td @if (in_array('idCreador', $camposEditadosArray)) class="bg-danger" @endif>{{ $tarea->user->name}}</td>
                                        
                                       

                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('tareas.edit', $tarea->id) }}"><img width="20"
                                                        height="20"
                                                        src="https://img.icons8.com/ios-glyphs/30/edit--v1.png"
                                                        alt="edit--v1"title="editar" /></a>
                                                <button type="submit" class="btn btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#modalCarreras{{ $tarea->id }}">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                    <img width="20" height="20"
                                                        src="https://img.icons8.com/doodle/48/compost-bin.png"
                                                        alt="compost-bin" title="eliminar" />
                                                </button>
                                            </div>
                                            <div class="modal fade" id="modalCarreras{{ $tarea->id }}">
                                                <!-- Contenido del modal -->
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="{{ route('tareas.destroy', $tarea->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="alert alert-primary" role="alert">
                                                                    <center>¿Deseas eliminar la tarea?</center>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                </div>
                                                                <div class="d-grid col-6 mx-auto">
                                                                    <button type="submit" class="btn btn-success btn-sm"><i
                                                                            class="fa fa-fw fa-trash"></i>
                                                                        {{ __('Eliminar') }}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="btnCerrar" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                    </td>
                    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    <script>
        function limpiar() {
            document.getElementById('#area').innerHTML = '';
            document.getElementById('myTabContent').innerHTML = '';
        }
        var tablaTareas = $('#tareas').DataTable({
            "order" : [[1, "desc"]],

            responsive: true,
            autoWidth: true,
            "language": {

                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros en página",
                'paginate': {
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            },
            "columnDefs": [{
                "searchable": false,

            }] // Excluir la primera y última columna de la búsqueda
        });
        $('#filtrar').click(function() {
            var selectedValue = $('#area').val(); // Obtener el valor seleccionado
            var columnIndex = $('#area').data('index'); // Obtener el índice de columna
            var Select = $('#estado').val();
            console.log(Select);
            if (Select === '0') { // Si se selecciona "Todos"

            tablaTareas.column(7).search(selectedValue).draw();
            }
            
            else if(Select === '9'){
                console.log('entro');
              //  tablaTareas.search('').column().search('').draw();
                tablaTareas.column(7).search(selectedValue).draw();
                

            }
            else {
                tablaTareas.column(5).search(Select).draw();
                tablaTareas.column(7).search(selectedValue).draw();
            }

            
        });

        $("#btnLimpiarBusqueda").on('click', function() {
            $("#area").val('');
            tablaTareas.search('').column().search('').draw();

        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@endif
