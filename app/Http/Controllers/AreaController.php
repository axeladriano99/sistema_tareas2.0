<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
/**
 * Class AreaController
 * @package App\Http\Controllers
 */
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all()->where('estado','=',1);
        $id = Auth::id();
        $userr= User::find($id);
        if($userr->rol==1)
        {
            return view('area.index', compact('areas'));
        }
        elseif($userr->rol==2)
        {
            return redirect()->route('home.index');
        }
        else{
            return view('area.index', compact('areas'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = new Area();
        $areas = Area::all()->where('estado','=',1);
        return view('area.create', compact('area','areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Area::validationRules(), Area::validationMessages());
        request()->validate(Area::$rules);

        $area = Area::create($request->all());

        return redirect()->route('areas.create')
            ->with('exito', 'Area creado correctamemte.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::find($id);

        return view('area.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find($id);

        return view('area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        request()->validate(Area::$rules);

        $area->update($request->all());

        return redirect()->route('areas.create')
            ->with('exito', 'Area actualizado correctamente');
    }
    public function listAreas(){
        $area = Area::all()->where('estado','=',1);
        return datatables()->collection($area)->toJson();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $area= Area::find($id);
        $area->estado=2;
        $area->save();
        return redirect()->route('areas.create')
            ->with('exito', 'Area eliminado correctamente');

        /*$area = Area::find($id)->delete();
        return redirect()->route('areas.index')
            ->with('exito', 'Area eliminado correctamente');
        */
    }
}
