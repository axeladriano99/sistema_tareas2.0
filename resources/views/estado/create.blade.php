
@if (auth()->check() && (auth()->user()->hasRole('administrador') || auth()->user()->hasRole('superadministrador')))
@extends('plantilla')
@section('content')
    <div class="row" style="padding: 15px;font-family: 'Oswald', sans-serif;
    fint-size: 48px; color:black; ">
        <div class="col-md-12">

            @includeif('partials.errors')
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear estado') }}</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('estados.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('estado.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
       
    <div class="col-12" style="padding: 10px;font-family: 'Oswald', sans-serif;
    color:black; ">
             </div>
             @if ($message = Session::get('success'))
                 <div class="alert alert-success">
                     <p>{{ $message }}</p>
                 </div>
             @endif
                     <br>
                    <div class="cardes">
                        <div class="bg-light rounded h-100 ">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="estado">
                                    <thead class="thead">
                                        <tr>
                                            <th style="text-align: center;">
                                                <span style="margin-left: 100px;">Nombre</span>
                                            </th>
                                            <th style="text-align: center;">
                                                Creacion 
                                            </th>
                                                <th style="text-align: right;">
                                                    <div style="padding-right: 50px;">Acciones</div>
                                            </th>
                                        </tr>                                        

                                    </thead>
                                    <tbody>
                                        @foreach ($estados as $estado)
                                            <tr>
                                                
                                                <td style="text-align: center;">
                                                    <div style="margin-left: 100px;">{{ $estado->name }}</div>
                                                </td>   
                                                <td>{{$estado->created_at}}</td>
                                                <td  style="text-align: right; padding-right: 50px">
                                                    <div class="justify-content-between">
                                                        <a class="btn btn-sm btn-success"
                                                        href="{{ route('estados.edit', $estado->id) }}"></i> <img width="30"
                                                            height="30"
                                                            src="https://img.icons8.com/ios-glyphs/30/edit--v1.png"
                                                            alt="edit--v1" title="editar"/></a>
                                                    <button type="submit" class="btn btn-dark" data-bs-toggle="modal"
                                                        data-bs-target="#modalCarreras{{ $estado->id }}">
                                                        <i class="fa-solid fa-circle-plus"></i> <img width="30"
                                                            height="30"
                                                            src="https://img.icons8.com/doodle/48/compost-bin.png"
                                                            alt="compost-bin" title="eliminar"/>
                                                    </button>
                                                    
                                                    <div class="modal fade" id="modalCarreras{{ $estado->id }}">
                                                        <!-- Contenido del modal -->
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="{{ route('estados.destroy', $estado->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                         <div class="alert alert-primary" role="alert">
                                                                    <center>¿Deseas eliminar el estado?</center>
                                                                </div>
                                                                        <div class="input-group mb-3">
                                                                        </div>
                                                                        <div class="d-grid col-6 mx-auto">
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-sm"><i
                                                                                    class="fa fa-fw fa-trash"></i>
                                                                                {{ __('Eliminar') }}</button>
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
                                                    </form>
                                                </div>
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .cardes{
                    padding-left: 40px;
                    padding-right: 30px;
                }
                </style>
            
        </div><script>

                        new DataTable('#estado', {
                            "order" : [[1, "desc"]],
                            responsive: true,
                            autoWidth: true,
                            "language": {
                                "lengthMenu": "Mostrar _MENU_ registros en pagina",
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
                    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
                    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endsection
@endif