<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaComponent extends Component
{
    public $nombreComponent = "Categoria";
    public $id_seleccionado = 0;

    public $id_cat = null;
    public $nombre;
    public $detalle;

    protected $rules = [
        "nombre" => "required|min:3|max:50|unique:categorias,nombre"
    ];

    public function updated($nombre)
    {
        $this->validateOnly($nombre);
    }

    public function store()
    {
        

        /*Categoria::create([
            "nombre" => $this->nombre,
            "detalle" => $this->detalle
        ]);*/
        if($this->id_cat != null){

            $cat = Categoria::find($this->id_cat);
            $cat->nombre = $this->nombre;
            $cat->detalle = $this->detalle;
            $cat->update();

            $this->id_cat = null;

        }else{
            $this->validate();
            
            $cat = new Categoria();
            $cat->nombre = $this->nombre;
            $cat->detalle = $this->detalle;
            $cat->save();

        }
        $this->nombre = "";
        $this->detalle = "";

        
    }

    public function update()
    {

        $cat = Categoria::find($this->id_cat);
            $cat->nombre = $this->nombre;
            $cat->detalle = $this->detalle;
            $cat->update();

            $this->id_cat = null;
            $this->id_seleccionado = 0;
        
    }

    public function editarCategoria($id)
    {
        $this->id_seleccionado = $id;
        $this->id_cat = $id;
        $cate = Categoria::find($id);

        $this->nombre = $cate->nombre;
        $this->detalle = $cate->detalle;
    }

    public function resetInput()
    {
        $this->id_seleccionado = 0;
        $this->nombre = '';
        $this->detalle = '';
        
    }

    public function render()
    {
        $categorias = Categoria::orderBy('id', 'desc')->get();

        return view('livewire.categoria-component', ["categorias" => $categorias])
                // ->layout('layouts.theme.admin');
                ->extends('layouts.theme.admin')
                ->section('contenedor');
                // ->slot("main");
    }
}
