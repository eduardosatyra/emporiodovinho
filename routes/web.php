<?php

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('produto/categoria', 'CategoriaController');
Route::resource('produto/produto', 'ProdutoController');
Route::resource('cliente/cliente', 'ClienteController');
Route::resource('fornecedor/fornecedor', 'FornecedorController');
Route::resource('estoque/entrada', 'EntradaController');
Route::resource('estoque/saida', 'SaidaController');
Route::resource('venda/venda', 'VendaController');
Route::resource('usuario/usuario', 'UsuarioController');
Route::get('relatorios/vendas', 'RelatorioController@index');
Route::get('relatorios/produtos', 'RelatorioController@produtos');
Route::get('relatorios/vendas/cliente', 'RelatorioController@vendasCliente');
Route::post('relatorios/vendas/cliente', 'RelatorioController@buscaVendasCliente');



Route::auth();

Auth::routes();
Route::get('/venda/venda', 'VendaController@index');
Route::get('/logout', 'Auth\LoginController@logout');

