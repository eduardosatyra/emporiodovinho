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

        if($request->get('searchText')){
            $query=trim($request->get('searchText'));
            $fornecedor=DB::table('fornecedor')            
            ->orWhere('nome', 'LIKE', '%'.$query.'%')           
            ->orWhere('num_doc', 'LIKE', '%'.$query.'%')
            ->where('status', '=', 'Ativo')
            ->orderBy('id_fornecedor', 'desc')
            ->paginate(10);            
            return view('fornecedor.fornecedor.index', [
                "fornecedor"=>$fornecedor, "searchText"=>$query
                ]);
        }
           
            $fornecedor=DB::table('fornecedor')
            ->where('status', '=', 'Ativo')
            ->orderBy('id_fornecedor', 'desc')
            ->paginate(10);            
            return view('fornecedor.fornecedor.index', [
                "fornecedor"=>$fornecedor, "searchText"=>''
                ]);
       
    }

    public function create(){
    	return view("fornecedor.fornecedor.create");
    }

    public function store(FornecedorFormRequest $request){        
    	$fornecedor = new Fornecedor;
        $data = $request->all();
        $fornecedor->fill($data);
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
    	$fornecedor=Fornecedor::findOrFail($id);
        $data = $request->all();
        $fornecedor->fill($data);
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
