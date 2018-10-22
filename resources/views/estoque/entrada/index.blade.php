@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Entradas</h3>
		<a  href="entrada/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar entrada</a>
		@include('estoque.entrada.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Data e hora</th>
					<th>Fornecedor</th>
					<th>Tipo Pagamento</th>
					<th>Total</th>
					<th>Ações</th>
				</thead>
				@foreach ($entradas as $ent)
				<tr>					
					<td><?php echo date('d/m/Y H:i:s', strtotime($ent->data_hora)); ?></td>
					<td>{{ $ent->nome}}</td>
					<td>{{ $ent->tipo_pagamento}}</td>
					<td>R$ <?php echo number_format($ent->total, 2, ',', '.') ?></td>					
					<td>
					<a href="{{URL::action('EntradaController@show',$ent->id_entrada)}}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar"><span class="glyphicon glyphicon-search"></span></a>
					</td>
				</tr>
				@include('estoque.entrada.modal')
				@endforeach
			</table>
		</div>
		{{$entradas->render()}}
	</div>
</div>
@stop