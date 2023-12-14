<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body> <div class="container-scroller">
  <!-- partial:../../partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg"
                  alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img
                  src="../../assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <ul class="nav">
          <li class="nav-item profile">
              <div class="profile-desc">
                  <div class="profile-pic">
                      <div class="count-indicator">
                          <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.jpg"
                              alt=""><h4 style="color: aliceblue;">{{ Auth::user()->name }}</h4>
                          <span class="count bg-success"></span>
                      </div>
                      <div class="profile-name">
                          <h5 class="mb-0 font-weight-normal">
                              @if (session('status'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('status') }}
                                  </div>
                              @endif
                      </div>
                  </div>
          <li class="nav-item nav-category">
              <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
              @role('administrador')
              <a class="nav-link" href="{{ url('users') }}">
                  <span class="menu-icon">
                      <i class="mdi mdi-speedometer"></i>
                  </span>
                  <span class="menu-title">Crear usuario</span>
              </a>
              @endrole
          </li>
          
          <li class="nav-item menu-items">
              @role('administrador')
              <a class="nav-link" href="{{ url('tareas') }}">
                  <span class="menu-icon">
                      <i class="mdi mdi-speedometer"></i>
                  </span>
                  <span class="menu-title">Crear tarea</span>
              </a>
              @endrole
          </li>

          <li class="nav-item menu-items">
              @role('administrador')
              <a class="nav-link" href="{{ url('estados') }}" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-icon">
                      <i class="mdi mdi-laptop"></i>
                  </span>
                  <span class="menu-title">Crear estado</span>
                  <i class="menu-arrow"></i>
              </a>
              @endrole
          </li>
          <li class="nav-item menu-items">
              @role('administrador')
              <a class="nav-link" href="{{ url('areas') }}">
                  <span class="menu-icon">
                      <i class="mdi mdi-playlist-play"></i>
                  </span>
                  <span class="menu-title">Crear Area</span>
              </a>
              @endrole
          </li>

          <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank
                          Page
                      </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a>
                  </li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a>
                  </li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a>
                  </li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register
                      </a></li>
              </ul>
          </div>
          </li>
          </li>
      </ul>
  </nav>

  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href=""><img
                      src="../../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
              <ul class="navbar-nav w-100">
                  <div id="app">
                      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                          <div class="container">
                              <a class="navbar-brand">
                                  {{ config('app.name', 'SISTEMA DE ASIGNACION DE TAREAS') }}
                              </a>
                              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#navbarSupportedContent"
                                  aria-controls="navbarSupportedContent" aria-expanded="false"
                                  aria-label="{{ __('Toggle navigation') }}">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                              </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                  <li class="nav-item dropdown d-none d-lg-block">
                      @role('administrador')
                      <a class="nav-link btn btn-success create-new-button" href="{{ url('users') }}">Crear
                          nuevo usuario</a>
                      @endrole
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                          aria-labelledby="createbuttonDropdown">
                          <h6 class="p-3 mb-0">Projects</h6>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">


                                  <div class="preview-icon bg-dark rounded-circle">
                                      <i class="mdi mdi-file-outline text-primary"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">

                                  <p class="preview-subject ellipsis mb-1">Crear Usuario</p>
                              </div>
                          </a>
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-dark rounded-circle">
                                      <i class="mdi mdi-web text-info"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <p class="preview-subject ellipsis mb-1">UI Development</p>
                              </div>
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-dark rounded-circle">
                                      <i class="mdi mdi-layers text-danger"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <p class="preview-subject ellipsis mb-1">Software Testing</p>
                              </div>
                          </a>
                          <div class="dropdown-divider"></div>
                          <p class="p-3 mb-0 text-center">See all projects</p>
                      </div>
                  </li>
                  <li class="nav-item nav-settings d-none d-lg-block">
                      <a class="nav-link" href="#">
                          <i class="mdi mdi-view-grid"></i>
                      </a>
                  </li>
                  <li class="nav-item dropdown border-left">
                      <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          <span class="count bg-success"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">

                  </li>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                      aria-labelledby="notificationDropdown">
                      <h6 class="p-3 mb-0"></h6>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item preview-item">
                          <div class="preview-thumbnail">
                              <div class="preview-icon bg-dark rounded-circle">
                                  <i class="mdi mdi-calendar text-success"></i>
                              </div>
                          </div>
                          <div class="preview-item-content">
                              <p class="preview-subject mb-1"></p>
                              <p class="text-muted ellipsis mb-0"> </p>
                          </div>
                      </a>
                      <div class="dropdown-divider"></div>
                  </div>
                  <div class="preview-item-content">
                      <p class="preview-subject mb-1">

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item">
                          </a>
                      </div>
                  </div>
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-dark rounded-circle">
                          </div>
                      </div>
                  </a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                          <div class="navbar-profile">
                              <img class="img-xs rounded-circle" src="../../assets/images/faces/face15.jpg"
                                  alt="">
                              <p class="mb-0 d-none d-sm-block navbar-profile-name"> {{ Auth::user()->name }}
                              </p>
                              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                          </div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                          aria-labelledby="profileDropdown">
                          <div class="">
                              <i class="mdi mdi"></i>
                          </div>

                          </a>
                          <div class="">
                              <div class="">
                                  <i class="mdi "></i>
                              </div>
                          </div>
                          <div class="preview-item-content">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                          @csrf</p>
                              
                              </a>
                          </div>
                          </a>

                          <div class="dropdown-divider"></div>
                          <p class="p-3 mb-0 text-center">Advanced settings</p>
                      </div>
                  </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none " type="button"
                  data-toggle="offcanvas">
                  <span class="mdi mdi-format-line-spacing"></span>
              </button>
          </div>
      </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                    <pre>
                              <span id="card_title">
                                  {{ __('Estado') }}
                              </span>
                              
                               <div class="float-right">
                              </div>
                          </pre>
                                </div>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif<div class="row">

                              <div class="col-lg-12 grid-margin stretch-card">
                                  <div class="card">
                                      <div class="card-body">
                                          <h4 class="card-title">Basic Table</h4>
                                          <p class="card-description">
                                          <div class="badge bg-primary text-wrap" style="width: 6rem;">
                                              TAREAS inicidasss
                                          </div>
                                          </p>
                                          <div class="table-responsive">
                                              <table class="table">
                                                  <thead>
                                                      <tr>
                                                          <th>id</th>
                                                          <th>nombre</th>
                                                          <th>Fecha de Inicio</th>
                                                          <th>Fecha de Creación</th>
                                                          <th>Fecha de Término</th>
                                                          <th>Descripción</th>
                                                          <th>Estado</th>
                                                          <th>Creador</th>
                                                          <th>Acciones</th>
                                                          <th> </th>
                                                          <!-- Nueva columna para los botones -->
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                <tr>
                                                  <td> 1 </td>
                                                  <td> Herman Beck </td>
                                                  <td>
                                                    <div class="progress">
                                                      <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </td>
                                                  <td> $ 77.99 </td>
                                                  <td> May 15, 2015 </td>
                                                
                                                    <td>
                                                        <form action="" method="POST">
                                                            <a class="btn btn-sm btn-primary " href=""><i
                                                                    class="fa fa-fw fa-eye"></i>
                                                                {{ __('Show') }}</a>
                                                            <a class="btn btn-sm btn-success" href=""><i
                                                                    class="fa fa-fw fa-edit"></i>
                                                                {{ __('Edit') }}</a>
                                                            <a class="btn btn-sm btn-success" href=""><i
                                                                    class="fa fa-fw fa-edit"></i>
                                                                {{ __('create') }}</a>
                                                            @csrf
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                {{ __('Delete') }}</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- partial:../../partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                bootstrapdash.com 2021</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                    href="https://www.bootstrapdash.com/bootstrap-admin-template/"
                                    target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../../assets/js/off-canvas.js"></script>
        <script src="../../assets/js/hoverable-collapse.js"></script>
        <script src="../../assets/js/misc.js"></script>
        <script src="../../assets/js/settings.js"></script>
        <script src="../../assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <!-- End custom js for this page -->
</body>

</html>
