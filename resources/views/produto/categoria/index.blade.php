@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Categorias</h3>
		<a href="categoria/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar categoria</a>
		@include('produto.categoria.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Ações</th>
				</thead>
				@foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->id_categoria}}</td>
					<td>{{ $cat->nome}}</td>
					<td>{{ $cat->descricao}}</td>
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
@stop