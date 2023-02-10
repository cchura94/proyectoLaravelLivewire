@section("titulo", "Gestión Productos")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <input wire:model="search" type="text" placeholder="Buscar productos..." class="form-control"/>
                        <!--<input wire:model="searchPrecio" type="text" placeholder="Buscar productos..."/>-->

                    </div>
                    <div class="col-md-4">
                        <select id="" wire:model="search" class="form-control">
                            <option value="TECLADO">TECLADO</option>
                            <option value="MONITOR">MONITOR</option>
                            <option value="ESCRITORIO">ESCRITORIO</option>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <select id="" wire:model="categoria_id" class="form-control">
                            <option value="">Seleccionar Categoria</option>
                            @foreach ($categorias as $cat)
                            <option value="{{$cat->id}}">{{ $cat->nombre }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <select wire:model="rows">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>COD</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>IMG</th>
                            <th>CATEGORIA</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->codigo }}</td>
                            <td>{{ $prod->nombre }}</td>
                            <td>{{ $prod->precio }}</td>
                            <td>{{ $prod->cantidad }}</td>
                            <td>{{ $prod->imagen }}</td>
                            <td>{{ $prod->categoria->nombre }}</td>
                            <td></td>
                        </tr>                            
                        @endforeach
                    </tbody>

                </table>
                {{ $productos->links() }}

            </div>
        </div>
    </div>

</div>
