@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3><strong>Editar Produto:</strong> {{ $produto->nome }}</h3>
	</div>
</div>

{!!Form::model($produto, ['method' => 'PATCH', 'route'=>['produto.update', $produto->id_produto], 'files'=>'true' ]) !!}

{{Form::token()}}

<div class="row" >
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
		<div class="panel-heading">Dados do Produto</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" class="form-control" required value="{{ $produto->nome }}" placeholder="Nome...">
					@if ($errors->has('nome'))
						<span class="text-danger">
							{{ $errors->first('nome') }}
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group"> 
					<label> Categoria</label>
					<select name="id_categoria" class="form-control">
						@foreach($categorias as $cat)
							@if($cat->id_categoria==$produto->id_categoria)
								<option value="{{$cat->id_categoria}}" selected>
								{{$cat->nome}}
								</option>
							@else
								<option value="{{$cat->id_categoria}}">
								{{$cat->nome}}
								</option>
							@endif
						@endforeach
				</select>
				</div> 
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="codigo">Código</label>
					<input type="text" name="codigo" maxlength="5" class="form-control" required value="{{ $produto->codigo }}" placeholder="Digite apenas números..">
					@if ($errors->has('codigo'))
						<span class="text-danger">
							{{ $errors->first('codigo') }}
						</span>
					@endif
				</div> 
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">        
				<div class="form-group">
					<label for="descricao">Descrição</label>
					<input type="text" value="{{ $produto->descricao }}" name="descricao" class="form-control" placeholder="Descrição...">
					@if ($errors->has('descricao'))
						<span class="text-danger">
							{{ $errors->first('descricao') }}
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">        
				<div class="form-group">
					<label> Status</label>
					<select name="status" class="form-control">											
						<option value="Ativo" @if($produto->status == "Ativo") selected  @endif selected>Ativo</option>						
						<option value="Inativo" @if($produto->status == "Inativo") selected  @endif>Inativo</option>						
					</select>
				</div>
			</div>
		</div>
    </div>
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
		<div class="panel-heading">Estoque</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">      
				<div class="form-group">
					<label for="estoque">Estoque mínimo</label>
					<input type="text" name="estoque_minimo" class="form-control" required value="{{ $produto ->estoque_minimo }}" placeholder="Estoque minimo">
					@if ($errors->has('estoque_minimo'))
						<span class="text-danger">
							{{ $errors->first('estoque_minimo') }}
						</span>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default" style="margin-left: 16px; width: 97%;">
	<div class="panel-heading">Valores Unitários</div>
		<div class="panel-body">
			<div class="col-lg-6 col-sm-6 col-xs-12">        
				<div class="form-group">
					<label for="preco_compra">Preco de Compra</label>
					<input type="text" value="{{ $produto->preco_compra }}" name="preco_compra" class="form-control money">
					@if ($errors->has('preco_compra'))
						<span class="text-danger">
							{{ $errors->first('preco_compra') }}
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">        
				<div class="form-group">
					<label for="preco_venda">Preço de Venda</label>
					<input type="text" value="{{ $produto->preco_venda }}" name="preco_venda" class="form-control money">
					@if ($errors->has('preco_venda'))
						<span class="text-danger">
							{{ $errors->first('preco_venda') }}
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