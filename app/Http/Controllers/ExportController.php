<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TareasExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Estado;
use App\Models\Tarea;
class ExportController extends Controller
{
    use Exportable;
   
    public function store(Request $request)
    {
    $usuario = $request->input('usuario');
    $estado = $request->input('estado');
    return Excel::download(new TareasExport, 'tareasss.xlsx');
    }

}
