<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('estoque/categoria', 'CategoriaController');
Route::resource('estoque/produto', 'ProdutoController');
Route::resource('venda/cliente', 'ClienteController');
Route::resource('compra/fornecedor', 'FornecedorController');
Route::resource('compra/entrada', 'EntradaController');
Route::resource('venda/venda', 'VendaController');
Route::get('venda/consultaEstoque', 'VendaController@consultaEstoque');

