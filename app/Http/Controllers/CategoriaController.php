<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Categoria;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\CategoriaFormRequest;
use DB;


class CategoriaController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categoria')
            ->where('nome', 'LIKE', '%'.$query.'%')
            ->where('condicao', '=', '1')
            ->orderBy('id_categoria', 'desc')
            ->paginate(7);
            return view('produto.categoria.index', [
                "categorias"=>$categorias, "searchText"=>$query
                ]);
        }
    }

    public function create(){
    	return view("produto.categoria.create");
    }

    public function store(CategoriaFormRequest $request){
    	$categoria = new Categoria;
    	$categoria->nome=$request->get('nome');
    	$categoria->descricao=$request->get('descricao');
    	$categoria->condicao='1';
    	$categoria->save();
    	return Redirect::to('produto/categoria');
    }

    public function show($id){
    	return view("produto.categoria.show",
    		["categoria"=>Categoria::findOrFail($id) ]);
    }

    public function edit($id){
    	return view("produto.categoria.edit",
    		["categoria"=>Categoria::findOrFail($id) ]);
    }

    public function update(CategoriaFormRequest $request, $id){
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nome=$request->get('nome');
    	$categoria->descricao=$request->get('descricao');
    	//$categoria->condicao=$request->get('condicao');
    	$categoria->update();
    	return Redirect::to('produto/categoria');
    }

    public function destroy($id){
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condicao='0';
    	$categoria->update();
    	return Redirect::to('produto/categoria');
    }
}
