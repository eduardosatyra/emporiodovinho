<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Produto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Illuminate\Validation\Rule;

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
            ->orderBy('id_produto', 'desc')                       
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

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_categoria'=>'required',
            'codigo'=>'required|max:99999|numeric|unique:produto',
            'nome'=>'required|max:200|unique:produto',
            'estoque_minimo'=>'required|numeric',
            'preco_compra'=>'required',
            'preco_venda'=>'required',
        ]);        
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$produto = new Produto;
    	$produto->id_categoria=$request->get('id_categoria');
    	$produto->codigo=$request->get('codigo');
    	$produto->nome=$request->get('nome');
        $produto->estoque_minimo=$request->get('estoque_minimo');
		$produto->preco_compra= str_replace(',','.',str_replace('.','',$request->get('preco_compra')));
		$produto->preco_venda=str_replace(',','.',str_replace('.','',$request->get('preco_venda')));
    	$produto->descricao=$request->get('descricao');
    	$produto->status=$request->get('status');
    	$produto->save();
        flash('Produto cadastrado com sucesso.')->success();
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

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id_categoria'=>'required',           
            'estoque_minimo'=>'required|numeric',
            'preco_compra'=>'required',
            'preco_venda'=>'required',
            'codigo' => [
                'required','max:99999', 'numeric',
                Rule::unique('produto')->ignore($id, 'id_produto'),
            ],
            'nome' => [
                'required','max:200',
                Rule::unique('produto')->ignore($id, 'id_produto'),
            ],
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
    	$produto=Produto::findOrFail($id);

		$produto->id_categoria=$request->get('id_categoria');
    	$produto->codigo=$request->get('codigo');
    	$produto->nome=$request->get('nome');
        $produto->estoque=$request->get('estoque');
        $produto->estoque_minimo=$request->get('estoque_minimo');
		$produto->descricao=$request->get('descricao');
        $produto->preco_compra= str_replace(',','.',str_replace('.','',$request->get('preco_compra')));
        $produto->preco_venda=str_replace(',','.',str_replace('.','',$request->get('preco_venda')));
    	
    	//$categoria->condicao=$request->get('condicao');
    	$produto->update();
        flash('Produto atualizado com sucesso.')->success();
    	return Redirect::to('produto/produto');
    }

    public function destroy($id){
    	$produto=Produto::findOrFail($id);
    	$produto->status='Inativo';
    	$produto->update();
        flash('Produto removido com sucesso.')->success();
    	return Redirect::to('produto/produto');
    }
}
