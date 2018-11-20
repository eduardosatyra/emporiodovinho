@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Fornecedores</h3>
		<a  href="fornecedor/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar fornecedor</a>
		@include('fornecedor.fornecedor.search')
	</div>
	<div class="col-md-4 pull-right msg" style="display: none;">
		@include('flash::message')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nome</th>
					<th>Número Documento</th>
					<th>Endereço</th>
					<th>Telefone</th>
					<th>E-mail</th>
					<th>Status</th>
					<th>Ações</th>
				</thead>
				@foreach ($fornecedor as $for)
				<tr>
					<td>{{ $for->nome}}</td>
					<td>{{ $for->num_doc}}</td>
					<td>{{ $for->endereco}}</td>
					<td>{{ $for->telefone}}</td>
					<td>{{ $for->email}}</td>
					<td>{{ $for->status}}</td>
					<td>
						<a href="{{URL::action('FornecedorController@edit',$for->id_fornecedor)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" data-target="#modal-delete-{{$for->id_fornecedor}}" data-toggle="modal" class="deletar btn btn-xs btn-danger" data-placement="top" title="" data-original-title="Deletar"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
				</tr>
				@include('fornecedor.fornecedor.modal')
				@endforeach
			</table>
		</div>
		{{$fornecedor->render()}}
	</div>
</div>
@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
$(document).ready(function() {
	setTimeout(carregar, 1);
});
function carregar() {
	$('.msg').show();
   $('.alert-success').attr('style', 'background-color: #00a65a !important;');
   $('.alert-success').not('.alert-important').delay(3000).fadeOut(350);
}
</script>
@endpush
@stop