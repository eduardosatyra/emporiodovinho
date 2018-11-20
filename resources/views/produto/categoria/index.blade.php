@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Categorias</h3>
		<a href="categoria/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar categoria</a>
		@include('produto.categoria.search')
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
					<th>Categoria</th>
					<th>Ações</th>
				</thead>
				@foreach ($categorias as $cat)
				<tr>					
					<td>{{ $cat->nome}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->id_categoria)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal" class="deletar btn btn-xs btn-danger" data-placement="top" title="" data-original-title="Deletar"><span class="glyphicon glyphicon-remove"></span></a>     
					</td>
				</tr>
				@include('produto.categoria.modal')
				@endforeach
			</table>
		</div>
		{{$categorias->render()}}
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

