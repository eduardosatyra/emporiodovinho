@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Entradas <a href="entrada/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('compra.entrada.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Data</th>
					<th>Fornecedor</th>
					<th>Tipo Comprovante</th>					
					<th>Taxa</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opções</th>
				</thead>
				@foreach ($entradas as $ent)
				<tr>
					<td>{{ $ent->data_hora}}</td>
					<td>{{ $ent->nome}}</td>
					<td>{{ $ent->tipo_comprovante. ' - ' . $ent->serie_comprovante. ' - ' .$ent->num_comprovante}}</td>
					<td>{{ $ent->taxa}}</td>
					<td>{{ $ent->total}}</td>
					<td>{{ $ent->estado}}</td>
					<td>					
						<a href="{{URL::action('EntradaController@show',$ent->id_entrada)}}"><button class="btn btn-info">Detalhes</button></a>
						<a href="" data-target="#modal-delete-{{$ent->id_entrada}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('compra.entrada.modal')
				@endforeach
			</table>
		</div>
		{{$entradas->render()}}
	</div>
</div>
@stop