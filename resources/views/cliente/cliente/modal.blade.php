<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cli->id_cliente}}">
{{Form::Open(array('action'=>array('ClienteController@destroy',$cli->id_cliente),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" 
			aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title">Apagar Cliente</h4>
	</div>
	<div class="modal-body">
		<p>Confirme se deseja apagar o cliente</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		<button type="submit" class="btn btn-primary">Confirmar</button>
	</div>
</div>
</div>
{{Form::Close()}}

</div>