<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'notas';

    protected $fillable = ['detalle','estado','observaciones','pedido_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'pedido_id');
    }
    
}
