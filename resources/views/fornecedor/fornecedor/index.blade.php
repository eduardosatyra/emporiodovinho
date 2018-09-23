@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Fornecedores <a href="fornecedor/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('fornecedor.fornecedor.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nome</th>
					<th>Tipo Documento</th>
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
					<td>{{ $for->tipo_documento}}</td>
					<td>{{ $for->num_doc}}</td>
					<td>{{ $for->endereco}}</td>
					<td>{{ $for->telefone}}</td>
					<td>{{ $for->email}}</td>
					<td>{{ $for->status}}</td>
					<td>
						<a href="{{URL::action('FornecedorController@edit',$for->id_fornecedor)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$for->id_fornecedor}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('fornecedor.fornecedor.modal')
				@endforeach
			</table>
		</div>
		{{$fornecedor->render()}}
	</div>
</div>
@stop