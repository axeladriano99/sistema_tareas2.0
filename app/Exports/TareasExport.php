<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\User;
use App\Models\Tarea;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TareasExport implements FromQuery, WithHeadings, WithStyles

{


    private $usuarios;
    private $estados;


    public function foryear($usuarios)
    {
        $this->estados = 0;
        $this->usuarios = $usuarios;
        return $this;
    }
    public function todos($usuarios, $estados)
    {
        $this->usuarios = $usuarios;
        $this->estados = $estados;
        return $this;
    }
    public function headings(): array
    {
        return [
            [
                'id',
                'nombre',
                'Fecha_inicio',
                'fecha_creacion',
                'fecha_termino',
                'descripcion',
                'Estado',
                'Creador',
                'Usuario Asignado',
                'estado'
            ]
        ];
    }


    use Exportable;
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        if ($this->usuarios > 0) {
            return   Tarea::query()
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users', 'tareas.idCreador', '=', 'users.id')
                ->join('users as asignado', 'tareas.idUsuario', '=', 'asignado.id')
                ->select('tareas.id', 'nombre', 'Fecha_inicio', 'fecha_creacion', 'fecha_termino', 'descripcion', 'idEstado', 'idCreador', 'estados.name as idEstado', 'users.name as idCreador', 'asignado.name as idUsuario')
                ->selectRaw('CASE WHEN tareas.estado = 1 THEN "Activo" ELSE "Inactivo" END AS estado')
                ->where('asignado.name', '=', $this->usuarios)
                ->where('estados.name', '=', $this->estados);
        } else {

            return   Tarea::query()
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users', 'tareas.idCreador', '=', 'users.id')
                ->join('users as asignado', 'tareas.idUsuario', '=', 'asignado.id')
                ->select('tareas.id', 'nombre', 'Fecha_inicio', 'fecha_creacion', 'fecha_termino', 'descripcion', 'idEstado', 'idCreador', 'estados.name as idEstado', 'users.name as idCreador', 'asignado.name as idUsuario')
                ->selectRaw('CASE WHEN tareas.estado = 1 THEN "Activo" ELSE "Inactivo" END AS estado');
        }
    }
    
    
    
    public function styles(Worksheet $sheet)
    {
        // Define los estilos de la hoja de cálculo aquí
        // Por ejemplo, para dar formato a la primera fila (encabezados) hasta la columna D (columna 4):
        $sheet->getStyle('$A$1:$J$1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'ADD8E6'],
            ],
        ]);
    }
}
