@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Categorias <a href="categoria/create"><button class="btn btn-success">Novo</button></a></h3>
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
					<th>Opções</th>
				</thead>
				@foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->id_categoria}}</td>
					<td>{{ $cat->nome}}</td>
					<td>{{ $cat->descricao}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->id_categoria)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
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