<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Pessoa;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\PessoaFormRequest;
use DB;

class FornecedorController extends Controller {
    
    public function __construct(){
    	//
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $pessoas=DB::table('pessoa')
            ->where('nome', 'LIKE', '%'.$query.'%')
            ->where('tipo_pessoa', '=', 'Fornecedor')
            ->orwhere('num_doc', 'LIKE', '%'.$query.'%')
            ->where('tipo_pessoa', '=', 'Fornecedor')
            ->orderBy('id_pessoas', 'desc')
            ->paginate(7);
            return view('compra.fornecedor.index', [
                "pessoas"=>$pessoas, "searchText"=>$query
                ]);
        }
    }

    public function create(){
    	return view("compra.fornecedor.create");
    }

    public function store(PessoaFormRequest $request){
    	$pessoa = new Pessoa;
    	$pessoa->tipo_pessoa='Fornecedor';
    	$pessoa->nome=$request->get('nome');
    	$pessoa->tipo_documento=$request->get('tipo_documento');
    	$pessoa->num_doc=$request->get('num_doc');
    	$pessoa->endereco=$request->get('endereco');
    	$pessoa->telefone=$request->get('telefone');
    	$pessoa->email=$request->get('email');
    	$pessoa->save();
    	return Redirect::to('compra/fornecedor');
    }

    public function show($id){
    	return view("compra.fornecedor.show",
    		["pessoa"=>Pessoa::findOrFail($id) ]);
    }

    public function edit($id){
    	return view("compra.fornecedor.edit",
    		["pessoa"=>Pessoa::findOrFail($id) ]);
    }

    public function update(PessoaFormRequest $request, $id){
    	$pessoa=Pessoa::findOrFail($id);    	
    	$pessoa->tipo_pessoa='Fornecedor';
    	$pessoa->nome=$request->get('nome');
    	$pessoa->tipo_documento=$request->get('tipo_documento');
    	$pessoa->num_doc=$request->get('num_doc');
    	$pessoa->endereco=$request->get('endereco');
    	$pessoa->telefone=$request->get('telefone');
    	$pessoa->email=$request->get('email');
    	$pessoa->update();
    	return Redirect::to('compra/fornecedor');
    }

    public function destroy($id){
    	$pessoa=Pessoa::findOrFail($id);
    	$pessoa->tipo_pessoa='Inativo';
    	$pessoa->update();
    	return Redirect::to('compra/fornecedor');
    }
}
