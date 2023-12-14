@extends('plantilla')
@section('content')
<div class="margen-tabla">
        <div class="col-md-12">
                <div class="card-body">
                    <div class="float-left">
                        <p> <span class="card-title">{{ __('CAMPOS EDITADOS') }} </span></p>
                         
                    </div>
                             </div>
                             
                                <div class="card-body" >
                                    <table class="table table-striped table-hover" id="tareas">
                                        <thead class="thead">
                                            <tr>
                                                <th>Fecha creacion del motivo </th>
                                                <th>Motivo</th>
                                                <th>Fecha de inicio </th>
                                                <th>Fecha de inicio Modificada</th>
                                                <th>Fecha final origina </th>
                                                <th>Fecha final modificada</th>
                                               
                                            </tr>
                                        </thead>
                                        <body>
                                            <tr>
                                                @foreach($editable as $editaron)
                                                <td>{{$editaron->created_at}}</td>
                                                <td>{{$editaron->descripcion}}</td>
                                                <td>{{$editaron->fecha_modificada}}</td>
                                                <td>{{$editaron->Fecha_inicio}}</td>
                                                <td>{{$editaron->fecha_finalanterior}}</td>
                                                <td>{{$editaron->fecha_termino}}</td>
                                               
                                                @endforeach
                                        <tbody>
                                        </table>
                                </div>
                             </div>
        </div>

        </div>
    </div>
@endsection