@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Visão Geral</h3>
    </div>
</div>  
<div>
    <section class="content">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h4>Produtos Cadastrados</h4>
                    <h2>{{$produtos}}</h2>
                </div>
                <div class="icon">
                    <i class="fa fa-cube" area-hidden="true"></i>
                </div>
            </div>
        </div>        
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h4>Quantidade de produtos no estoque</h4>
                    <h2>{{$qtdProdutosEstoque}}</h2>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                </div>
            </div>
        </div>        
        <div class="col-sm-4 col-md-4 col-lg-4">
            <a href="relatorios/produtos/estoque-minimo">
            <div class="small-box bg-red">                
                <div class="inner">
                    <h4>Produtos com estoque baixo</h4>
                    <h2>{{$estoqueBaixo}}</h2>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box" style="background-color: purple; color: white">
                <div class="inner">
                    <h4>Valor total do estoque</h4>
                    <h2>R$ <?php echo number_format($valorDoEstoque, 2, ',', '.') ?></h2>
                </div>
                <div class="icon">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h4>Quantidade de vendas no mês</h4>
                    <h2>{{$totalVendas[0]->quantidade}}</h2>                    
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h4>Valor total das vendas no mês</h4>
                    <h2>R$ <?php echo number_format($totalVendas[0]->total_venda, 2, ',', '.')?></h2>
                </div>
                <div class="icon">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</section>
</div>   
@stop
