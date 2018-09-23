@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Relatório de Vendas por Cliente</h3>
    </div>
</div> 
<div class="col-md-12">
    <div class="col-md-3">
        <input type="date" class="col-md-9" id="data_inicio">           
    </div>    
    <div class="col-md-3">
        <input type="date" class="col-md-9" id="data_final">           
    </div>
    <div class="col-md-2">
        <div class="form-group">            
            <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
                <option value="">Todos os clientes</option>
                @foreach($cliente as $cli)
                <option value="{{$cli->id_cliente}}">
                    {{$cli->nome}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    {{ csrf_field() }}      
    <div class="col-md-3">
        <button class="btn btn-primary" id="gerar">Gerar Relatório</button>
    </div>         
</div>
<div>
    <span class="col-md-12 text-danger" style="display: none;" id="nenhumRegistro">Nenhum registro encontrado</span>
    <span class="btn btn-info pull-right" id="exportCsv" style="display: none;">Exportar em CSV</span>    
    <span class="btn btn-success pull-right" id="exportExcel" style="display: none; margin-right: 10px; margin-bottom: 20px;">Exportar em Excel</span>    
    <table class="table table-bordered" id="table-cliente">        
    </table>
</div>


@push('scripts')
<script>
    $('#gerar').click(function(){                
        data_inicial = $("#data_inicio").val();
        data_final = $('#data_final').val();
        id_cliente = $("#id_cliente option:selected").val();       

        $.ajax({
                type:'POST',
                url:"/relatorios/vendas/cliente",
                dataType: 'JSON',
                data: {
                    "_token": $('input[name=_token]').val(),
                    "data_inicial": data_inicial,
                    "data_final": data_final,
                    "id_cliente": id_cliente 
                },
                success:function(data){
                    if (data == '') {
                        $("#nenhumRegistro").show();
                    }else{
                        $("#nenhumRegistro").hide();
                        $("#table-cliente tr").remove();
                        $("#exportExcel").show();
                        $("#exportCsv").show();
                        var thead = $("<thead>");
                        var title = $("<tr>");
                            var cols = ""; 
                                cols += '<th>Cliente</th>';       
                                cols += '<th>Tipo de Pagamento</th>';
                                cols += '<th>Data e Hora</th>';
                                cols += '<th>Total da Venda</th>';
                            thead.append(title);
                            title.append(cols) 
                            $("#table-cliente").append(thead);                  
                        
                            $.each(data, function(index, value) {
                                var newRow = $("<tr>");
                                    var cols = "";     
                                    cols += '<td>' + value.nome + '</td>';      
                                    cols += '<td>' + value.tipo_pagamento + '</td>';      
                                    cols += '<td>' + value.data_hora + '</td>';
                                    cols += '<td>' + value.total_venda + '</td>';
                                    newRow.append(cols);        
                                    $("#table-cliente").append(newRow);
                            });    
                        } 
                        
                    
                },
                error:function(){
                  alert("erro");
                },
            });
    });
        
    
</script>
@endpush
@stop
