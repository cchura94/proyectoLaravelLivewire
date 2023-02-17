<?php

namespace App\Http\Livewire\Admin\Pedido;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoPedidoComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $carrito = [];

    public function mount()
    {
        
    }

    public function addCarrito($prod)
    {
        $p = [
            "id" => $prod["id"],
            "nombre" => $prod["nombre"],
            "precio" => $prod["precio"],
            "cantidad" => 1
        ];
        
        array_push($this->carrito, $p);
        session()->flash('message', 'Producto Agregado.');
        
    }

    public function quitarCarrito($id_c)
    {
        $pos = 0;
        $sw = 0;
        foreach ($this->carrito as $carr) {
            
            if($id_c == $carr['id'] && $sw==0){
                $sw=1;
            }
            if($sw!=1){
                $pos++;
            }
        }

        array_splice($this->carrito, $pos, 1);

        session()->flash('message', 'Producto quitado.');
    }
/*
$clave = array_search($id_c, array_column($this->carrito, 'id'));
if ($clave !== false) {
    unset($this->carrito[$clave]);
}*/
        
    


    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%'.$this->search.'%')->paginate(5);

        return view('livewire.admin.pedido.nuevo-pedido-component', compact("productos"));
    }
}
