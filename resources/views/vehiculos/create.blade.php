@extends('layouts.app')

@section('titulo', 'Nuevo Vehículo')

@section('content')
    <h1 class="mb-4">Registrar Vehículo</h1>

    <form action="{{ route('vehiculos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Placa *</label>
            <input type="text"
                   name="placa"
                   class="form-control @error('placa') is-invalid @enderror"
                   value="{{ old('placa') }}"
                   required>

            @error('placa')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo *</label>
            <select name="tipo"
                    class="form-select @error('tipo') is-invalid @enderror"
                    required>
                <option value="">Seleccione...</option>
                <option value="Automóvil" {{ old('tipo') == 'Automóvil' ? 'selected' : '' }}>Automóvil</option>
                <option value="Motocicleta" {{ old('tipo') == 'Motocicleta' ? 'selected' : '' }}>Motocicleta</option>
                <option value="Camioneta" {{ old('tipo') == 'Camioneta' ? 'selected' : '' }}>Camioneta</option>
            </select>

            @error('tipo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Propietario</label>
            <input type="text"
                   name="propietario"
                   class="form-control"
                   value="{{ old('propietario') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones"
                      class="form-control"
                      rows="3">{{ old('observaciones') }}</textarea>
        </div>

        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </form>
@endsection
