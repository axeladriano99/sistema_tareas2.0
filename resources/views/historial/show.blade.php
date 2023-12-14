@extends('layouts.app')

@section('template_title')
    {{ $historial->name ?? "{{ __('Show') Historial" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Historial</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('historials.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Idusuario:</strong>
                            {{ $historial->idUsuario }}
                        </div>
                        <div class="form-group">
                            <strong>Idtarea:</strong>
                            {{ $historial->idTarea }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $historial->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
