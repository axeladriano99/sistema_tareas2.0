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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">



    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/estilos.css') }}">
</head>

<body>
    <div class="" style="font-family: 'Oswald', sans-serif;
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
                    @role('superadministrador')
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-laptop me-2"></i>Procedimientos </a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('tareas.index') }}" class="dropdown-item">Lista de tareas</a>
                                <a href="{{ route('tareas.create') }}" class="dropdown-item">Creacion de Tareas</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="{{ route('historials.index') }}" class="nav-link dropdown"><i
                                    class="fa fa-laptop me-2"></i>Lista de Historial</a>

                        </div>
                    @endrole
                    @role('superadministrador')
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-laptop me-2"></i>Mantenimiento</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('users.create') }}" class="dropdown-item">Usuarios</a>
                                <a href="{{ route('estados.create') }}" class="dropdown-item">Estados</a>
                                <a href="{{ route('areas.create') }}" class="dropdown-item">Areas</a>
                            </div>
                        </div>
                    @endrole



                </div>
            </nav>
        </div>
        <div class="content">
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf</p>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            @role('superadministrador')
                <div class="row-lg-12-mg-12"
                    style="padding: 45px;font-family: 'Oswald', sans-serif;
        font-size: 25px; color:black; ">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card-body">
                            <div id="area-selector">
                                <div class="justify-content-between">

                                    <div class="row ">
                                        <div class="col">
                                            <span class="help-block text-muted small-font">
                                                <h3>Selecciona el Area de tu interes</h3>
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <span class="help-block text-muted small-font"> </span>
                                            <select onchange="ListadoUsuarios(this.value)" class="form-select"
                                                id="area" name="area" aria-label="Default select example">
                                                <option value="0">SELECCIONE</option>
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}">{{ $area->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div id="tab-container">
                                            <ul class="nav nav-tabs" id="myTab"
                                                style="font-family: 'Oswald', sans-serif;
                                        font-size: 15px; color:black; "rol="tablist">
                                            </ul>
                                        </div>
                                        <div class="tab-content"
                                            style="font-family: 'Oswald', sans-serif;
                                    font-size: 15px; color:black; "rol="tablist"
                                            id="myTabContent">
                                        </div>

                                        <script>
                                            function limpiar() {
                                                document.getElementById('myTab').innerHTML = '';
                                                document.getElementById('myTabContent').innerHTML = '';
                                            }

                                            function ListadoUsuarios(idArea) {
                                                // Código AJAX para obtener los datos de la tabla y construir la tabla DataTable
                                                $.ajax({
                                                    url: "{{ route('superAdm') }}?id=" + idArea, // Cambia la URL a la que corresponda
                                                    method: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        limpiar();
                                                        if (data.length == 0) {
                                                            return;
                                                        }
                                                        document.getElementById('myTab').innerHTML = '';
                                                        var content = '';
                                                        data.forEach(element => {
                                                            var tabName = element.name;
                                                            var id = element.id;
                                                            var tab = $('<li class="nav-item" style="f" role="presentation">');
                                                            var button = $('<button onclick="IniciarDatatable(' + id +
                                                                ')" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab' +
                                                                id +
                                                                '" type="button" role="tab" aria-controls="tab' + id +
                                                                '" aria-selected="false">' + tabName + '</button>');
                                                            tab.append(button);
                                                            $('#myTab').append(tab);

                                                            var tableHtml =

                                                                '<div class="row" width="100%">' +
                                                                '<div class="table-responsive">' +
                                                                '<br>' +
                                                                '<h6  class="btn btn-success mb-4 ">Pendientes</h6>' +
                                                                '<table class="table" width="100%"  10px; padding: 10px; color: black"; id="tareas1' +
                                                                id + '" style="width: 100%">' +
                                                                '<thead bgcolor="#1136A9">' +
                                                                '<tr>' +
                                                                '<th>Nombre</th>' +
                                                                '<th>Fecha creación</th>' +
                                                                '<th>Fecha inicio</th>' +
                                                                '<th>Fecha Finalizacion</th>' +
                                                                '<th>Descripción</th>' +
                                                                '<th>Estado</th>' +
                                                                '<th>Creador</th>' +
                                                                '<th>Acciones</th>' +
                                                                '</tr>' +
                                                                '</thead>' +
                                                                '</table>' +
                                                                '</div>' +
                                                                '</div>';

                                                            var tableHtml2 =
                                                                '<div class="row" width="100%">' +
                                                                '<div class="table-responsive">' +
                                                                '<br>' +
                                                                '<h6  class="btn btn-success mb-4 ">En Proceso</h6>' +
                                                                '<table class="table" width="100%" style="margin: 10px; padding: 10px; color: black" id="tareas2' +
                                                                id + '" style="width: 100%">' +
                                                                '<thead bgcolor="#1136A9">' +
                                                                '<tr>' +
                                                                '<th>Nombre</th>' +
                                                                '<th>Fecha creación</th>' +
                                                                '<th>Fecha inicio</th>' +
                                                                '<th>Fecha Finalizacion</th>' +
                                                                '<th>Descripción</th>' +
                                                                '<th>Estado</th>' +
                                                                '<th>Creador</th>' +
                                                                '<th>Acciones</th>'+
                                                                '</tr>' +
                                                                '</thead>' +
                                                                '</table>' +
                                                                '</div>' +
                                                                '</div>';
                                                            var tableHtml3 =
                                                                '<div class="row" width="100%">' +
                                                                '<div class="table-responsive">' +
                                                                '<br>' +
                                                                '<h6  class="btn btn-success mb-4 ">Finalizado</h6>' +
                                                                '<table class="table" width="100%" style="margin: 10px; padding: 10px; color: black" id="tareas3' +
                                                                id + '" style="width: 100%">' +
                                                                '<thead bgcolor="#1136A9">' +
                                                                '<tr>' +
                                                                '<th>Nombre</th>' +
                                                                '<th>Fecha creación</th>' +
                                                                '<th>Fecha inicio</th>' +
                                                                '<th>Fecha Finalizacion</th>' +
                                                                '<th>Descripción</th>' +
                                                                '<th>Estado</th>' +
                                                                '<th>Creador</th>' +
                                                                '<th>Acciones</th>'+
                                                                '</tr>' +
                                                                '</thead>' +
                                                                '</table>' +
                                                                '</div>' +
                                                                '</div>';

                                                            content += '<div class="tab-pane fade" id="tab' + id +
                                                                '" role="tabpanel" aria-labelledby="' + id + '" tabindex="0"> ' +
                                                                tableHtml + ' ' + tableHtml2 + ' ' + tableHtml3 + ' </div>';

                                                        });
                                                        document.getElementById('myTabContent').innerHTML = content;

                                                        // Crear una nueva pestaña
                                                        /*var tabId = 'tab-' + idArea;
                                                        var tabName = data.user.name;

                                                        var tab = $('<li class="nav-item" role="presentation">');
                                                        var button = $('<button class="nav-link" id="' + tabId +
                                                            '" data-bs-toggle="tab" data-bs-target="#' + tabId +
                                                            '" type="button" role="tab" aria-controls="' + tabId +
                                                            '" aria-selected="false">' + tabName + '</button>');

                                                        tab.append(button);
                                                        $('#myTab').append(tab);

                                                        // Crear el contenido de la pestaña
                                                        var tabContent = $('<div class="tab-pane fade" id="' +
                                                            tabId + '" role="tabpanel" aria-labelledby="' +
                                                            tabId + '-tab" tabindex="0"></div>');

                                                        var tableHtml = '<div class="row" width="100%">' +
                                                            '<div class="table-responsive">' +
                                                            '<table class="table" width="100%" style="margin: 10px; padding: 10px; color: black" id="tareas' +
                                                            userId + '" style="width: 100%">' +
                                                            '<thead bgcolor="#1136A9">' +
                                                            '<tr>' +
                                                            '<th>Nombre</th>' +
                                                            '<th>Fecha inicio</th>' +
                                                            '<th>Fecha creación</th>' +
                                                            '<th>Descripción</th>' +
                                                            '<th>Estado</th>' +
                                                            '<th>Creador</th>' +
                                                            '</tr>' +
                                                            '</thead>' +
                                                            '</table>' +
                                                            '</div>' +
                                                            '</div>';

                                                        tabContent.append(tableHtml);
                                                        $('#myTabContent').append(tabContent);

                                                        // Inicializar la tabla DataTable
                                                        $('#tareas' + userId).DataTable({
                                                            responsive: true,
                                                            autoWidth: true,
                                                            "language": {
                                                                "lengthMenu": "Mostrar _MENU_ registros en página",
                                                                "zeroRecords": "Nada encontrado - disculpa",
                                                                "info": "Mostrando la página _PAGE_ de _PAGES_",
                                                                "infoEmpty": "No hay registros disponibles",
                                                                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                                                                'search': "Buscar:",
                                                                'paginate': {
                                                                    'next': 'Siguiente'
                                                                }
                                                            }
                                                        });*/
                                                    },
                                                    error: function() {}
                                                });

                                            }


                                            function IniciarDatatable(idTabla) {
                                                $("#tareas1" + idTabla).dataTable().fnDestroy();
                                                new DataTable('#tareas1' + idTabla, {
                                                    "order": [
                                                        [1, "desc"]
                                                    ],
                                                    "ajax": "{{ route('ListarTareaUsuario') }}?id=" + idTabla,
                                                    "columns": [{
                                                            data: 'nombre'
                                                        },
                                                        {
                                                            data: 'fecha_creacion'
                                                        },
                                                        {
                                                            data: 'Fecha_inicio'
                                                        },
                                                        {
                                                            data: 'fecha_termino'
                                                        },

                                                        {
                                                            data: 'descripcion'
                                                        },
                                                        {
                                                            data: 'estados_id'
                                                        },
                                                        {
                                                            data: 'idCreador'
                                                        },
                                                        {
                                                            "render": function(data, type, row) {
                                                                return '<a href="historialAdm/' + row.id +
                                                                    '" id="ButtonEditar" class="editar edit-modal btn btn-warning botonEditar" onclick="Boton(' +
                                                                    row.id +
                                                                    ')"><span class="fa "></span><span class="hidden-xs">Ver campos editados</span></a>';
                                                            }
                                                        }


                                                    ],

                                                    responsive: true,
                                                    autoWidth: true,
                                                    "language": {
                                                        "lengthMenu": "Mostrar _MENU_ registros en pagina",
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


                                                $("#tareas2" + idTabla).dataTable().fnDestroy();
                                                new DataTable('#tareas2' + idTabla, {
                                                    "order": [
                                                        [1, "desc"]
                                                    ],
                                                    "ajax": "{{ route('tabla2') }}?id=" + idTabla,
                                                    "columns": [{
                                                            data: 'nombre'
                                                        },
                                                        {
                                                            data: 'fecha_creacion'
                                                        },
                                                        {
                                                            data: 'Fecha_inicio'
                                                        },
                                                        {
                                                            data: 'fecha_termino'
                                                        },

                                                        {
                                                            data: 'descripcion'
                                                        },
                                                        {
                                                            data: 'estados_id'
                                                        },
                                                        {
                                                            data: 'idCreador'
                                                        },
                                                        {
                                                            "render": function(data, type, row) {
                                                                return '<a href="historialAdm/' + row.id +
                                                                    '" id="ButtonEditar" class="editar edit-modal btn btn-warning botonEditar" onclick="Boton(' +
                                                                    row.id +
                                                                    ')"><span class="fa "></span><span class="hidden-xs">Ver campos editados</span></a>';
                                                            }
                                                        }
                                                        
                                                    ],
                                                    responsive: true,
                                                    autoWidth: true,
                                                    "language": {
                                                        "lengthMenu": "Mostrar _MENU_ registros en pagina",
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
                                                $("#tareas3" + idTabla).dataTable().fnDestroy();
                                                new DataTable('#tareas3' + idTabla, {
                                                    "order": [
                                                        [1, "desc"]
                                                    ],
                                                    "ajax": "{{ route('tabla3') }}?id=" + idTabla,
                                                    "columns": [{
                                                            data: 'nombre'
                                                        },
                                                        {
                                                            data: 'fecha_creacion'
                                                        },
                                                        {
                                                            data: 'Fecha_inicio'
                                                        },
                                                        {
                                                            data: 'fecha_termino'
                                                        },

                                                        {
                                                            data: 'descripcion'
                                                        },
                                                        {
                                                            data: 'estados_id'
                                                        },
                                                        {
                                                            data: 'idCreador'
                                                        },
                                                        {
                                                            "render": function(data, type, row) {
                                                                return '<a href="historialAdm/' + row.id +
                                                                    '" id="ButtonEditar" class="editar edit-modal btn btn-warning botonEditar" onclick="Boton(' +
                                                                    row.id +
                                                                    ')"><span class="fa "></span><span class="hidden-xs">Ver campos editados</span></a>';
                                                            }
                                                        }
                                                    ],
                                                    responsive: true,
                                                    autoWidth: true,
                                                    "language": {
                                                        "lengthMenu": "Mostrar _MENU_ registros en pagina",
                                                        "zeroRecords": "Nada encontrado - disculpa",
                                                        "info": "Mostrando la pagina  _PAGE_ de _PAGES_",
                                                        "infoEmpty": "No hay registros disponibles",
                                                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                                                        'search': "Buscar:",
                                                        'paginate': {
                                                            'Previous': 'Anterior',
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
