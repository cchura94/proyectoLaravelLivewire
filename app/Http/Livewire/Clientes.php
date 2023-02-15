<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_completo, $ci_nit, $telefono, $direccion;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.clientes.view', [
            'clientes' => Cliente::latest()
						->orWhere('nombre_completo', 'LIKE', $keyWord)
						->orWhere('ci_nit', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre_completo = null;
		$this->ci_nit = null;
		$this->telefono = null;
		$this->direccion = null;
    }

    public function store()
    {
        $this->validate([
		'nombre_completo' => 'required',
        ]);

        Cliente::create([ 
			'nombre_completo' => $this-> nombre_completo,
			'ci_nit' => $this-> ci_nit,
			'telefono' => $this-> telefono,
			'direccion' => $this-> direccion
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Cliente Successfully created.');
    }

    public function edit($id)
    {
        $record = Cliente::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre_completo = $record-> nombre_completo;
		$this->ci_nit = $record-> ci_nit;
		$this->telefono = $record-> telefono;
		$this->direccion = $record-> direccion;
    }

    public function update()
    {
        $this->validate([
		'nombre_completo' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'nombre_completo' => $this-> nombre_completo,
			'ci_nit' => $this-> ci_nit,
			'telefono' => $this-> telefono,
			'direccion' => $this-> direccion
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Cliente Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Cliente::where('id', $id)->delete();
        }
    }
}