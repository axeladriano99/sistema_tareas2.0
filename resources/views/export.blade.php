@if (auth()->check() &&
        (auth()->user()->hasRole('administrador') ||
            auth()->user()->hasRole('superadministrador')))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Sistema de Tareas</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="{{ asset('img/favicon.ico') }}" rel="icon">
        <link rel="stylesheet" href="{{ asset('style.css') }}">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/estilos.css') }}">
    </head>

    <body>
        <div class=" position-relative bg-white d-flex p-99"
            style="font-family: 'Oswald', sans-serif;
    fint-size: 48px; color:black;">


            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="index.html" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa"></i></h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src={{ asset('img/user.jpg') }} alt=""
                                style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0" style="text-align:right; padding-right: 65px;"> {{ Auth::user()->name }}
                            </h6>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown">
                            <a href="{{ route('home.index') }}" class="nav-item nav-link "><i
                                    class="fa fa-table me-2"></i>Home</a>
                        </div>
                        @if (auth()->check() && (auth()->user()->hasRole('administrador') || auth()->user()->hasRole('superadministrador')))

                    
                     
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                        class="fa fa-laptop me-2"></i>Procedimientos </a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="{{ route('tareas.index') }}" class="dropdown-item">Lista de tareas</a>
                                    <a href="{{ route('tareas.create') }}" class="dropdown-item">Creacion de Tareas</a>
                                </div>
                            </div>
                        
                     
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                        class="fa fa-laptop me-2"></i>Mantenimiento</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="{{ route('users.index') }}" class="dropdown-item">Usuarios</a>
                                    <a href="{{ route('estados.create') }}" class="dropdown-item">Estados</a>
                                    <a href="{{ route('areas.create') }}" class="dropdown-item">Areas</a>
                                </div>
                            </div>
                        
                     
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                        class="fa fa-laptop me-2"></i>Reportes </a>
                                        
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="{{ route('export') }}" class="dropdown-item">Generar reporte</a>
                                 
                                </div>
                            </div>
                        
                        
    
                    </div>
                    @endif
                    </div>
                </nav>
            </div>
            <div class="content">

                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4">

                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">

                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                                <hr class="dropdown-divider">

                                <hr class="dropdown-divider">

                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src={{ asset('img/user.jpg') }} alt=""
                                    style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex"> {{ Auth::user()->name }}</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesion') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf</p>
                                    </form>
                                </a>
                            </div>
                        </div>

                    </div>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-info"  style="margin-left: 30px">
                            <div class="card-body">
                                <h3 class="card-title"> CRITERIOS DE BUSQUEDA</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" id="btnLimpiarBusqueda">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width:20%;" class="form-floading mx-1">
                                        <input type="text" id="txtTarea" class="form-control" data-index="2" placeholder="Nombre de la tarea">
                                        </div>
                                        <div style="width:20%" class="mx-1">
                                            <select onchange="ListadoUsuarios(this.value)" class="form-select"
                                            id="area" name="area"
                                            aria-label="Default select example">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="form-control"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                        </span>
                        <div class="float-right" style=" margin-right: 20px;">
                            <br>
                            <a href="{{ route('tareas.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Crear Nueva una Tarea') }}
                            </a>
                        </div>
                    </div>
                    <div style="padding-left: 2.5px;">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div><br>
                    <div class="cardes"  >
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
                                        <td>{{ $tarea->nombre }}</td>
                                        <td>{{ $tarea->fecha_creacion }}</td>
                                        <td>{{ $tarea->Fecha_inicio }}</td>
                                        <td>{{ $tarea->fecha_termino }}</td>
                                        <td>{{ $tarea->descripcion }}</td>
                                        <td>{{ $tarea->idEstado }}</td>
                                        <td>{{ $tarea->users->name }}</td>
                                        <td>{{ $tarea->user->name }}</td>

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
                    </div>
                    </td>
                    </tr>
@endforeach
</tbody>
</table>
</div>
<style>
    .cardes{
        padding-left: 30px;
        padding-right: 30px;
    }
    </style>

<script>
    new $.fn.dataTable('#tareas', {
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
        },
        "columnDefs": [{
                "searchable": false,
                "targets": [1, 8]
            } // Excluir la primera y última columna de la búsqueda
        ]
    });
    $(document).ready(function(){
                        $("txtTarea").keyup(function(){
                            table.column($(this).data('index')).search(this.value).draw();
                        })
                    })
</script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src={{ asset('lib/chart/chart.min.js') }}></script>
<script src={{ asset('lib/easing/easing.min.js') }}></script>
<script src={{ asset('lib/waypoints/waypoints.min.js') }}></script>
<script src={{ asset('lib/owlcarousel/owl.carousel.min.js') }}></script>
<script src={{ asset('lib/tempusdominus/js/moment.min.js') }}></script>
<script src={{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}></script>
<script src={{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
@endif
