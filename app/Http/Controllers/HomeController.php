<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Tarea;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estado;
use App\Exports\TareasExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    use Exportable;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function administrador(){
        $areas = Area::all();
            $userId = Auth::id();
            $area_admi =DB::table('users')
            ->select('idArea')
            ->where('id','=',$userId)
            ->first();
            $personal_sistemas= DB::table('users')
            ->select('users.*')
            ->where('idArea','=',$area_admi->idArea)
            ->get();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
                ->where('tareas.estado',1)
                ->get();
            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->get();
            return view('administrador',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','personal_sistemas','areas','personaladm'));
    }
    public function index(){
        $id= Auth::id();
        $user= User::find($id);
        if($user->rol ==1)
        {
            return redirect()->route('homeAdministrador');
        }
        elseif($user->rol==2)
        {
            $areas = Area::all();
            $userId = Auth::id();
            $area_admi =DB::table('users')
            ->select('idArea')
            ->where('id','=',$userId)
            ->first();
            $personal_sistemas= DB::table('users')
            ->select('users.*')
            ->where('idArea','=',$area_admi->idArea)
            ->get();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
               
                ->orderBy('tareas.created_at', 'asc')
                ->get();

              



            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
            ->latest('tareas.created_at')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
           


            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->leftJoin('editables', 'tareas.id','=','editables.idTarea')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','editables.campos_editado','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->orderBy('tareas.fecha_creacion','desc')
            ->get();
          
            return view('home',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','personal_sistemas','areas','personaladm'));
        }
        else{
            $areas = Area::all();
            $userId = Auth::id();
            $area_admi =DB::table('users')
            ->select('idArea')
            ->where('id','=',$userId)
            ->first();
            $personal_sistemas= DB::table('users')
            ->select('users.*')
            ->where('idArea','=',$area_admi->idArea)
            ->get();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
                ->where('tareas.estado',1)
                ->get();
            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->get();
            return view('admi',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','personal_sistemas','areas','personaladm'));
        }
    }
       /* $areas =  Area::pluck('nombre', 'id');
        
    */
    public function admin(){
        $userss = Auth::id();
        
        $Rol= User::find($userss);
        if($Rol->rol ==3)
        {
            $areas = Area::all();
            $userId = Auth::id();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
                ->where('tareas.estado',1)
                ->get();
            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->get();
            return view('admi',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','areas'));
            
        }
        else
        {
            $areas = Area::all();
            $userId = Auth::id();
            $area_admi =DB::table('users')
            ->select('idArea')
            ->where('id','=',$userId)
            ->first();
            $personal_sistemas= DB::table('users')
            ->select('users.*')
            ->where('idArea','=',$area_admi->idArea)
            ->get();
            $tareas_iniciadas = DB::table('tareas')
                ->join('estados', 'tareas.idEstado', '=', 'estados.id')
                ->join('users','tareas.idCreador','=','users.id')
                ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
                ->where('tareas.idUsuario', $userId)
                ->where('tareas.idEstado', 2)
                ->where('tareas.estado',1)
                ->get();
            $tareas_sin_iniciar =  DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->where('tareas.estado',1)
            ->get();
            $personaladm = DB::Table('users')->select('users.*')->where('idArea',1)->get();
            $tareas_terminadas = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->join('users','tareas.idCreador','=','users.id')
            ->select('tareas.*','estados.name as estados_id','users.name as idCreador')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 3)
            ->where('tareas.estado',1)
            ->get();
            return view('home',compact('tareas_iniciadas','tareas_sin_iniciar','tareas_terminadas','personal_sistemas','areas','personaladm'));
            
        }
    }
    public function create(){
        $tarea = new Tarea();
        $estado = Estado::pluck('name', 'id');
        $usuarios = User::pluck('name', 'id');
        return view('homeCreateAdmi', compact('tarea', 'estado', 'usuarios'));
    }
    public function store(Request $request)
    {
        
        $id=Auth::id();
        $user = DB::table('users')->select('users.*')->where('id','=',$id)->first();
       
        if($user->rol == 1)
        {
            $request['fecha_creacion'] = date('Y-m-d H:i:s');
            $request['idCreador'] = Auth::id();
           $request['idUsuario'] = Auth::id();
            //dd($request);
            //$tarea->update($request->all());
            $tarea = Tarea::create($request->all());
            return redirect()->route('home.index')
                ->with('success', 'Tarea creada correctamente.');
        }
        elseif ($user->rol == 2) {

            $estado = Estado::pluck('name', 'id');
            // Primero, valida el formulario
            $request->validate(Tarea::validacionTecnico(), Tarea::validationMessagesTenico());
        
            // A continuación, realiza el procesamiento
            $fecha_inicio_hora = $request->input('Fecha_inicio') . ' ' . $request->input('hora_inicio');
            $fecha_termino_hora = $request->input('fecha_termino') . ' ' . $request->input('hora_termino');
        
            // Verifica si la fecha de inicio es menor o igual a la fecha de termino
            if ($fecha_inicio_hora <= $fecha_termino_hora) {
                $request['Fecha_inicio'] = $fecha_inicio_hora;
                $request['fecha_termino']=$fecha_termino_hora;
                $request['idCreador'] = Auth::id();
                $request['fecha_creacion'] = date('Y-m-d H:i:s');
                $request['idUsuario'] = Auth::id();
                $tarea = Tarea::create($request->all());
              
                return redirect()->route('home.index')
                    ->with('success', 'Tarea creada correctamente.');
            }
            else{
                $error= "La fecha de inicio tiene que se menor a la fecha de termino";
                return view('homeCreate',compact('error','estado'));
            }
        }
        
        else{

        }
        $request['fecha_creacion'] = date('Y-m-d H:i:s');
        $request['idCreador'] = Auth::id();
       
        //dd($request);
        //$tarea->update($request->all());
        $tarea = Tarea::create($request->all());
        return redirect()->route('home.index')
            ->with('success', 'Tarea creada correctamente.');
    }
    public function edit($id){
        $tarea = Tarea::find($id);
        $usuarios = User::pluck('name','id');
        $estado = Estado::pluck('name','id');
        $fecha_hora = explode(' ', $tarea->Fecha_inicio);
    $tarea->Fecha_inicio = $fecha_hora[0]; // Establecer la fecha
    $tarea->hora_inicio = $fecha_hora[1];
    dd("$tarea->hora_inicio");
        return view('edit', compact('tarea','estado','usuarios'));
    }
    public function actualizar(Request $request, Tarea $tarea)
    {
        request()->validate(Tarea::$rules);
        $tarea->update($request->all());
        return redirect()->route('home.index')->with('success', 'Tarea actualizada correctamente');
    }
    // este metodo edit edita la ta tarea y lo pasa a estado de sin iniciar a iniciado y terminado,

       
        /*
        $userId = Auth::id();

        $tareas_sin_iniciar = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->select('tareas.*','estados.name as estados_id')
            ->where('tareas.idUsuario', $userId)
            ->where('tareas.idEstado', 1)
            ->get();

        
        $tareas_iniciadas = DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->select('tareas.*','estados.name as estados_id')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 2)
        ->get();

        $tareas_terminadas = DB::table('tareas')
        ->join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->select('tareas.*','estados.name as estados_id')
        ->where('tareas.idUsuario', $userId)
        ->where('tareas.idEstado', 3)
        ->get();
        return view('home',compact('tareas_sin_iniciar','tareas_iniciadas','tareas_terminadas'));*/
    

    public function update($id){
       $idEstadoCambiado =  Tarea::find($id);
        if($idEstadoCambiado->idEstado==1){
            $idEstadoCambiado->idEstado=2;
            
        }
        elseif($idEstadoCambiado->idEstado==2)
            $idEstadoCambiado->idEstado=3;
            
               
        $idEstadoCambiado->save();
        return redirect('home');
    }

    public function export(){
        $estado = Estado::all();
        $usuarios = User::all();
        $tareas = Tarea::join('estados', 'tareas.idEstado', '=', 'estados.id')
        ->select("tareas.*", 'estados.name as idEstado')
        ->where('tareas.estado', '=', 1)
        ->get();
        return view('export',compact('estado','usuarios','tareas'));
    }
    public function generar(Request $request ){
       $estados=$request->input('estado');
        $usuarios=$request->input('area');
        if($estados == "0")
        {
            return (new TareasExport)->foryear($usuarios)->download('tareas.xlsx');
        }
        elseif($estados == "sin iniciar" || $estados == "iniciado" ||$estados == "terminado" )
        {
            return (new TareasExport)->todos($usuarios,$estados)->download('tareas.xlsx');
        }
        elseif($estados=="9")
        {
            return (new TareasExport)->foryear($usuarios)->download('tareas.xlsx'); ;
        }
         
       
    }
}