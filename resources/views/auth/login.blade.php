<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
</head>

<body>
    <section class="vh-100" style="background-color: #DCB222 ;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 4rem;">
                        <div class="card-body p-5 text-center">
                            <img src="https://static.vecteezy.com/system/resources/previews/004/303/637/non_2x/to-do-list-in-cartoon-style-the-concept-of-planning-and-successful-execution-of-affairs-vector.jpg"
                                width="150px">
                            <h3 class="mb-5">SISTEMA DE TAREAS</h3>
                            <form action="{{ route('post') }}" method="post">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{{ session('error') }}}
                                    </div>
                                @endif
                                @if(isset($error))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endif

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example11">correo corporativo</label>
                                    <input type="email" name="email" id="form2Example11" class="form-control"
                                        placeholder="Ingresa correo" />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="form2Example22" class="form-control" />
                                    <label class="form-label" name="password" for="form2Example22">contraseña</label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>
