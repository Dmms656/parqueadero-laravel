@extends('layouts.app')

@section('titulo', 'Histórico de vehículos')

@section('content')
    <h1 class="mb-4">Histórico de vehículos</h1>

    <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary mb-3">
        Volver
    </a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Propietario</th>
                <th>Ingreso</th>
                <th>Salida</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->placa }}</td>
                    <td>{{ $vehiculo->tipo }}</td>
                    <td>{{ $vehiculo->propietario ?? '-' }}</td>
                    <td>{{ optional($vehiculo->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ optional($vehiculo->hora_salida)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No hay registros históricos
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
