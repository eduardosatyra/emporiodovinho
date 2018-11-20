<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Categoria;
use Illuminate\Support\Facades\Redirect;
use DB;
use Validator;
use Illuminate\Validation\Rule;


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

    public function store(Request $request){
        $categorias = DB::table('categoria')
                    ->where('nome', 'LIKE', '%'.$request->nome.'%')
                    ->where('condicao', '=', '0')
                    ->first();
        if (!empty($categorias)) {            
            $categoria=Categoria::findOrFail($categorias->id_categoria);
            $categoria->condicao = 1;
            $categoria->update();
            flash('Categoria cadastrada com sucesso.')->success();
            return Redirect::to('produto/categoria');
        } else {
            $validator = Validator::make($request->all(), [
                'nome'=>'required|max:256|unique:categoria',
            ]);
        }
                
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
    	$categoria = new Categoria;
    	$categoria->nome=$request->get('nome');
    	$categoria->condicao='1';
    	$categoria->save();
        flash('Categoria cadastrada com sucesso.')->success();
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

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nome' => [
                'max:256',
                'required',
                Rule::unique('categoria')->ignore($id, 'id_categoria'),
            ],         
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nome=$request->get('nome');
    	$categoria->update();
        flash('Categoria atualizada com sucesso.')->success();
    	return Redirect::to('produto/categoria');
    }

    public function destroy($id){
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condicao='0';
    	$categoria->update();
        flash('Categoria removida com sucesso.')->success();
    	return Redirect::to('produto/categoria');
    }
}
