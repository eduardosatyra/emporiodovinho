@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Relatórios disponíveis</h3>
    </div>
</div>  
<div>
    <section class="content">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h4>Relatório de vendas</h4>
                    <p>Relatório de vendas, filtro por data, cliente.</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a class="small-box-footer" href="/relatorios/vendas/cliente">
                    Clique aqui
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h4>Produtos mais vendidos</h4>
                    <p>Relatório de produtos, filtro por data</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube"></i>
                </div>
                <a class="small-box-footer" href="/relatorios/produtos">
                    Clique aqui
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h4>Produtos com estoque minimo atingido</h4>
                    <p>Relatório de produtos com estoque baixo.</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-cubes"></i>
                </div>
                <a class="small-box-footer" href="/relatorios/produtos/estoque-minimo">
                    Clique aqui
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
</div>   
@stop
