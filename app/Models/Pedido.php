<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot("cantidad")->withTimestamps();
    }

    public static function generateCode()
    {
        $prefix = 'COD_';
        $latest = self::latest('id')->first();
        if ($latest) {
            return $prefix . sprintf("%04d", $latest->id + 1);
        } else {
            return $prefix . '0001';
        }
    }
}
