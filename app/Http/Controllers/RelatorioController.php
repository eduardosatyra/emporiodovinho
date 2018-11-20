<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DataTables\RelatoriosDatatable;
use emporiodovinho\User;
use Yajra\Datatables\Datatables;

class RelatorioController extends Controller {
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return view('relatorios.vendas.dashboard');

    }

    public function produtos(){
        $produtos=DB::table('produto as pro')
        ->select('pro.id_produto', 'pro.nome')
        ->where('pro.status', '=', 'Ativo')
        ->get();

        $categorias=DB::table('categoria')
    	->where('condicao', '=', '1')
    	->get();
        return view('relatorios.produtos.formulario', ["produtos"=>$produtos, "categorias"=>$categorias]);
    }

    public function vendasCliente(){
        $cliente=DB::table('cliente')->get();
        return view('relatorios.vendas.cliente', ["cliente"=>$cliente]);
    }

    public function getVendas(Request $request){
        $data_inicial = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_inicial)));
        $data_final = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_final)));
        $data = DB::table('venda')
                        ->join('cliente', 'cliente.id_cliente', '=', 'venda.id_cliente')
                        ->select('cliente.nome', 'venda.tipo_pagamento', 'venda.data_hora', 'venda.total_venda')
                        ->whereRaw("date(venda.data_hora) BETWEEN DATE('$data_inicial') AND DATE('$data_final')")
                        ->get();
        foreach ($data as $key => $value) {
             $value->total_venda = 'R$ '.number_format($value->total_venda, 2, ',', '.');
             $value->data_hora = date('d/m/Y H:i:s', strtotime($value->data_hora)); 
        }             
        return response()->json($data);   
    }

    public function getProdutosVendidos(Request $request){
        $produto = $request->produto == 'all' ? false : $request->produto;
        $data_inicial = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_inicial)));
        $data_final = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_final)));
        $data = DB::table('detalhe_venda')
                        ->join('produto', 'produto.id_produto', '=', 'detalhe_venda.id_produto')
                        ->join('categoria', 'categoria.id_categoria', '=', 'produto.id_categoria')
                        ->join('venda', 'venda.id_venda', '=', 'detalhe_venda.id_venda')
                        ->select( DB::raw('produto.codigo as cod, produto.nome as produto, categoria.nome as categoria, sum(detalhe_venda.faturamento) as faturamento ,sum( detalhe_venda.quantidade ) as quantidade, sum(detalhe_venda.faturamento)  / sum(detalhe_venda.quantidade)  as ticket ') )
                        ->whereRaw("date(venda.data_hora) BETWEEN DATE('$data_inicial') AND DATE('$data_final')")
                        ->where("produto.status", "=", "Ativo")
                        ->when($produto, function ($query, $produto) {
                            return $query->where('detalhe_venda.id_produto', $produto);
                        })
                        ->groupBy('detalhe_venda.id_produto')
                        ->orderBy('quantidade', 'desc')                        
                        ->get();
        foreach ($data as $key => $value) {
            $value->ticket = 'R$ '.number_format($value->ticket, 2, ',', '.');
            $value->faturamento = 'R$ '.number_format($value->faturamento, 2, ',', '.');            
        } 

        return response()->json($data);   
    }

    public function getEstoqueMinimo(){
        return view('relatorios.produtos.estoque-minimo');        
    }

    public function estoqueMinimo(){
        $data=DB::table('produto')
        ->select('produto.*', 'categoria.nome as categoria')
        ->join('categoria', 'categoria.id_categoria', '=', 'produto.id_categoria')
        ->whereRaw("estoque <= estoque_minimo")
        ->where('status', '=', 'Ativo')
        ->get();        

        foreach ($data as $key => $value) {
            $value->preco_venda = 'R$ '.number_format($value->preco_venda, 2, ',', '.');            
        } 

        return response()->json($data);        
    }

    
}
