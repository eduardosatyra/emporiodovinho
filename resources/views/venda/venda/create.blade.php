@extends('layouts.admin')
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nova Venda</h3>
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

			{!!Form::open(array('url'=>'venda/venda','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
           

            <div class="row">
            	
            	<div class="col-lg-12 col-sm-12 col-xs-12">
	            	<div class="form-group">
	            	<label for="nome">Cliente</label>
	            	
                        <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
                              @foreach($pessoas as $pes)
                              <option value="{{$pes->id_pessoas}}">
                              {{$pes->nome}}
                              </option>
                              @endforeach
                        </select>
	            	</div>
            	</div>

            	

            	<div class="col-lg-4 col-sm-4 col-xs-12">
            		<div class="form-group">
            		<label>Tipo Comprovante</label>
            		<select name="tipo_comprovante" id="tipo_comprovante" class="form-control">
                              <option value="Dinheiro">Dinheiro </option>
	            		<option value="Boleto"> Boleto </option>
	            		<option value="Cartão">Cartão </option>
            		</select>
            		</div>
            	</div>
            	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            		<div class="form-group">
	            	<label for="num_doc">Série Comprovante</label>
	            	<input type="text" name="serie_comprovante" required value="{{old('serie_comprovante')}}" class="form-control" placeholder="Série do comprovante...">
	            	</div>
            		
            	</div>
            		
            	<div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                        <label for="num_doc">Número Comprovante</label>
                        <input type="text" name="num_comprovante" required value="{{old('num_comprovante')}}" class="form-control" placeholder="Número do comprovante...">
                        </div>
                  </div>
            </div>
           
      <div class="row">

            <div class="panel panel-primary">
                  <div class="panel-body">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                              <div class="form-group">
                              <label for="nome">Produto</label>
                              
                              <select name="p_id_produto" id="p_id_produto" class="form-control selectpicker" data-live-search="true">
                                    @foreach($produtos as $pro)
                                    <option value="{{$pro->id_produto}}">
                                    {{$pro->nome}}
                                    </option>
                                    @endforeach
                              </select>
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Estoque Atual</label>                            
                                    <input type="text" readonly="true" id="estoque_atual" class="form-control" value="">                             
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Quantidade</label>
                              <input type="number" name="quantidade" value="{{old('quantidade')}}" 
                              id="p_quantidade"
                              class="form-control" placeholder="Quantidade...">
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Preço Venda</label>
                              <input type="number" name="preco_venda" value="{{old('preco_venda')}}" 
                              id="p_preco_venda"
                              class="form-control" placeholder="Preço de Venda...">
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Desconto</label>
                              <input type="number" name="desconto" value="{{old('desconto')}}" 
                              id="p_desconto"
                              class="form-control" placeholder="Desconto...">
                              </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <button type="button" id="bt_add"
                              class="btn btn-primary">
                              Adicionar
                              </button>
                              
                              </div>
                        </div>


                        <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
                        <table id="detalhes" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                        <th>Opções</th>
                        <th>Produtos</th>
                        <th>Quantidade</th>
                        <th>Preço Compra</th>
                        <th>Preço Venda</th>
                        <th>Total</th>
                        </thead>
                        <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="total">R$ 0,00</th>
                        <input type="hidden" name="total_venda" id="total_venda">    
                        </tfoot>
                        </table>
                        </div>

                  </div>
            </div>

                  <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12" id="salvar">
                  <div class="form-group">

                        <input name="_token" value="{{ csrf_token() }}"
                         type="hidden">
                  	<button class="btn btn-primary" id="salvar" type="submit">Salvar</button>
                  	<button class="btn btn-danger" type="reset">Cancelar</button>
                  </div>
                 </div>

	</div>	
      {!!Form::close()!!}		
            
@push('scripts')

<script>

$(document).ready(function(){
      id_produto = $('#p_id_produto').val();
            $.ajax({
                  type: 'GET',
                  url: '/venda/consultaEstoque',
                  data: {
                        'id_produto': id_produto
                  },
                  success: function(data){
                        $('#estoque_atual').val(data.estoque);
                  }                  
      });
      $('#bt_add').click(function(){
            adicionar();

      });
      id_produto = $(this).val();
});

var cont=0;
total = 0;
subtotal=[];
$("#salvar").hide();

function adicionar(){
      id_produto=$("#p_id_produto").val();
      produto=$("#p_id_produto option:selected").text();
      quantidade=$("#p_quantidade").val();
      preco_compra=$("#p_preco_compra").val();
      preco_venda=$("#p_preco_venda").val();

      if(id_produto!="" && quantidade!="" && quantidade>0 && preco_compra!="" && preco_venda!=""){

            subtotal[cont]=(quantidade*preco_compra);
            total = total + subtotal[cont];
            var linha = '<tr class="selected" id="linha'+cont+'">    <td> <button type="button" class="btn btn-warning" onclick="apagar('+cont+');"> X </button></td>      <td> <input type="hidden" name="id_produto[]" value="'+id_produto+'">'+produto+'</td>             <td> <input type="number" name="quantidade[]" value="'+quantidade+'"></td>                       <td> <input type="number" name="preco_compra[]" value="'+preco_compra+'"></td>                     <td> <input type="number" name="preco_venda[]" value="'+preco_venda+'"></td>                      <td> '+subtotal[cont]+' </td> </tr>'
            cont++;
            limpar();
            $("#total").html("R$: " + total);
            ocultar();
            $('#detalhes').append(linha);

      }else{
            alert("Erro ao inserir os detalhes, preencha os campos corretamente!!");

      }
}


function limpar(){
      $("#p_quantidade").val("");
      $("#p_preco_venda").val("");
      $("#p_preco_compra").val("");
}


function ocultar(){
      if(total>0){
            $("#salvar").show();
      } else{
            $("#salvar").hide();
      }
}

function apagar(index){
      total = total - subtotal[index];
      $("#total").html("R$: " + total);
      $("#linha" + index).remove();
      ocultar();
}

$('#p_id_produto').change(function(){
      id_produto = $(this).val();
            $.ajax({
                  type: 'GET',
                  url: '/venda/consultaEstoque',
                  data: {
                        'id_produto': id_produto
                  },
                  success: function(data){
                        $('#estoque_atual').val(data.estoque);
                  }                  
            });
})





</script>

@endpush
@stop