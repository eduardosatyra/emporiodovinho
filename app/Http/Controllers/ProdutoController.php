<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Produto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use emporiodovinho\Http\Requests\ProdutoFormRequest;
use DB;

class ProdutoController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request->get('searchText')){
            $query=trim($request->get('searchText'));
            $produtos=DB::table('produto as p')
            ->join('categoria as c', 'p.id_categoria', '=', 'c.id_categoria')
            ->select('p.id_produto', 'p.nome', 'p.preco_venda', 'p.codigo', 'p.estoque', 'c.nome as categoria', 'p.descricao', 'p.status')
           
            ->orWhere('p.nome', 'LIKE', '%'.$query.'%')                    
            ->orderBy('id_produto', 'desc')
            ->paginate(10);
            return view('produto.produto.index', [
                "produtos"=>$produtos, "searchText"=>$query
                ]);
        }

        $produtos=DB::table('produto as p')
            ->join('categoria as c', 'p.id_categoria', '=', 'c.id_categoria')
            ->select('p.id_produto', 'p.nome', 'p.preco_venda', 'p.codigo', 'p.estoque', 'c.nome as categoria', 'p.descricao', 'p.status')                       
            ->paginate(10);
            return view('produto.produto.index', [
                "produtos"=>$produtos, "searchText"=>''
                ]);
    }

    public function create(){

    	$categorias=DB::table('categoria')
    	->where('condicao', '=', '1')
    	->get();

    	return view("produto.produto.create", ["categorias"=>$categorias]);
    }

    public function store(ProdutoFormRequest $request){
    	$produto = new Produto;
    	$produto->id_categoria=$request->get('id_categoria');
    	$produto->codigo=$request->get('codigo');
    	$produto->nome=$request->get('nome');
    	$produto->estoque=$request->get('estoque');
        $produto->estoque_minimo=$request->get('estoque_minimo');
		$produto->preco_compra=$request->get('preco_compra');
		$produto->preco_venda=$request->get('preco_venda');
    	$produto->descricao=$request->get('descricao');
    	$produto->status=$request->get('status');  	

    	$produto->save();
    	return Redirect::to('produto/produto');
    }

    public function show($id){
    	return view("produto.produto.show",
    		["produto"=>Categoria::findOrFail($id) ]);
    }

    public function edit($id){

    	$produto = Produto::findOrFail($id);
    	$categorias = DB::table('categoria')->where('condicao', '=', '1')->get();

    	return view("produto.produto.edit",
    		["produto"=>$produto, "categorias"=>$categorias]);
    }

    public function update(ProdutoFormRequest $request, $id){
    	$produto=Produto::findOrFail($id);

		$produto->id_categoria=$request->get('id_categoria');
    	$produto->codigo=$request->get('codigo');
    	$produto->nome=$request->get('nome');
        $produto->estoque=$request->get('estoque');
        $produto->estoque_minimo=$request->get('estoque_minimo');
		$produto->descricao=$request->get('descricao');
		$produto->preco_compra=$request->get('preco_compra');
		$produto->preco_venda=$request->get('preco_venda');
    	
    	//$categoria->condicao=$request->get('condicao');
    	$produto->update();
    	return Redirect::to('produto/produto');
    }

    public function destroy($id){
    	$produto=Produto::findOrFail($id);
    	$produto->status='Inativo';
    	$produto->update();
    	return Redirect::to('produto/produto');
    }
}
