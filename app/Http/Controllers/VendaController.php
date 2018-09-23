<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Venda;
use emporiodovinho\DetalheVenda;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\VendaFormRequest;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 


class VendaController extends Controller {
     public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $vendas = DB::table('venda as v')
            ->join('cliente as c', 'v.id_cliente', '=' , 'c.id_cliente')
            ->select('v.id_venda', 'v.data_hora', 'c.nome', 'v.tipo_pagamento', 'v.total_venda')         
            ->where('v.id_venda', 'LIKE', '%'.$query.'%')
            ->orderBy('v.id_venda', 'desc')
            ->paginate(10);    

            return view('venda.venda.index', [
                "vendas"=>$vendas, "searchText"=>$query
                ]); 
        }
    }

    public function create(){
    	$cliente=DB::table('cliente')->get();
        $produtos=DB::table('produto as pro')        
        ->select('pro.id_produto', 'pro.nome', 'pro.estoque', 'pro.preco_venda')
        ->where('pro.estado', '=', 'Ativo')
        ->where('pro.estoque', '>' , '0')
        ->get();
        return view('venda.venda.create', ["cliente"=>$cliente, "produtos"=>$produtos]);
    }

    public function store(VendaFormRequest $request){

        $venda = new Venda;
        $venda->id_cliente=$request->get('id_cliente');
        $venda->tipo_pagamento=$request->get('tipo_pagamento');            
        $mytime = Carbon::now('America/Sao_Paulo');
        $venda->data_hora=$mytime->toDateTimeString();
        $venda->total_venda=$request->get('total_venda');
        $venda->save();

        $id_produto=$request->get('id_produto');
        $quantidade=$request->get('quantidade');
        $desconto=$request->get('desconto');
        $preco_venda=$request->get('preco_venda'); 

        $cont = 0;
        while($cont < count($id_produto)) {
            $detalhe = new DetalheVenda();
            $detalhe->id_venda=$venda->id_venda;
            $detalhe->id_produto=$id_produto[$cont];
            $detalhe->quantidade=$quantidade[$cont];
            $detalhe->desconto=$desconto[$cont];
            $detalhe->preco_venda=$preco_venda[$cont];
            $detalhe->save();
            $cont=$cont+1;

        }
            
    	return Redirect::to('venda/venda');
    }

    public function show($id){
        $venda = DB::table('venda as v')
            ->join('cliente as c', 'v.id_cliente', '=' , 'c.id_cliente')
            ->join('detalhe_venda as dv', 'v.id_venda', '=' , 'dv.id_venda')
            ->select('v.id_venda', 'v.data_hora', 'c.nome', 'v.tipo_pagamento', 'v.total_venda')
            ->where('v.id_venda' , '=' , $id)
            ->first();            
            $detalhes=DB::table('detalhe_venda as d')
            ->join('produto as p', 'd.id_produto', '=', 'p.id_produto')
            ->select('p.nome as produto', 'd.quantidade', 'd.desconto', 'd.preco_venda')
            ->where('d.id_venda', '=' , $id)
            ->get();
    	return view("venda.venda.show",
    		["venda"=>$venda, "detalhes"=>$detalhes ]);
    }
}
