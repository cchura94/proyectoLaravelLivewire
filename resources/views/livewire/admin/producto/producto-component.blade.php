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
                    <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoModal">
                    Nuevo Producto
                    </button>
                    </div>
                    <div class="col-md-2">
                        <select id="" wire:model="search" class="form-control">
                            <option value="TECLADO">TECLADO</option>
                            <option value="MONITOR">MONITOR</option>
                            <option value="ESCRITORIO">ESCRITORIO</option>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <select id="" wire:model="categoria_filter" class="form-control">
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

    <div wire:ignore.self class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="guardarProducto">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Ingrese Nombre Producto</label>
                        <input type="text" wire:model.lazy="nombre" class="form-control" id="nom" aria-describedby="eNom">
                        @error('nombre') 
                        <small id="eNom" class="alert alert-danger form-text">{{ $message }}</small>
                        @enderror
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pre">Ingrese Precio</label>
                                <input type="number" wire:model.lazy="precio" step="0.01" class="form-control" id="pre" aria-describedby="ePre">
                                <small id="ePre" class="form-text">Algun datos.</small>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cant">Ingrese Cantidad</label>
                                <input type="number" wire:model.lazy="cantidad" class="form-control" id="cant" aria-describedby="eCant">
                                @error('cantidad')
                                        <small id="eCant" class="alert alert-danger form-text">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nom">Ingrese Descripción</label>
                        <input type="text" wire:model.lazy="descripcion" class="form-control" id="nom" aria-describedby="eDesc">
                        <small id="eDesc" class="form-text">Algun datos.</small>
                    </div>
                    <div class="form-group">
                        <label for="cat">Categoria</label>
                        <select id="cat" wire:model.lazy="categoria_id" class="form-control" aria-describedby="eCat">
                            @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach    
                        </select>
                        @error('categoria_id')
                                <small id="eCat" class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div wire:loading wire:target="imagen">Subiendo Imagen...</div>
                    <div  wire:loading wire:target="imagen" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <input type="file" wire:model="imagen">
 
                    @error('imagen') <small class="alert alert-danger">{{ $message }}</small> @enderror
                
                    @if ($imagen)
                    Imagen Preview:
                    <img src="{{ $imagen->temporaryUrl() }}" width="100%">
                @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
