</div>
      <div class="modal-footer">

        <button type="button" wire:click.prevent="resetInput()" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        @if($id_seleccionado < 1)
        <button type="button" wire:click.prevent="store()" class="btn btn-primary">GUARDAR</button>
        @else
        <button type="button" wire:click.prevent="update()" class="btn btn-primary" >MODIFICAR</button>
        @endif
      </div>
    </div>
  </div>
</div>