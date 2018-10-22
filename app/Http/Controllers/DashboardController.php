<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function getDashboard(){
    	$produtosCadastrados = DB::table('produto')->where('status', '=', 'Ativo')->get();
    	$produtos = count($produtosCadastrados);
    	
    	$qtdProdutosEstoque = 0;
    	$valorDoEstoque = 0;
    	foreach ($produtosCadastrados as $produto) {
    		$qtdProdutosEstoque += $produto->estoque;
    		$valorDoEstoque += $produto->estoque * $produto->preco_venda;
    	}
    	$estoqueBaixo = DB::table('produto')
	        ->whereRaw("estoque <= estoque_minimo")
	        ->where('status', '=', 'Ativo')
	        ->count();
        $dataInicio = date("Y")."-".date("m")."-"."01";
        $dataAtual = date('Y-m-d');
        $totalVendas = DB::table('venda')
        			->select( DB::raw('count(id_venda) as quantidade, sum(total_venda) as total_venda'))
        			->whereRaw("date(data_hora) BETWEEN DATE('$dataInicio') AND DATE('$dataAtual')")
        			->get();



    	return view('principal' ,[
                "produtos"=>$produtos, "qtdProdutosEstoque"=>$qtdProdutosEstoque, "valorDoEstoque"=>$valorDoEstoque, "estoqueBaixo"=>$estoqueBaixo, "totalVendas"=>$totalVendas
                ]); 
    }
}
