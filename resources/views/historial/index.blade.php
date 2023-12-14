@extends('plantilla')
@section('content')
    @if (auth()->check() &&
            (auth()->user()->hasRole('administrador') ||
                auth()->user()->hasRole('superadministrador')))
        <br>
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">
                    <h3 style="margin-left: 50px; color:blue;" >Lista de Historiales</h3>
                </span>
                <div class="float-right" style=" margin-right: 20px;">
                    <br>
                </div>
            </div>
            <br>
            <div class="tarjeta-centrada">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="historial">
                            <thead class="thead">
                                <tr>


                                    <th>Nombre del usuario</th>
                                    <th>Nombre de la tarea</th>
                                    <th>Motivo del Cambio</th>
                                    <th> Fecha creacion </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historials as $historial)
                                    <tr>


                                        <td>{{ $historial->idUsuario }}</td>
                                        <td>{{ $historial->idTarea }}</td>
                                        <td>{{ $historial->descripcion }}</td>
                                        <td>{{ $historial->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <style>
            #historial th:nth-child(4),
            #historial td:nth-child(4) {
                display: none;
            }
        </style>
        <script>
            new DataTable('#historial', {
                "order": [
                    [3, "desc"]
                ],
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
    @endif
@endsection
