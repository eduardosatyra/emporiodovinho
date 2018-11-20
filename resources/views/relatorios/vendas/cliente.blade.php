@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div style="margin-left: 10px; margin-bottom: 20px;">
        <span>Período de</span>
        <input type="text" id="data_inicial"><i class="fa fa-calendar" aria-hidden="true"></i>
        <span style="margin-left: 10px;">até</span>
        <input type="text" id="data_final"><i class="fa fa-calendar" aria-hidden="true"></i>
        <button style="background: #2196F3; color: white; margin-left: 10px;" id="filtro">Filtrar</button>
    </div>
</div>
<table id="listar-venda" class="display" style="width:100%">
    <thead>
        <tr>                
            <th>Cliente</th>
            <th>Tipo de Pagamento</th>
            <th>Data e hora da venda</th>
            <th>Total da venda</th>
        </tr>
    </thead>
</table>
@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script>
$(document).ready(function() {
    var today = new Date();
     $('#data_inicial , #data_final').datepicker({
        endDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
        format: "dd/mm/yyyy",
        language: "pt-BR"
    }).datepicker("setDate",'now');

    function fetch_data(data_inicial, data_final, token){

        $('#listar-venda').DataTable({
            "processing": true,
            "serverSide": false,
            "order": [[ 2, "desc" ]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                "type": "POST",
                "url": "{{route('relatorio.data')}}",
                "dataSrc":"",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    data_inicial:data_inicial, data_final:data_final, token:token,

                }                       
            },
            dom: 'lBfrtip',
                                         buttons: [
                        'excel', 'print',
                        {
                            extend: 'pdfHtml5',
                            download: 'open',
                            title: 'Relatório de Vendas',
                            customize: function ( doc ) {
                            doc.content[1].table.widths = [ '25%', '25%', '25%', '25%'];
                            doc.content.splice( 1, 0, {
                        margin: [ -5, -70, 0, 1 ],
                        alignment: 'left',
                        image: 'data:image/png;base64,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',
                        width: 90,
                        height: 90

                    });
                }
                        }
                    ],
                    "columns": [
                    { "data": "nome" },
                    { "data": "tipo_pagamento" },
                    { "data": "data_hora" },
                    { "data": "total_venda" }
                ]    

        });        
    }

    $('#filtro').click(function(){
        var data_inicial = $('#data_inicial').val();
        var data_final = $('#data_final').val(); 
        var token = "{{ csrf_token() }}";

        $('#listar-venda').DataTable().destroy();
        fetch_data(data_inicial, data_final, token);

    });


});
    
</script>
<style>
.dt-buttons{
    margin-left:20%; 
}
</style>
@endpush
@stop
