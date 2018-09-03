@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Clientes <a href="cliente/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('cliente.cliente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nome</th>
					<th>Tipo Documento</th>
					<th>Número Documento</th>
					<th>Endereço</th>
					<th>Telefone</th>
					<th>E-mail</th>
					<th>Status</th>
				</thead>
				@foreach ($clientes as $cli)
				<tr>
					<td>{{ $cli->id_cliente}}</td>
					<td>{{ $cli->nome}}</td>
					<td>{{ $cli->tipo_documento}}</td>
					<td>{{ $cli->num_doc}}</td>
					<td>{{ $cli->endereco}}</td>
					<td>{{ $cli->telefone}}</td>
					<td>{{ $cli->email}}</td>
					<td>{{ $cli->status}}</td>
					<td>
						<a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('cliente.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>
@stop