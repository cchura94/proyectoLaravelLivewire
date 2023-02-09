<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">

                <h1>Categoria</h1>

                

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>DETALLE</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->nombre }}</td>
                            <td>{{ $cat->detalle }}</td>
                            <td>
                                <button class="btn btn-warning" wire:click="editarCategoria({{$cat}})"><i class="fa fa-edit"></i></button>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                
            <form wire:submit.prevent="guardarCategoria">
                <div class="form-group">
                    <label for="nom">Ingrese Nombre</label>
                    <input type="text" wire:model.lazy="nombre" class="form-control @error('nombre')is-invalid @enderror" id="nom">
                    @error('nombre') <span class="alert alert-danger">{{ $message }}</span> @enderror
                
                </div>
                    <input type="text" wire:model.lazy="detalle" class="form-control">
                    @error('detalle') <span class="alert alert-danger">{{ $message }}</span> @enderror
                
                    <button type="submit" class="btn btn-info btn-block">Guardar Categoria</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>

            </div>
        </div>
    </div>

</div>