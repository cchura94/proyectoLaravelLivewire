<?php

namespace App\Http\Livewire\Admin\Pedido;

use App\Models\Pedido;
use Livewire\Component;

class ShowModalComponent extends Component
{
    public $pedido;

    public function mostrarPedido($id)
    {
        $this->pedido = Pedido::find($id);
        
    }

    public function render()
    {
        return view('livewire.admin.pedido.show-modal-component');
    }
}
