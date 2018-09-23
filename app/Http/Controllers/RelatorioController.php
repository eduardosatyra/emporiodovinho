<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

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
        ->where('pro.estado', '=', 'Ativo')
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

    public function buscaVendasCliente(Request $request){
        $role = $request->id_cliente;
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $vendasCliente = DB::table('venda')
                        ->join('cliente', 'cliente.id_cliente', '=', 'venda.id_cliente')
                        ->select('cliente.nome', 'venda.tipo_pagamento', 'venda.data_hora', 'venda.total_venda')
                        ->where('data_hora' ,'>=' , $data_inicial)
                        ->where('data_hora' ,'<=' , $data_final)
                        ->when($role, function ($query, $role) {
                            return $query->where('venda.id_cliente', $role);
                        })
                        ->get();

        return response()->json($vendasCliente);

    }

    
}
