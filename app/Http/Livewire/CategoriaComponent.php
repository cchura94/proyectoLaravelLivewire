<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaComponent extends Component
{
    public $nombre;
    public $detalle;

    protected $rules = [
        "nombre" => "required|min:3|max:50|unique:categorias"
    ];

    public function updated($nombre)
    {
        $this->validateOnly($nombre);
    }

    public function guardarCategoria()
    {
        $this->validate();

        /*Categoria::create([
            "nombre" => $this->nombre,
            "detalle" => $this->detalle
        ]);*/
        $cat = new Categoria();
        $cat->nombre = $this->nombre;
        $cat->detalle = $this->detalle;
        $cat->save();

        $this->nombre = "";
        $this->detalle = "";
        
    }

    public function editarCategoria($categoria)
    {
        $this->nombre = $categoria["nombre"];
        $this->detalle = $categoria["detalle"];
    }

    public function render()
    {
        $categorias = Categoria::all();

        return view('livewire.categoria-component', ["categorias" => $categorias])
                // ->layout('layouts.theme.admin');
                ->extends('layouts.theme.admin')
                ->section('contenedor');
                // ->slot("main");
    }
}
