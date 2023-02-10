<?php

namespace App\Http\Livewire\Admin\Producto;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ProductoComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $categoria_id = '';
    public $rows = 2;


    public function render()
    {
        $categorias = Categoria::get();

        if($this->categoria_id != ''){
            // $productos = Categoria::find($this->categoria_id)->productos;
            $productos = Producto::where('categoria_id', $this->categoria_id)
                                    ->where('nombre', 'like', '%'.$this->search.'%')
                                    ->paginate($this->rows);

        }else{

            $productos = Producto::where('nombre', 'like', '%'.$this->search.'%')
                                    ->orWhere('precio', 'like', '%'.$this->search.'%')
                                    ->orWhere('codigo', 'like', '%'.$this->search.'%')
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
