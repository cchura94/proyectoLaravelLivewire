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



    public function guardarProducto()
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
