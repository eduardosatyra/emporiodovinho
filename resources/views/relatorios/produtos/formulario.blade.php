@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Relatório de Produtos</h3>
	</div>
</div>  
<div class="row">
	<div class="margin-top-10px col-sm-12 col-lg-12 col-md-12">
		<form action="/relatorios/produtos/export"  id="ProdutoRelatorioForm" method="post" accept-charset="utf-8" novalidate="novalidate">
			 {{ csrf_field() }}
			<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>             			
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="nome">Produto</label>
				<select name="id_produto" id="id_produto" class="form-control selectpicker" data-live-search="true">
					<option value="selecione">Selecione um produto..</option>
					@foreach($produtos as $pro)
					<option value="{{$pro->id_produto}}">
						{{$pro->nome}}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3 col-lg-3 col-md-3">
			<div class="form-group"> 
				<label> Categoria</label>
				<select name="id_categoria" class="form-control">
					<option value="selecione">Selecione uma categoria</option>
					@foreach($categorias as $cat)
					<option value="{{ $cat->id_categoria }}">            				
						{{$cat->nome}}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3 col-lg-3 col-md-3">
			<label for="ProdutoAtivo">Ativo</label>
			<select name="ativo" class="form-control" autocomplete="off" id="ProdutoAtivo">
				<option value="">Todos</option>
				<option value="1">Ativos</option>
				<option value="0">Inativos</option>
			</select>
		</div>
		<div class="both col-sm-12 col-lg-12 col-md-12">
			<button class="btn btn-success btn-responsive" type="submit">
				<span class="margin-right-10px"></span>Gerar
			</button>                                    
			<button type="button" id="reset-form" class="btn btn-danger btn-responsive">
				<span class="margin-right-10px"></span>Limpar</button>                                
			</div>
		</form>
	</div>
</div>  

@stop
