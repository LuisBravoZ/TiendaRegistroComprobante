<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $fillable = [
        'numero_comprobante',
        'banco',
        'monto',
        'fecha_transferencia',
        'tipo_transaccion',
    ];
}
