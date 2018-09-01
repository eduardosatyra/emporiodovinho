@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Vendas <a href="venda/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('venda.venda.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Data</th>
					<th>Cliente</th>					
					<th>Total</th>					
					<th>Opções</th>
				</thead>
				
               @foreach ($vendas as $ven)
				<tr>
					<td>{{ $ven->id_venda}}</td>
					<td>{{ $ven->data_hora}}</td>
					<td>{{ $ven->nome}}</td>
					<td>{{ $ven->total_venda}}</td>
				<td>					
					<a href="{{URL::action('VendaController@show',$ven->id_venda)}}"><button class="btn btn-info">Detalhes</button></a>
                    <a href="" data-target="#modal-delete-{{$ven->id_venda}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
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