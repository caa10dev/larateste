<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirmForm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Deseja excluir o item <b class="indice"> ?</b> ?</h4>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-confirm" data-token="{{ csrf_token() }}">Deletar o Item</button>
        <button type="button" class="btn btn-primary" id="btn-cancel">Cancelar</button>
      </div>
    </div>
  </div>
</div>