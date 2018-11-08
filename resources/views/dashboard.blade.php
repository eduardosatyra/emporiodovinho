@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Dashboard</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4>Total de vendas por mês</h4>
        <canvas id="bar-chart"></canvas>        
    </div>
    <div class="col-md-6">
        <h4>Produtos mais vendidos</h4>
        <canvas id="bar-chart-produtos"></canvas>        
    </div>
</div>

@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>

<script>
 var ctx = $("#bar-chart");
 var chartGraph = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        datasets: [{
            label: 'Total de vendas por mês',
            data: [ {{$meses["01"]}},
                    {{$meses["02"]}},
                    {{$meses["03"]}},
                    {{$meses["04"]}},
                    {{$meses["05"]}},
                    {{$meses["06"]}},
                    {{$meses["07"]}},
                    {{$meses["08"]}},
                    {{$meses["09"]}},
                    {{$meses["10"]}},
                    {{$meses["11"]}},
                    {{$meses["12"]}},
            ],
            backgroundColor: [
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)',
                'rgba(77, 200, 167, 0.85)'
            ],
            borderColor: [
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)',
                'rgba(77, 200, 167, 1)'
            ],
            borderWidth: 1
        }]
    }
 });
 

 var ctx = $("#bar-chart-produtos");
 var chartGraph = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: [   
                    @foreach ($produtosMaisVendidos as $produtos)
                        "{{$produtos->nome}}",
                    @endforeach 
                    ],


        datasets: [{
            label: 'Quantidade de produtos vendidos',
            data: [ 
                    @foreach ($produtosMaisVendidos as $produtos)
                        "{{$produtos->quantidade}}",
                    @endforeach                    
            ],
            backgroundColor: [
                 @foreach ($produtosMaisVendidos as $produtos)
                        'rgba(77, 166, 253, 0.85)',
                 @endforeach        
            ],
            borderColor: [
                @foreach ($produtosMaisVendidos as $produtos)
                        'rgba(77, 166, 253, 1)',
                 @endforeach
                
            ],
            borderWidth: 1
        }]
    }
 });
</script>
@endpush
@stop
