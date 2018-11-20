@extends('layouts.admin')
@section('conteudo')
<div class="row">	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Produtos</h3>
		<a  href="produto/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar produto</a>
		@include('produto.produto.search')
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
					<th>Código</th>
					<th>Nome</th>					
					<th>Categoria</th>
					<th>Preço de Venda</th>
					<th>Estoque</th>					
					<th>Status</th>
					<th>Ações</th>
				</thead>
               @foreach ($produtos as $prod)
				<tr>
					<td>{{ $prod->codigo}}</td>					
					<td>{{ $prod->nome}}</td>					
					<td>{{ $prod->categoria}}</td>					
					<td>R$ <?php echo number_format($prod->preco_venda, 2, ',', '.') ?></td>
					<td>{{ $prod->estoque}}</td>
					<td>{{ $prod->status}}</td>
					<td>
						<a href="{{URL::action('ProdutoController@edit',$prod->id_produto)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" data-target="#modal-delete-{{$prod->id_produto}}" data-toggle="modal" class="deletar btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar"><span class="glyphicon glyphicon-remove"></span></a>                         
					</td>
				</tr>
				@include('produto.produto.modal')
				@endforeach
			</table>
		</div>
		{{$produtos->render()}}
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