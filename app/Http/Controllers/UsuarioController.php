<?php

namespace emporiodovinho\Http\Controllers;

use Illuminate\Http\Request;
use emporiodovinho\User;
use Illuminate\Support\Facades\Redirect;
use emporiodovinho\Http\Requests\UsuarioFormRequest;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller {
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('users')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->paginate(7);
            return view('usuario.usuario.index', [
                "usuarios"=>$usuarios, "searchText"=>$query
                ]);
        }
    }

     public function create(){
    	return view("usuario.usuario.create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', 
        ]);        
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$usuario = new User;
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));    
    	$usuario->save();
        flash('Usuário cadastrado com sucesso.')->success();  
    	return Redirect::to('usuario/usuario');
    }

    public function edit($id){
    	return view("usuario.usuario.edit",
    		["usuario"=>User::findOrFail($id) ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed', 
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],          
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$usuario=User::findOrFail($id);
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
    	$usuario->update();
        flash('Usuário atualizado com sucesso.')->success();  
    	return Redirect::to('usuario/usuario');
    }

    public function destroy($id){
    	$usuario=User::findOrFail($id);
        $usuario = DB::table('users')->where('id', '=', $id)->delete();
        flash('Usuário removido com sucesso.')->success();  
        return Redirect::to('usuario/usuario');
    }
}

