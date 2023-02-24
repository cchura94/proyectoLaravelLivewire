@extends("layouts.theme.admin")

@section("titulo", "Lista Pedido")

@section("contenedor")

    <livewire:admin.pedido.lista-pedido-component /> 
    

@endsection

@section("javascript")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>

    console.log(Livewire)

  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).on("change", function(e){
        let fecha = $(this).val();

        Livewire.emit('ff', fecha);

    });
  });
</script>
@endsection