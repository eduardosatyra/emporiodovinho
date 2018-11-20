@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Dashboard</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4 style="font-weight: bold; padding-left: 30%;" class="col-md-12">Total de vendas por mês</h4>
        <canvas id="bar-chart" width="400" height="300"></canvas>        
    </div>
    <div class="col-md-6">
        <h4 style="font-weight: bold; padding-left: 30%;" class="col-md-12">Produtos mais vendidos</h4>
        <canvas id="bar-chart-produtos" width="400" height="300"></canvas>        
    </div>
</div>
<div class="row" style="display: flex; justify-content: center; margin-top: 100px;">
    <h2 style="font-weight: bold">Fluxo de Caixa</h2>
</div>
<div class="row">
    <div class="content" style="display: flex; justify-content: space-between;">
        <div class="small-box bg-green" style="width: 24%;  height: 20%; padding: 1%;">
            <h4>Vendas Geral</h4>        
            <p style="font-size: 30px;">R$ <?php echo number_format($receitas[0]->total_venda, 2, ',', '.')?></p>
            <div class="icon">
                <i class="fa fa-usd" aria-hidden="true"></i>
            </div>
        </div>
        <div class="small-box bg-red" style="width: 24%; height: 20%; padding: 1%;">
            <h4>Despesas de Produtos</h4>
            <p style="font-size: 30px;">R$ <?php echo number_format($despesas[0]->total_entrada, 2, ',', '.')?></p>
            <div class="icon">
                <i class="fa fa-money" aria-hidden="true"></i>
            </div>        
        </div>
        <?php
            $color = 'bg-green';
            $info = 'Lucro';
            if ($receitas[0]->total_venda - $despesas[0]->total_entrada < 0) {
                $color = 'bg-red';
                $info = 'Prejuízo';
            }
        ?>
        <div class="small-box <?php echo $color ?> " style="width: 24%; height: 20%; padding: 1%;">
            <h4><?php echo $info ?></h4>
            <p style="font-size: 30px;">R$ <?php echo number_format($receitas[0]->total_venda - $despesas[0]->total_entrada, 2, ',', '.')?></p>        
            <div class="icon">
                <i class="fa fa-line-chart" aria-hidden="true"></i>
            </div>        
        </div>
        <div class="small-box bg-purple" style="width: 24%; height: 20%; padding: 1%;">
            <h4><?php echo $info ?> %</h4>
            <p style="font-size: 30px;"><?php echo number_format($percentual, 2,',', '.') ?>%</p>
            <div class="icon">
                <i class="fa fa-percent" aria-hidden="true"></i>
            </div>        
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <canvas id="pie-chart" width="400" height="300"></canvas>    
    </div>
    <div class="col-md-7">
        <canvas id="line-chart" width="400" height="300"></canvas>    
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

var despesas =  <?php echo $despesas[0]->total_entrada ?>;
var receitas = <?php echo $receitas[0]->total_venda ?>;

 var options = {
        scaleFontFamily: "'Verdana'",
        scaleFontSize: 13,
        animation: false,
        responsive: true,
          tooltips: {
    callbacks: {
      label: (tooltipItem, data) => {
        return formatMoney(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
      },
    },
  },        
          title: {
            display: true,
            text: 'Vendas Geral x Despesas de Produtos (Geral)'
          }
    };

    var data = {
        labels: ["Despesas de Produtos", "Vendas Geral"],
        datasets: [
            {
                backgroundColor: [ "#FF0000","#3CB371"],
                strokeColor: "rgba(0,145,255,1)",
                pointColor: "rgba(0,145,255,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0,145,255,1)",
                data: [despesas, receitas]
            }

        ]
    };

var ctx = $("#pie-chart");
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
    options: options
});


 var options = {
        scaleFontFamily: "'Verdana'",
        scaleFontSize: 13,
        animation: false,
        responsive: true,
            scales: {
        yAxes: [
            {
                ticks: {
                    callback: function(label, index, labels) {
                        return formatMoney(label);
                    }
                }
            }
        ]
    },
          tooltips: {
    callbacks: {
      label: (tooltipItem, data) => {
        return formatMoney(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
      },
    },
  },        
          title: {
            display: true,
            text: 'Vendas x Despesas (Mensais)'
          }
    };

    var data = {        
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        datasets: [
            {
                label: "Despesas no mês",
                backgroundColor:"transparent",
                borderWidth: 3,
                borderColor: 'rgba(229,25,25,0.85)',
                data: [ {{$despesas_mensal["01"]}},
                    {{$despesas_mensal["02"]}},
                    {{$despesas_mensal["03"]}},
                    {{$despesas_mensal["04"]}},
                    {{$despesas_mensal["05"]}},
                    {{$despesas_mensal["06"]}},
                    {{$despesas_mensal["07"]}},
                    {{$despesas_mensal["08"]}},
                    {{$despesas_mensal["09"]}},
                    {{$despesas_mensal["10"]}},
                    {{$despesas_mensal["11"]}},
                    {{$despesas_mensal["12"]}},
            ],

        },
        {
                label: "Receitas no mês",
                backgroundColor:"transparent",
                borderWidth: 3,
                borderColor: 'rgba(9,174,9,0.85)',
                data: [ {{$receitas_mensal["01"]}},
                    {{$receitas_mensal["02"]}},
                    {{$receitas_mensal["03"]}},
                    {{$receitas_mensal["04"]}},
                    {{$receitas_mensal["05"]}},
                    {{$receitas_mensal["06"]}},
                    {{$receitas_mensal["07"]}},
                    {{$receitas_mensal["08"]}},
                    {{$receitas_mensal["09"]}},
                    {{$receitas_mensal["10"]}},
                    {{$receitas_mensal["11"]}},
                    {{$receitas_mensal["12"]}},
            ],

        }

        ],
    };

var ctx = $("#line-chart");
var myPieChart = new Chart(ctx,{
    type: 'line',
    data: data,
    options: options
});


function formatMoney(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return 'R$ ' + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

</script>
@endpush
@stop
