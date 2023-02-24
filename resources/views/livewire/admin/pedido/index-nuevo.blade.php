@extends("layouts.theme.admin")

@section("titulo", "Nuevo Pedido")

@section("contenedor")

    
    <livewire:admin.pedido.nuevo-pedido-component /> 

    


@endsection

@section("javascript")

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    
    Livewire.on('guardado', function(pedido){

        console.log(pedido)

        Swal.fire(
            `
            <h1>Pedido Registrado</h1>
            <strong>CLIENTE: ${pedido.cliente.nombre_completo}</strong>
            <h5>CI/NIT: ${pedido.cliente.ci_nit}</h5>
            <h4>CODIGO PEDIDO: ${pedido.cod_ped}</h4> 
            `,
            'Aceptar!',
            'success'
            )
        
    });


</script>

@endsection