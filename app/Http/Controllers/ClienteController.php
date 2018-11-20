<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Cliente;
use Illuminate\Support\Facades\Redirect;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{

    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request->get('searchText')){
            $query=trim($request->get('searchText'));
            $clientes=DB::table('cliente')
            ->where('nome', 'LIKE', '%'.$query.'%')
            ->orwhere('num_doc', 'LIKE', '%'.$query.'%')
            ->where('status', '=', 'Ativo')
            ->orderBy('id_cliente', 'desc')
            ->paginate(10);
            return view('cliente.cliente.index', [
                "clientes"=>$clientes, "searchText"=>$query
                ]);
        }

        $clientes=DB::table('cliente')            
            ->where('status', '=', 'Ativo')
            ->orderBy('id_cliente', 'desc')
            ->paginate(10);
            return view('cliente.cliente.index', [
                "clientes"=>$clientes, "searchText"=>''
                ]);
    }

    public function create(){
    	return view("cliente.cliente.create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nome'=>'required|max:100',
            'tipo_documento'=>'required|max:20',
            'num_doc'=> 'required|max:20|unique:cliente',
            'telefone'=> 'max:20',
            'email' => 'max:100'
        ]);        
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$cliente = new Cliente;
        $cliente->fill($request->all());
        $cliente->save();
        if($request->get('venda')){
            return redirect()->back();
        }
        flash('Cliente cadastrado com sucesso.')->success();
        return Redirect::to('cliente/cliente');
    	
    }

    public function show($id){
    	return view("cliente.cliente.show",
    		["cliente"=>Cliente::findOrFail($id) ]);
    }

    public function edit($id){
    	return view("cliente.cliente.edit",
    		["cliente"=>Cliente::findOrFail($id) ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nome'=>'required|max:100',            
            'tipo_documento'=>'required|max:20',
            'email'=>'max:100',
            'telefone'=>'max:20'   ,     
            'num_doc' => [
                'required','max:20',
                Rule::unique('cliente')->ignore($id, 'id_cliente'),
            ],         
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$cliente=Cliente::findOrFail($id);
    	$cliente->nome=$request->get('nome');
    	$cliente->tipo_documento=$request->get('tipo_documento');
    	$cliente->num_doc=$request->get('num_doc');
    	$cliente->telefone=$request->get('telefone');
    	$cliente->email=$request->get('email');
    	$cliente->update();
        flash('Cliente atualizado com sucesso.')->success();
    	return Redirect::to('cliente/cliente');
    }

    public function destroy($id){
    	$cliente=Cliente::findOrFail($id);
    	$cliente->status='Inativo';
    	$cliente->update();
        flash('Cliente removido com sucesso.')->success();
    	return Redirect::to('cliente/cliente');
    }
    }
