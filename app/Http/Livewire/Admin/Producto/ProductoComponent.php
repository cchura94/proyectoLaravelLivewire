<?php

namespace App\Http\Livewire\Admin\Producto;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProductoComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $nombreComponent = "Producto";
    public $id_seleccionado = 0;

    public $search = '';
    public $categoria_filter = '';
    public $rows = 2;
    
    public $nombre;
    public $precio;
    public $codigo;
    public $cantidad;
    public $descripcion;
    public $categoria_id;
    public $imagen;

    protected $rules = [
        "nombre" => "required|min:3|max:200",
        "categoria_id" => "required",
        "cantidad" => "required",
        'imagen' => 'image|max:10000',
    ];



    public function store()
    {
        $this->validate();

        $prod = new Producto();
        $prod->nombre = $this->nombre; 
        $prod->codigo = Producto::generateCode(); 
        $prod->precio = $this->precio; 
        $prod->cantidad = $this->cantidad; 
        $prod->descripcion = $this->descripcion; 
        $prod->categoria_id = $this->categoria_id;
        $prod->save();

        $this->imagen->store('imagenes');
        
    }

    public function edit($id)
    {
        $this->id_seleccionado = $id;

        $producto = Producto::find($id);
        
        $this->nombre = $producto->nombre;
        $this->precio = $producto->precio;
        $this->cantidad = $producto->cantidad;
        $this->descripcion = $producto->descripcion;
        $this->categoria_id = $producto->categoria_id;
    }

    public function update()
    {
        $this->validate([
            "nombre" => "required|min:3|max:200",
            "categoria_id" => "required",
            "cantidad" => "required",
            'imagen' => 'image|max:10000'
        ]);
    
            if ($this->id_seleccionado>0) {
                $prod = Producto::find($this->id_seleccionado);
                $prod->nombre = $this->nombre;
                $prod->precio = $this->precio;
                $prod->cantidad = $this->cantidad;
                $prod->categoria_id = $this->categoria_id;
                $prod->descripcion = $this->descripcion;
                $prod->update();
    
                $this->resetInput();
                // $this->dispatchBrowserEvent('closeModal');
                // session()->flash('message', 'Cliente Successfully updated.');
            }
    }

    public function resetInput()
    {		
        $this->id_seleccionado = 0;

		$this->nombre = null;
		$this->cantidad = null;
		$this->precio = null;
		$this->categoria_id = null;
        $this->descripcion = null;
        $this->imagen = null;
    }

    public function render()
    {
        $categorias = Categoria::get();

        if($this->categoria_filter != ''){
            // $productos = Categoria::find($this->categoria_id)->productos;
            $productos = Producto::where('categoria_id', $this->categoria_filter)
                                    ->where('nombre', 'like', '%'.$this->search.'%')
                                    ->orderBy('id', 'desc')
                                    ->paginate($this->rows);

        }else{

            $productos = Producto::where('nombre', 'like', '%'.$this->search.'%')
                                    ->orWhere('precio', 'like', '%'.$this->search.'%')
                                    ->orWhere('codigo', 'like', '%'.$this->search.'%')
                                    ->orderBy('id', 'desc')
                                    ->paginate($this->rows);
        }

        /*
        $productos = Producto::where('nombre', 'like', '%'.$this->searchNombre.'%')
                                ->where('precio', 'like', '%'.$this->searchPrecio.'%')
                                ->paginate(10);
*/
        return view('livewire.admin.producto.producto-component', compact('productos', 'categorias'))
                ->extends('layouts.theme.admin')
                ->section('contenedor');
    }
}
