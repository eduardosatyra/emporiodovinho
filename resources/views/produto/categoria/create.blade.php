@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nova Categoria</h3>
		{!!Form::open(array('url'=>'produto/categoria','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" class="form-control" placeholder="Nome...">
			@if ($errors->has('nome'))
	            <span class="text-danger">
	                {{ $errors->first('nome') }}
	            </span>
            @endif
		</div>
		<div class="form-group">
			<label for="descricao">Descrição</label>
			<input type="text" name="descricao" class="form-control" placeholder="Descrição...">
			@if ($errors->has('descricao'))
                <span class="text-danger">
                    {{ $errors->first('descricao') }}
                </span>
            @endif
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Salvar</button>
			<button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
		</div>

		{!!Form::close()!!}		

	</div>
</div>
@stop