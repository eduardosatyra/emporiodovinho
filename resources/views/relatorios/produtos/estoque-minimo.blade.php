@extends('layouts.admin')
@section('conteudo')
<div class="row" style="margin-left: 10px;">
    <h2>Lista de produtos com estoque baixo</h2>
</div>
<table id="listar-produtos" class="display" style="width:100%">
    <thead>
        <tr>                
            <th>Código</th>
            <th>Produto</th>
            <th>Valor de Venda</th>
            <th>Quantidade</th>
        </tr>
    </thead>
</table>
@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script>
$(document).ready(function() {
        $('#listar-produtos').DataTable({
            "processing": true,
            "serverSide": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                "type": "GET",
                "url": "{{route('relatorio.produto.estoque-minimo')}}",
                "dataSrc":""                       
            },
            dom: 'Bfrtip',
                    buttons: [
                    'excel', 'pdf', 'print'
                    ],
                    "columns": [
                    { "data": "codigo" },
                    { "data": "nome" },
                    { "data": "preco_venda" },
                    { "data": "estoque" }
                ]    

        });        
    });

    
</script>
@endpush
@stop
