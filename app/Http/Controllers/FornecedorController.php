<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Fornecedor;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\FornecedorFormRequest;
use DB;
use Validator;
use Illuminate\Validation\Rule;

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

    public function store(Request $request){   
        $validator = Validator::make($request->all(), [
            'nome'=>'required|max:100',
            'tipo_documento'=>'max:20',
            'num_doc'=> 'max:20|unique:fornecedor|required',
            'endereco'=> 'max:100',
            'telefone'=> 'max:20|unique:fornecedor',       
            'email'=> 'max:50|unique:fornecedor',
            'status'=> 'required',
            'cep'=> 'max:12',
            'endereco'=> 'max:255',
            'bairro'=> 'max:255',
            'cidade'=> 'max:255',
            'estado'=> 'max:255',
            'complemento'=> 'max:255'
        ]);        
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$fornecedor = new Fornecedor;
        $data = $request->all();
        $fornecedor->fill($data);
    	$fornecedor->save();
        flash('Fornecedor cadastrado com sucesso.')->success();
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

    public function update(Request $request, $id){
         $validator = Validator::make($request->all(), [
            'nome'=>'required|max:100',
            'tipo_documento'=>'max:20',            
            'endereco'=> 'max:100',           
            'status'=> 'required',
            'cep'=> 'max:12',
            'endereco'=> 'max:255',
            'bairro'=> 'max:255',
            'cidade'=> 'max:255',
            'estado'=> 'max:255',
            'complemento'=> 'max:255',      
            'num_doc' => [
                'required','max:20',
                Rule::unique('fornecedor')->ignore($id, 'id_fornecedor'),
            ],
            'email' => [
                'max:100',
                 Rule::unique('fornecedor')->ignore($id, 'id_fornecedor'),
            ],
            'telefone' => [
                'max:20',
                 Rule::unique('fornecedor')->ignore($id, 'id_fornecedor'),
            ]          
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$fornecedor=Fornecedor::findOrFail($id);
        $data = $request->all();
        $fornecedor->fill($data);
    	$fornecedor->update();
        flash('Fornecedor atualizado com sucesso.')->success();
    	return Redirect::to('fornecedor/fornecedor');
    }

    public function destroy($id){       
    	$fornecedor=Fornecedor::findOrFail($id);
    	$fornecedor->status='Inativo';
    	$fornecedor->update();
        flash('Fornecedor removido com sucesso.')->success();
    	return Redirect::to('fornecedor/fornecedor');
    }
}
