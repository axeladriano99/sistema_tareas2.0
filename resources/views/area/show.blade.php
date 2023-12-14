@extends('plantilla')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Area :') }} </span>
                            <div class="card-body">
                        
                                <div class="form-group">
                                    <strong>Nombre:   </strong>
                                    {{ $area->nombre }}
                                </div>
        
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('areas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
@endsection