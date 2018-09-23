@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Listar Relatórios de Vendas</h3>
    </div>
</div>  
<div>
    <section class="content">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h4>Vendas por cliente</h4>
                    <p>Relatório de clientes, filtro por tipo, situação, nome, telefone, e-mail e período.</p>
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
                    <p>Relatório de produtos, filtro por grupo, situação, nome, código e particularidade.</p>
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
    </div>
</section>
</div>   
@stop
