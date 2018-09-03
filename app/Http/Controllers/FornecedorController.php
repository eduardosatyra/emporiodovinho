<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Fornecedor;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\FornecedorFormRequest;
use DB;

class FornecedorController extends Controller {
    
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $fornecedor=DB::table('fornecedor')
            ->where('nome', 'LIKE', '%'.$query.'%')
            ->orwhere('num_doc', 'LIKE', '%'.$query.'%')
            ->orderBy('id_fornecedor', 'desc')
            ->paginate(7);
            return view('fornecedor.fornecedor.index', [
                "fornecedor"=>$fornecedor, "searchText"=>$query
                ]);
        }
    }

    public function create(){
    	return view("fornecedor.fornecedor.create");
    }

    public function store(FornecedorFormRequest $request){
    	$fornecedor = new Fornecedor;
    	$fornecedor->nome=$request->get('nome');
    	$fornecedor->tipo_documento=$request->get('tipo_documento');
    	$fornecedor->num_doc=$request->get('num_doc');
    	$fornecedor->endereco=$request->get('endereco');
    	$fornecedor->telefone=$request->get('telefone');
    	$fornecedor->email=$request->get('email');
        $fornecedor->sexo=$request->get('sexo');
        $fornecedor->status=$request->get('status');
    	$fornecedor->save();
    	return Redirect::to('fornecedor/fornecedor');
    }

    public function show($id){
    	return view("fornecedor.fornecedor.show",
    		["fornecedor"=>Fornecedor::findOrFail($id) ]);
    }

    public function edit($id){
    	return view("fornecedor.fornecedor.edit",
    		["fornecedor"=>Fornecedor::findOrFail($id) ]);
    }

    public function update(FornecedorFormRequest $request, $id){
    	$pessoa=Pessoa::findOrFail($id);    	
    	$fornecedor->nome=$request->get('nome');
        $fornecedor->tipo_documento=$request->get('tipo_documento');
        $fornecedor->num_doc=$request->get('num_doc');
        $fornecedor->endereco=$request->get('endereco');
        $fornecedor->telefone=$request->get('telefone');
        $fornecedor->email=$request->get('email');
        $fornecedor->sexo=$request->get('sexo');
        $fornecedor->status=$request->get('status');
    	$fornecedor->update();
    	return Redirect::to('fornecedor/fornecedor');
    }

    public function destroy($id){
    	$fornecedor=Fornecedor::findOrFail($id);
    	$fornecedor->status='Inativo';
    	$fornecedor->update();
    	return Redirect::to('fornecedor/fornecedor');
    }
}
