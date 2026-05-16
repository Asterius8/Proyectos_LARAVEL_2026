@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center">SERVICIOS ESCOLARES</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Alumnos</a></li>
            <li class="breadcrumb-item active">Detalle</li>
        </ol>
    </nav>

    {{-- Mensaje de éxito --}}
    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    <div class="card p-4">
        <h2>Información del Alumno</h2>
        <p><strong>Número de Control:</strong> {{ $alumno->Num_Control }}</p>
        <p><strong>Nombre:</strong> {{ $alumno->Nombre }}</p>
        <p><strong>Primer Apellido:</strong> {{ $alumno->Primer_Ap }}</p>
        <p><strong>Segundo Apellido:</strong> {{ $alumno->Segundo_Ap }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $alumno->Fecha_Nac }}</p>
        <p><strong>Semestre:</strong> {{ $alumno->Semestre }}</p>
        <p><strong>Carrera:</strong> {{ $alumno->Carrera }}</p>

        <a href="{{ route('alumnos.index') }}" class="btn btn-warning mt-3">Volver</a>
    </div>
</div>
@endsection