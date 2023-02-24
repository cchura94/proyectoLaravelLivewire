<?php

namespace App\Http\Livewire\Admin\Pedido;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoPedidoComponent extends Component
{
    use WithPagination;

    protected $listeners = ['limpiar' => 'resetInput'];

    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $carrito = [];
    public $cliente_selecionado;
    public $buscar_cliente = "";

    public function mount()
    {
        
    }

    public function resetInput()
    {
        $this->search = '';
        $this->carrito = [];
        $this->cliente_selecionado = null;
        $this->buscar_cliente = '';
        
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

    public function seleccionarClie($clie_id)
    {
        $this->cliente_selecionado = Cliente::find($clie_id);
    }

    public function guardarPedido()
    {
        if(isset($this->cliente_selecionado->id)){
            DB::beginTransaction();

            try {
                $pedido = new Pedido();
                $pedido->fecha = date('Y-m-d H:i:s');
                $pedido->cod_ped = Pedido::generateCode();
                $pedido->estado = 1; // EN PROCESO

                $pedido->cliente_id = $this->cliente_selecionado->id;
                $pedido->save();

                foreach ($this->carrito as $carr) {
                    $pedido->productos()->attach($carr['id'], ["cantidad" => $carr['cantidad']]);
                }

                $pedido->estado = 2;
                $pedido->update();

                DB::commit();

                $pedido->cliente;

                $this->emit('limpiar');

                $this->emit('guardado', $pedido);
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
            }

            
        }else{

        }        
    }


    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%'.$this->search.'%')->paginate(5);

        $clientes = Cliente::where('ci_nit', 'like', '%'.$this->buscar_cliente.'%')->paginate(2);

        return view('livewire.admin.pedido.nuevo-pedido-component', compact("productos", "clientes"));
    }
}
