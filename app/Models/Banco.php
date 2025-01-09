<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $fillable = ['nombre'];

    /**
     * Relación uno a muchos con comprobantes.
     */
    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class);
    } 
}
