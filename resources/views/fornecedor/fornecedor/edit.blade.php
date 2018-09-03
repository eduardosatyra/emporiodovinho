@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Fornecedor: {{ $pessoa->nome }}</h3>
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
{!!Form::model($fornecedor, ['method'=>'PATCH', 'route'=>['fornecedor.update', $fornecedor->id_fornecedor]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" required value="{{$fornecedor->nome}}" class="form-control" placeholder="Nome...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Tipo Documento</label>
			<select name="tipo_documento" class="form-control">
				<option value="{{$fornecedor->tipo_documento}}"> {{$fornecedor->tipo_documento}} </option>
				<option value="CPF"> CPF </option>
				<option value="RG"> RG </option> 
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="num_doc">Número Documento</label>
			<input type="text" name="num_doc" required 
			value="{{$fornecedor->num_doc}}" class="form-control" placeholder="Número do Documento...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="endereco">Endereço</label>
			<input type="text" name="endereco" required value="{{$fornecedor->endereco}}" class="form-control" placeholder="Endereço...">
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
			<input type="text" name="telefone" class="form-control" value="{{$fornecedor->telefone}}"
			placeholder="Telefone...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" 
			value="{{$fornecedor->email}}"
			class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control">
				<option value="{{$fornecedor->status}}"> {{$fornecedor->status}} </option>
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