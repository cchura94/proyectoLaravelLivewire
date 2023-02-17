<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{$nombreComponent}} | {{ $id_seleccionado > 0 ? 'EDITAR' : 'CREAR' }}
        </h5>
        <h6 class="text-warning text-center" wire:loading>ESPERE POR FAVOR</h6>
        <div  wire:loading class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
          </div>
        
      </div>
      <div class="modal-body">
        