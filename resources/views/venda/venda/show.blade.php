@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		<label for="nome">Cliente</label>
			<p>{{$venda->nome}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		<label>Tipo Pagamento</label>
			<p>{{$venda->tipo_pagamento}}</p>
		</div>
	</div>	
</div>     
<div class="row">
	<div class="panel panel-primary" style="margin-left: 16px; width: 97%;">
		<div class="panel-body">
			<div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
				<table id="detalhes" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						<th>Produtos</th>
						<th>Quantidade</th>
						<th>Preço Venda</th>
						<th>Desconto</th>                        
						<th>Total</th>
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th id="total">{{$venda->total_venda}}</th>     
					</tfoot>
					<tbody>
						@foreach($detalhes as $det)
						<tr>
							<td>{{$det->produto}}</td>
							<td>{{$det->quantidade}}</td>
							<td>{{$det->preco_venda}}</td>
							<td>{{$det->desconto}}</td>
							<td>{{$det->quantidade*$det->preco_venda}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
@stop