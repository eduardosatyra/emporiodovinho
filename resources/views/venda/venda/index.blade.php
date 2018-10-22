@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Vendas</h3>
		<a  href="venda/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar venda</a>
		@include('venda.venda.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
					<th>Data</th>
					<th>Cliente</th>
					<th>Tipo de Pagamento</th>					
					<th>Total</th>					
					<th>Ações</th>
				</thead>
				
               @foreach ($vendas as $ven)
				<tr>					
					<td><?php echo date('d/m/Y H:i:s', strtotime($ven->data_hora)); ?></td>
					<td>{{ $ven->nome}}</td>
					<td>{{ $ven->tipo_pagamento}}</td>
					<td>R$ <?php echo number_format($ven->total_venda, 2, ',', '.') ?></td>					
				<td>
					<a href="{{URL::action('VendaController@show',$ven->id_venda)}}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar"><span class="glyphicon glyphicon-search"></span></a>
					</td>
				</tr>
				@include('venda.venda.modal')
				@endforeach
			</table>
		</div>
		{{$vendas->render()}}
	</div>
</div>
@stop