@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Cliente: {{ $cliente->nome }}</h3>
	</div>
</div>
{!!Form::model($cliente, ['method'=>'PATCH', 'route'=>['cliente.update', $cliente->id_cliente]])!!}
{{Form::token()}}
<div class="row">
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
		<div class="panel-heading">Dados do cliente</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" required value="{{$cliente->nome}}" class="form-control" placeholder="Nome...">
					@if ($errors->has('nome'))
                        <span class="text-danger">
                            {{ $errors->first('nome') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Tipo Documento</label>
					<select name="tipo_documento" class="form-control">						
						<option value="CPF" @if($cliente->tipo_documento == "CPF") selected  @endif> CPF </option>
						<option value="RG" @if($cliente->tipo_documento == "RG") selected  @endif> RG </option>
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="num_doc">Número Documento</label>
					<input type="text" name="num_doc" required
					value="{{$cliente->num_doc}}" class="form-control" placeholder="Número do Documento...">
					@if ($errors->has('num_doc'))
                        <span class="text-danger">
                            {{ $errors->first('num_doc') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" class="form-control" value="{{$cliente->telefone}}"
					placeholder="Telefone...">
					@if ($errors->has('telefone'))
                        <span class="text-danger">
                            {{ $errors->first('telefone') }}
                        </span>
                    @endif
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
		</div>
	</div>

</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">Salvar</button>
	<button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
</div>
{!!Form::close()!!}
@stop