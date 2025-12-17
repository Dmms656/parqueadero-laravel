<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    // Muestra solo los vehículos que están dentro (estado ABIERTO)
    public function index()
    {
        $vehiculos = Vehiculo::activos();
        return view('vehiculos.index', compact('vehiculos'));
    }

    // Muestra el formulario para registrar un nuevo vehículo
    public function create()
    {
        return view('vehiculos.create');
    }

    // Registra la entrada de un vehículo
    public function store(Request $request)
    {
        // Validación básica
        // La placa no puede repetirse si ya hay un vehículo ABIERTO
        $request->validate([
            'placa' => [
                'required',
                'max:10',
                Rule::unique('vehiculos')->where(function ($query) {
                    return $query->where('estado', 'ABIERTO');
                }),
            ],
            'tipo' => 'required',
        ]);

        // Se crea el vehículo como ABIERTO (ingresó al parqueadero)
        Vehiculo::create([
            'placa'         => $request->placa,
            'tipo'          => $request->tipo,
            'propietario'   => $request->propietario,
            'observaciones' => $request->observaciones,
            'estado'        => 'ABIERTO',
        ]);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo registrado. Ingreso correcto.');
    }

    // Muestra el formulario para editar un vehículo
    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', compact('vehiculo'));
    }

    // Actualiza los datos del vehículo
    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Permite editar la placa sin chocar con el mismo registro
        $request->validate([
            'placa' => [
                'required',
                'max:10',
                Rule::unique('vehiculos')
                    ->ignore($vehiculo->id)
                    ->where(function ($query) {
                        return $query->where('estado', 'ABIERTO');
                    }),
            ],
            'tipo' => 'required',
        ]);

        // Se actualizan solo los datos editables
        $vehiculo->update([
            'placa'         => $request->placa,
            'tipo'          => $request->tipo,
            'propietario'   => $request->propietario,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    // Marca la salida del vehículo (borrado lógico)
    public function destroy(Vehiculo $vehiculo)
    {
        // No se elimina el registro, solo se marca como CERRADO
        $vehiculo->marcarSalida();

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo marcado como salido.');
    }

    // Muestra el historial de vehículos que ya salieron
    public function historial()
    {
        $vehiculos = Vehiculo::where('estado', 'CERRADO')
            ->orderBy('hora_salida', 'desc')
            ->get();

        return view('vehiculos.historial', compact('vehiculos'));
    }

}
