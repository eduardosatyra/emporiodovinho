@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Fornecedor: {{ $fornecedor->nome }}</h3>
	</div>
</div>
{!!Form::model($fornecedor, ['method'=>'PATCH', 'route'=>['fornecedor.update', $fornecedor->id_fornecedor]])!!}
{{Form::token()}}
<div class="row">
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
		<div class="panel-heading">Dados do fornecedor</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" required value="{{$fornecedor->nome}}" class="form-control" placeholder="Nome...">
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
						<option value="CPF" @if($fornecedor->tipo_documento == "CPF") selected  @endif> CPF </option>
						<option value="RG" @if($fornecedor->tipo_documento == "RG") selected  @endif> RG </option>
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="num_doc">Número Documento</label>
					<input type="text" name="num_doc" required
					value="{{$fornecedor->num_doc}}" class="form-control" placeholder="Número do Documento...">
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
					<input type="text" name="telefone" class="form-control" value="{{$fornecedor->telefone}}"placeholder="Telefone...">
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
					<input type="text" name="email" value="{{$fornecedor->email}}" class="form-control">
					@if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Status</label>					
					<select name="status" class="form-control">						
						<option  value="Ativo" @if($fornecedor->status == "Ativo") selected  @endif > Ativo</option>
						<option  value="Inativo" @if($fornecedor->status == "Inativo") selected  @endif > Inativo</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
		<div class="panel-heading">Endereço</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="cep">CEP</label>
					<input type="text" name="cep" value="{{$fornecedor->cep}}" class="form-control">
					@if ($errors->has('cep'))
                        <span class="text-danger">
                            {{ $errors->first('cep') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="endereco">Endereço</label>
					<input type="text" name="endereco" value="{{$fornecedor->endereco}}" class="form-control" >
					@if ($errors->has('endereco'))
                        <span class="text-danger">
                            {{ $errors->first('endereco') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="numero">Número</label>
					<input type="text" name="numero" value="{{$fornecedor->numero}}" class="form-control" >
					@if ($errors->has('numero'))
                        <span class="text-danger">
                            {{ $errors->first('numero') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="bairro">Bairro</label>
					<input type="text" name="bairro" value="{{$fornecedor->bairro}}" class="form-control" >
					@if ($errors->has('bairro'))
                        <span class="text-danger">
                            {{ $errors->first('bairro') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="cidade">Cidade</label>
					<input type="text" name="cidade" value="{{$fornecedor->cidade}}" class="form-control"  >
					@if ($errors->has('cidade'))
                        <span class="text-danger">
                            {{ $errors->first('cidade') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="estado">Estado</label>					
					<select id="estado" name="estado" class="form-control">
                        <option value="AC"  @if($fornecedor->estado == "AC") selected  @endif>Acre</option>
                        <option value="AL"  @if($fornecedor->estado == "AL") selected  @endif>Alagoas</option>
                        <option value="AP"  @if($fornecedor->estado == "AP") selected  @endif>Amapá</option>
                        <option value="AM"  @if($fornecedor->estado == "AM") selected  @endif>Amazonas</option>
                        <option value="BA"  @if($fornecedor->estado == "BA") selected  @endif>Bahia</option>
                        <option value="CE"  @if($fornecedor->estado == "CE") selected  @endif>Ceará</option>
                        <option value="DF"  @if($fornecedor->estado == "DF") selected  @endif>Distrito Federal</option>
                        <option value="ES"  @if($fornecedor->estado == "ES") selected  @endif>Espírito Santo</option>
                        <option value="GO"  @if($fornecedor->estado == "GO") selected  @endif>Goiás</option>
                        <option value="MA"  @if($fornecedor->estado == "MA") selected  @endif>Maranhão</option>
                        <option value="MT"  @if($fornecedor->estado == "MT") selected  @endif>Mato Grosso</option>
                        <option value="MS"  @if($fornecedor->estado == "MS") selected  @endif>Mato Grosso do Sul</option>
                        <option value="MG"  @if($fornecedor->estado == "MG") selected  @endif>Minas Gerais</option>
                        <option value="PA"  @if($fornecedor->estado == "PA") selected  @endif>Pará</option>
                        <option value="PB"  @if($fornecedor->estado == "PB") selected  @endif>Paraíba</option>
                        <option value="PR"  @if($fornecedor->estado == "PR") selected  @endif>Paraná</option>
                        <option value="PE"  @if($fornecedor->estado == "PE") selected  @endif>Pernambuco</option>
                        <option value="PI"  @if($fornecedor->estado == "PI") selected  @endif>Piauí</option>
                        <option value="RJ"  @if($fornecedor->estado == "RJ") selected  @endif>Rio de Janeiro</option>
                        <option value="RN"  @if($fornecedor->estado == "RN") selected  @endif>Rio Grande do Norte</option>
                        <option value="RS"  @if($fornecedor->estado == "RS") selected  @endif>Rio Grande do Sul</option>
                        <option value="RO"  @if($fornecedor->estado == "RO") selected  @endif>Rondônia</option>
                        <option value="RR"  @if($fornecedor->estado == "RR") selected  @endif>Roraima</option>
                        <option value="SC"  @if($fornecedor->estado == "SC") selected  @endif>Santa Catarina</option>
                        <option value="SP"  @if($fornecedor->estado == "SP") selected  @endif>São Paulo</option>
                        <option value="SE"  @if($fornecedor->estado == "SE") selected  @endif>Sergipe</option>
                        <option value="TO"  @if($fornecedor->estado == "TO") selected  @endif>Tocantins</option>                       
                    </select>                    
					@if ($errors->has('estado'))
                        <span class="text-danger">
                            {{ $errors->first('estado') }}
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="complemento">Complemento</label>
					<input type="text" name="complemento" value="{{$fornecedor->complemento}}" class="form-control">
					@if ($errors->has('complemento'))
                        <span class="text-danger">
                            {{ $errors->first('complemento') }}
                        </span>
                    @endif
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