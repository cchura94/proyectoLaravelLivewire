<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Nota;
use App\Models\Pedido;

class Notas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $detalle, $estado, $observaciones, $pedido_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.notas.view', [
            'notas' => Nota::latest()
						->orWhere('detalle', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
						->orWhere('observaciones', 'LIKE', $keyWord)
						->orWhere('pedido_id', 'LIKE', $keyWord)
						->paginate(10),
            'pedidos' => $this->listarPedidos(),
        ]);
    }

    public function listarPedidos()
    {
        return Pedido::get();
    }

    public function pedidoSelect($id_pedido)
    {
        $this->pedido_id = $id_pedido;
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->detalle = null;
		$this->estado = null;
		$this->observaciones = null;
		$this->pedido_id = null;
    }

    public function store()
    {
        $this->validate([
		'detalle' => 'required',
		'estado' => 'required',
		'observaciones' => 'required',
		'pedido_id' => 'required',
        ]);

        Nota::create([ 
			'detalle' => $this-> detalle,
			'estado' => $this-> estado,
			'observaciones' => $this-> observaciones,
			'pedido_id' => $this-> pedido_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Nota Successfully created.');
    }

    public function edit($id)
    {
        $record = Nota::findOrFail($id);
        $this->selected_id = $id; 
		$this->detalle = $record-> detalle;
		$this->estado = $record-> estado;
		$this->observaciones = $record-> observaciones;
		$this->pedido_id = $record-> pedido_id;
    }

    public function update()
    {
        $this->validate([
		'detalle' => 'required',
		'estado' => 'required',
		'observaciones' => 'required',
		'pedido_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Nota::find($this->selected_id);
            $record->update([ 
			'detalle' => $this-> detalle,
			'estado' => $this-> estado,
			'observaciones' => $this-> observaciones,
			'pedido_id' => $this-> pedido_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Nota Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Nota::where('id', $id)->delete();
        }
    }
}