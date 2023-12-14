@extends('plantilla')
@section('content')
        <div class="row" style="padding: 45px;font-family: 'Oswald', sans-serif;
        fint-size: 48px; color:black; ">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default" style="padding: ">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar area ') }} </span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('areas.update', $area->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('area.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
