<?php

namespace emporiodovinho\Http\Controllers;
use Illuminate\Http\Request;
use emporiodovinho\Saida;
use emporiodovinho\DetalheSaida;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\SaidaFormRequest;
use DB;
use Auth;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class SaidaController extends Controller {
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $saidas = DB::table('saida as s')
            ->join('users as u', 's.id_usuario', '=' , 'u.id')            
            ->join('detalhe_saida as ds', 's.id_saida', '=' , 'ds.id_saida')
            ->join('produto as p', 'ds.id_produto', '=', 'p.id_produto')
            ->select('s.id_saida', 's.data_hora', 'u.name', 'ds.motivo', 'p.nome', 'ds.quantidade')
            ->where('s.id_saida', 'LIKE', '%'.$query.'%')
            ->orderBy('s.id_saida', 'desc')
            ->groupBy('s.id_saida', 's.data_hora', 'u.name')
            ->paginate(7);


            return view('estoque.saida.index', [
                "saidas"=>$saidas, "searchText"=>$query
                ]); 
        }
    }

    public function create(){
        $produtos=DB::table('produto as pro')
        ->select('pro.id_produto', 'pro.nome', 'pro.estoque')
        ->where('pro.status', '=', 'Ativo')
        ->get();
        return view('estoque.saida.create', ["produtos"=>$produtos]);
    }

    public function store(SaidaFormRequest $request){
        $saida = new Saida;
        $saida->id_usuario = Auth::id();            
        $mytime = Carbon::now('America/Sao_Paulo');
        $saida->data_hora=$mytime->toDateTimeString();
        $saida->save();

        $id_produto=$request->get('id_produto');
        $quantidade=$request->get('quantidade');
        $motivo=$request->get('motivo'); 

        $cont = 0;
        while($cont < count($id_produto)) {
            $detalhe = new DetalheSaida();
            $detalhe->id_saida=$saida->id_saida;
            $detalhe->id_produto=$id_produto[$cont];
            $detalhe->quantidade=$quantidade[$cont];
            $detalhe->motivo=$motivo[$cont];
            $detalhe->save();
            $cont=$cont+1;

        }

    	return Redirect::to('estoque/saida');
    }

    public function show($id){
        $saida = DB::table('saida as s')
            ->join('users as u', 's.id_usuario', '=' , 'u.id')
            ->join('detalhe_saida as ds', 's.id_saida', '=' , 'ds.id_saida')
            ->select('s.id_saida', 's.data_hora', 'u.name')
            ->where('s.id_saida' , '=' , $id)
            ->groupBy('s.id_saida', 's.data_hora', 'u.name')
            ->first();            
            $detalhes=DB::table('detalhe_saida as ds')
            ->join('produto as p', 'ds.id_produto', '=', 'p.id_produto')
            ->select('p.nome', 'ds.quantidade', 'ds.motivo')
            ->where('ds.id_saida', '=' , $id)
            ->get();
    	return view("estoque.saida.show",
    		["saida"=>$saida, "detalhes"=>$detalhes ]);
    }

    /*public function destroy($id){
    	$entrada=Entrada::findOrFail($id);
    	$entrada->estado='C';
    	$entrada->update();
    	return Redirect::to('estoque/entrada');
    }*/
}
