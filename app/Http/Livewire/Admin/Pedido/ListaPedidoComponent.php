<?php

namespace App\Http\Livewire\Admin\Pedido;

use App\Models\Pedido;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class ListaPedidoComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $pedido;
    public $filtro_fecha="";

     protected $listeners = ['ff' => "fitroFechaPedido"];

     public function fitroFechaPedido($fecha)
     {
        $date = Carbon::parse($fecha);
        

        $this->filtro_fecha = $date->format('Y-m-d');
     }

      public function mostrarPedido($id)
    {
        $this->pedido = Pedido::find($id);
        
    }


    public function render()
    {
        
        $pedidos = Pedido::where('fecha', 'like', '%'.$this->filtro_fecha.'%')->paginate(5);
        return view('livewire.admin.pedido.lista-pedido-component', compact('pedidos'));
    }
}
