@extends('plantilla')
@section('content')
@if (auth()->check() && (auth()->user()->hasRole('administrador') || auth()->user()->hasRole('superadministrador')))
        <div class="row" style="padding: 45px;font-family: 'Oswald', sans-serif;
        fint-size: 48px; color:black; ">
            <div class="col-md-12">

                @includeif('partials.errors')
                
               <a href="{{route('users.index')}}"  class="btn btn-success"> Lista de usuarios</a>
                    <br>
                    <br>

                <div class="card card-default">
                    
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('user.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@endif