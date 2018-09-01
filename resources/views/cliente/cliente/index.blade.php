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
				</thead>
				@foreach ($pessoas as $pes)
				<tr>
					<td>{{ $pes->id_pessoas}}</td>
					<td>{{ $pes->nome}}</td>
					<td>{{ $pes->tipo_documento}}</td>
					<td>{{ $pes->num_doc}}</td>
					<td>{{ $pes->endereco}}</td>
					<td>{{ $pes->telefone}}</td>
					<td>{{ $pes->email}}</td>
					<td>
						<a href="{{URL::action('ClienteController@edit',$pes->id_pessoas)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$pes->id_pessoas}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('cliente.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$pessoas->render()}}
	</div>
</div>
@stop