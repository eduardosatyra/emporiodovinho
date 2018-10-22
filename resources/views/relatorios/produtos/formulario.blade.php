@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div style="margin-left: 10px; margin-bottom: 20px;" class="col-md-9">
        <span>Período de: </span>
        <input type="text" id="data_inicial"><i class="fa fa-calendar" aria-hidden="true"></i>
        <span style="margin-left: 10px; margin-right: 10px;">até:</span>
        <input type="text" id="data_final"><i class="fa fa-calendar" aria-hidden="true"></i>
        <div class="pull-right">
            <select name="id_produto" id="id_produto" class="selectpicker" data-live-search="true">
               <option value="all">Selecione um produto..</option>
                @foreach($produtos as $pro)                                    
                    <option value="{{$pro->id_produto}}">
                    {{$pro->nome}}
                    </option>
                @endforeach
            </select>
            <button style="background: #2196F3; color: white; margin-left: 10px;" id="filtro">Filtrar</button>
        </div>        
    </div>
</div>
<table id="listar-produtos" class="display" style="width:100%">
    <thead>
        <tr>                
            <th>Código</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Quantidade</th>
            <th>Preço de venda</th>
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

    function fetch_data(data_inicial, data_final, token, produto){

        $('#listar-produtos').DataTable({
            "processing": true,
            "serverSide": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                "type": "POST",
                "url": "{{route('relatorio.produto')}}",
                "dataSrc":"",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    data_inicial:data_inicial, data_final:data_final, token:token, produto:produto

                }                       
            },
            "order": [[ 3, "desc" ]],
            dom: 'Bfrtip',
                    buttons: [
                    'excel', 'pdf', 'print'
                    ],
                    "columns": [
                    { "data": "cod" },
                    { "data": "produto" },
                    { "data": "categoria" },
                    { "data": "quantidade" },
                    { "data": "preco_venda" }
                ]    

        });        
    }

    $('#filtro').click(function(){
        var data_inicial = $('#data_inicial').val();
        var data_final = $('#data_final').val(); 
        var token = "{{ csrf_token() }}";
        var produto = $("#id_produto option:selected").val();
        
        $('#listar-produtos').DataTable().destroy();
        fetch_data(data_inicial, data_final, token, produto);

    });


});
    
</script>
@endpush
@stop
