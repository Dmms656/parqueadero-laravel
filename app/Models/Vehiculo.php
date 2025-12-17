<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = [
        'placa',
        'tipo',
        'propietario',
        'observaciones',
        'estado',
        'hora_salida'
    ];


    // Indica a Laravel que hora_salida es una fecha
    protected $casts = [
        'hora_salida' => 'datetime',
    ];

    // Solo vehículos dentro del parqueadero
    public static function activos()
    {
        return self::where('estado', 'ABIERTO')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Marcar salida (borrado lógico)
    public function marcarSalida()
    {
        $this->update([
            'estado' => 'CERRADO',
            'hora_salida' => now()
        ]);
    }
}
