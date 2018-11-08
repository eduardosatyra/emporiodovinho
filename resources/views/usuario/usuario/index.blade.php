@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Usuários</h3>
		<a  href="usuario/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar usuário</a>
		@include('usuario.usuario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
					<th>Nome</th>
					<th>Email</th>
					<th>Opções</th>
				</thead>
				@foreach ($usuarios as $user)
				<tr>					
					<td>{{ $user->name}}</td>
					<td>{{ $user->email}}</td>
					<td>
						<a href="{{URL::action('UsuarioController@edit',$user->id)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal" class="deletar btn btn-xs btn-danger" data-placement="top" title="" data-original-title="Deletar"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
				</tr>
				@include('usuario.usuario.modal')
				@endforeach
			</table>
		</div>
		{{$usuarios->render()}}
	</div>
</div>
@stop