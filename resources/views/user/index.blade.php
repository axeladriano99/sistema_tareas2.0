@extends('plantilla')
@section('content')
    @if (auth()->check() &&
            (auth()->user()->hasRole('administrador') ||
                auth()->user()->hasRole('superadministrador')))<br>
       <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">
                </span>
                <div class="float-right" style=" margin-right: 20px;">
                    <br>
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right" data-placement="left">
                        {{ __('Crear Nuevo Usuario') }}
                    </a>
                </div>
            </div>
            <div class="espaciado">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>@endif<br>
            </div>
                <div class="tarjeta-centrada">
                <div class="card-body">
                    <table class="table table-striped display responsive table-hover" id="estado">
                        <thead class="thead">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th >Email</th>
                                <th>Dni</th>
                                <th>Cargo</th>
                                <th>Area</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->apellidoPaterno }}</td>
                                    <td>{{ $user->apellido_Materno }}</td>
                                    <td >{{ $user->email }}</td>
                                    <td >{{ $user->DNI }}</td>
                                    <td>{{ $user->cargo }}</td>
                                    <td>{{ $user->area->nombre }}</td>
                                    <td>{{ $user->estado == 1 ? 'activo' : 'inactivo' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('users.edit', $user->id) }}"><img width="20"
                                                    height="20" src="https://img.icons8.com/ios-glyphs/30/edit--v1.png"
                                                    alt="edit--v1" title="editar" />
                                            </a>
                                            <button type="submit" class="btn btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#modalCarreras{{ $user->id }}" title="eliminar"><img
                                                    width="20" height="20"
                                                    src="https://img.icons8.com/doodle/48/compost-bin.png"
                                                    alt="compost-bin" />
                                            </button>
                                            <div class="modal fade" id="modalCarreras{{ $user->id }}">
                                                <!-- Contenido del modal -->
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="alert alert-primary" role="alert">
                                                                    <center>¿Deseas cambiar el estado del usuario?</cemter>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                </div>
                                                                <div class="d-grid col-6 mx-auto">
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                                            class="fa fa-fw fa-trash"></i>
                                                                        {{ __('cambiar estado ') }}</button>
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


        <script>
            new DataTable('#estado', {
                "order" : [[1, "desc"]],
                responsive: true,
                autoWidth: true,
                "language": {
                    "lengthMenu": "Mostrar_MENU_registros en pagina",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la pagina  _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
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
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @endsection
@endif
