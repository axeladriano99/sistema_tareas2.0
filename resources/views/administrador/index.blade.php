@extends('plantilla')
@section('content')
@role('administrador')
<br>
        <div class="col-12" style="padding: 10px;font-family: 'Oswald', sans-serif;
         color:black; ">
            <div class="float-right">
                <a href="{{ route('admiIndex.create') }}" class="btn btn-success btn-sm float-right" data-placement="left">
                    {{ __('Crear nueva Tarea') }}
                </a>
            </div>
            <br>
            <div class="card-body">
            <div class="bg-light rounded h-100 ">
                <h6  class="btn btn-success mb-4 " >Pendientes</h6>
             
                    <div class="table-responsive">
                        <table class="table table-striped display responsive table-hover" id="tareaTecnico1">

                            <thead class="thead">
                                <tr>
                                    <th>nombre</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Término</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Creador</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas_sin_iniciar as $tareas)
                                    <tr>
                                        @php
                                            $camposEditadosArray = explode(',', $tareas->campos_editado);
                                        @endphp
                                        <td @if (in_array('nombre', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->nombre }}
                                        </td>


                                        <td>{{ $tareas->fecha_creacion }}</td>
                                        <td @if (in_array('Fecha_inicio', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->Fecha_inicio }}</td>
                                        <td @if (in_array('fecha_termino', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->fecha_termino }}</td>

                                        <td @if (in_array('descripcion', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->descripcion }}</td>
                                            <td >{{ $tareas->estados_id }}
                                        <td @if (in_array('idCreador', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->idCreador }}
                                        </td>
                                        
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admiIndex.edit', $tareas->id) }}">
                                                        <img width="20" height="20"
                                                            src="https://img.icons8.com/ios-glyphs/30/edit--v1.png"
                                                            alt="edit--v1"title="editar" />
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-link btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modalIniciar{{ $tareas->id }}">
                                                        <img src="{{ asset('arrows-rotate-solid.svg') }}"
                                                            title="cambiar estado" width="20" height="20">

                                                    </button>
                                                </div>


                                                <div class="modal fade" id="modalIniciar{{ $tareas->id }}">
                                                    <!-- Contenido del modal -->
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <label class="h5" id="titulo_modal">Cambiar el estado de la
                                                                    tarea?</label>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form name="frmCarrerasxx" id="frmCarrerasxx" method="POST"
                                                                    action="{{ url('home', [$tareas->id]) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="alert alert-primary" role="alert">
                                                                        ¿Deseas cambiar el estado a
                                                                        iniciado?
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                    </div>
                                                                    <div class="d-grid col-6 mx-auto">
                                                                        <button type="submit" class="btn btn-success"><i
                                                                                class="fa-solid fa-floppy-disk"></i>
                                                                            Cambiar a iniciado</button>
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
                </div>
            </div>
        </div>
        <script>
            new DataTable('#tareaTecnico1', {
                responsive: true,
                    autoWidth: true,
                    "language": {
                        "lengthMenu": "Mostrar_MENU_registros en pagina",
                        "zeroRecords": "Nada encontrado - disculpa",
                        "info": "Mostrando la pagina  _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        'search': "Buscar:",
                        'paginate': {
                            'previous': 'Anterior',
                            'next': 'Siguiente'
                        }
                    }
            });
        </script>
   
   
        <div class="col-12" style="padding: 10px;font-family: 'Oswald', sans-serif;
         color:black; ">
          <div class="card-body">
            <div class="bg-light rounded h-100 ">
                <h6  class="btn btn-success mb-4 ">En proceso</h6>
               
                    <div class="table-responsive">
                        <table class="table table-striped display responsive table-hover" id="tareaTecnico2">
                            <thead class="thead">
                                <tr>
                                    <th>nombre</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Término</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Creador</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas_iniciadas as $tareas)
                                    <tr>
                                        @php
                                        $camposEditadosArray = explode(',', $tareas->campos_editado);
                                    @endphp
                                    <td @if (in_array('nombre', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->nombre }}
                                    </td>


                                    <td>{{ $tareas->fecha_creacion }}</td>
                                    <td @if (in_array('Fecha_inicio', $camposEditadosArray)) class="bg-danger" @endif>
                                        {{ $tareas->Fecha_inicio }}</td>
                                    <td @if (in_array('fecha_termino', $camposEditadosArray)) class="bg-danger" @endif>
                                        {{ $tareas->fecha_termino }}</td>

                                    <td @if (in_array('descripcion', $camposEditadosArray)) class="bg-danger" @endif>
                                        {{ $tareas->descripcion }}</td>
                                        <td >{{ $tareas->estados_id }}
                                    <td @if (in_array('idCreador', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->idCreador }}
                                    </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admiIndex.edit', $tareas->id) }}">
                                                        <img width="20" height="20"
                                                            src="https://img.icons8.com/ios-glyphs/30/edit--v1.png"
                                                            alt="edit--v1"title="editar" />
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-link btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modalIniciar{{ $tareas->id }}">
                                                        <img src="{{ asset('arrows-rotate-solid.svg') }}"
                                                            title="cambiar estado" width="20" height="20">
                                                    </button>
                                                </div>


                                                <div class="modal fade" id="modalIniciar{{ $tareas->id }}">
                                                    <!-- Contenido del modal -->
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <label class="h5" id="titulo_modal">Cambiar el estado de la
                                                                    tarea?</label>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form name="frmCarrerasxx" id="frmCarrerasxx" method="POST"
                                                                    action="{{ url('home', [$tareas->id]) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="alert alert-primary" role="alert">
                                                                        ¿Deseas cambiar el estado a
                                                                        terminado?
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                    </div>
                                                                    <div class="d-grid col-6 mx-auto">
                                                                        <button type="submit" class="btn btn-success"><i
                                                                                class="fa-solid fa-floppy-disk"></i>
                                                                            Cambiar a terminado</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="btnCerrar"
                                                                    class="btn btn-secondary"
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
                </div>
            </div>
            <script>
                new DataTable('#tareaTecnico2', {
                    responsive: true,
                    autoWidth: true,
                    "language": {
                        "lengthMenu": "Mostrar_MENU_registros en pagina",
                        "zeroRecords": "Nada encontrado - disculpa",
                        "info": "Mostrando la pagina  _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        'search': "Buscar:",
                        'paginate': {
                            'previous': 'Anterior',
                            'next': 'Siguiente'
                        }
                    }
                });
            </script>
       
       
        <div class="col-12" style="padding: 10px;font-family: 'Oswald', sans-serif;
        color:black; ">
         <div class="card-body">
                    <h6  class="btn btn-success mb-4 ">Finalizado</h6>
                    <div class="table-responsive">
                        <table class="table" id="tareaTecnico3">
                            <thead>
                                <tr>
                                    <th>nombre</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Término</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Creador</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas_terminadas as $tareas)
                                    <tr>
                                        @php
                                            $camposEditadosArray = explode(',', $tareas->campos_editado);
                                        @endphp
                                        <td @if (in_array('nombre', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->nombre }}
                                        </td>
                                        <td>{{ $tareas->fecha_creacion }}</td>
                                        <td @if (in_array('Fecha_inicio', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->Fecha_inicio }}</td>
                                        <td @if (in_array('fecha_termino', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->fecha_termino }}</td>

                                        <td @if (in_array('descripcion', $camposEditadosArray)) class="bg-danger" @endif>
                                            {{ $tareas->descripcion }}</td>
                                            <td >{{ $tareas->estados_id }}
                                        <td @if (in_array('idCreador', $camposEditadosArray)) class="bg-danger" @endif>{{ $tareas->idCreador }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                new DataTable('#tareaTecnico3', {
                    responsive: true,
                    autoWidth: true,
                    "language": {
                        "lengthMenu": "Mostrar_MENU_registros en pagina",
                        "zeroRecords": "Nada encontrado - disculpa",
                        "info": "Mostrando la pagina  _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        'search': "Buscar:",
                        'paginate': {
                            'previous': 'Anterior',
                            'next': 'Siguiente'
                        }
                    }
                });
            </script>
       
       
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @endrole
@endsection