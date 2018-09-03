@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Cliente: {{ $cliente->nome }}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{!!Form::model($cliente, ['method'=>'PATCH', 'route'=>['cliente.update', $cliente->id_cliente]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" required value="{{$cliente->nome}}" class="form-control" placeholder="Nome...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Tipo Documento</label>
			<select name="tipo_documento" class="form-control">
				<option value="{{$cliente->tipo_documento}}"> {{$cliente->tipo_documento}} </option>
				<option value="CPF"> CPF </option>
				<option value="RG"> RG </option> 
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="num_doc">Número Documento</label>
			<input type="text" name="num_doc" required 
			value="{{$cliente->num_doc}}" class="form-control" placeholder="Número do Documento...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="endereco">Endereço</label>
			<input type="text" name="endereco" required value="{{$cliente->endereco}}" class="form-control" placeholder="Endereço...">
		</div>	
	</div>	
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Sexo</label>
			<select name="sexo" class="form-control">
				<option value="{{$cliente->sexo}}"> {{$cliente->sexo}} </option>
				<option value="Masculino"> MASCULINO </option>
				<option value="Feminino"> FEMININO </option> 
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefone">Telefone</label>
			<input type="text" name="telefone" class="form-control" value="{{$cliente->telefone}}"
			placeholder="Telefone...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" 
			value="{{$cliente->email}}"
			class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control">
				<option value="{{$cliente->status}}"> {{$cliente->status}} </option>
				<option value="Ativo"> ATIVO </option>
				<option value="Inativo"> INATIVO </option> 
			</select>
		</div>
	</div>
</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">Salvar</button>
	<button class="btn btn-danger" type="reset">Cancelar</button>
</div>
{!!Form::close()!!}		
@stop