@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nova Entrada</h3>
    </div>
</div>
{!!Form::open(array('url'=>'estoque/entrada','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label for="nome">Fornecedor</label>
            <select name="id_fornecedor" id="id_fornecedor" class="form-control selectpicker" data-live-search="true">
                @foreach($fornecedor as $for)
                <option value="{{$for->id_fornecedor}}">
                    {{$for->nome}}
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
                <option value="cheque"> Cheque </option>
                <option value="cartao">Cartão </option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary" style="margin-left: 16px; width: 97%;">
        <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
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
                    <label for="quantidade">Quantidade</label>
                    <input type="number" name="quantidade" value="{{old('quantidade')}}" 
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
                    <label for="preco_compra">Preço Compra</label>
                    <input type="text" name="preco_compra" value="{{old('preco_compra')}}" 
                    id="p_preco_compra"
                    class="form-control money" placeholder="Preço de Compra...">
                    @if ($errors->has('preco_compra'))
                        <span class="text-danger">
                            {{ $errors->first('preco_compra') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <label for="preco_venda">Preço Venda</label>
                    <input type="text" name="preco_venda" value="{{old('preco_venda')}}" 
                    id="p_preco_venda"
                    class="form-control money" placeholder="Preço de Venda...">
                    @if ($errors->has('preco_venda'))
                        <span class="text-danger">
                            {{ $errors->first('preco_venda') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <button type="button" id="bt_add"
                    class="btn btn-primary" style="margin-top: 24px;">
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
    });
    var cont=0;
    total = 0;
    subtotal=[];
    $("#salvar").hide();
    function adicionar(){
        id_produto=$("#p_id_produto").val();
        produto=$("#p_id_produto option:selected").text();
        quantidade=$("#p_quantidade").val();
        preco_compra= $("#p_preco_compra").val();
        preco_compra = preco_compra.replace(".", "");
        preco_compra = preco_compra.replace(",", ".");
        preco_venda=$("#p_preco_venda").val();
        preco_venda = preco_venda.replace(".", "");
        preco_venda = preco_venda.replace(",", ".");             
        if(id_produto!="" && quantidade!="" && quantidade>0 && preco_compra!="" && preco_venda!=""){
            subtotal[cont]=(quantidade*preco_compra);
            total = total + subtotal[cont];
            var linha = '<tr class="selected" id="linha'+cont+'">    <td> <button type="button" class="btn btn-danger" onclick="apagar('+cont+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>      <td> <input type="hidden" name="id_produto[]" value="'+id_produto+'">'+produto+'</td>             <td> <input type="text" name="quantidade[]" readonly value="'+quantidade+'"></td>                       <td> <input type="text" class="money"  name="preco_compra[]" readonly value="'+preco_compra+'"></td>                     <td> <input type="text" class="money"  name="preco_venda[]" readonly value="'+preco_venda+'"></td><td> '+subtotal[cont].toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+' </td> </tr>'
            cont++;
            limpar();
            $("#total").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
            ocultar();
            $('#detalhes').append(linha);
        }else{
            bootbox.alert("Erro ao inserir os detalhes, preencha os campos corretamente!!");
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
        $("#total").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
        $("#linha" + index).remove();
        ocultar();
    }
</script>
@endpush
@stop