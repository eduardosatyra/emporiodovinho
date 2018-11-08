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
            <th>Nome</th>
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
            dom: 'Bfrtip',
                    buttons: [
                    'excel', 'pdf', 'print'
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
@endpush
@stop
