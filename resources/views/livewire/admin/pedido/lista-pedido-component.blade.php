<div>

    <h1>Pedidos</h1>

    <input type="text" id="datepicker">
{{ $filtro_fecha }}
    <table class="table table-hover">
        <thead>
            <tr>
                <th>COD</th>
                <th>FECHA</th>
                <th>CLIENTE</th>
                <th>PRODUCTOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $ped)
            <tr>
                <td>{{ $ped->cod_ped }}</td>
                <td>{{ $ped->fecha }}</td>
                <td>
                    <strong>{{ $ped->cliente->nombre_completo }}</strong> -
                    <span>{{ $ped->cliente->ci_nit }}</span>

                </td>
                <td>
                    
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $ped->id }}" wire:click="mostrarPedido({{ $ped->id }})">
        Ver productos
    </button>

                <!-- Modal -->
     <div class="modal fade" id="Modal{{$ped->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $ped->cod_ped }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">CLIENTE</label>
                    <input type="text" readonly class="form-control" value="{{ $ped->cliente->nombre_completo }}">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>COD</th>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($ped)
                            @foreach ($ped->productos as $prod)
                            <tr>
                                <td>{{ $prod->codigo }}</td>
                                <td>{{ $prod->nombre }}</td>
                                <td>
                                    <strong>{{ $prod->precio }}</strong>

                                </td>
                            </tr>

                            @endforeach

                            @endif

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>  


                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $pedidos->links() }}

    
     

</div>