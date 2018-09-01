@extends('layouts.admin')
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Produto: {{ $produto->nome }}</h3>
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
			
			{!!Form::model($produto, ['method' => 'PATCH', 'route'=>['produto.update', $produto->id_produto], 'files'=>'true' ]) !!}

            {{Form::token()}}
            
            <div class="row" >
            	
            	<div class="col-lg-6 col-sm-6 col-xs-12">
	            		<div class="form-group">
	            			<label for="nome">Nome</label>
	            			<input type="text" name="nome" class="form-control" required value="{{ $produto->nome }}" placeholder="Nome...">
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
	            			<input type="text" name="codigo" class="form-control" required value="{{ $produto -> codigo }}" placeholder="Código...">
	                    </div>         		

            	</div>

            	<div class="col-lg-6 col-sm-6 col-xs-12">      
	            		<div class="form-group">
	            			<label for="estoque">Estoque</label>
	            			<input type="text" name="estoque" class="form-control" required value="{{ $produto -> estoque }}" placeholder="Estoque...">
	                    </div>
            	</div>


            	<div class="col-lg-6 col-sm-6 col-xs-12">        
	            		<div class="form-group">
			            	<label for="descricao">Descrição</label>
			            	<input type="text" value="{{ $produto -> descricao }}" name="descricao" class="form-control" placeholder="Descrição...">
            			</div>
            	</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">        
					<div class="form-group">
						<label for="descricao">Preco de Compra</label>
						<input type="text" value="{{ $produto -> preco_compra }}" name="preco_compra" class="form-control">
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">        
					<div class="form-group">
						<label for="descricao">Preço de Venda</label>
						<input type="text" value="{{ $produto -> preco_venda }}" name="preco_venda" class="form-control">
					</div>
				</div>
            </div>

            
            
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Salvar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>            


			{!!Form::close()!!}		
            
@stop