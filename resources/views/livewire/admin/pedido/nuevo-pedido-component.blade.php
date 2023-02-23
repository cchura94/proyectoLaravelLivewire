<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Datos de Pedido</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Lista de Productos</h5>

                    <input type="text" wire:model.debounce.500ms="search" class="form-control">
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                                <th>CANTIDAD</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $prod)
                            <tr>
                                <td>{{ $prod->id }}</td>
                                <td>{{ $prod->nombre }}</td>
                                <td>{{ $prod->precio }}</td>
                                <td>{{ $prod->cantidad }}</td>
                                <td>
                                    <button class="btn btn-info" wire:click="addCarrito({{ $prod }})"><i class="fa fa-save"></i></button>
                                </td>
                            </tr>                                
                            @endforeach
                        </tbody>

                    </table>
                    {{ $productos->links() }}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Carrito</h5>
                            <div  wire:loading class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
          </div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>P.U.</th>
                                            <th>C</th>
                                            <th>S.T</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carrito as $c)
                                        <tr>
                                            <td>{{ $c["nombre"] }}</td>
                                            <td>{{ $c["precio"] }}</td>
                                            <td>{{ $c["cantidad"] }}</td>
                                            <td>{{ $c["cantidad"] * $c["precio"] }}</td>
                                            <td>
                                                <button class="btn btn-danger" wire:click="quitarCarrito({{$c['id']}})">x</button>
                                            </td>
                                        </tr>                                
                                        @endforeach
                                    </tbody>
    
                                </table>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Cliente</h5>
                            <div class="table-responsive">
                                @if($cliente_selecionado)                                
                                <strong>CLIENTE: {{ $cliente_selecionado->nombre_completo }}</strong>
<br>
                                <strong>CI/NIT: {{ $cliente_selecionado->ci_nit }}</strong>
                                @endif
                                <input type="text" class="form-control" wire:model="buscar_cliente">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>CI/NIT</th>
                                            <th>NOMBRES</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $clie)
                                        <tr>
                                            <td>{{ $clie->ci_nit }}</td>
                                            <td>{{ $clie->nombre_completo }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" wire:click="seleccionarClie({{ $clie->id }})"><i class="fa fa-user"></i></button>
                                            </td>
                                        </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-success btn-block" wire:click="guardarPedido()">Guardar Pedido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>   

</div>
