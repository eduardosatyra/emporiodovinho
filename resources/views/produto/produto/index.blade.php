@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Produtos <a href="produto/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('produto.produto.search')
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
					<th>Estoque</th>					
					<th>Estado</th>
					<th>Opções</th>
				</thead>
               @foreach ($produtos as $prod)
				<tr>
					<td>{{ $prod->codigo}}</td>					
					<td>{{ $prod->nome}}</td>					
					<td>{{ $prod->categoria}}</td>
					<td>{{ $prod->estoque}}</td>
					<td>{{ $prod->estado}}</td>
					<td>
						<a href="{{URL::action('ProdutoController@edit',$prod->id_produto)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$prod->id_produto}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('produto.produto.modal')
				@endforeach
			</table>
		</div>
		{{$produtos->render()}}
	</div>
</div>
@stop