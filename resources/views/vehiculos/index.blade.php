@extends('layouts.app')

@section('titulo', 'Vehículos en el parqueadero')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vehículos dentro</h1>

        <div>
            <a href="{{ route('vehiculos.historial') }}"
               class="btn btn-outline-secondary me-2">
                Histórico
            </a>

            <a href="{{ route('vehiculos.create') }}"
               class="btn btn-primary">
                Nuevo ingreso
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Propietario</th>
                <th>Observaciones</th>
                <th>Hora de ingreso</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->placa }}</td>
                    <td>{{ $vehiculo->tipo }}</td>
                    <td>{{ $vehiculo->propietario ?? '-' }}</td>

                    {{-- Observaciones: si no hay, muestra "-" --}}
                    <td>
                        {{ $vehiculo->observaciones ?? '-' }}
                    </td>

                    <td>
                        {{ optional($vehiculo->created_at)->format('d/m/Y H:i') ?? '-' }}
                    </td>

                    <td>
                        <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                           class="btn btn-sm btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Marcar este vehículo como salido?')">
                                Salida
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay vehículos dentro del parqueadero
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
