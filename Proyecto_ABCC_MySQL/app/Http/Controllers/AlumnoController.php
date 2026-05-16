<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlumnoController extends Controller
{
    //----------------------------------------- Altas -----------------------------------------
    public function create(){
        return view('insertar');
    }

    public function store(Request $request){
        //validaciones

        Alumno::create($request->post());

        //mensajes de exito
        Session::flash('message', 'Agregado Correctamente');
        //mensajes de exito
        return redirect()->route('alumnos.index')->with('exito', 'Agregado Correctamente');
    }

    //----------------------------------------- Bajas -----------------------------------------
    public function destroy(Alumno $alumno){
        $alumno->delete();
        Session::flash('message', 'ELIMINANDO Correctamente!!!');
        return redirect()->route('alumnos.index');
    }

    //----------------------------------------- Cambios -----------------------------------------
    public function edit(Alumno $alumno)
    {
        return view('editar', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $alumno->Num_Control = $request->input('Num_Control');
        $alumno->Nombre      = $request->input('Nombre');
        $alumno->Primer_Ap   = $request->input('Primer_Ap');
        $alumno->Segundo_Ap  = $request->input('Segundo_Ap');
        $alumno->Fecha_Nac   = $request->input('Fecha_Nac');
        $alumno->Semestre    = $request->input('Semestre');
        $alumno->Carrera     = $request->input('Carrera');

        $alumno->save();

        Session::flash('message', 'Modificado Correctamente!!!');
        return redirect()->route('alumnos.index');
    }

    //----------------------------------------- Consultas -----------------------------------------
    public function index(Request $request)
    {
        $filtro = $request->input('filtro', '');

        $alumnos = Alumno::when($filtro, function ($query) use ($filtro) {
                        $query->where('Nombre', 'like', "%{$filtro}%")
                              ->orWhere('Primer_Ap', 'like', "%{$filtro}%")
                              ->orWhere('Num_Control', 'like', "%{$filtro}%");
                    })
                    ->latest()
                    ->paginate(3)
                    ->withQueryString();

        return view('index', compact('alumnos', 'filtro'));
    }

    public function show(Alumno $alumno)
    {
        return view('detalle', compact('alumno'));
    }
}