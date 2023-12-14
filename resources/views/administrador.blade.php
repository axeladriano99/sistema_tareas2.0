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
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
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
                        <h6 class="mb-0" style="text-align:right; padding-right: 65px;"> {{ Auth::user()->name }}</h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="{{ route('home.index') }}" class="nav-item nav-link "><i
                                class="fa fa-table me-2"></i>Home</a>
                    </div>
                   
                    @role('administrador')
                    <div class="nav-item dropdown">
                        <a href="{{route('administrador')}}" class="nav-link dropdown" ><i
                                class="fa fa-laptop me-2"></i>Lista de Personal</a>
                        
                    </div>
                    @endrole
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
                                <a href="{{route('historials.index')}}" class="nav-link dropdown" ><i
                                        class="fa fa-laptop me-2"></i>Lista de Historial</a>
                                
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
                        
                     
                            
                        
                        
    
                    </div>
                    @endif
                </div>
        </div>
        </nav>
    </div>
    <div class="content">

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa "></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">

            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">

                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                        <hr class="dropdown-divider">

                        <hr class="dropdown-divider">

                    </div>
                </div>
                <div class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src={{ asset('img/user.jpg') }} alt=""
                            style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex"> {{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesion') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf</p>
                            </form>
                        </a>
                    </div>
                </div>

            </div>
        </nav>
        @role('administrador')
            <div class="row-lg-12-mg-12" style="padding: 45px;font-family: 'Oswald', sans-serif;
color:black; ">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <h3 class="page-title" style="margin-left: 100px;">Lista de usuarios registrados con su lista
                                de
                                tareas </h3>
                        </h4>
                        <p class="card-description">

                        <div class="badge bg-success text-wrap">

                            PERSONAL ADMINISTRATIVO
                        </div>
                        </p>

                    </div>

                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        @foreach ($personal_sistemas as $personal_sistema)
                            <li class="nav-item " role="presentaion">
                                <button onclick="IniciarDatatable({{ $personal_sistema->id }})" class="nav-link"
                                    id="{{ $personal_sistema->id }}" data-bs-toggle="tab"
                                    data-bs-target="#tab{{ $personal_sistema->id }}" type="button" role="tabpanel"
                                    aria-controls="tab{{ $personal_sistema->id }}"
                                    aria-selected="false">{{ $personal_sistema->name }}</button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach ($personal_sistemas as $personal_sistema)
                            <div class="tab-pane fade" id="tab{{ $personal_sistema->id }}" role="tabpanel"
                                aria-labelledby="{{ $personal_sistema->id }}" tabindex="0">
                                <br>
                                <h6  class="btn btn-success mb-4 ">Sin iniciar</h6>
                                <div class="card-body">
                                <div class="row" width="100%">
                                    <div class="table-responsive" style="margin: 10px; padding: 10px; width: 100%; color:black">
                                        <table class="table" width="100%"
                                            style="margin: 10px; padding: 10px; color: black"
                                            id="tareas{{ $personal_sistema->id }}" style="width: 100%">
                                            <thead bgcolor="#1136A9">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha creación</th>
                                                    <th>Descripción</th>
                                                    <th>Estado</th>
                                                    <th>Creador</th>
                                                    <!-- Nueva columna para los botones -->
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                </div>
                                <br><br>
                                <h6  class="btn btn-success mb-4 ">Iniciado</h6>
                                <div class="table-responsive" style="margin: 10px; padding: 10px; width: 100%; color:black">
                                    <table class="table" width="100%"
                                        style="margin: 10px; padding: 10px; color: black"
                                        id="tareass{{ $personal_sistema->id }}" style="width: 100%">
                                        <thead bgcolor="#1136A9">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha creacion</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Creador</th>
                                                <!-- Nueva columna para los botones -->
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <h6  class="btn btn-success mb-4 ">Terminado</h6>
                                <div class="table-responsive" style="margin: 10px; padding: 10px; width: 100%;">
                                    <table class="table" width="100%"
                                        style="margin: 10px; padding: 10px; color: black"
                                        id="tareasss{{ $personal_sistema->id }}" style="width: 100%">
                                        <thead bgcolor="#1136A9">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha creacion</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Creador</th>
                                                <!-- Nueva columna para los botones -->
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                    </ul>
                </div>
            </div>
        </div>
        </div>
        </div>



        <script>
            function IniciarDatatable(idTabla) {
                $("#tareas" + idTabla).dataTable().fnDestroy();
                new DataTable('#tareas' + idTabla, {
                    "ajax": "{{ route('ListarTareaUsuario') }}?id=" + idTabla,
                    "columns": [{
                            data: 'nombre'
                        },
                        {
                            data: 'Fecha_inicio'
                        },
                        {
                            data: 'fecha_creacion'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'estados_id'
                        },
                        {
                            data: 'idCreador'
                        }
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
                $("#tareass" + idTabla).dataTable().fnDestroy();
                new DataTable('#tareass' + idTabla, {
                    "ajax": "{{ route('tabla2') }}?id=" + idTabla,
                    "columns": [{
                            data: 'nombre'
                        },
                        {
                            data: 'Fecha_inicio'
                        },
                        {
                            data: 'fecha_creacion'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'estados_id'
                        },
                        {
                            data: 'idCreador'
                        }
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
                $("#tareasss" + idTabla).dataTable().fnDestroy();
                new DataTable('#tareasss' + idTabla, {
                    "ajax": "{{ route('tabla3') }}?id=" + idTabla,
                    "columns": [{
                            data: 'nombre'
                        },
                        {
                            data: 'Fecha_inicio'
                        },
                        {
                            data: 'fecha_creacion'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'estados_id'
                        },
                        {
                            data: 'idCreador'
                        }
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

            }
        </script>
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


        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @endrole
