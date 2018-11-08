@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Principal</h3>
    </div>
</div>
<div class="box box-primary padding-bottom-0">
    <section class="content">
        <h3>Acesso Rápido</h3>
        <table width="100%" border="0" cellpadding="5" cellspacing="5">
            <tbody>
                <tr>
                    <td>
                        <a href="cliente/cliente/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-user text-primary"></i>Cadastrar Clientes
                        </a>
                    </td>
                    <td>
                        <a href="produto/produto/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-suitcase text-primary"></i>Cadastrar Produtos
                        </a>
                    </td>
                    <td>
                        <a href="produto/categoria/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-folder text-primary"></i>Cadastrar Categorias
                        </a>
                    </td>
                    <td>
                        <a href="fornecedor/fornecedor/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-truck text-primary"></i>Cadastrar Fornecedores
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="usuario/usuario/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-users text-primary"></i>Cadastrar Usuários
                        </a>
                    </td>
                    <td>
                        <a href="relatorios/vendas" class="btn btn-app" style="width:50%">
                            <i class="fa fa-bar-chart text-primary"></i>Visualizar Relatórios
                        </a>
                    </td>
                    <td>
                        <a href="venda/venda/create" class="btn btn-app" style="width:50%">
                            <i class="fa fa-shopping-cart text-primary"></i>Vendas
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
<div class="box box-primary padding-bottom-0">
    <section class="content">
        <h3>Visão Geral</h3>
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
