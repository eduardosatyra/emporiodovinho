<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Entrada;
use emporiodovinho\DetalheEntrada;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\EntradaFormRequest;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 

class EntradaController extends Controller {

    public function __construct(){
    	//
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $entradas = DB::table('entrada as e')
            ->join('pessoa as p', 'e.id_fornecedor', '=' , 'p.id_pessoas')
            ->join('detalhe_entrada as de', 'e.id_entrada', '=' , 'de.id_entrada')
            ->select('e.id_entrada', 'e.data_hora', 'p.nome', 'e.tipo_comprovante','e.serie_comprovante','e.num_comprovante', 'e.taxa', 'e.estado', DB::raw('sum(de.quantidade*preco_compra) as total'))
            ->where('estado' , '=' , 'A')
            ->where('e.num_comprovante', 'LIKE', '%'.$query.'%')
            ->orderBy('e.id_entrada', 'desc')
            ->groupBy('e.id_entrada', 'e.data_hora', 'p.nome', 'e.tipo_comprovante','e.serie_comprovante', 'e.num_comprovante' ,'e.taxa', 'e.estado')
            ->paginate(7);          

            return view('compra.entrada.index', [
                "entradas"=>$entradas, "searchText"=>$query
                ]); 
        }
    }

    public function create(){
    	$pessoas=DB::table('pessoa')
        ->where('tipo_pessoa', '=' , 'Fornecedor')->get();
        $produtos=DB::table('produto as pro')
        ->select('pro.id_produto', 'pro.nome')
        ->where('pro.estado', '=', 'Ativo')
        ->get();
        return view('compra.entrada.create', ["pessoas"=>$pessoas, "produtos"=>$produtos]);
    }

    public function store(EntradaFormRequest $request){

        try{
            DB::beginTransaction();
            $entrada = new Entrada;
            $entrada->id_fornecedor=$request->get('id_fornecedor');
            $entrada->tipo_comprovante=$request->get('tipo_comprovante');
            $entrada->serie_comprovante=$request->get('serie_comprovante');
            $entrada->num_comprovante=$request->get('num_comprovante');            
            $mytime = Carbon::now('America/Sao_Paulo');
            $entrada->data_hora=$mytime->toDateTimeString();
            $entrada->taxa='0';
            $entrada->estado='A';
            $entrada->save();

            $id_produto=$request->get('id_produto');
            $quantidade=$request->get('quantidade');
            $preco_compra=$request->get('preco_compra');
            $preco_venda=$request->get('preco_venda'); 

            $cont = 0;
            while($cont < count($id_produto)) {
                $detalhe = new DetalheEntrada();
                $detalhe->id_entrada=$entrada->id_entrada;
                $detalhe->id_produto=$id_produto[$cont];
                $detalhe->quantidade=$quantidade[$cont];
                $detalhe->preco_compra=$preco_compra[$cont];
                $detalhe->preco_venda=$preco_venda[$cont];
                $detalhe->save();
                $cont=$cont+1;

            }

             DB::commit();            
       }catch(\Exception $e){
            DB::rollback();
       }
    	return Redirect::to('compra/entrada');
    }

    public function show($id){
        $entrada = DB::table('entrada as e')
            ->join('pessoa as p', 'e.id_fornecedor', '=' , 'p.id_pessoas')
            ->join('detalhe_entrada as de', 'e.id_entrada', '=' , 'de.id_entrada')
            ->select('e.id_entrada', 'e.data_hora', 'p.nome', 'e.tipo_comprovante','e.serie_comprovante', 'e.num_comprovante', 'e.taxa', 'e.estado', DB::raw('sum(de.quantidade*preco_compra) as total'))
            ->where('e.id_entrada' , '=' , $id)
            ->groupBy('e.id_entrada', 'e.data_hora', 'p.nome', 'e.tipo_comprovante','e.serie_comprovante', 'e.num_comprovante' ,'e.taxa', 'e.estado')
            ->first();            
            $detalhes=DB::table('detalhe_entrada as d')
            ->join('produto as p', 'd.id_produto', '=', 'p.id_produto')
            ->select('p.nome as produto', 'd.quantidade', 'd.preco_compra', 'd.preco_venda')
            ->where('d.id_entrada', '=' , $id)
            ->get();
    	return view("compra.entrada.show",
    		["entrada"=>$entrada, "detalhes"=>$detalhes ]);
    }

    public function destroy($id){
    	$entrada=Entrada::findOrFail($id);
    	$entrada->estado='C';
    	$entrada->update();
    	return Redirect::to('compra/entrada');
    }
}
