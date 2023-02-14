<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class); 
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)->withPivot(["cantidad"])->withTimestamps();
    }

    /*
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $prefix = 'COD_';
            $latest = self::latest('id')->first();
            if ($latest) {
                $model->codigo = $prefix . sprintf("%04d", $latest->id + 1);
            } else {
                $model->codigo = $prefix . '0001';
            }
        });
    }
    */

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
