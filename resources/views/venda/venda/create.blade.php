@extends('layouts.admin')
@section('conteudo')

<div class="row" id="pdv">
    {!!Form::open(array('url'=>'venda/venda','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div style="display: block" id="venda-produto">        
        <div class="col-sm-6 col-md-6 col-lg-6">
            <label style="margin-left: 15px; margin-bottom:0"><h4 class="margin-top-0">SELECIONE O PRODUTO ABAIXO</h4></label>
            <div class="form-group">            
                <select name="p_id_produto" id="p_id_produto" class="col-md-8 selectpicker" data-live-search="true">
                    <option value="selecione">Selecione um produto..</option>
                    @foreach($produtos as $pro)                                    
                    <option value="{{$pro->id_produto}}_{{$pro->estoque}}_{{$pro->preco_venda}}_{{$pro->codigo}}">
                        {{$pro->nome}}
                    </option>
                    @endforeach
                </select>
            </div>
            <label style="margin-left: 15px; margin-bottom:0""><h4 class="margin-top-0">SELECIONE O CLIENTE</h4></label>
            <div class="form-group">                   
                <select name="id_cliente" id="id_cliente" class="col-md-8 selectpicker" data-live-search="true" >
                <option value="0">Selecione um cliente..</option>
                @foreach($cliente as $cli)
                <option value="{{$cli->id_cliente}}">
                {{$cli->nome}}
                </option>
                @endforeach
                </select>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-cliente">
                    <i class="glyphicon glyphicon-plus-sign"></i>
                Adicionar Cliente
                </button>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12">
                <label for="">CÓDIGO: </label><input type="text" class="form-control" id="codigo" readonly="true">
                <label for="">QUANTIDADE: </label><input type="text"  class="form-control" id="p_quantidade" onBlur="calculaTotal()">
                <label for="">ESTOQUE ATUAL: </label><input type="text" class="form-control" id="estoque_atual" readonly="true">
                <label for="">VALOR UNITÁRIO: </label><input type="text" class="form-control" id="p_preco_venda" readonly="true">
                <label for="">DESCONTO: </label><input type="text" class="form-control" id="p_desconto" onBlur="calculaTotal()">
                <label for="">VALOR TOTAL: </label><input type="text" class="form-control" id="valor_total" autocomplete="off" readonly="true">
                <input type="hidden" value="0.00" name="total_atual" id="total_atual">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <button id="salva-produto" type="button" class="btn btn-primary btn-lg" style="width:100%; margin-top: 10px;" onclick="adicionar()">ADICIONAR PRODUTO</button>
                </div>            
            </div>
        </div>
        <div class="margin-top-10px-xs col-sm-6 col-md-6 col-lg-6">
            <div id="produtos-selecionados">
                <div id="lista" class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped" id="itens">
                        <tbody>
                            <tr>
                                <th width="5%"><h4 class="margin-top-0 margin-bottom-0">Qtd.</h4></th>
                                <th><h4 class="margin-top-0 margin-bottom-0">Produto</h4></th>
                                <th><h4 class="margin-top-0 margin-bottom-0">Valor unit.</h4></th>
                                <th width="10%"><h4 class="margin-top-0 margin-bottom-0">Desconto</h4></th>
                                <th width="10%"><h4 class="margin-top-0 margin-bottom-0">Preço</h4></th>
                                <th width="10%"></th>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
                <h4>TOTAL DO PEDIDO</h4>
                <div class="total-pedido">
                    R$ 0,00
                </div>
            </div>
            <div class="row">
                <div class="margin-top-10px col-sm-12 col-md-12 col-lg-12">
                    <button id="botao-pagar" type="button" disabled="disabled" class="btn btn-success btn-lg" onclick="pagar();" style="width:100%">FINALIZAR VENDA</button>
                </div>
                <div class="margin-top-10px col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                    <button id="cancelar" type="button" class="btn btn-danger btn-lg" onclick="cancelarPedido();" style="width:100%">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>
    <div id="tela-pagamento" class="etapa none" style="display: none; overflow: hidden;">
        <input name="_token" value="{{ csrf_token() }}"
                    type="hidden">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <fieldset class="muted">
                    <legend>
                        <h3 class="margin-top-0">
                            <i class="fa fa-credit-card margin-right-10px"></i>&nbsp;Forma de Pagamento
                        </h3>
                    </legend>
                    <div class="">
                        <select id="tipo_pagamento" class="form-control" autocomplete="off" name="tipo_pagamento">
                            <option value="dinheiro">Dinheiro à vista </option>	            		
                            <option value="cartao-credito">Cartão de crédito</option>
                            <option value="cartao-debito">Cartão de débito</option>
                            <option value="cheque">Cheque</option>
                        </select><br>
                        <select id="parcelas" class="form-control" autocomplete="off" name="qtd_parcelas" style="display: none">
                            <option value="1x">1x</option>	            		
                            <option value="2x">2x</option>
                            <option value="3x">3x</option>
                            <option value="4x">4x</option>	            		
                            <option value="5x">5x</option>
                            <option value="6x">6x</option>
                            <option value="7x">7x</option>	            		
                            <option value="8x">8x</option>
                            <option value="9x">9x</option>
                            <option value="10x">10x</option>	            		
                            <option value="11x">11x</option>
                            <option value="12x">12x</option>
                        </select>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <h4>TOTAL PAGO</h4>
                        <div class="input-total-pago">
                            <input class="money" autocomplete="off" type="text" id="PedidoValorPago" placeholder="" value="">  
                            <span class="btn btn-primary" id="botao-confirma-pagamento">
                                <h4 style="color:#FFFFFF; margin-top: 3px;"><i class="fa fa-angle-double-right margin-right-10px"></i>Confirmar</h4>
                            </span>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <fieldset id="box-pagamentos" class="muted" style="padding:0 !important; display: none;">
                    <legend><h3 class="margin-top-0"><i class="fa fa-usd margin-right-10px"></i>&nbsp;Pagamentos</h3></legend>
                    <table width="100%" cellpadding="5" cellspacing="5" id="table-forma-pagamento">
                        <tbody>                            
                        </tbody>
                    </table>
                </fieldset>

                    <fieldset class="muted" style="padding:0 !important">
                        <legend><h3 class="margin-top-0"><i class="fa fa-money margin-right-10px"></i>&nbsp;Total</h3></legend>
                        <table width="100%" cellpadding="5" cellspacing="0" class="margin-bottom-10px">
                            <tbody>
                                <tr class="border-bottom-1px">
                                    <td width="120"><h4>SUBTOTAL:</h4></td>
                                    <td class="nowrap" width="1"><h4>R$ <span id="sub-total"></span></h4></td>
                                </tr>                                
                                <tr class="border-bottom-1px">
                                    <td width="120"><h4>PAGAMENTOS:</h4></td>
                                    <td class="nowrap" width="1"><h4>R$ <span id="pagamentos">0,00</span></h4></td>
                                </tr>
                                <tr style="background-color: #ccc;">
                                    <td width="120"><h4>TROCO:</h4></td>
                                    <td class="nowrap" width="1"><h4>R$ <span id="troco">0,00</span></h4></td>
                                </tr>
                            </tbody>
                    </table>
                    </fieldset>
                    <div class="both margin-top-10px text-right botoes-pagamentos" style="margin-top: 20px;">
                        <button type="submit" id="botao-finalizar" disabled="disabled" autocomplete="off" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-ok margin-right-10px"></span>Finalizar</button>             <button type="button" id="botao-cancelar" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove margin-right-10px"></span>Cancelar</button></div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}	
        </div>
        @include('venda.venda.modal-cliente')

        @push('scripts')
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script>

            cont = 0;
            subtotal=[];
            function formataNum(moeda){
                moeda = moeda.replace(".","");
                moeda = moeda.replace(",",".");
                return parseFloat(moeda);
                
            }
            function soma(total, subtotal) {
                total = formataNum(total);
                subtotal = parseFloat(subtotal);
                total = total + subtotal;
                return numeroParaMoeda(total);
            }

            function numeroParaMoeda(n, c, d, t){
                c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
            }

            function calculaTotal(){
                var quantidade = $('#p_quantidade').val();
                var preco_venda = $('#p_preco_venda').val();
                preco_venda = preco_venda;
                var desconto = $('#p_desconto').val();
                desconto = desconto;
                var valor_total = (quantidade * preco_venda) - desconto;        
                valor_total = numeroParaMoeda(valor_total);        
                $('#valor_total').val(valor_total);
            };
            
            function adicionar(){
                dadosProdutos = document.getElementById("p_id_produto").value.split('_');
                id_produto=dadosProdutos[0];
                produto=$("#p_id_produto option:selected").text();

                quantidade=$("#p_quantidade").val();      
                preco_venda = $('#p_preco_venda').val();
                desconto = $('#p_desconto').val();

                estoque=$("#estoque_atual").val();
                estoque = parseInt(estoque);
                quantidade = parseInt(quantidade);

                if(id_produto!="" && quantidade!="" && quantidade>0 && preco_venda!=""){
                    if(estoque >= quantidade){
                        $("#botao-pagar").prop("disabled", false);
                        $('select[name=p_id_produto]').val("selecione");
                        $('.selectpicker').selectpicker('refresh');                  
                        subtotal= (quantidade*preco_venda)-desconto;
                        total = $('#total_atual').val();
                        total = soma(total, subtotal.toFixed(2));
                        atualizaTotal(total);
                        subtotal = numeroParaMoeda(subtotal);

                        var linha = '<tr class="selected" id="linha'+cont+'"><td><input type="hidden" name="quantidade[]" value="'+quantidade+'"><input type="hidden" class="total" name="total[]" value="'+total+'">'+quantidade+'</td><td><input type="hidden" name="id_produto[]" value="'+id_produto+'">'+produto+'</td><td><input type="hidden" name="preco_venda[]" value="'+preco_venda+'">'+preco_venda+'</td><td><input type="hidden" name="desconto[]" value="'+desconto+'">'+desconto+'</td><td><input type="hidden" class="subtotal" name="subtotal[]" value="'+subtotal+'">'+subtotal +'</td><td class="text-center"><button onclick="deletarProduto('+cont+')" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></button></td></tr>'
                        cont++;
                        limpar();                 
                        $('#itens').append(linha);
                    }else{
                        bootbox.alert("A quantidade vendida não pode ser maior que o estoque.");  
                    }
                }else{
                    bootbox.alert("Erro ao inserir os produtos da venda, preencha os campos corretamente!!");
                }
            }
            function deletarProduto(produto){
                linha = '#linha'+produto;
                var subtotal = formataNum($(linha).children("td").children('.subtotal').val());
                var total = formataNum($('#total_atual').val());
                total = total - subtotal;
                total_atual = numeroParaMoeda(total);
                atualizaTotal(total_atual);
                $(linha).remove();
                var tr = $("#itens tbody tr").length;
                if(tr < 2){
                    $("#botao-pagar").prop("disabled", true);    
                }
                
            }

            function atualizaTotal(total){
                $('.total-pedido').html("R$ " + total);
                $('#total_atual').val(total);
            }

            $("#p_id_produto").change(mostrarValores);

            function mostrarValores(){
                dadosProdutos = document.getElementById("p_id_produto").value.split('_');
                $("#codigo").val(dadosProdutos[3]);
                $("#p_preco_venda").val(dadosProdutos[2]);
                $("#estoque_atual").val(dadosProdutos[1]);
            }

            function limpar(){
                $("#p_quantidade").val("");
                $("#p_preco_venda").val("");
                $("#p_desconto").val("");
                $("#codigo").val("");
                $("#estoque_atual").val("");
                $("#valor_total").val("");
            }

            function pagar(){
                $('#venda-produto').hide();
                $('#tela-pagamento').show();
                $('#sub-total').text($('#total_atual').val());                
            }

            $("#tipo_pagamento").change(function(){
                var pagamento = $("#tipo_pagamento").val();
                if(pagamento == "cartao-credito"){
                    $("#parcelas").show();
                }else{
                    $("#parcelas").hide();
                }

            });

            $("#botao-confirma-pagamento").click(function(){                           
                var forma_pagamento = $('#tipo_pagamento').val();
                var total_pago = formataNum($('#PedidoValorPago').val());
                var subtotal = formataNum($('#total_atual').val());
                if(isNaN(total_pago)){
                    return false;
                }
                if(total_pago < subtotal){
                    bootbox.alert("O valor pago não pode ser menor que o total da venda");
                    return false;
                }                
                $("#box-pagamentos").show();
                $("#botao-finalizar").prop("disabled", false);
                $("#pagamentos").text($('#PedidoValorPago').val());
                $("#PedidoValorPago").val("");
                var troco = total_pago - subtotal;
                $("#troco").text(numeroParaMoeda(troco.toFixed(2)));

                switch(forma_pagamento) {
                    case "cartao-credito":
                        forma_pagamento = "Cartão de Crédito"
                    break;
                    case "cartao-debito":
                        forma_pagamento = "Cartão de Débito"
                    break;
                    case "dinheiro":
                        forma_pagamento = "Dinheiro à vista"
                    break;
                    case "cheque":
                        forma_pagamento = "Cheque"
                    break;
                }
               
               var linha = '<tr class="tr_forma_pagamento"><td  width="350">'+forma_pagamento+'</td><td>R$ '+numeroParaMoeda(total_pago)+'</td><td><button type="button" class="btn btn-xs btn-danger" onclick="removePagamento()"><i class="glyphicon glyphicon-remove"></i></button></td></tr>';

            $('#table-forma-pagamento').append(linha);

            });

            function removePagamento(){
                $('.tr_forma_pagamento').remove();
                $("#pagamentos").text("0,00");
                $("#troco").text("0,00");
                $('#box-pagamentos').hide();
                $("#botao-finalizar").prop("disabled", true);
            }

            $("#botao-cancelar").click(function(){
                removePagamento();
                $('#venda-produto').show();
                $('#tela-pagamento').hide();
            });

            function cancelarPedido(){
                bootbox.confirm({
                message: "Deseja cancelar este pedido?",
                buttons: {
                confirm: {
                label: 'Sim',
                className: 'btn-success'
                },
                cancel: {
                label: 'Não',
                className: 'btn-danger'
                }
                },
                callback: function (result) {
                    if(result){
                        $('select[name=p_id_produto]').val("selecione");
                        $('.selectpicker').selectpicker('refresh');
                        $("#venda-produto input").val("");
                        $("#itens").find(".selected").remove();
                        $('.total-pedido').html("R$ 0,00");                        
                    }
                }
                });
        }

        </script>

        @endpush
        @stop