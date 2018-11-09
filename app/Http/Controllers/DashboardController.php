<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use emporiodovinho\Venda;
class DashboardController extends Controller
{
    public function getPrincipal(){
    	$produtosCadastrados = DB::table('produto')->get();
    	$produtos = count($produtosCadastrados);
    	
    	$qtdProdutosEstoque = 0;
    	$valorDoEstoque = 0;
    	foreach ($produtosCadastrados as $produto) {
    		$qtdProdutosEstoque += $produto->estoque;
    		$valorDoEstoque += $produto->estoque * $produto->preco_compra;
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

    public function getDashboard(){
        $vendas = DB::table('venda')->select(DB::raw('CONCAT(LPAD(MONTH(data_hora), 2, "0"), "/", YEAR(data_hora)) mes, COUNT(id_venda) total_venda'))
            ->groupBy(DB::raw('YEAR(data_hora), MONTH(data_hora)'))->get();

        $meses = $this->getDados($vendas);

        $produtosMaisVendidos = DB::table('detalhe_venda as dv')->select(DB::raw('p.nome as nome, sum(dv.quantidade) as quantidade'))
                                ->join('produto as p', 'p.id_produto', '=', 'dv.id_produto')
                                ->groupBy('dv.id_produto')
                                ->orderBy('quantidade', 'desc')
                                ->limit(5)
                                ->get();
        $receitas = DB::table("venda")->select(DB::raw('sum(total_venda) as total_venda'))->get();
        $despesas = DB::table("entrada")->select(DB::raw('sum(total_entrada) as total_entrada'))->get();

        $receitas_mensal = DB::table("venda")->select(DB::raw('CONCAT(LPAD(MONTH(data_hora), 2, "0"), "/", YEAR(data_hora)) mes, SUM(total_venda) total_venda'))
            ->groupBy(DB::raw('YEAR(data_hora), MONTH(data_hora)'))->get();


        $despesas_mensal = DB::table("entrada")->select(DB::raw('CONCAT(LPAD(MONTH(data_hora), 2, "0"), "/", YEAR(data_hora)) mes, SUM(total_entrada) total_venda'))
            ->groupBy(DB::raw('YEAR(data_hora), MONTH(data_hora)'))->get();


        $receitas_mensal = $this->getDados($receitas_mensal);
        $despesas_mensal = $this->getDados($despesas_mensal);

        $percentual = 0;
        if( $despesas[0]->total_entrada != 0){
            $percentual = (($receitas[0]->total_venda - $despesas[0]->total_entrada) / $despesas[0]->total_entrada) * 100;    
        }
        

        return view('dashboard', ["meses"=>$meses , "produtosMaisVendidos"=>$produtosMaisVendidos, "receitas"=>$receitas, "despesas"=>$despesas, "percentual"=>$percentual, "receitas_mensal"=>$receitas_mensal, "despesas_mensal"=>$despesas_mensal]);
    }

    function getDados($dados){
        $meses = [  "01" => 0,
                    "02" => 0,
                    "03" => 0,
                    "04" => 0,
                    "05" => 0,
                    "06" => 0,
                    "07" => 0,
                    "08" => 0,
                    "09" => 0,
                    "10" => 0,
                    "11" => 0,
                    "12" => 0
        ];

        foreach ($dados as $key => $value) {           
            if(array_key_exists(substr($value->mes, 0, 2), $meses)){                
                $meses[substr($value->mes, 0, 2)] = $value->total_venda;
            }
        }

        return $meses;
    }
}
