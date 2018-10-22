@extends('layouts.admin')
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nova Venda</h3>
		</div>
	</div>
			{!!Form::open(array('url'=>'venda/venda','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="row">            	
            	<div class="col-lg-6 col-sm-6 col-xs-6">
	            	<div class="form-group">
	            	<label for="nome">Cliente</label>	            	
                        <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
                              @foreach($cliente as $cli)
                              <option value="{{$cli->id_cliente}}">
                              {{$cli->nome}}
                              </option>
                              @endforeach
                        </select>
	            	</div>
            	</div>   	

            	<div class="col-lg-6 col-sm-6 col-xs-6">
            		<div class="form-group">
            		<label>Tipo Pagamento</label>
            		<select name="tipo_pagamento" id="tipo_pagamento" class="form-control">
                        <option value="dinheiro">Dinheiro </option>	            		
	            		<option value="cartao">Cartão </option>
	            		<option value="cheque">Cheque </option>
            		</select>
            		</div>
            	</div>
            </div>
           
      <div class="row">

            <div class="panel panel-primary" style="margin-left: 16px; width: 97%;">
                  <div class="panel-body">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                              <div class="form-group">
                              <label for="nome">Produto</label>
                              
                              <select name="p_id_produto" id="p_id_produto" class="form-control selectpicker" data-live-search="true">
                                   <option value="selecione">Selecione um produto..</option>
                                    @foreach($produtos as $pro)                                    
                                    <option value="{{$pro->id_produto}}_{{$pro->estoque}}_{{$pro->preco_venda}}">
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
                              <input type="number" name="quantidade"  
                              id="p_quantidade"
                              class="form-control" placeholder="Quantidade...">
                              @if ($errors->has('quantidade'))
                                    <span class="text-danger">
                                          {{ $errors->first('quantidade') }}
                                    </span>
                              @endif
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Preço Venda</label>
                              <input type="number" name="preco_venda" id="p_preco_venda"
                              class="form-control" placeholder="Preço de Venda..." disabled>
                              @if ($errors->has('preco_venda'))
                                    <span class="text-danger">
                                          {{ $errors->first('preco_venda') }}
                                    </span>
                              @endif
                              </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                              <div class="form-group">
                              <label for="num_doc">Desconto</label>
                              <input type="text" name="desconto" id="p_desconto"
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
                        <th>Preço Venda</th>
                        <th>Desconto</th>
                        <th>Total</th>
                        </thead>
                        <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><h4 id="total">R$ 0,00</h4></th>
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
                  	<button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
                  </div>
                 </div>

	</div>	
      {!!Form::close()!!}		
            
@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>

$(document).ready(function(){
      $('#bt_add').click(function(){
            adicionar();

      });
      id_produto = $(this).val();
});

var cont=0;
total = 0;
subtotal=[];
$("#salvar").hide();
$("#p_id_produto").change(mostrarValores);

function mostrarValores(){
      dadosProdutos = document.getElementById("p_id_produto").value.split('_');
      $("#p_preco_venda").val(dadosProdutos[2]);
      $("#estoque_atual").val(dadosProdutos[1]);
}

function adicionar(){
      dadosProdutos = document.getElementById("p_id_produto").value.split('_');
      id_produto=dadosProdutos[0];
      produto=$("#p_id_produto option:selected").text();
      quantidade=$("#p_quantidade").val();
      desconto=$("#p_desconto").val();
      preco_venda=$("#p_preco_venda").val();
      estoque=$("#estoque_atual").val();
      estoque = parseInt(estoque);
      quantidade = parseInt(quantidade);

      if(id_produto!="" && quantidade!="" && quantidade>0 && preco_venda!=""){
            if(estoque >= quantidade){                  
                  subtotal[cont]=(quantidade*preco_venda-desconto);
                  total = total + subtotal[cont];
                  var linha = '<tr class="selected" id="linha'+cont+'"><td> <button type="button" class="btn btn-warning" onclick="apagar('+cont+');"> X </button></td><td><input type="hidden" name="id_produto[]" value="'+id_produto+'">'+produto+'</td><td> <input type="number" name="quantidade[]" value="'+quantidade+'"></td><td><input type="number" name="preco_venda[]" value="'+preco_venda+'"></td><td><input type="number" name="desconto[]" value="'+desconto+'"></td><td> '+subtotal[cont]+' </td></tr>'
                  cont++;
                  limpar();
                  $("#total").html("R$: " + total);
                  $("#total_venda").val(total);
                  ocultar();
                  $('#detalhes').append(linha);
            }else{
                alert("A quantidade vendida não pode ser maior que o estoque.");  
            }
      }else{
            alert("Erro ao inserir os produtos da venda, preencha os campos corretamente!!");
      }
}


function limpar(){
      $("#p_quantidade").val("");
      $("#p_preco_venda").val("");
      $("#p_desconto").val("");
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
      $("#total_venda").val(total);
      $("#linha" + index).remove();
      ocultar();
}
</script>

@endpush
@stop