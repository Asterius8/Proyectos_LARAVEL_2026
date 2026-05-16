@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center">SERVICIOS ESCOLARES</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Alumnos</a></li>
            <li class="breadcrumb-item active">Modificar</li>
        </ol>
    </nav>

    <div class="card p-4">
        <h2>Modificar Datos</h2>

        {{-- Errores de validación --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('alumnos.update', $alumno->id) }}">
            @csrf
            @method('PUT')  {{-- necesario para UPDATE en Laravel --}}

            <div class="mb-3">
                <label class="form-label fw-bold">Número de Control</label>
                <input type="text" name="Num_Control" class="form-control"
                       value="{{ old('Num_Control', $alumno->Num_Control) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <input type="text" name="Nombre" class="form-control"
                       value="{{ old('Nombre', $alumno->Nombre) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Primer Apellido</label>
                <input type="text" name="Primer_Ap" class="form-control"
                       value="{{ old('Primer_Ap', $alumno->Primer_Ap) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Segundo Apellido</label>
                <input type="text" name="Segundo_Ap" class="form-control"
                       value="{{ old('Segundo_Ap', $alumno->Segundo_Ap) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Fecha de Nacimiento</label>
                <input type="date" name="Fecha_Nac" class="form-control"
                       value="{{ old('Fecha_Nac', $alumno->Fecha_Nac) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Semestre</label>
                <input type="number" name="Semestre" class="form-control"
                       value="{{ old('Semestre', $alumno->Semestre) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Carrera</label>
                <input type="text" name="Carrera" class="form-control"
                       value="{{ old('Carrera', $alumno->Carrera) }}">
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-warning">Cancelar</a>
        </form>
    </div>
</div>
@endsection