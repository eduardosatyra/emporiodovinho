<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\Cliente;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController extends Controller
{
    
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $clientes=DB::table('cliente')
            ->where('nome', 'LIKE', '%'.$query.'%')
            ->orwhere('num_doc', 'LIKE', '%'.$query.'%')
            ->orderBy('id_cliente', 'desc')
            ->paginate(7);
            return view('cliente.cliente.index', [
                "clientes"=>$clientes, "searchText"=>$query
                ]);
        }
    }

    public function create(){
    	return view("cliente.cliente.create");
    }

    public function store(ClienteFormRequest $request){
    	$cliente = new Cliente;
    	$cliente->nome=$request->get('nome');
    	$cliente->tipo_documento=$request->get('tipo_documento');
    	$cliente->num_doc=$request->get('num_doc');
        $cliente->sexo=$request->get('sexo');
    	$cliente->endereco=$request->get('endereco');
    	$cliente->telefone=$request->get('telefone');
    	$cliente->email=$request->get('email');
        $cliente->status=$request->get('status');
    	$cliente->save();
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

    public function update(ClienteFormRequest $request, $id){
    	$cliente=Cliente::findOrFail($id);
    	$cliente->nome=$request->get('nome');
    	$cliente->tipo_documento=$request->get('tipo_documento');
    	$cliente->num_doc=$request->get('num_doc');
    	$cliente->endereco=$request->get('endereco');
    	$cliente->telefone=$request->get('telefone');
    	$cliente->email=$request->get('email');
        $cliente->status=$request->get('status');
    	$cliente->update();
    	return Redirect::to('cliente/cliente');
    }

    public function destroy($id){
    	$cliente=Cliente::findOrFail($id);
    	$cliente->status='Inativo';
    	$cliente->update();
    	return Redirect::to('cliente/cliente');
    }
    }
